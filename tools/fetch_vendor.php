<?php
// Unduh pustaka sekali ke folder vendor lokal.
// Dipakai: php tools/fetch_vendor.php
$targets = [
    [
        'url'  => 'https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js',
        'dest' => __DIR__ . '/../public/assets/vendor/chart.umd.min.js',
    ],
    [
        'url'  => 'https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js',
        'dest' => __DIR__ . '/../public/assets/vendor/xlsx.full.min.js',
    ],
];

if (! is_dir(dirname($targets[0]['dest']))) {
    mkdir(dirname($targets[0]['dest']), 0777, true);
}

foreach ($targets as $t) {
    if (is_file($t['dest']) && filesize($t['dest']) > 10000) {
        echo "SKIP (sudah ada): {$t['dest']} (" . filesize($t['dest']) . " B)\n";
        continue;
    }

    $ch = curl_init($t['url']);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $body  = curl_exec($ch);
    $err   = curl_error($ch);
    $code  = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($body === false || $code !== 200 || strlen($body) < 5000) {
        echo "GAGAL ({$code}) {$t['url']} :: {$err}\n";
        continue;
    }

    file_put_contents($t['dest'], $body);
    echo "OK  " . basename($t['dest']) . " (" . strlen($body) . " B)\n";
}
