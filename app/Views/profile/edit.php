<?php
/**
 * =====================================================================
 *  UBAH PROFIL
 * ---------------------------------------------------------------------
 *  Dulu file ini membuat shell dashboard sendiri (sidebar + topbar
 *  buatan) dengan warna berbeda dari sidebar utama, sehingga halaman
 *  terlihat tidak konsisten dengan halaman lain.
 *
 *  Sekarang memakai layouts/template yang sama dengan seluruh
 *  halaman dashboard.
 * =====================================================================
 */
helper('role');
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/page_header', [
    'ultPageTitle'    => 'Ubah Profil',
    'ultPageSubtitle' => 'Perbarui data & informasi akun Anda.',
    'ultPageIcon'     => 'fa-user-pen',
    'ultPageActions'  => '<a href="' . base_url('profile') . '" class="btn btn-light btn-sm">'
        . '<i class="fas fa-arrow-left"></i> Kembali ke Profil</a>',
    'ultBreadcrumb'   => ['Dashboard', 'Profil', 'Ubah Profil'],
]) ?>

<div class="card">
    <div class="card-body">

        <!-- Error validasi -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('profile/update') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label" for="full_name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        class="form-control <?= validation_show_error('full_name') ? 'is-invalid' : '' ?>"
                        value="<?= old('full_name', $user['full_name'] ?? '') ?>"
                        required>
                    <div class="invalid-feedback">
                        <?= validation_show_error('full_name') ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>"
                        value="<?= old('email', $user['email'] ?? '') ?>"
                        required>
                    <div class="invalid-feedback">
                        <?= validation_show_error('email') ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="phone_number">Nomor HP</label>
                    <input
                        type="text"
                        id="phone_number"
                        name="phone_number"
                        class="form-control <?= validation_show_error('phone_number') ? 'is-invalid' : '' ?>"
                        value="<?= old('phone_number', $user['phone_number'] ?? '') ?>"
                        required>
                    <div class="invalid-feedback">
                        <?= validation_show_error('phone_number') ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="profile_photo">Foto Profil</label>
                    <input
                        type="file"
                        id="profile_photo"
                        name="profile_photo"
                        class="form-control"
                        accept="image/*">
                    <small class="ult-select-hint">
                        Format JPG, PNG, atau WEBP. Maksimal 2&nbsp;MB.
                    </small>
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="<?= base_url('profile') ?>" class="btn btn-light">
                    Batal
                </a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection() ?>
