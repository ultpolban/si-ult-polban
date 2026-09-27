<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">
            Kelola data FAQ (Frequently Asked Questions).
        </small>

    </div>

    <a
        href="<?= site_url('faqs/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah FAQ

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('faqs/_filter') ?>

<?= $this->include('faqs/_table') ?>

<?= $this->include('faqs/_modal') ?>

<?= $this->endSection() ?>