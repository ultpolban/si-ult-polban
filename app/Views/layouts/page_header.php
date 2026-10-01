<?php
/**
 * =====================================================================
 *  PAGE HEADER - SI ULT POLBAN
 * =====================================================================
 *
 *  Header seragam untuk semua halaman dashboard.
 *
 *  Variabel opsional:
 *   $ultPageTitle   judul halaman
 *   $ultPageSubtitle  keterangan di bawah judul
 *   $ultPageIcon    class ikon (tanpa "fas")
 *   $ultPageActions HTML tombol aksi di kanan
 *   $ultBreadcrumb  array breadcrumb
 */
$ultPageTitle    = $ultPageTitle ?? ($pageTitle ?? $title ?? 'Dashboard');
$ultPageSubtitle = $ultPageSubtitle ?? '';
$ultPageIcon     = $ultPageIcon ?? 'fa-tachometer-alt';
$ultPageActions  = $ultPageActions ?? '';
$ultBreadcrumb   = $ultBreadcrumb ?? ($breadcrumb ?? []);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center g-3">

            <div class="col-md-8">

                <?php if ($ultBreadcrumb !== []): ?>
                    <ol class="breadcrumb">
                        <?php foreach ($ultBreadcrumb as $ultCrumbIndex => $ultCrumb): ?>
                            <?php if ($ultCrumbIndex === array_key_last($ultBreadcrumb)): ?>
                                <li class="breadcrumb-item active"><?= esc($ultCrumb) ?></li>
                            <?php else: ?>
                                <li class="breadcrumb-item"><?= esc($ultCrumb) ?></li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ol>
                <?php endif ?>

                <div class="d-flex align-items-center gap-3">
                    <span class="ult-page-icon"><i class="fas <?= esc($ultPageIcon) ?>"></i></span>
                    <div>
                        <h1><?= esc($ultPageTitle) ?></h1>
                        <?php if ($ultPageSubtitle !== ''): ?>
                            <p><?= esc($ultPageSubtitle) ?></p>
                        <?php endif ?>
                    </div>
                </div>

            </div>

            <?php if ($ultPageActions !== ''): ?>
                <div class="col-md-4">
                    <div class="ult-page-actions">
                        <?= $ultPageActions ?>
                    </div>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>
