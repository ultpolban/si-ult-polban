<?php
/**
 * Cek urutan cascade untuk aturan yang bisa saling menimpa.
 *
 * Fokus pada .g-* / .gap-*: di AdminLTE 3 (Bootstrap 4) .row sudah punya
 * gutter lewat padding kolom, jadi gap TIDAK boleh dipakai pada .row.
 * Kalau .g-3 menang, kartu terakhir turun ke baris berikutnya.
 */
$root = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$css  = (string) file_get_contents($root . '/public/assets/css/ult-dashboard.css');
$css  = preg_replace('#/\*.*?\*/#s', '', $css);

/** Hitung posisi (index karakter) sebuah blok CSS. */
function blockPos(string $css, string $needle): int
{
    $p = strpos($css, $needle);
    return $p === false ? -1 : $p;
}

$gap      = blockPos($css, '.g-3, .gap-3 {');
$rowGap   = blockPos($css, '.row.g-1, .row.gap-1,');

echo "=== URUTAN ATURAN GAP ===\n";
printf(".g-3, .gap-3        : posisi %d\n", $gap);
printf(".row.g-* (override) : posisi %d\n\n", $rowGap);

if ($gap === -1 || $rowGap === -1) {
    echo "!! Salah satu aturan tidak ditemukan.\n";
    exit(1);
}
/*
 * Untuk override menang, aturan .row.g-* harus ditulis SESUDAH .g-*.
 * (Selain itu, spesifisitas .row.g-3 (0,2,0) juga mengalahkan
 *  .g-3 (0,1,0), tapi urutan yang benar tetap dijaga agar aman.)
 */
$ok = $rowGap > $gap;

echo $ok
    ? "OK — .row.g-* ditulis SESUDAH .g-*, jadi overrides-nya menang.\n"
    : "!! SALAH — .row.g-* ditulis sebelum .g-*, sehingga gap tetap aktif\n"
      . "   pada .row dan kartu terakhir turun ke baris berikutnya.\n";

/* Apakah masih ada .row yang bisa mendapat gap dari selector lain? */
echo "\n=== CEK LANGSUNG: .row dengan gap ===\n";
preg_match_all('/\.row[^{,]*\b(g|gap)-[1-5]\b[^{]*\{[^}]*\}/i', $css, $m);

$withoutOverride = [];
foreach ($m[0] as $rule) {
    if (strpos($rule, 'gap: 0') === false && strpos($rule, 'gap:0') === false) {
        $withoutOverride[] = trim(preg_replace('/\s+/', ' ', $rule));
    }
}

if ($withoutOverride === []) {
    echo "(tidak ada .row yang mendapat gap selain override)\n";
} else {
    foreach ($withoutOverride as $r) {
        echo "  !! {$r}\n";
    }
}