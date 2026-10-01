<?php
/**
 * =====================================================================
 *  PEMERIKSA KEBOCORAN PHP + PALET LIRAL — SI ULT POLBAN
 * =====================================================================
 *
 *  Dua jenis masalah yang tidak biasanya ketahuan sendiri:
 *
 *  1. KOMENTAR BOCOR
 *     PHP hanya mengenali komentar di dalam blok PHP. Kalau "/** ..."
 *     ditulis SETELAH tag penutup, seluruh tulisan itu tercetak sebagai
 *     teks junk di atas halaman. Tanda pastinya: ada "/*" di mode HTML
 *     yang tidak pernah ditutup.
 *
 *  2. PALET LIRAL
 *     Yang bikin halaman terlihat beda bukan warna dekoratif, tapi
 *     variabel IDENTITAS tema yang ditulis ulang dengan warna literal
 *     (--ult-navy, --polban-navy, --ult-orange, ...).
 *
 *  Pakai: php tools/php_leak.php
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

/**Ada pembuka komentar yang tidak ditutup di dalam HTML. */
function hasUnclosedComment(string $html): ?int
{
    $offset = 0;

    while (($open = strpos($html, '/*', $offset)) !== false) {
        $before = $open === 0 ? "\n" : $html[$open - 1];

        // Bukan awal token -> bagian dari nilai atribut (mis. image/*)
        if (ctype_alnum($before) || $before === '"' || $before === "'") {
            $offset = $open + 2;
            continue;
        }

        $close = strpos($html, '*/', $open + 2);
        if ($close === false) {
            return $open;
        }

        $offset = $close + 2;
    }

    return null;
}

$identityTokens = [
    '--ult-navy', '--ult-navy-dark', '--ult-navy-light',
    '--ult-primary', '--ult-primary-light',
    '--ult-orange', '--ult-border', '--ult-bg', '--ult-card-bg',
    '--polban-navy', '--polban-blue', '--polban-orange', '--soft-bg',
];

// Halaman error berdiri sendiri, palet merGsinya memang wajar.
$standalone = ['app/Views/errors/'];

$views = rglobPhp($root . '/app/Views');
$leaks = [];
$palettes = [];

foreach ($views as $f) {
    $rel = str_replace($root . '/', '', $f);
    $src = file_get_contents($f);

    foreach (@token_get_all($src) as $t) {
        // Yang benar-benar dicetak ke browser hanyalah T_INLINE_HTML.
        if (! is_array($t) || $t[0] !== T_INLINE_HTML) {
            continue;
        }

        $text = $t[1];

        $at = hasUnclosedComment($text);
        if ($at !== null) {
            $line = $t[2] + substr_count(substr($text, 0, $at), "\n");
            $leaks[] = sprintf('%-46s baris %-5d %s', $rel, $line, trim(substr($text, $at, 50)));
        }

        if (preg_match_all('#<style[^>]*>(.*?)</style>#si', $text, $blocks)) {
            foreach ($blocks[1] as $css) {
                if (! preg_match('/:root\s*\{([^}]*)\}/is', $css, $rm)) {
                    continue;
                }

                foreach ($standalone as $skip) {
                    if (str_starts_with($rel, $skip)) {
                        continue 2;
                    }
                }

                foreach ($identityTokens as $token) {
                    $re = '/' . preg_quote($token, '/') . '\s*:\s*(#[0-9a-f]{3,8}|rgba?\()/i';
                    if (preg_match($re, $rm[1], $hit)) {
                        $palettes[] = sprintf('%-46s %s = %s', $rel, $token, trim($hit[1]));
                    }
                }
            }
        }
    }
}

echo "=== 1. KOMENTAR PHP YANG BOCOR KE HALAMAN ===\n";
if ($leaks === []) {
    echo "  (bersih)\n";
} else {
    foreach ($leaks as $l) {
        echo "  !! {$l}\n";
    }
}

echo "\n=== 2. PALET LITERAL (halaman terlihat beda) ===\n";
$palettes = array_values(array_unique($palettes));

if ($palettes === []) {
    echo "  (bersih)\n";
} else {
    foreach ($palettes as $p) {
        echo "  !! {$p}\n";
    }
}

printf(
    "\n=== RINGKASAN ===\nView diperiksa : %d\nKebocoran      : %d\nPalet literal : %d\n",
    count($views),
    count($leaks),
    count(array_unique($palettes))
);