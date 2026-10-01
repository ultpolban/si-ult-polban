<?php

/**
 * =====================================================================
 *  AUDIT CSS — SI ULT POLBAN
 * =====================================================================
 *
 *  Mengambil seluruh class= yang dipakai view lalu mengecek apakah
 *  class tersebut punya definisi di stylesheet yang benar-benar dimuat
 *  oleh halaman (lihat layouts/head.php).
 *
 *  Pakai:  php tools/css_audit.php [path-view]
 *          php tools/css_audit.php            -> seluruh app/Views
 *          php tools/css_audit.php app/Views/mahasiswa/dashboard.php
 *
 *  Hasil: daftar class kustom yang TIDAK punya CSS (kandidat bug/tema).
 */

declare(strict_types=1);

$root = dirname(__DIR__);

/** Gaya yang dimuat layouts/head.php (urutannya penting). */
$loadedCss = [
    'adminlte/css/adminlte.min.css',
    'css/ult-dashboard.css',
    'css/theme-polban.css',
    'css/petugas.css',
    'css/table.css',
    'css/responsive.css',
    'css/ult-select.css',
];

/** Utility class bawaan AdminLTE / Bootstrap yang tidak perlu didefinisikan ulang. */
$vendorPrefix = [
    'col', 'd-', 'flex', 'justify-', 'align-', 'text-', 'bg-', 'border', 'rounded',
    'm-', 'mt-', 'mb-', 'ml-', 'mr-', 'mx-', 'my-', 'p-', 'pt-', 'pb-', 'pl-', 'pr-',
    'px-', 'py-', 'w-', 'h-', 'shadow', 'font-', 'fw-', 'text-', 'badge', 'btn',
    'card', 'row', 'container', 'form-', 'input-', 'nav', 'navbar', 'dropdown',
    'table', 'progress', 'list-', 'media', 'jumbotron', 'alert', 'modal', 'close',
    'sr-only', 'stretched-', 'position-', 'float-', 'fixed-', 'sticky-', 'top-',
    'bottom-', 'start-', 'end-', 'gap-', 'order-', 'overflow-', 'cursor-',
    'visually-', 'clearfix', 'collapse', 'show', 'hidden', 'active', 'disabled',
    'd-none', 'img-', 'embed-', 'figure-', 'pre-', 'code', 'kbd', 'blockquote',
    'breadcrumb', 'pagination', 'page-item', 'page-link', 'spinner-', 'toast',
    'accordion', 'carousel', 'custom-', 'was-validated', 'valid-', 'invalid-',
    'small-box', 'info-box', 'direct-', 'card-', 'callout', 'control-sidebar',
    'main-sidebar', 'sidebar-', 'layout-', 'wrapper', 'content-wrapper', 'site-',
    'login-', 'register-', 'lockscreen', 'iframe', 'kull', 'mailbox-', 'chat-',
    'timeline-', 'map-container', 'products-', 'price-', 'nav-pills', 'nav-tabs',
];

/* ------------------------------------------------------------------ */
/* 1. Kumpulkan class dari CSS yang dimuat                             */
/* ------------------------------------------------------------------ */
$cssBuffer = '';
foreach ($loadedCss as $rel) {
    $file = $root . '/public/assets/' . $rel;
    if (is_file($file)) {
        $cssBuffer .= "\n/* FILE: {$rel} */\n" . (string) file_get_contents($file);
    } else {
        fwrite(STDERR, "WARN: stylesheet tidak ditemukan: {$rel}\n");
    }
}

$defined = [];
if (preg_match_all('/\.(-?[_a-zA-Z][\w-]*)/', $cssBuffer, $m)) {
    foreach ($m[1] as $cls) {
        $defined[strtolower($cls)] = true;
    }
}
// Kumpulkan juga nama class dari ruleset `class="a b c"` gaya CSS lama? tidak perlu.

/* ------------------------------------------------------------------ */
/* 2. Target view                                                      */
/* ------------------------------------------------------------------ */
$target = $argv[1] ?? ($root . '/app/Views');
$files  = [];
if (is_file($target)) {
    $files[] = $target;
} elseif (is_dir($target)) {
    $dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($target));
    foreach ($dir as $f) {
        if ($f->isFile() && str_ends_with($f->getFilename(), '.php')) {
            $files[] = $f->getPathname();
        }
    }
}
sort($files);

$unusedByView = [];   // class => [view]
$totalClasses = 0;

foreach ($files as $file) {
    $html = (string) file_get_contents($file);
    $seen = [];
    if (! preg_match_all('/class\s*=\s*"([^"]+)"/', $html, $mm)) {
        continue;
    }
    foreach ($mm[1] as $raw) {
        // buang ekspresi php di dalam atribut
        $raw = preg_replace('/<\?php.*?\?>|\<?=.*?\?>/s', ' ', $raw);
        foreach (preg_split('/\s+/', trim($raw)) ?: [] as $cls) {
            if ($cls === '' || $cls === '$') {
                continue;
            }
            // class hasil interpolasi variabel -> lewati
            if (preg_match('/[\$>{}]/', $cls)) {
                continue;
            }
            $totalClasses++;
            $lower = strtolower($cls);
            $seen[$lower] = true;
        }
    }
    foreach (array_keys($seen) as $cls) {
        if (isset($defined[$cls])) {
            continue;
        }
        $skip = false;
        foreach ($vendorPrefix as $p) {
            if ($p !== '' && (str_starts_with($cls, $p) || str_contains($cls, '-' . $p))) {
                $skip = true;
                break;
            }
        }
        if ($skip) {
            continue;
        }
        $unusedByView[$cls][] = str_replace(str_replace('\\', '/', $root) . '/', '', str_replace('\\', '/', $file));
    }
}

/* ------------------------------------------------------------------ */
/* 3. Laporan                                                           */
/* ------------------------------------------------------------------ */
ksort($unusedByView);

echo "=== AUDIT CSS ===\n";
echo "File view dicek : " . count($files) . "\n";
echo "Class diimpor   : {$totalClasses}\n";
echo "Class kustom tanpa CSS : " . count($unusedByView) . "\n\n";

foreach ($unusedByView as $cls => $views) {
    $sample = array_slice(array_values(array_unique($views)), 0, 4);
    printf("  .%-34s (%d view)  %s\n", $cls, count(array_unique($views)), implode(', ', $sample));
}
