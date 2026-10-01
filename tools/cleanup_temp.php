<?php
/**
 * =====================================================================
 *  PEMBERSIHAN BERKAS SEMENTARA — SI ULT POLBAN
 * =====================================================================
 *
 *  Menghapus seluruh berkas kerja sementara yang dibuat perkakas
 *  (_verify.txt, _*.txt, cookie jar, _smoke/, _backup/) sehingga
 *  folder tools/ hanya berisi perkakas yang memang berguna.
 *
 *  Pakai:  php tools/cleanup_temp.php
 */
$keep = [
    // Pemeriksa
    'verify.php',          // verifikasi tema + alur kerja tiap role
    'smoke.php',           // smoke test seluruh halaman
    'php_leak.php',        // kebocoran komentar PHP + palet liar
    'css_structure.php',   // blok CSS tersesat di dalam aturan
    'css_components.php',  // komponen wajib yang hilang
    'css_lint.php',        // kurung kurawal + var() tak terdefinisi
    'viewclasses.php',     // class view yang belum punya CSS
    'pagecheck.php',       // isi elemen penting sebuah halaman
    'pagecheck2.php',      // halaman yang paletunya diubah

    // Perbaikan
    'fix_palette.php',     // seragamkan :root antar halaman
    'cleanup.php',         // hapus file mati (butuh --apply)
    'cleanup_temp.php',
    'build_css.php',
    'fetch_vendor.php',    // unduh pustaka lokal
    'strip_style.php',     // buang <style> liar dari view
    'slice.php',
    'make_transparent_logo.php',
    'unify_logo.php',
    'css_audit.php',
];

$removed = 0;
$freed   = 0;

/*
 * Aturan aman: HANYA berkas yang namanya diawali "_" (berkas kerja
 * sementara) yang dihapus. Perkakas dan berkas proyek tidak akan
 * tersentuh walau daftar $keep lupa diperbarui.
 */
foreach (scandir(__DIR__) as $e) {
    if ($e === '.' || $e === '..') continue;
    if (! str_starts_with($e, '_')) continue;

    $path = __DIR__ . '/' . $e;

    if (is_file($path)) {
        $freed += filesize($path);
        unlink($path);
        $removed++;
        echo "  dihapus  {$e}\n";
        continue;
    }

    if (is_dir($path)) {
        $n = iterator_count(new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)
        ));
        $freed += $n;
        $rm = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($rm as $item) {
            $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
        }
        rmdir($path);
        $removed += $n;
        echo "  dihapus  {$e}/ ({$n} berkas)\n";
    }
}

printf("\n%d berkas sementara dihapus (%s byte)\n", $removed, number_format($freed, 0, ',', '.'));