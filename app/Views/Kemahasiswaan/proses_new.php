<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Proses Tiket' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3 class="mb-4">Proses Tiket Layanan</h3>

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
<form action="<?= base_url('kemahasiswaan/updateProses/' . $tiket['id']) ?>" method="post" enctype="multipart/form-data">                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label">Nomor Tiket</label>
                        <input type="text" class="form-control" value="<?= $tiket['no_tiket'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit Layanan</label>
                        <input type="text" class="form-control" value="<?= $tiket['nama_unit'] ?? '-' ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori Layanan</label>
                        <input type="text" class="form-control" value="<?= $tiket['nama_kategori'] ?? '-' ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Layanan</label>
                        <input type="text" class="form-control" value="<?= $tiket['nama_layanan'] ?? '-' ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Pengajuan</label>
                        <input type="text" class="form-control" value="<?= $tiket['judul'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Pengajuan</label>
                        <textarea class="form-control" rows="4" readonly><?= $tiket['deskripsi'] ?></textarea>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Status Tiket</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="Menunggu" <?= $tiket['status'] == 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                            <option value="Diproses" <?= $tiket['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                            <option value="Selesai" <?= $tiket['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Unit Layanan</label>
                        <textarea name="catatan" class="form-control" rows="4"><?= $tiket['catatan'] ?? '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Dokumen Hasil</label>
                        <input type="file" id="file_hasil" class="form-control" accept=".pdf,.jpg,.jpeg,.png" multiple>
                        <input type="file" name="file_hasil[]" id="file_storage" multiple hidden>
                        <div id="list_file" class="mt-3"></div>
                        <small class="text-muted">
                            Bisa upload banyak file tanpa batas.<br>
                            Format PDF, JPG, JPEG, PNG.<br>
                            Maksimal 5 MB per file.
                        </small>
                    </div>

                    <?php if (!empty($tiket['dokumen_hasil'])): ?>
                        <div class="alert alert-info">
                            <b>Dokumen sebelumnya:</b>
                            <ul class="mt-2">
                                <?php foreach ($tiket['dokumen_hasil'] as $dokumen): ?>
                                    <li class="mb-2">
                                        <a href="<?= base_url('uploads/hasil/' . $dokumen['nama_file']) ?>" target="_blank">
                                            <?= $dokumen['nama_file'] ?>
                                        </a>
                                        <a href="<?= base_url('kemahasiswaan/hapus-dokumen/' . $dokumen['id']) ?>"
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary">Simpan Proses</button>
                    <a href="<?= base_url('unit-layanan/detail/' . $tiket['id']) ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        let inputFile = document.getElementById('file_hasil');
        let storageFile = document.getElementById('file_storage');
        let listFile = document.getElementById('list_file');
        let daftarFile = [];

        inputFile.addEventListener('change', function () {
            let fileBaru = Array.from(this.files);

            fileBaru.forEach(function (file) {
                if (file.size > 5242880) {
                    alert('Ukuran ' + file.name + ' maksimal 5 MB');
                    return;
                }

                daftarFile.push(file);
            });

            tampilkanFile();
            simpanFile();
            this.value = '';
        });

        function tampilkanFile() {
            listFile.innerHTML = '';

            daftarFile.forEach(function (file, index) {
                listFile.innerHTML += `
                    <div class="alert alert-secondary d-flex justify-content-between align-items-center">
                        <span>${file.name}</span>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusFile(${index})">×</button>
                    </div>
                `;
            });
        }

        function simpanFile() {
            let dataTransfer = new DataTransfer();
            daftarFile.forEach(function (file) {
                dataTransfer.items.add(file);
            });
            storageFile.files = dataTransfer.files;
        }

        function hapusFile(index) {
            daftarFile.splice(index, 1);
            tampilkanFile();
            simpanFile();
        }
    </script>
</body>
</html>
