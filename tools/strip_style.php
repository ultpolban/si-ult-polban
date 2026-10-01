<?php
/**
 * Menghapus blok <style>...</style> dari sebuah view.
 * Pakai: php tools/strip_style.php <view.php>
 */
$file = $argv[1];
$src  = file_get_contents($file);

$new = preg_replace('#\n?<style[^>]*>.*?</style>\s*#s', "\n\n", $src, -1, $count);

if ($count === 0) {
    echo "Tidak ada blok <style> di {$file}\n";
    exit;
}

file_put_contents($file, $new);
echo "Menghapus {$count} blok <style> dari {$file}\n";
echo "Ukuran: " . strlen($src) . " -> " . strlen($new) . " byte\n";