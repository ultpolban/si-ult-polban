<?php
/**
 * Samakan SEMUA logo di halaman auth & dashboard memakai file logo
 * POLBAN yang sama (assets/img/logo-polban.png).
 *
 * Sebelumnya sebagian halaman masih memakai assets/img/logo.svg
 * (placeholder kotak biru "ULT") sehingga tema terlihat tidak seragam.
 *
 * Jalankan: php tools/unify_logo.php
 */

$root = dirname(__DIR__);

/** @var array<string, string> $replacements pasangan sumber => tujuan */
$replacements = [];

// 1) Ganti src logo.svg -> logo-polban.png
$replacements['logo.svg'] = 'logo-polban.png';

// 2) Hapus atribut width/height hardcoded pada <img> logo agar
//    ukurannya dikendalikan sepenuhnya oleh CSS.
$views = [];

$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root . '/app/Views')
);

foreach ($it as $f) {
    if (! $f->isFile() || $f->getExtension() !== 'php') {
        continue;
    }

    $views[] = $f->getPathname();
}

sort($views);

$changed = 0;

foreach ($views as $file) {
    $c    = file_get_contents($file);
    $orig = $c;

    foreach ($replacements as $from => $to) {
        $c = str_replace("assets/img/$from", "assets/img/$to", $c);
    }

    // Buang atribut width/height pada <img> yang menunjuk logo POLBAN
    $c = preg_replace(
        '/(<img\b[^>]*assets\/img\/logo-polban\.png[^>]*?)\s*\n?\s*width="\d+"/i',
        '$1',
        $c
    );

    $c = preg_replace(
        '/(<img\b[^>]*assets\/img\/logo-polban\.png[^>]*?)\s*\n?\s*height="\d+"/i',
        '$1',
        $c
    );

    if ($c !== $orig) {
        file_put_contents($file, $c);
        echo 'UPDATED ' . str_replace($root . '/', '', $file) . PHP_EOL;
        $changed++;
    }
}

echo PHP_EOL . "Total file diperbarui: {$changed}" . PHP_EOL;
