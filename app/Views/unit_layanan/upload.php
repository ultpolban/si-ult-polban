<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Upload Dokumen Hasil' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3 class="mb-4">Upload Dokumen Hasil Tiket</h3>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-body">
                <form action="<?= base_url('unit-layanan/simpanUpload/' . $tiket['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label">Nomor Tiket</label>
                        <input type="text" class="form-control" value="<?= $tiket['no_tiket'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" value="<?= $tiket['nama_layanan'] ?? '-' ?>" readonly>
                    </div>

                    <?php if (!empty($dokumen_hasil)): ?>
                        <div class="mb-3">
                            <label class="form-label">Dokumen Hasil Yang Sudah Ada</label>
                            <?php foreach ($dokumen_hasil as $dokumen): ?>
                                <div class="mb-2">
                                    <a href="<?= base_url('uploads/hasil/' . $dokumen['nama_file']) ?>" target="_blank" class="btn btn-success btn-sm">
                                        Lihat Dokumen
                                    </a>
                                    <span class="ms-2"><?= $dokumen['nama_file'] ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Upload Dokumen Hasil Baru</label>
                        <input type="file" name="file_hasil[]" id="file_hasil" class="form-control" multiple accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">
                            Bisa upload banyak file tanpa batas.<br>
                            PDF, JPG, JPEG, PNG.<br>
                            Maksimal 5 MB/file.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary">Upload Dokumen</button>
                    <a href="<?= base_url('unit-layanan/dashboard') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
