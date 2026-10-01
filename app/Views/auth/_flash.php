<?php
/*
 |--------------------------------------------------------------------------
 | Flash message auth (login, registrasi, MFA, izin registrasi)
 |--------------------------------------------------------------------------
 | Dipakai di seluruh halaman dalam folder auth.
 */

$authFlash = [
    'success' => ['class' => 'alert-success', 'icon' => 'fa-check-circle'],
    'error'   => ['class' => 'alert-danger',  'icon' => 'fa-exclamation-circle'],
    'warning' => ['class' => 'alert-warning', 'icon' => 'fa-exclamation-triangle'],
    'info'    => ['class' => 'alert-info',    'icon' => 'fa-info-circle'],
];
?>

<?php foreach ($authFlash as $key => $conf): ?>

    <?php $message = session()->getFlashdata($key); ?>

    <?php if ($message): ?>

        <div class="alert <?= esc($conf['class']) ?> alert-dismissible fade show" role="alert">

            <i class="fas <?= esc($conf['icon']) ?> me-2"></i>

            <?= esc($message) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>

        </div>

    <?php endif; ?>

<?php endforeach; ?>

<?php $authErrors = session()->getFlashdata('errors'); ?>

<?php if (is_array($authErrors) && $authErrors !== []): ?>

    <?php foreach ($authErrors as $authError): ?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <i class="fas fa-exclamation-circle me-2"></i>

            <?= esc($authError) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>

        </div>

    <?php endforeach; ?>

<?php elseif (is_string($authErrors) && $authErrors !== ''): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc($authErrors) ?>

    </div>

<?php endif; ?>
