<?php
// Pemotong file sederhana: php tools/slice.php <file> <startLine> <jumlah> [outfile]
[$s, $file, $start, $count, $out] = array_pad($argv, 5, null);
$lines   = file($file, FILE_IGNORE_NEW_LINES);
$slice   = array_slice($lines, ((int) $start) - 1, (int) $count);
$content = implode("\n", $slice);
if ($out) {
    file_put_contents($out, $content);
    echo "ok -> {$out}\n";
} else {
    echo $content, "\n";
}
