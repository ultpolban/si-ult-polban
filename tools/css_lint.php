<?php
// php tools/css_lint.php — cek CSS: kurung kurawal seimbang & var() terdefinisi
$files = glob(__DIR__ . '/../public/assets/css/*.css');
$bad   = 0;

foreach ($files as $f) {
    $css = file_get_contents($f);
    $css = preg_replace('#/\*.*?\*/#s', '', $css);          // buang komentar
    $css = preg_replace('/"[^"]*"|\'[^\']*\'/', '""', $css); // buang string

    $open  = substr_count($css, '{');
    $close = substr_count($css, '}');

    $name = basename($f);
    $ok   = $open === $close;

    printf("%-30s { = %-5d } = %-5d %s\n", $name, $open, $close, $ok ? 'OK' : '!! TIDAK SEIMBANG');

    if (! $ok) {
        $bad++;
    }
}

// Var() yang dipakai tapi tidak pernah didefinisikan
$defined = [];
$used    = [];

foreach ($files as $f) {
    $css = file_get_contents($f);

    preg_match_all('/(--[\w-]+)\s*:/', $css, $m);
    foreach ($m[1] as $v) {
        $defined[strtolower($v)] = true;
    }

    preg_match_all('/var\(\s*(--[\w-]+)/', $css, $m);
    foreach ($m[1] as $v) {
        $used[strtolower($v)] = true;
    }
}

$undef = array_diff(array_keys($used), array_keys($defined));

echo "\n";
echo 'file css      : ' . count($files) . "\n";
echo 'kerawal rusak : ' . $bad . "\n";
echo 'var tak didefinisikan : ' . count($undef) . "\n";

foreach ($undef as $v) {
    echo "  {$v}\n";
}