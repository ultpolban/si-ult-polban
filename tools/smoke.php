<?php

/**
 * =====================================================================
 *  SMOKE TEST LIVE — SI ULT POLBAN
 * =====================================================================
 *
 *  Login memakai akun demo (lihat DemoUserSeeder) lalu memanggil
 *  seluruh URL dashboard / halaman utama untuk memastikan:
 *      - status HTTP 200
 *      - tidak ada error PHP (fatal / uncaught / undefined / SQL)
 *      - shell layout (sidebar + navbar) ikut ter-render
 *
 *  Pakai:  php tools/smoke.php
 *  Hasil:  tools/_smoke/report.txt  (+ snapshot halaman yang error)
 */

declare(strict_types=1);

$BASE    = 'http://localhost:8080/index.php';
$OUTDIR  = __DIR__ . '/_smoke';
$PASSWORD = 'Polban123';

if (! is_dir($OUTDIR)) {
    mkdir($OUTDIR, 0777, true);
}

$accounts = [
    'superadmin' => 'superadmin@polban.ac.id',
    'adminult'   => 'adminult@polban.ac.id',
    'petugasult' => 'petugasult@polban.ac.id',
    'unittujuan' => 'unittujuan@polban.ac.id',
    'pimpinan'   => 'pimpinan@polban.ac.id',
    'mhs'        => 'mhs@polban.ac.id',
    'dosen'      => 'dosen@polban.ac.id',
    'tendik'     => 'tendik@polban.ac.id',
    'alumni'     => 'alumni@polban.ac.id',
    'mitra'      => 'mitra@polban.ac.id',
    'wali'       => 'wali@polban.ac.id',
    'umum'       => 'umum@polban.ac.id',
];

$targets = [
    '/dashboard',
    '/admin/dashboard',
    '/mahasiswa/dashboard',
    '/dosen/dashboard',
    '/tendik/dashboard',
    '/alumni/dashboard',
    '/mitra/dashboard',
    '/orangtua/dashboard',
    '/umum/dashboard',
    '/akademik/dashboard',
    '/jurusan/dashboard',
    '/kemahasiswaan/dashboard',
    '/keuangan/dashboard',
    '/perpustakaan/dashboard',
    '/upt-tik/dashboard',
    '/administrasi-umum/dashboard',
    '/petugas/dashboard',
    '/unit/dashboard',
    '/pimpinan/dashboard',
];

/**
 * Jalankan satu request GET dengan cookie jar per akun.
 */
function req(string $base, string $url, ?string &$cookieFile, string $jarDir, bool $postLogin = false, array $post = []): array
{
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $base . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 5,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_COOKIEJAR      => $jarDir . '/' . basename((string) $cookieFile),
        CURLOPT_COOKIEFILE     => $jarDir . '/' . basename((string) $cookieFile),
        CURLOPT_USERAGENT      => 'ULT-SmokeTest/1.0',
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER         => false,
    ]);
    if ($postLogin) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    }
    $body   = curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err    = curl_error($ch);
    curl_close($ch);

    return [
        'status' => $status,
        'body'   => (string) $body,
        'error'  => $err,
    ];
}

/**
 * Deteksi jejak error PHP / query pada body HTML.
 */
function detectError(string $html): string
{
    $patterns = [
        'FATAL'      => '/Fatal error/i',
        'UNCAUGHT'   => '/Uncaught\s+(Exception|Error|Throwable)/i',
        'CI-ERROR'   => '/An Error was encountered|Whoops!|An unexpected error occurred/i',
        'ENCODING'   => '/htmlspecialchars\(\)|htmlspecialchars\(\): Passing null/i',
        'SQL'        => '/SQLSTATE\[|DatabaseException|mysql error/i',
        'UNDEFINED'  => '/Undefined (variable|array key|index|property)/i',
        'TYPE'       => '/must be of type|Argument \d+ must be/i',
        'DEPRECATED' => '/Deprecated:/i',
        'VIEW-ERR'   => '/CodeIgniter\\\\Exceptions\\\\(PageNotFound|RedirectException)|<\/p>\s*<pre/i',
    ];
    foreach ($patterns as $tag => $re) {
        if (preg_match($re, $html)) {
            return $tag;
        }
    }

    return '';
}

$report   = [];
$problems = [];

foreach ($accounts as $tag => $email) {
    $jar = $tag;
    @unlink($OUTDIR . '/' . $jar);

    $login = req($BASE, '/login', $jar, $OUTDIR, true, [
        'email'    => $email,
        'password' => $PASSWORD,
    ]);

    // Pastikan benar-benar masuk: ambil halaman depan, cek ada navbar.
    $probe = req($BASE, '/', $jar, $OUTDIR);
    $loggedIn = (bool) preg_match('/logout|Keluar/i', $probe['body']);

    if (! $loggedIn) {
        $problems[] = sprintf('%-12s LOGIN GAGAL (%d)', $tag, $login['status']);
    }

    foreach ($targets as $url) {
        $r    = req($BASE, $url, $jar, $OUTDIR);
        $html = $r['body'];
        $err  = $r['error'] !== '' ? 'CURL-ERR' : detectError($html);

        $shell = preg_match('/id="sidebar"|class="main-sidebar"|<nav/i', $html) ? 'shell' : '-';

        $row = sprintf('%-12s %-30s %3d %-10s %-6s %7d', $tag, $url, $r['status'], $err ?: 'OK', $shell, strlen($html));
        $report[] = $row;

        if ($r['status'] !== 200 || $err !== '' || ! $loggedIn) {
            $problems[] = $row;
            if ($err !== '' || $r['status'] !== 200) {
                $safe = preg_replace('/[^a-z0-9]+/i', '_', $tag . '_' . $url);
                file_put_contents($OUTDIR . '/ERR_' . $safe . '.html', $html);
            }
        }
    }
}

$summary = sprintf(
    "TOTAL: %d | MASALAH: %d | Tanggal: %s",
    count($report),
    count($problems),
    date('Y-m-d H:i:s')
);

$out = "=== SMOKE TEST SI ULT POLBAN ===\n{$summary}\n\n"
     . "--- SELURUH HALAMAN ---\n" . implode("\n", $report)
     . "\n\n--- HANYA YANG BERMASALAH ---\n"
     . ($problems ? implode("\n", $problems) : '(tidak ada — semua OK)') . "\n";

file_put_contents($OUTDIR . '/report.txt', $out);

echo $summary . "\n";
echo "Report: {$OUTDIR}/report.txt\n";
if ($problems) {
    echo "\n" . implode("\n", $problems) . "\n";
}
