<?php
// php tools/viewclasses.php <view.php> [view2.php ...]
//                     php tools/viewclasses.php            -> semua view dashboard

$css = '';
$sheets = array_merge(
    glob(__DIR__ . '/../public/assets/css/*.css'),
    [
        __DIR__ . '/../public/assets/adminlte/css/adminlte.min.css',
        __DIR__ . '/../public/assets/adminlte/plugins/fontawesome-free/css/all.min.css',
        __DIR__ . '/../public/assets/adminlte/plugins/select2/css/select2.min.css',
    ]
);
foreach ($sheets as $f) {
    if (is_file($f)) {
        $css .= file_get_contents($f);
    }
}

$targets = array_slice($argv, 1);
if ($targets === []) {
    foreach (glob(__DIR__ . '/../app/Views/*/dashboard.php') as $f) {
        $targets[] = $f;
    }
    $targets[] = __DIR__ . '/../app/Views/dashboard/index.php';
}

$missing = [];

foreach ($targets as $file) {
    $html = file_get_contents($file);

    preg_match_all('/class\s*=\s*["\']([^"\']+)["\']/', $html, $m);

    $seen = [];
    foreach ($m[1] as $raw) {
        $raw = preg_replace('/<\?php.*?\?>|<\?=.*?\?>/s', ' ', $raw);
        foreach (preg_split('/\s+/', trim($raw)) as $c) {
            if ($c === '' || preg_match('/[\$>{}=]/', $c)) continue;
            $c = strtolower($c);
            if (isset($seen[$c])) continue;
            $seen[$c] = true;

            if (preg_match('/\.' . preg_quote($c, '/') . '(?![\w-])/i', $css)) continue;

            if (! isset($missing[$c])) $missing[$c] = [];
            $missing[$c][] = basename($file);
        }
    }
}

ksort($missing);

echo "=== CLASS VIEW TANPA CSS ===\n";
echo 'Total class bermasalah: ' . count($missing) . "\n\n";

foreach ($missing as $c => $files) {
    printf("  .%-28s (%d) %s\n", $c, count($files), implode(', ', array_slice(array_unique($files), 0, 3)));
}