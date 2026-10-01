<?php
/**
 * =====================================================================
 *  VERIFIKASI AKHIR — SI ULT POLBAN
 * =====================================================================
 *
 *  Mengecek dua hal:
 *   A. Semua dashboard memakai tema yang sama
 *      (shell + design system + tanpa <style> liar + tanpa CDN).
 *   B. Alur inti tiap role masih bisa dibuka (HTTP 200, tanpa error PHP).
 *
 *  Pakai:  php tools/verify.php
 *  Hasil:  tools/_verify.txt
 */
$BASE    = 'http://localhost:8080/index.php';
$OUT     = __DIR__ . '/_verify.txt';
$JAR     = __DIR__ . '/_verify_jar';
$PASSWORD = 'Polban123';

$lines = [];
function say(string $s): void
{
    global $lines;
    $lines[] = $s;
    file_put_contents(__DIR__ . '/_verify.txt', implode("\n", $lines));
}

function req(string $url, string $jar, bool $post = false, array $data = []): array
{
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 5,
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_CONNECTTIMEOUT => 8,
        CURLOPT_COOKIEJAR      => $jar,
        CURLOPT_COOKIEFILE     => $jar,
    ]);
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    $body   = (string) curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ['status' => $status, 'body' => $body];
}

function errors(string $html): string
{
    $checks = [
        'FATAL'     => '/Fatal error/i',
        'UNCAUGHT'  => '/Uncaught\s+(Exception|Error|Throwable)/i',
        'CI-ERROR'  => '/An Error was encountered|Whoops!/i',
        'SQL'       => '/SQLSTATE\[|DatabaseException/i',
        'UNDEFINED' => '/Undefined (variable|array key|index|property)/i',
        'DEPRECATED'=> '/Deprecated:/i',
    ];
    foreach ($checks as $tag => $re) {
        if (preg_match($re, $html)) {
            return $tag;
        }
    }
    return '';
}

/**
 * Sidik jari seluruh blok <style> pada sebuah halaman.
 * Kalau dua dashboard punya sidik jari berbeda, berarti salah
 * satunya menyisipkan gaya sendiri (tema jadi tidak seragam).
 */
function styleSignature(string $html): string
{
    preg_match_all('#<style[^>]*>(.*?)</style>#s', $html, $m);

    $css = implode("\n", $m[1]);

    return md5($css);
}

$phase = $argv[1] ?? 'all';

/* ------------------------------------------------------------------ */
$accounts = [
    'superadmin' => ['superadmin@polban.ac.id', '/akademik/dashboard'],
    'adminult'   => ['adminult@polban.ac.id',   '/admin/dashboard'],
    'petugasult' => ['petugasult@polban.ac.id', '/petugas/dashboard'],
    'unit'       => ['unittujuan@polban.ac.id', '/unit/dashboard'],
    'pimpinan'   => ['pimpinan@polban.ac.id',   '/pimpinan/dashboard'],
    'mahasiswa'  => ['mhs@polban.ac.id',        '/mahasiswa/dashboard'],
    'dosen'      => ['dosen@polban.ac.id',      '/dosen/dashboard'],
    'tendik'     => ['tendik@polban.ac.id',     '/tendik/dashboard'],
    'alumni'     => ['alumni@polban.ac.id',     '/alumni/dashboard'],
    'mitra'      => ['mitra@polban.ac.id',      '/mitra/dashboard'],
    'wali'       => ['wali@polban.ac.id',       '/orangtua/dashboard'],
    'umum'       => ['umum@polban.ac.id',       '/umum/dashboard'],
];

$fail      = 0;
$signatures = [];

say('=== VERIFIKASI TEMA & ALUR KERJA ===');
say('Waktu: ' . date('Y-m-d H:i:s'));
say('');

foreach ($accounts as $tag => [$email, $dash]) {
    if ($phase !== 'all' && $phase !== 'roles') {
        break;
    }
    $jar = $JAR . '_' . $tag;
    @unlink($jar);

    $login = req($BASE . '/login', $jar, true, ['email' => $email, 'password' => $PASSWORD]);
    $r     = req($BASE . $dash, $jar);
    $html  = $r['body'];
    $err   = errors($html);
    $in    = preg_match('/Keluar|logout/i', $html) ? 'YA' : 'TIDAK';

    $shell  = preg_match('/class="main-sidebar/', $html) ? 'ya' : 'TIDAK';
    $tema   = preg_match('/assets\/css\/ult-dashboard\.css/', $html) ? 'ya' : 'TIDAK';

    // Gaya harus IDENTIK di semua dashboard: hanya boleh ada blok
    // milik shell bersama (_sidebar_style, _navbar_style) + debug toolbar.
    // Kalau ada view yang menyisipkan palet sendiri, tandanya berbeda.
    $signature = styleSignature($html);
    $styleCount = preg_match_all('/<style/i', $html);

    $cdn = preg_match('#<script[^>]+src="https?://(cdn|cdnjs|unpkg|ajax\.googleapis|fonts\.googleapis)#i', $html)
        ? 'ADA(!)' : 'tidak';

    $ok = ($r['status'] === 200 && $err === '' && $shell === 'ya' && $tema === 'ya'
        && $cdn === 'tidak' && $in === 'YA');

    if (! $ok) {
        $fail++;
    }

    $sig = substr($signature, 0, 8);
    $signatures[$sig] = ($signatures[$sig] ?? 0) + 1;

    say(sprintf(
        '%-11s %-22s %3d %-9s shell=%-6s tema=%-6s style=%d sig=%s cdn=%-8s %s',
        $tag, $dash, $r['status'], $err ?: 'OK', $shell, $tema, $styleCount, $sig, $cdn,
        $ok ? 'OK' : '<== PERIKSA'
    ));
}

/* Style signature harus sama persis di semua dashboard. */
$jumlahVarian = count($signatures);
if ($jumlahVarian > 1) {
    $fail++;
    say('');
    say("!! TEMA TIDAK SERAGAM: ada {$jumlahVarian} varian gaya antar dashboard:");
    foreach ($signatures as $sig => $n) {
        say("     {$sig} -> {$n} halaman");
    }
} else {
    say('');
    say('Gaya identik di semua dashboard (1 varian).');
}

/* ------------------------------------------------------------------ */
/* 2. Semua dashboard unit yang boleh diakses admin                   */
/* ------------------------------------------------------------------ */
say('');
say('--- dashboard unit (akses admin) ---');

$unitDashboards = [
    '/dashboard', '/admin/dashboard', '/akademik/dashboard', '/jurusan/dashboard',
    '/kemahasiswaan/dashboard', '/keuangan/dashboard', '/perpustakaan/dashboard',
    '/upt-tik/dashboard', '/administrasi-umum/dashboard', '/petugas/dashboard',
    '/unit/dashboard', '/pimpinan/dashboard', '/mahasiswa/dashboard', '/dosen/dashboard',
    '/tendik/dashboard', '/alumni/dashboard', '/mitra/dashboard',
    '/orangtua/dashboard', '/umum/dashboard',
];

$jarAdmin = $JAR . '_s_adminult';
if ($phase === 'all' || $phase === 'dash') {
    @unlink($jarAdmin);
    req($BASE . '/login', $jarAdmin, true, ['email' => 'adminult@polban.ac.id', 'password' => $PASSWORD]);

    foreach ($unitDashboards as $u) {
        $r     = req($BASE . $u, $jarAdmin);
        $err   = errors($r['body']);
        $shell = preg_match('/class="main-sidebar/', $r['body']) ? 'ya' : 'TIDAK';
        $sig   = substr(styleSignature($r['body']), 0, 8);

        if ($r['status'] !== 200 || $err !== '' || $shell === 'TIDAK') {
            $fail++;
        }

        say(sprintf('  %-30s %3d %-9s shell=%-6s sig=%s', $u, $r['status'], $err ?: 'OK', $shell, $sig));
    }
}

/* ------------------------------------------------------------------ */
/* 3. Halaman umum (tanpa login)                                       */
/* ------------------------------------------------------------------ */
say('');
say('--- halaman publik ---');
foreach (['/', '/login/form', '/registration-request', '/services', '/tracking', '/faqs'] as $u) {
    if ($phase !== 'all' && $phase !== 'public') {
        break;
    }
    $r   = req($BASE . $u, $JAR . '_pub');
    $err = errors($r['body']);
    if ($r['status'] >= 400 || $err !== '') {
        $fail++;
    }
    say(sprintf('  %-24s %3d %s', $u, $r['status'], $err ?: 'OK'));
}

/* ------------------------------------------------------------------ */
/* Ringkasan                                                           */
/* ------------------------------------------------------------------ */
say('');
say('=== RINGKASAN ===');
say($fail === 0
    ? 'SEMUA LULUS — tema seragam, tidak ada error PHP, tidak ada CDN liar.'
    : "ADA {$fail} HALAMAN YANG PERLU DICERMATI.");

file_put_contents($OUT, implode("\n", $lines));
echo "Selesai. Laporan: {$OUT} (gagal: {$fail})\n";