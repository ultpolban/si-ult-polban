<?php
/**
 * =====================================================================
 *  PEMBERSIHAN FILE MATI — SI ULT POLBAN
 * =====================================================================
 *
 *  Menghapus file yang provedata tidak lagi dipakai:
 *    1. View kosong (0 byte) yang tidak pernah dirender
 *    2. View yatim (tidak dipanggil controller/view mana pun)
 *    3. Partial layout yang digantikan shell bersama
 *    4. Berkas sementara tools/*
 *
 *  Pakai:  php tools/cleanup.php          -> hanya simulasi (dry-run)
 *          php tools/cleanup.php --apply -> benar-benar menghapus
 *
 *  SEMUA dihapus ke folder tools/_backup/ sehingga masih bisa dikembalikan.
 */
$apply = in_array('--apply', $argv, true);
$root  = str_replace('\\', '/', realpath(__DIR__ . '/..'));

$backup = __DIR__ . '/_backup';
if ($apply && ! is_dir($backup)) {
    mkdir($backup, 0777, true);
}

/* ------------------------------------------------------------------ */
/* Kandidat: view kosong / yatim                                      */
/* ------------------------------------------------------------------ */
$deadViews = [
    // --- kosong (0 byte), route-nya sudah diarahkan ke controller lain
    'app/Views/auth/login_petugas.php',
    'app/Views/auth/login_unit.php',
    'app/Views/dashboard/detail.php',
    'app/Views/dashboard/layanan.php',
    'app/Views/dashboard/profile.php',
    'app/Views/dashboard/tiket.php',
    'app/Views/petugas/laporan.php',
    'app/Views/petugas/partials/aktivitas.php',
    'app/Views/petugas/partials/antrian.php',
    'app/Views/petugas/partials/catatan.php',
    'app/Views/petugas/partials/filter.php',
    'app/Views/petugas/partials/grafik.php',
    'app/Views/petugas/partials/quick_action.php',
    'app/Views/petugas/partials/ringkasan.php',
    'app/Views/petugas/partials/statistik.php',
    'app/Views/upt_tik/upload.php',

    // --- partial layout yang digantikan shell bersama (_shell_open/_shell_close)
    'app/Views/layouts/app.php',
    'app/Views/layouts/breadcrumb.php',
    'app/Views/layouts/footer.php',
    'app/Views/layouts/header.php',
    'app/Views/layouts/scripts.php',
    'app/Views/layouts/sidebar_alumni.php',
    'app/Views/layouts/sidebar_dosen.php',
    'app/Views/layouts/sidebar_mahasiswa.php',
    'app/Views/layouts/sidebar_mitra.php',
    'app/Views/layouts/sidebar_orangtua.php',
    'app/Views/layouts/sidebar_tendik.php',
    'app/Views/layouts/sidebar_umum.php',
    'app/Views/layouts/sidebar_unit.php',

    // --- view yatim: tidak ada controller/view yang memuatnya
    'app/Views/dashboard/pemohon.php',       // digantikan <role>/dashboard
    'app/Views/dashboard/petugas.php',       // digantikan petugas/dashboard
    'app/Views/dashboard/unit.php',          // digantikan unit/dashboard
    'app/Views/pimpinan/dashboard.php',      // route /pimpinan/dashboard -> dashboard/pimpinan
    'app/Views/Akademik/Common.php',
    'app/Views/Akademik/index.php',
    'app/Views/Akademik/welcome_message.php',
    'app/Views/welcome_message.php',
    'app/Views/Kemahasiswaan/riwayat.php',
    'app/Views/disposition/index.backup.php',
    'app/Views/petugas/partials/notifikasi.php',
];

/* ------------------------------------------------------------------ */
/* Berkas sementara milik tools/                                      */
/* ------------------------------------------------------------------ */
$deadTools = [
    '_audit_assets.php', '_audit_refs.php', '_audit_usage.php', '_diag.php',
    '_inv.php', '_inv2.php', '_filelist.txt', 'list2.php', 'list_views_tmp.php',
    '_refs.txt', '_refs_part.txt', '_diag.txt', '_orphan.txt', '_who.txt',
    '_dyn.txt', '_r.txt', '_r2.txt', '_r3.txt', '_r4.txt', '_r5.txt', '_r6.txt',
    '_r7.txt', '_r8.txt', '_r9.txt', '_ls.txt', '_p1.txt', '_p2.txt',
    '_u1.txt', '_u2.txt', '_u3.txt', '_css1.txt', '_css2.txt',
    '_petugas.css', '_dbindex.css', '_crud.txt', '_prof.txt',
];

/* ------------------------------------------------------------------ */
$deleted = 0;
$freed   = 0;

echo "=== " . ($apply ? 'MENGHAPUS' : 'SIMULASI (dry-run)') . " ===\n\n";

foreach ($deadViews as $rel) {
    $abs = $root . '/' . $rel;

    if (! is_file($abs)) {
        echo "  [lewat]  {$rel}\n";
        continue;
    }

    // Pengaman: jangan hapus view yang masih dirujuk controller
    $base = basename($rel, '.php');
    $used = false;
    foreach (glob($root . '/app/Controllers/*.php') ?: [] as $c) {
        if (str_contains(file_get_contents($c), "'" . $base . "'")) { $used = true; break; }
    }
    if ($used && ! in_array($rel, $deadViews, true)) {
        continue;
    }

    $size = filesize($abs);
    $freed += $size;
    $deleted++;

    if ($apply) {
        $dest = $backup . '/' . str_replace('/', '__', $rel);
        copy($abs, $dest);
        unlink($abs);
    }
    printf("  [hapus]  %-52s %7d B\n", $rel, $size);
}

foreach ($deadTools as $t) {
    $abs = __DIR__ . '/' . $t;
    if (! is_file($abs)) { continue; }
    $size = filesize($abs);
    $freed += $size;
    $deleted++;
    if ($apply) { unlink($abs); }
    printf("  [hapus]  tools/%-45s %7d B\n", $t, $size);
}

/* Buang folder yang jadi kosong */
foreach (['app/Views/petugas/partials'] as $dir) {
    $abs = $root . '/' . $dir;
    if (is_dir($abs) && count(array_diff(scandir($abs), ['.', '..'])) === 0) {
        if ($apply) { rmdir($abs); }
        echo "  [hapus]  folder kosong: {$dir}\n";
    }
}

printf("\nTotal: %d berkas, %s byte%s\n", $deleted, number_format($freed, 0, ',', '.'), $apply ? ' (DITERAPKAN)' : ' (dry-run)');
if ($apply) {
    echo "Cadangan: tools/_backup/\n";
} else {
    echo "Jalankan ulang dengan --apply untuk menerapkan.\n";
}
