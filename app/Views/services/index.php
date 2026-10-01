<?php
/**
 * =====================================================================
 *  DAFTAR LAYANAN (publik) - dikelompokkan per kategori
 * ---------------------------------------------------------------------
 *  Memakai layout publik (layouts/template_public) yang sama dengan
 *  landing page dan halaman detail layanan.
 *
 *  Struktur:
 *    1. Page header  : judul + ringkasan jumlah layanan & kategori
 *    2. Ringkasan    : kartu statistik (total layanan / kategori)
 *    3. per Kategori : judul kategori + ikon + jumlah, lalu kartu
 *                      layanan di dalamnya (ukuran lebih besar & rapi)
 *
 *  Data kategori dibentuk di ServiceController::index()
 *  (mengelompokkan services berdasarkan service_unit_id).
 * =====================================================================
 */
helper('role');

$isLoggedIn = (bool) session()->get('isLoggedIn');

$categories    = $categories ?? [];
$totalServices = $totalServices ?? 0;
$totalUnits    = $totalUnits ?? 0;
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
                <li class="breadcrumb-item active" aria-current="page">
                    Layanan
                </li>
            </ol>
        </nav>

        <div class="svc-hero-inner">

            <span class="svc-hero-icon">
                <i class="bi bi-grid-1x2"></i>
            </span>

            <div class="svc-hero-text">
                <span class="svc-hero-eyebrow">Katalog Layanan</span>

                <h1>Semua Layanan</h1>

                <div class="svc-hero-tags">
                    <span class="svc-tag">
                        <i class="bi bi-collection"></i>
                        <?= (int) $totalServices ?> Layanan
                    </span>

                    <span class="svc-tag">
                        <i class="bi bi-diagram-3"></i>
                        <?= (int) $totalUnits ?> Kategori
                    </span>

                    <span class="svc-tag is-online">
                        <i class="bi bi-check2-circle"></i>
                        Tanpa Cuci
                    </span>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- ================================================================
     2. ISI: KATEGORI + LAYANAN
     ================================================================ -->
<section class="svc-body">
    <div class="container container-wide">

        <?php if ($categories === []): ?>

            <div class="svc-card">
                <div class="svc-card-body">
                    <p class="svc-empty">
                        <i class="bi bi-inbox"></i>
                        Belum ada layanan yang tersedia saat ini.
                    </p>
                </div>
            </div>

        <?php else: ?>

            <?php foreach ($categories as $group): ?>
                <?php
                $unit     = $group['unit'] ?? null;
                $icon     = $group['icon'] ?? 'bi-grid';
                $list     = $group['services'] ?? [];
                $count    = (int) ($group['count'] ?? 0);
                $unitId   = (int) ($unit['id'] ?? 0);
                $groupId  = 'kategori-' . ($unitId > 0 ? $unitId : 'lainnya');
                ?>

                <section class="svc-group" id="<?= esc($groupId) ?>">

                    <!-- Judul kategori -->
                    <div class="svc-group-head">
                        <span class="svc-group-icon">
                            <i class="bi <?= esc($icon) ?>"></i>
                        </span>

                        <div class="svc-group-title">
                            <h2>
                                <?= esc($unit['name'] ?? 'Layanan Lainnya') ?>
                            </h2>

                            <p>
                                <?= $count ?> layanan tersedia
                                <?php if (! empty($unit['description'])): ?>
                                    &mdash; <?= esc($unit['description']) ?>
                                <?php endif ?>
                            </p>
                        </div>

                        <span class="svc-group-count"><?= $count ?></span>
                    </div>

                    <!-- Kartu layanan -->
                    <div class="row g-4 g-xl-5">

                        <?php foreach ($list as $service): ?>
                            <?php
                            $hours = $service['service_hours'] ?? null;
                            $desc  = trim((string) ($service['description'] ?? ''));
                            $slug  = 'svc-' . (int) $service['id'];
                            ?>

                            <div class="col-12">

                                <article class="svc-item">

                                    <span class="svc-item-icon">
                                        <i class="bi <?= esc($icon) ?>"></i>
                                    </span>

                                    <div class="svc-item-body">
                                        <h3 class="svc-item-title"><?= esc($service['name']) ?></h3>

                                        <p class="svc-item-desc">
                                            <?= esc($desc !== '' ? $desc : 'Layanan siap diajukan melalui Unit Layanan Terpadu.') ?>
                                        </p>
                                    </div>

                                    <div class="svc-item-aside">
                                        <span class="svc-item-hours">
                                            <i class="bi bi-clock"></i>
                                            <?= $hours !== null && $hours !== '' ? esc((string) $hours) . ' Jam' : '-' ?>
                                        </span>

                                        <a href="<?= base_url('layanan/detail/' . (int) $service['id']) ?>"
                                           class="svc-item-link"
                                           aria-label="Lihat detail <?= esc($service['name']) ?>">
                                            Lihat Detail
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>

                                </article>

                            </div>
                        <?php endforeach; ?>

                    </div>

                </section>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</section>

<?= $this->endSection() ?>
