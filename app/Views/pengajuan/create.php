<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Buat Pengajuan</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('pengajuan-layanan') ?>">Pengajuan Layanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buat Pengajuan</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0"><i class="bi bi-send-fill me-2"></i>Buat Pengajuan Layanan</h5>
    </div>
    <div class="card-body">
        
        <?php if (session()->has('errors')) : ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('pengajuan-layanan/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Layanan <span class="text-danger">*</span></label>
                    <select class="form-select" name="layanan_id" required>
                        <option value="">-- Pilih Layanan --</option>
                        <?php foreach ($layanans as $lay) : ?>
                            <option value="<?= $lay['id'] ?>" <?= old('layanan_id') == $lay['id'] ? 'selected' : '' ?>>
                                <?= esc($lay['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Prioritas</label>
                    <select class="form-select" name="prioritas" required>
                        <option value="Normal" <?= old('prioritas') == 'Normal' ? 'selected' : '' ?>>Normal</option>
                        <option value="Penting" <?= old('prioritas') == 'Penting' ? 'selected' : '' ?>>Penting</option>
                        <option value="Mendesak" <?= old('prioritas') == 'Mendesak' ? 'selected' : '' ?>>Mendesak</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="judul" value="<?= old('judul') ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="5"><?= old('deskripsi') ?></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Ajukan</button>
                <a href="<?= base_url('pengajuan-layanan') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection() ?>
