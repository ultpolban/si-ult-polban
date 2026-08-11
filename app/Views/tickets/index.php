<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>
        <small class="text-muted">Kelola dan pantau seluruh tiket layanan.</small>
    </div>
    <a href="<?= site_url('tickets/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Tiket</a>
</div>
<?= $this->include('components/alert') ?>
<div class="card">
    <div class="card-body">
        <?= $this->include('tickets/_filter') ?>
        <?= $this->include('tickets/_table') ?>
        <?php if (isset($pager)): ?><div class="mt-3"><?= $pager->links() ?></div><?php endif; ?>
    </div>
</div>
<?= $this->include('tickets/_modal') ?>
<?= $this->endSection() ?>