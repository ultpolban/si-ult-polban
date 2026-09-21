<?php

use App\Filters\RateLimitFilter;
use App\Filters\SanitizeInputFilter;
use App\Filters\SecurityHeadersFilter;
use App\Validation\SecurityRules;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\URI;
use CodeIgniter\HTTP\UserAgent;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Validation\ValidationInterface;
use Config\App;
use Config\Filters as FiltersConfig;

/**
 * Menguji pengerasan keamanan endpoint registrasi:
 * kebijakan password, penyaringan input (injection/XSS), dan rate limit.
 *
 * @internal
 */
final class SecurityHardeningTest extends CIUnitTestCase
{
    /**
     * Membuat request tiruan beserta payload POST tertentu.
     *
     * @param array<string, mixed> $post
     */
    private function makeRequest(string $path, array $post = [], string $method = 'POST'): IncomingRequest
    {
        $request = new IncomingRequest(
            new App(),
            new URI('http://localhost:8080/' . ltrim($path, '/')),
            '',
            new UserAgent()
        );

        $request->setMethod($method);
        $request->setGlobal('post', $post);

        return $request;
    }

    /**
     * Jalankan SanitizeInputFilter pada payload tertentu.
     *
     * @param array<string, mixed> $post
     *
     * @return mixed
     */
    private function runSanitizeFilter(array $post)
    {
        return (new SanitizeInputFilter())->before(
            $this->makeRequest('registration-request', $post)
        );
    }

    /**
     * Instance Validation baru untuk setiap pengujian.
     *
     * Validation::run() tidak mereset daftar galat (hanya reset() yang
     * melakukannya), sehingga shared service akan membawa galat dari
     * pengujian sebelumnya jika dipakai ulang.
     */
    private function freshValidation(): ValidationInterface
    {
        return \Config\Services::validation(null, false);
    }

    /**
     * Payload serangan beserta signature yang seharusnya terdeteksi.
     *
     * @return array<string, array{0: string, 1: string}>
     */
    public static function dangerousPayloadProvider(): array
    {
        return [
            'sql union select'           => ["' UNION SELECT email, password FROM users -- ", 'sql_union_select'],
            'sql tautologi kutip'        => ["' or 1=1 --", 'sql_tautology'],
            'sql stacked query'          => ["Budi'; DROP TABLE users; --", 'sql_stacked'],
            'sql time based'             => ["' OR SLEEP(5)--", 'sql_time_based'],
            'sql metadata'               => ["' UNION SELECT table_name FROM information_schema.tables", 'sql_metadata'],
            'sql outfile'                => ["' INTO OUTFILE '/tmp/x.php'", 'sql_file'],
            'sql xp_cmdshell'            => ["'; EXEC xp_cmdshell 'dir'", 'sql_xp_cmdshell'],
            'xss tag script'             => ['<script>alert(document.cookie)</script>', 'xss_tag'],
            'xss event handler'          => ['<img src=x onerror=alert(1)>', 'xss_event'],
            'xss svg payload'            => ['<svg/onload=alert(1)>', 'xss_tag'],
            'xss skema javascript'       => ['javascript:alert(1)', 'xss_scheme'],
            'command injection chain'    => ['Budi; whoami', 'cmd_chain'],
            'command injection subshell' => ['$(cat /etc/passwd)', 'cmd_subshell'],
            'path traversal'             => ['../../../../etc/passwd', 'lfi_traversal'],
            'php wrapper'                => ['php://filter/convert.base64-encode/resource=index', 'lfi_wrapper'],
            'payload ter-encode ganda'   => ['%2527%2520OR%25201%253D1--', 'sql_tautology'],
            'html entity encoding'       => ['&lt;script&gt;alert(1)&lt;/script&gt;', 'xss_tag'],
        ];
    }

    /**
     * @dataProvider dangerousPayloadProvider
     */
    public function testSanitizeFilterMenolakPayloadBerbahaya(string $payload, string $expectedSignature): void
    {
        $result = $this->runSanitizeFilter([
            'full_name' => 'Budi Santoso',
            'purpose'   => $payload,
        ]);

        $this->assertInstanceOf(
            ResponseInterface::class,
            $result,
            'Payload berbahaya harus ditolak (signature: ' . $expectedSignature . ').'
        );
        $this->assertSame(400, $result->getStatusCode());
    }

    /**
     * @dataProvider dangerousPayloadProvider
     */
    public function testSanitizeFilterTidakMenerapkanSignaturePadaPassword(string $payload, string $expectedSignature): void
    {
        // Password harus tetap utuh (tidak ditolak dan tidak diubah) karena
        // nilainya hanya di-hash dan tidak pernah masuk ke query.
        $password = 'Aa1!' . $payload;

        $request = $this->makeRequest('registration-request', [
            'full_name'             => 'Budi Santoso',
            'password'              => $password,
            'password_confirmation' => $password,
        ]);

        $result = (new SanitizeInputFilter())->before($request);

        $this->assertNotInstanceOf(ResponseInterface::class, $result);
        $this->assertSame($password, $request->getPost('password'));
        $this->assertSame($password, $request->getPost('password_confirmation'));
    }

    public function testSanitizeFilterMembersihkanTagHtmlTanpaMenolakRequest(): void
    {
        $request = $this->makeRequest('registration-request', [
            'full_name' => '<b>Budi</b> <i>Santoso</i>',
            'purpose'   => 'Perlu akses <a href="/cek-nilai">cek nilai</a>',
        ]);

        $result = (new SanitizeInputFilter())->before($request);

        $this->assertNotInstanceOf(ResponseInterface::class, $result);
        $this->assertSame('Budi Santoso', $request->getPost('full_name'));
        $this->assertSame('Perlu akses cek nilai', $request->getPost('purpose'));
    }

    public function testSanitizeFilterMenolakSkemaUriBerbahaya(): void
    {
        // Skema javascript: ditolak (bukan sekadar dibersihkan) karena
        // tidak pernah muncul pada input pengguna yang sah.
        $result = $this->runSanitizeFilter([
            'purpose' => 'Perlu akses <a href="javascript:alert(1)">cek nilai</a>',
        ]);

        $this->assertInstanceOf(ResponseInterface::class, $result);
        $this->assertSame(400, $result->getStatusCode());
    }

    public function testSanitizeFilterMembuangNullByteDanKarakterKontrol(): void
    {
        $request = $this->makeRequest('registration-request', [
            'full_name' => "Budi\0Santoso\x07",
        ]);

        $result = (new SanitizeInputFilter())->before($request);

        $this->assertNotInstanceOf(ResponseInterface::class, $result);
        $this->assertSame('BudiSantoso', $request->getPost('full_name'));
    }

    /**
     * Input sah yang TIDAK boleh ditolak maupun berubah.
     *
     * @return array<string, array{0: array<string, string>}>
     */
    public static function legitimateInputProvider(): array
    {
        return [
            'nama dengan apostrof & gelar' => [[
                'full_name'    => "O'Brien, S.T. (Alumni)",
                'address'      => 'Jl. Gegerkalong Hilir No. 1, Bandung 40113',
                'purpose'      => 'Untuk keperluan penelitian skripsi dan data 2024',
                'phone_number' => '081234567890',
                'nim'          => '221511001',
            ]],
            'nama dengan hyphen & instansi' => [[
                'full_name'        => 'Ni Made Ayu Al-Farizi M.Kom.',
                'institution_name' => 'PT. Kereta Api Indonesia (Persero)',
                'purpose'          => 'Akses data akademik & layanan surat menyurat',
                'address'          => 'Kampus Polban, Jl. Gegerkalong Hilir',
                'position'         => 'Staf Administrasi',
            ]],
        ];
    }

    /**
     * @dataProvider legitimateInputProvider
     *
     * @param array<string, string> $payload
     */
    public function testSanitizeFilterMeloloskanInputSah(array $payload): void
    {
        $request = $this->makeRequest('registration-request', $payload);

        $result = (new SanitizeInputFilter())->before($request);

        $this->assertNotInstanceOf(ResponseInterface::class, $result);

        foreach ($payload as $field => $value) {
            $this->assertSame($value, $request->getPost($field), 'Field ' . $field . ' berubah.');
        }
    }

    public function testSanitizeFilterMembersihkanParameterGet(): void
    {
        $request = $this->makeRequest('registration-request/status', [], 'GET');
        $request->setGlobal('get', ['email' => '<b>budi</b>@example.com']);

        $result = (new SanitizeInputFilter())->before($request);

        $this->assertNotInstanceOf(ResponseInterface::class, $result);
        $this->assertSame('budi@example.com', $request->getGet('email'));
    }

    public function testSanitizeFilterMengabaikanRequestTanpaInput(): void
    {
        $request = $this->makeRequest('dashboard', [], 'GET');

        $result = (new SanitizeInputFilter())->before($request);

        $this->assertNull($result);
    }

    /**
     * @return array<string, array{0: string, 1: bool}>
     */
    public static function passwordProvider(): array
    {
        return [
            'kuat (valid)'      => ['P@ssw0rd123', true],
            'kuat (valid) #2'   => ['Polban#2024Ult', true],
            'tanpa huruf besar' => ['polban#2024x', false],
            'tanpa huruf kecil' => ['POLBAN#2024X', false],
            'tanpa angka'       => ['Polban#Raya', false],
            'tanpa simbol'      => ['Polban2024XX', false],
            'terlalu pendek'    => ['Aa1!short', false],
            'umum & lemah'      => ['password123', false],
            'hanya angka'       => ['1234567890!', false],
        ];
    }

    /**
     * @dataProvider passwordProvider
     */
    public function testKebijakanPasswordDiterapkan(string $password, bool $shouldPass): void
    {
        $validation = $this->freshValidation();
        $validation->setRules([
            'password' => [
                'label'  => 'Password',
                'rules'  => SecurityRules::password(),
                'errors' => SecurityRules::passwordErrors(),
            ],
        ]);

        $this->assertSame(
            $shouldPass,
            $validation->run(['password' => $password]),
            'Password "' . $password . '" => ' . implode(' | ', $validation->getErrors())
        );
    }

    public function testPasswordTerlaluPanjangDitolak(): void
    {
        $validation = $this->freshValidation();
        $validation->setRules([
            'password' => [
                'label'  => 'Password',
                'rules'  => SecurityRules::password(),
                'errors' => SecurityRules::passwordErrors(),
            ],
        ]);

        $this->assertFalse($validation->run(['password' => 'Aa1!' . str_repeat('x', 80)]));
        $this->assertSame('Password maksimal 72 karakter.', $validation->getError('password'));
    }

    public function testPesanGalatPasswordBerbahasaIndonesia(): void
    {
        $validation = $this->freshValidation();
        $validation->setRules([
            'password' => [
                'label'  => 'Password',
                'rules'  => SecurityRules::password(),
                'errors' => SecurityRules::passwordErrors(),
            ],
        ]);

        $validation->run(['password' => 'polban2024x']);

        $this->assertSame(
            'Password harus memuat huruf besar, huruf kecil, angka, dan simbol.',
            $validation->getError('password')
        );
    }

    public function testPasswordOpsionalMengizinkanNilaiKosong(): void
    {
        $validation = $this->freshValidation();
        $validation->setRules([
            'password' => [
                'label'  => 'Password',
                'rules'  => SecurityRules::password(false),
                'errors' => SecurityRules::passwordErrors(),
            ],
        ]);

        $this->assertTrue(
            $validation->run(['password' => '']),
            'Errors: ' . implode(' | ', $validation->getErrors())
        );
    }

    public function testValidatorRegistrasiMemakaiKebijakanPasswordBaru(): void
    {
        $rules = \App\Validation\RegistrationRequestValidator::store();

        $this->assertSame(SecurityRules::password(), $rules['password']['rules']);
        $this->assertSame(SecurityRules::passwordErrors(), $rules['password']['errors']);
        $this->assertSame('required|matches[password]', $rules['password_confirmation']['rules']);
    }

    public function testRateLimitMemblokirSetelahBatasTercapai(): void
    {
        $path   = '/login';
        $filter = new RateLimitFilter();

        foreach (range(1, 10) as $attempt) {
            $this->assertNull(
                $filter->before($this->makeRequest($path, ['field' => 'nilai']), ['10', '60']),
                'Request ke-' . $attempt . ' seharusnya masih diizinkan.'
            );
        }

        $blocked = $filter->before($this->makeRequest($path, ['field' => 'nilai']), ['10', '60']);

        $this->assertInstanceOf(ResponseInterface::class, $blocked);
        $this->assertSame(429, $blocked->getStatusCode());
        $this->assertNotSame('', $blocked->getHeaderLine('Retry-After'));

        $this->cleanupRateLimit($path);
    }

    public function testRateLimitMenghormatiArgumenFilter(): void
    {
        $path   = '/register';
        $filter = new RateLimitFilter();

        $this->assertNull($filter->before($this->makeRequest($path, ['a' => '1']), ['2', '60']));
        $this->assertNull($filter->before($this->makeRequest($path, ['a' => '1']), ['2', '60']));

        $blocked = $filter->before($this->makeRequest($path, ['a' => '1']), ['2', '60']);

        $this->assertInstanceOf(ResponseInterface::class, $blocked);
        $this->assertSame(429, $blocked->getStatusCode());

        $this->cleanupRateLimit($path);
    }

    public function testRateLimitTidakMembatasiRequestGet(): void
    {
        $path   = '/login/mfa/verify';
        $filter = new RateLimitFilter();

        foreach (range(1, 25) as $attempt) {
            $this->assertNull(
                $filter->before($this->makeRequest($path, [], 'GET'), ['2', '60']),
                'Request GET ke-' . $attempt . ' tidak boleh dibatasi.'
            );
        }
    }

    public function testRateLimitTidakMembatasiEndpointDiLuarDaftar(): void
    {
        $path   = '/dashboard';
        $filter = new RateLimitFilter();

        foreach (range(1, 20) as $attempt) {
            $this->assertNull(
                $filter->before($this->makeRequest($path, ['a' => '1']), ['1', '60']),
                'Endpoint di luar $rateLimitPaths tidak boleh dibatasi (request ' . $attempt . ').'
            );
        }
    }

    /**
     * Hapus entri cache rate limit agar tidak menumpuk di lingkungan uji.
     */
    private function cleanupRateLimit(string $path): void
    {
        $ip = $this->makeRequest($path, [])->getIPAddress();

        cache()->delete('ratelimit_' . md5(strtolower($path) . '|' . $ip));
    }

    public function testKonfigurasiFilterKeamananTerpasang(): void
    {
        $config = new FiltersConfig();

        $this->assertArrayHasKey('sanitize', $config->aliases);
        $this->assertArrayHasKey('ratelimit', $config->aliases);
        $this->assertArrayHasKey('securityheaders', $config->aliases);

        $this->assertContains('ratelimit', $config->globals['before']);
        $this->assertContains('csrf', $config->globals['before']);
        $this->assertContains('sanitize', $config->globals['before']);
        $this->assertContains('securityheaders', $config->globals['after']);

        // Rate limit WAJIB dievaluasi sebelum CSRF agar flood tanpa token
        // (yang ditolak CSRF) tetap ikut terhitung.
        $globals = $config->globals['before'];
        $this->assertLessThan(
            array_search('csrf', $globals, true),
            array_search('ratelimit', $globals, true),
            'Filter ratelimit harus berada sebelum csrf pada $globals[before].'
        );

        // Debug toolbar tidak boleh aktif.
        $this->assertNotContains('toolbar', $config->required['after']);

        $this->assertSame([
            'login',
            'login/mfa/verify',
            'register',
            'register/gate',
            'register/mfa/verify',
            'registration-request',
        ], $config->rateLimitPaths);
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function filterUriProvider(): array
    {
        return [
            'registration-request' => ['registration-request'],
            'register'             => ['register'],
            'register/gate'        => ['register/gate'],
            'login'                => ['login'],
            'login/mfa/verify'     => ['login/mfa/verify'],
            'halaman dashboard'    => ['dashboard'],
        ];
    }

    /**
     * @dataProvider filterUriProvider
     */
    public function testFilterTerpasangSesuaiUri(string $uri): void
    {
        $filters = service('filters');
        $filters->reset()->initialize($uri);

        $before = array_map(
            static fn (array $info): string => $info[0],
            $filters->getFiltersClass()['before']
        );

        $this->assertContains(CSRF::class, $before, 'Filter CSRF harus aktif pada URI ' . $uri);
        $this->assertContains(SanitizeInputFilter::class, $before, 'Sanitize harus aktif pada URI ' . $uri);
        $this->assertContains(RateLimitFilter::class, $before, 'Rate limit harus aktif pada URI ' . $uri);

        $this->assertLessThan(
            array_search(CSRF::class, $before, true),
            array_search(RateLimitFilter::class, $before, true),
            'Rate limit harus lebih dahulu daripada CSRF pada URI ' . $uri
        );

        $after = array_map(
            static fn (array $info): string => $info[0],
            $filters->getFiltersClass()['after']
        );

        $this->assertContains(SecurityHeadersFilter::class, $after, 'Header keamanan harus aktif pada URI ' . $uri);
    }

    public function testActivityLogBuildRowMenyimpanEmailTerstrukturDanMembersihkanDeskripsi(): void
    {
        $row = \App\Services\ActivityLogService::buildRow([
            'action'       => 'registration_request_created',
            'description'  => 'Permintaan izin registrasi baru dari <script>alert(1)</script>EVIL@Example.COM ',
            'module'       => 'registration_request',
            'reference_id' => 123,
            'email'        => 'EVIL@Example.COM',
            'ip_address'   => '127.0.0.1',
            'user_agent'   => 'UnitTest',
        ]);

        // Deskripsi user-controlled tidak boleh "bocor" menjadi module.
        $this->assertSame('registration_request', $row['module']);
        $this->assertSame('registration_request_created', $row['action']);

        $meta = json_decode((string) $row['new_data'], true);
        $this->assertIsArray($meta);
        $this->assertStringNotContainsString('<script>', (string) ($meta['description'] ?? ''));
        $this->assertStringContainsString('Permintaan izin registrasi baru dari', (string) ($meta['description'] ?? ''));
        $this->assertSame('evil@example.com', $meta['email'] ?? null);
    }

    public function testActivityLogBuildRowMenolakActionDanModuleBerbahaya(): void
    {
        $row = \App\Services\ActivityLogService::buildRow([
            'action' => 'LOGIN<script>',
            'module' => '../../../etc/passwd',
        ]);

        $this->assertSame('LOGINscript', $row['action']);
        $this->assertMatchesRegularExpression('/\A[A-Za-z0-9_.\-]+\z/', (string) $row['module']);
        $this->assertStringNotContainsString('/', (string) $row['module']);
    }

    public function testActivityLogBuildRowMemakaiFallbackUntukActionDanModuleKosong(): void
    {
        $row = \App\Services\ActivityLogService::buildRow([]);

        $this->assertSame('unknown', $row['action']);
        $this->assertSame('general', $row['module']);
        $this->assertNull($row['new_data']);
    }
}
