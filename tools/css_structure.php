<?php
/**
 * =====================================================================
 *  PEMERIKSA STRUKTUR CSS — SI ULT POLBAN
 * =====================================================================
 *
 *  css_lint.php hanya menghitung kurung kurawal. Itu tidak cukup:
 *  kalau sebuah blok sisipkan di TENGAH aturan CSS, jumlah kurawal
 *  tetap seimbang tetapi SEMUA aturan di dalamnya tidak berlaku,
 *  karena CSS tidak mendukung nesting gaya itu. Gejalanya: halaman
 *  tampil tanpa gaya dan tidak ada pesan error apa pun.
 *
 *  Di sini dihitung "masalah" = membuka blok baru (selector atau
 *  at-rule) sementara masih berada di dalam sebuah selector.
 *
 *  Pakai: php tools/css_structure.php [file.css]
 */
$root = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$file = $argv[1] ?? ($root . '/public/assets/css/ult-dashboard.css');

if (! is_file($file)) {
    exit("Berkas tidak ditemukan: {$file}\n");
}

$css = (string) file_get_contents($file);
$css = preg_replace('#/\*.*?\*/#s', '', $css);   // buang komentar

// Tumpuk: 'at' = @media / @supports (nesting di dalamnya WAJAR)
//         'rule' = selector { ... } (nesting TIDAK DIJINKAN)
$stack  = [];
$bad    = [];
$opened = null;

foreach (explode("\n", $css) as $n => $line) {
    $tokens = preg_split('/([{}])/', $line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    foreach ($tokens as $t) {
        if ($t === '{') {
            $parent = end($stack);

            if ($parent === 'rule') {
                $bad[] = sprintf('baris %-5d blok tersesat di dalam "%s"', $n + 1, $opened);
            }

            $isAt  = str_starts_with(ltrim($line), '@') || str_contains((string) $opened, '@');
            $stack[] = $isAt ? 'at' : 'rule';
            continue;
        }

        if ($t === '}') {
            array_pop($stack);
            continue;
        }

        if (trim($t) !== '' && end($stack) !== 'rule') {
            $opened = trim($t);
        }
    }
}

echo "Berkas          : {$file}\n";
echo 'Baris           : ' . (substr_count($css, "\n") + 1) . "\n";
echo 'Sisa tumpukan   : ' . count($stack) . " (harus 0)\n";
echo 'Masalah struktur: ' . count($bad) . "\n\n";

echo $bad === [] ? "  (struktur baik — tidak ada blok tersesat)\n" : '';
foreach ($bad as $b) {
    echo "  !! {$b}\n";
}