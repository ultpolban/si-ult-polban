<?php
/**
 * Cari halaman yang memakai kelas gap (g-* / gap-*) pada .row.
 *
 * AdminLTE 3 masih memakai Bootstrap 4: .row sudah punya gutter lewat
 * padding pada kolom. Menambah gap di atas gutter itu membuat total
 * lebar baris melebihi 100% sehingga flex-wrap menyingkirkan kartu
 * terakhir ke baris berikutnya.
 */
$root = str_replace('\\', '/', realpath(__DIR__ . '/..'));

function rglobPhp(string $dir): array
{
    $out = [];
    foreach (scandir($dir) as $e) {
        if ($e === '.' || $e === '..') continue;
        $p = $dir . '/' . $e;
        if (is_dir($p)) $out = array_merge($out, rglobPhp($p));
        elseif (strtolower(pathinfo($p, PATHINFO_EXTENSION)) === 'php') $out[] = $p;
    }
    return $out;
}

$total = 0;

foreach (rglobPhp($root . '/app/Views') as $f) {
    $rel = str_replace($root . '/app/Views/', '', $f);
    $src = file_get_contents($f);

    // <div class="row g-3 ..."> / class="row  gap-2"
    if (preg_match_all('/class="[^"]*\brow\b[^"]*\b(g|gap)-[1-5]\b[^"]*"/', $src, $m)) {
        foreach (array_unique($m[0]) as $hit) {
            $total++;
            printf("  %-44s %s\n", $rel, trim($hit));
        }
    }
}

echo "\nTotal pemakaian gap pada .row : {$total}\n";