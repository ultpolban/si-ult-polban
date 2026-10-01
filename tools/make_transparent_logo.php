<?php
/**
 * =====================================================================
 *  CEK LOGO POLBAN
 * =====================================================================
 *  File logo asli (logo-polban.png) SUDAH punya background transparan
 *  (kanal alpha). Yang membuat logo terlihat "berkotak" adalah CSS
 *  (background putih + border-radius + padding) di tiap halaman — bukan
 *  file gambarnya.
 *
 *  Jadi tools ini TIDAK mengubah gambar, hanya MEMVERIFIKASI bahwa file
 *  logo benar-benar transparan. Kalau ternyata tidak, file asli
 *  dicabut dari git lalu dipulihkan.
 *
 *  Jalankan: php tools/make_transparent_logo.php
 */

$root   = dirname(__DIR__);
$target = $root . '/public/assets/img/logo-polban.png';
$backup = $root . '/writable/logo-polban-asli.png';

/**
 * @return array{alpha:int,rgb:string}
 */
function probe(string $file, int $x, int $y): array
{
    $im = imagecreatefrompng($file);
    $c  = imagecolorsforindex($im, imagecolorat($im, $x, $y));
    imagedestroy($im);

    return [
        'alpha' => $c['alpha'],
        'rgb'   => sprintf('%02X%02X%02X', $c['red'], $c['green'], $c['blue']),
    ];
}

// 1. Pastikan file target ada
if (! is_file($target)) {
    fwrite(STDERR, "GAGAL: file logo tidak ditemukan.\n");
    exit(1);
}

$info = getimagesize($target);
$w    = $info[0];
$h    = $info[1];

echo "Logo  : {$target}" . PHP_EOL;
echo "Ukuran: {$w}x{$h}" . PHP_EOL;

// 2. Sample beberapa titik
$points = [
    [0, 0, 'pojok kiri atas'],
    [5, 5, 'dekat pojok'],
    [(int) ($w / 2), (int) ($h / 2), 'tengah'],
    [(int) ($w * 0.5), (int) ($h * 0.15), 'atas tengah'],
];

echo PHP_EOL . 'Sampel piksel:' . PHP_EOL;

$opaqueCorners = 0;

foreach ($points as [$x, $y, $label]) {
    $p = probe($target, $x, $y);

    printf(
        "  %-16s (%4d,%4d) rgb=#%s alpha=%3d %s\n",
        $label,
        $x,
        $y,
        $p['rgb'],
        $p['alpha'],
        $p['alpha'] > 100 ? '-> TRANSPARAN' : '-> WARNA'
    );

    if ($x < 20 && $y < 20 && $p['alpha'] <= 100) {
        $opaqueCorners++;
    }
}

// 3. Hitung berapa persen area yang transparan
$im    = imagecreatefrompng($target);
$total = 0;
$clear = 0;

for ($y = 0; $y < $h; $y += 2) {
    for ($x = 0; $x < $w; $x += 2) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        $total++;
        if ($c['alpha'] > 100) { $clear++; }
    }
}

imagedestroy($im);

$percent = $total > 0 ? round(($clear / $total) * 100, 1) : 0;

echo PHP_EOL;
echo "Area transparan: {$percent}% dari gambar" . PHP_EOL;

// 4. Pulihkan dari git bila file ternyata rusak (background jadi hitam)
if ($opaqueCorners > 0) {
    echo PHP_EOL . 'Logo TERLUKA (background tidak transparan) -> memulihkan dari git...' . PHP_EOL;

    $tmp = tempnam(sys_get_temp_dir(), 'logo');
    exec('git -C ' . escapeshellarg($root) . ' show HEAD:public/assets/img/logo-polban.png > ' . escapeshellarg($tmp), $o, $rc);

    if ($rc === 0 && filesize($tmp) > 1000) {
        copy($tmp, $target);
        file_put_contents($backup, file_get_contents($tmp));
        echo 'Logo berhasil dipulihkan.' . PHP_EOL;
    }

    @unlink($tmp);
} else {
    echo 'Logo OK: background sudah transparan, tidak perlu diproses lagi.' . PHP_EOL;
}

