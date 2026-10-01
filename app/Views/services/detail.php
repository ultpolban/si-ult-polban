<?php
/**
 * =====================================================================
 *  DETAIL LAYANAN (publik)
 * ---------------------------------------------------------------------
 *  Halaman ini dibuka dari kartu "Paling Banyak Diakses/Digunakan"
 *  di landing page.
 *
 *  Struktur (dibuat ulang agar enak dibaca):
 *    1. Page header  : breadcrumb + judul besar + badge unit/status
 *    2. Facts strip  : 4 kartu info ringkas (unit, waktu, syarat, status)
 *    3. Kartu utama  : Deskripsi -> Persyaratan (bernomor) -> Aksi
 *    4. Sidebar      : CTA ajukan (menonjol) + bantuan + layanan lain
 *
 *  Memakai layout publik dan palet tint yang sama dengan landing page.
 * =====================================================================
 */
helper('role');

$isLoggedIn = (bool) session()->get('isLoggedIn');

// Nama unit layanan
$unitName = $unit_name ?? null;

if ($unitName === null) {
    $unitDb = \Config\Database::connect()
        ->table('master_service_units')
        ->select('name')
        ->where('id', $service['service_unit_id'] ?? 0)
        ->get()
        ->getRowArray();

    $unitName = $unitDb['name'] ?? 'Unit Layanan Terpadu';
}

// Nilai yang sering dipakai
$svcName  = trim((string) ($service['name'] ?? '')) ?: 'Layanan';
$svcDesc  = trim((string) ($service['description'] ?? ''));
$svcHours = $service['service_hours'] ?? null;
$isOnline = ! empty($service['is_online']);
$reqCount = is_array($requirements ?? null) ? count($requirements) : 0;

$statusLabel = $isOnline ? 'Dapat Diajukan Online' : 'Ajukan di Kantor';
$statusClass = $isOnline ? 'is-online' : 'is-offline';

// Ikon menyesuaikan jenis layanan (heuristic dari nama layanan)
$svcIcon = match (true) {
    (bool) preg_match('/tuition|ukt|beasiswa|pembayaran/i', $svcName) => 'bi-wallet2',
    (bool) preg_match('/kulia|khs|nilai|transkrip|ijazah/i', $svcName)    => 'bi-mortarboard',
    (bool) preg_match('/perpustakaan|buku|peminjaman/i', $svcName)       => 'bi-journals',
    (bool) preg_match('/sertifikat|legalisir|pengajuan/i', $svcName)    => 'bi-file-earmark-check',
    default                                                          => 'bi-bell-concierge',
};
?>

<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<!-- ================================================================
     1. PAGE HEADER
     ================================================================ -->
<section class="svc-hero">

    <div class="container">

        <nav aria-label="Breadcrumb" class="svc-crumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('services') ?>">Layanan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= esc($svcName) ?>
                </li>
            </ol>
        </nav>

        <div class="svc-hero-inner">

            <span class="svc-hero-icon">
                <i class="bi <?= esc($svcIcon) ?>"></i>
            </span>

            <div class="svc-hero-text">
                <span class="svc-hero-eyebrow">Detail Layanan</span>

                <h1><?= esc($svcName) ?></h1>

                <div class="svc-hero-tags">
                    <span class="svc-tag">
                        <i class="bi bi-building"></i>
                        <?= esc($unitName) ?>
                    </span>

                    <span class="svc-tag <?= esc($statusClass) ?>">
                        <i class="bi <?= $isOnline ? 'bi-wifi' : 'bi-geo-alt' ?>"></i>
                        <?= esc($statusLabel) ?>
                    </span>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- ================================================================
     2. FACTS STRIP  (melayang di atas batas header)
     ================================================================ -->
<section class="svc-facts-wrap">
    <div class="container">
        <div class="svc-facts">

            <div class="svc-fact">
                <span class="svc-fact-icon is-navy"><i class="bi bi-building"></i></span>
                <div>
                    <small>Penanggung Jawab</small>
                    <strong><?= esc($unitName) ?></strong>
                </div>
            </div>

            <div class="svc-fact">
                <span class="svc-fact-icon is-orange"><i class="bi bi-clock-history"></i></span>
                <div>
                    <small>Estimasi Penyelesaian</small>
                    <strong>
                        <?php if ($svcHours !== null && $svcHours !== ''): ?>
                            <?= esc((string) $svcHours) ?> Jam
                        <?php else: ?>
                            <span class="is-muted">Belum ditentukan</span>
                        <?php endif ?>
                    </strong>
                </div>
            </div>

            <div class="svc-fact">
                <span class="svc-fact-icon is-green"><i class="bi bi-file-earmark-text"></i></span>
                <div>
                    <small>Jumlah Persyaratan</small>
                    <strong><?= $reqCount ?> Berkas</strong>
                </div>
            </div>

            <div class="svc-fact">
                <span class="svc-fact-icon <?= $isOnline ? 'is-green' : 'is-grey' ?>">
                    <i class="bi <?= $isOnline ? 'bi-laptop' : 'bi-bank' ?>"></i>
                </span>
                <div>
                    <small>Cara Pengajuan</small>
                    <strong><?= $isOnline ? 'Online' : 'Di Kantor' ?></strong>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================================================================
     3. ISI HALAMAN
     ================================================================ -->
<section class="svc-body">
    <div class="container">
        <div class="row g-4">

            <!-- ---------- KOLOM UTAMA ---------- -->
            <div class="col-lg-8">

                <article class="svc-card">
                    <div class="svc-card-head">
                        <span class="svc-card-icon"><i class="bi bi-file-text"></i></span>
                        <h2>Tentang Layanan Ini</h2>
                    </div>

                    <div class="svc-card-body">
                        <?php if ($svcDesc !== ''): ?>
                            <p class="svc-lead"><?= esc($svcDesc) ?></p>
                        <?php else: ?>
                            <p class="svc-empty">
                                <i class="bi bi-info-circle"></i>
                                Belum ada deskripsi untuk layanan ini. Silakan hubungi
                                Unit Layanan Terpadu untuk informasi lebih lanjut.
                            </p>
                        <?php endif ?>
                    </div>
                </article>

                <article class="svc-card">
                    <div class="svc-card-head">
                        <span class="svc-card-icon is-orange"><i class="bi bi-list-check"></i></span>
                        <h2>Persyaratan</h2>
                        <span class="svc-count-badge"><?= $reqCount ?></span>
                    </div>

                    <div class="svc-card-body">
                        <?php if ($reqCount > 0): ?>
                            <p class="svc-hint">
                                Siapkan berkas berikut sebelum mengajukan layanan.
                            </p>

                            <ol class="svc-req">
                                <?php foreach ($requirements as $i => $requirement): ?>
                                    <li>
                                        <span class="svc-req-no"><?= $i + 1 ?></span>
                                        <span class="svc-req-text">
                                            <?= esc($requirement['requirement'] ?? '') ?>
                                        </span>
                                    </li>
                                <?php endforeach ?>
                            </ol>
                        <?php else: ?>
                            <p class="svc-empty">
                                <i class="bi bi-check2-circle"></i>
                                Layanan ini tidak membutuhkan berkas persyaratan khusus.
                            </p>
                        <?php endif ?>
                    </div>
                </article>

                <div class="svc-actions">
                    <?php if ($isLoggedIn): ?>
                        <a href="<?= base_url(ult_role_dashboard()) ?>" class="btn-ajukan">
                            <i class="bi bi-speedometer2"></i> Ajukan dari Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login/form') ?>" class="btn-ajukan">
                            <i class="bi bi-box-arrow-in-right"></i> Login untuk Mengajukan
                        </a>
                    <?php endif ?>

                    <a href="<?= base_url('services') ?>" class="btn-outline-soft">
                        <i class="bi bi-arrow-left"></i> Daftar Layanan Lain
                    </a>
                </div>

            </div>



            <!-- ---------- SIDEBAR ---------- -->
            <div class="col-lg-4">
                <div class="svc-side">

                    <div class="svc-cta">
                        <span class="svc-cta-icon"><i class="bi bi-send"></i></span>

                        <h3>Ajukan Layanan Ini</h3>

                        <p>
                            Pengajuan diproses oleh
                            <strong><?= esc($unitName) ?></strong>
                            <?php if ($svcHours !== null && $svcHours !== ''): ?>
                                dengan estimasi
                                <strong><?= esc((string) $svcHours) ?> jam</strong>.
                            <?php endif ?>
                        </p>

                        <?php if ($isLoggedIn): ?>
                            <a href="<?= base_url(ult_role_dashboard()) ?>" class="svc-cta-btn">
                                <i class="bi bi-speedometer2"></i> Buka Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url('login/form') ?>" class="svc-cta-btn">
                                <i class="bi bi-box-arrow-in-right"></i> Masuk untuk Mengajukan
                            </a>
                        <?php endif ?>

                        <span class="svc-cta-note">
                            <i class="bi bi-shield-check"></i>
                            Data Anda hanya dipakai untuk keperluan layanan.
                        </span>
                    </div>

                    <div class="svc-card svc-card-sm">
                        <div class="svc-card-head">
                            <span class="svc-card-icon is-soft"><i class="bi bi-headset"></i></span>
                            <h3>Butuh Bantuan?</h3>
                        </div>

                        <div class="svc-card-body">
                            <p class="svc-sm-text">
                                Hubungi Unit Layanan Terpadu POLBAN pada jam kerja
                                untuk pendampingan pengajuan.
                            </p>

                            <a href="<?= base_url('/') ?>#kontak" class="svc-link">
                                <i class="bi bi-geo-alt"></i> Lihat Kontak
                            </a>
                            <a href="<?= base_url('login/form') ?>" class="svc-link">
                                <i class="bi bi-person"></i> Masuk ke Akun
                            </a>
                        </div>
                    </div>

                    <div class="svc-card svc-card-sm">
                        <div class="svc-card-head">
                            <span class="svc-card-icon is-soft"><i class="bi bi-grid"></i></span>
                            <h3>Jelajahi</h3>
                        </div>

                        <div class="svc-card-body">
                            <a href="<?= base_url('services') ?>" class="svc-link">
                                <i class="bi bi-list-check"></i> Semua Daftar Layanan
                            </a>
                            <a href="<?= base_url('/') ?>#pemohon" class="svc-link">
                                <i class="bi bi-people"></i> Layanan per Jenis Pemohon
                            </a>
                            <a href="<?= base_url('/') ?>#alur" class="svc-link">
                                <i class="bi bi-signpost-split"></i> Alur Pengajuan
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
