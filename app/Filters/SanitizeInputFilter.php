<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * SanitizeInputFilter
 *
 * Pertahanan berlapis terhadap serangan injection (XSS, SQL Injection,
 * command injection, dan path traversal) untuk SELURUH input pengguna.
 *
 * Cara kerja:
 *   1. Mendeteksi signature serangan pada nilai mentah. Nilai didekode
 *      berulang (URL-encoding + HTML entity) agar payload yang disamarkan
 *      tetap terbaca. Bila terdeteksi, request DITOLAK (HTTP 400) dan
 *      percobaan tersebut dicatat ke log aplikasi.
 *   2. Membersihkan setiap nilai string: membuang null byte, karakter
 *      kontrol, komentar HTML, seluruh tag HTML, dan skema URI berbahaya
 *      sehingga payload XSS tidak pernah ikut tersimpan ke database.
 *
 * Catatan penting:
 *   - Field password TIDAK pernah diubah (harus utuh apa adanya dan selalu
 *     di-hash dengan password_hash()), demikian pula token CSRF karena
 *     sudah divalidasi oleh filter `csrf` yang berjalan lebih dulu.
 *   - Filter ini adalah lapisan tambahan. Pertahanan utama SQL Injection
 *     tetap Query Builder CodeIgniter (prepared statement) dan validasi
 *     server-side pada masing-masing validator.
 */
class SanitizeInputFilter implements FilterInterface
{
    /**
     * Field yang dilewati tanpa diubah/diperiksa.
     *
     * @var list<string>
     */
    protected array $exceptFields = [
        'password',
        'password_confirmation',
        'confirm_password',
        'current_password',
        'new_password',
        'repeat_password',
        'mfa_code',
        'recovery_code',
    ];

    /**
     * Prefix nama field yang dilewati (token CSRF, dsb).
     *
     * @var list<string>
     */
    protected array $exceptPrefixes = [
        'csrf_',
    ];

    /**
     * Signature serangan berkeyakinan tinggi sehingga risiko salah-tolak
     * (false positive) sangat kecil.
     *
     * @var array<string, string>
     */
    protected array $signatures = [
        // ---------------- SQL Injection ----------------
        'sql_union_select' => '/\bunion\b[\s\/*]+(?:all[\s\/*]+)?\bselect\b/i',
        'sql_stacked'      => '/;\s*(?:select|insert|update|delete|drop|alter|create|truncate|grant|revoke)\b/i',
        'sql_tautology'    => '/(?:^|[\s\'"`])(?:or|and)\s+[\'"`]?\d+[\'"`]?\s*=\s*[\'"`]?\d+/i',
        'sql_comment'      => '/(?:--\s|\/\*!|;\s*--)/',
        'sql_time_based'   => '/\b(?:sleep|benchmark|pg_sleep)\s*\(|\bwaitfor\s+delay\b/i',
        'sql_metadata'     => '/\b(?:information_schema|sysobjects|syscolumns|pg_catalog|mysql\.user)\b/i',
        'sql_file'         => '/\b(?:load_file|into\s+outfile|into\s+dumpfile)\b/i',
        'sql_xp_cmdshell'  => '/\bxp_cmdshell\b/i',
        'sql_hex_block'    => '/\b0x[0-9a-f]{12,}\b/i',

        // ---------------- Command Injection ----------------
        'cmd_subshell'     => '/\$\s*\([^)]{1,200}\)|`[^`]{1,200}`/',
        'cmd_chain'        => '/[;&|]\s*(?:ls|cat|whoami|id|uname|wget|curl|chmod|chown|bash|sh|nc|netcat|powershell)\b(?=\s*(?:-|$|\/|\.\/))/i',
        'cmd_pipe'         => '/\|\s*(?:nc|netcat|bash|sh|perl|python|php|ruby)\b/i',

        // ---------------- Path Traversal / LFI ----------------
        'lfi_traversal'    => '/(?:\.\.\/|\.\.\\\\|%2e%2e%2f|%2e%2e\/)/i',
        'lfi_wrapper'      => '/\b(?:php|file|data|glob|phar|zip|expect|compress\.zlib):\/\//i',
        'lfi_sensitive'    => '#(?:/etc/(?:passwd|shadow|hosts)|/proc/self/environ|[a-z]:\\\\windows\\\\|boot\.ini)#i',

        // ---------------- XSS (payload mentah) ----------------
        'xss_tag'          => '/<\s*\/?\s*(?:script|iframe|object|embed|applet|svg|math|form|meta|link|base|body|frameset|style|template)\b/i',
        'xss_event'        => '/\bon(?:error|load|click|dblclick|mouseover|mouseenter|focus|blur|submit|change|input|animationstart|transitionend|toggle|pointerover)\s*=/i',
        'xss_scheme'       => '/\b(?:javascript|vbscript|livescript)\s*:/i',
    ];

    /**
     * Dijalankan sebelum controller.
     *
     * @param list<string>|null $arguments
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $post = $request->getPost();
        $get  = $request->getGet();

        $post = is_array($post) ? $post : [];
        $get  = is_array($get) ? $get : [];

        if ($post === [] && $get === []) {
            return null;
        }

        // 1. Tolak request yang memuat signature serangan.
        $signature = $this->detect($post) ?? $this->detect($get);

        if ($signature !== null) {
            return $this->reject($request, $signature);
        }

        // 2. Netralkan payload XSS pada nilai yang tersisa.
        if ($post !== []) {
            $request->setGlobal('post', $this->sanitize($post));
        }

        if ($get !== []) {
            $request->setGlobal('get', $this->sanitize($get));
        }

        return null;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak digunakan
    }

    /**
     * Cari signature serangan pada seluruh nilai string (rekursif).
     *
     * @param array<mixed> $data
     */
    protected function detect(array $data): ?string
    {
        foreach ($data as $key => $value) {
            if (is_string($key) && $this->isExcepted($key)) {
                continue;
            }

            if (is_array($value)) {
                $hit = $this->detect($value);

                if ($hit !== null) {
                    return $hit;
                }

                continue;
            }

            if (! is_string($value) || $value === '') {
                continue;
            }

            $probe = $this->decode($value);

            foreach ($this->signatures as $name => $pattern) {
                if (preg_match($pattern, $probe) === 1) {
                    return $name;
                }
            }
        }

        return null;
    }

    /**
     * Dekode nilai berulang agar payload yang disamarkan tetap terbaca.
     */
    protected function decode(string $value): string
    {
        $probe = $value;

        for ($i = 0; $i < 3; $i++) {
            $next = html_entity_decode(rawurldecode($probe), ENT_QUOTES | ENT_HTML5);

            if ($next === $probe) {
                break;
            }

            $probe = $next;
        }

        return $probe;
    }

    /**
     * Bersihkan seluruh nilai string (rekursif).
     *
     * @param array<mixed> $data
     *
     * @return array<mixed>
     */
    protected function sanitize(array $data): array
    {
        $clean = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $clean[$key] = $this->sanitize($value);

                continue;
            }

            if (! is_string($value)) {
                $clean[$key] = $value;

                continue;
            }

            $clean[$key] = is_string($key) && $this->isExcepted($key)
                ? $value
                : $this->clean($value);
        }

        return $clean;
    }

    /**
     * Netralkan payload XSS pada satu nilai string.
     */
    protected function clean(string $value): string
    {
        // Buang null byte & karakter kontrol (sisakan tab, LF, dan CR).
        $value = (string) preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value);

        // Buang komentar HTML agar trik pemecahan tag (<scr<!-- -->ipt>) gagal.
        $value = (string) preg_replace('/<!--.*?-->/s', '', $value);

        // Buang isi <script>/<style> beserta tag pembukanya.
        $value = (string) preg_replace('#<\s*(script|style)\b[^>]*>.*?<\s*/\s*\1\s*>#is', '', $value);
        $value = (string) preg_replace('#<\s*/?\s*(script|style)\b[^>]*>#is', '', $value);

        // Buang seluruh tag HTML/XML lain.
        $value = strip_tags($value);

        // Netralkan skema URI berbahaya.
        $value = (string) preg_replace('/\b(?:javascript|vbscript|livescript)\s*:/i', '', $value);
        $value = (string) preg_replace('/\bdata\s*:\s*(?:text|application|image|audio|video|font)\b/i', '', $value);

        return trim($value);
    }

    /**
     * Apakah field dikecualikan dari pembersihan/pemeriksaan.
     */
    protected function isExcepted(string $field): bool
    {
        $field = strtolower($field);

        if (in_array($field, $this->exceptFields, true)) {
            return true;
        }

        foreach ($this->exceptPrefixes as $prefix) {
            if (str_starts_with($field, $prefix)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Tolak request dan catat percobaan injection ke log.
     */
    protected function reject(RequestInterface $request, string $signature): ResponseInterface
    {
        $referenceId = strtoupper(bin2hex(random_bytes(4)));

        log_message('warning', 'SanitizeInputFilter menolak request [ref:{ref}] signature:{signature} uri:{uri} ip:{ip} method:{method}', [
            'ref'       => $referenceId,
            'signature' => $signature,
            'uri'       => $request->getUri()->getPath(),
            'ip'        => $request->getIPAddress(),
            'method'    => $request->getMethod(),
        ]);

        $response = service('response');

        $response->setStatusCode(400)
            ->setHeader('X-Robots-Tag', 'noindex, nofollow');

        if ($request->isAJAX()) {
            return $response->setJSON([
                'status'  => 'error',
                'message' => 'Permintaan ditolak karena terindikasi mengandung data berbahaya.',
                'ref'     => $referenceId,
            ]);
        }

        return $response->setBody(view('errors/security_blocked', ['referenceId' => $referenceId]));
    }
}
