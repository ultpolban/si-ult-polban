<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">
                <i class="fas fa-file-alt text-primary mr-2"></i>Detail Tiket
            </h1>
            <p class="text-muted mb-0">Informasi lengkap pengajuan layanan mahasiswa.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/tiket') ?>">Data Tiket</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #0d6efd; border-radius: 10px;">
                <div class="card-body p-3">
                    <small class="text-white-50 font-weight-bold d-block mb-1">No Tiket</small>
                    <h3 class="mb-0 font-weight-bold"><?= esc($tiket['nomor_tiket'] ?? 'ULT-001') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 text-dark shadow-sm h-100" style="background-color: #ffc107; border-radius: 10px;">
                <div class="card-body p-3">
                    <small class="text-dark-50 font-weight-bold d-block mb-1">Prioritas</small>
                    <h3 class="mb-0 font-weight-bold"><?= esc($tiket['prioritas'] ?? 'High') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #17a2b8; border-radius: 10px;">
                <div class="card-body p-3">
                    <small class="text-white-50 font-weight-bold d-block mb-1">Unit Tujuan</small>
                    <h3 class="mb-0 font-weight-bold"><?= esc($tiket['kategori'] ?? 'Akademik') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #198754; border-radius: 10px;">
                <div class="card-body p-3">
                    <small class="text-white-50 font-weight-bold d-block mb-1">Status</small>
                    <h3 class="mb-0 font-weight-bold"><?= esc($tiket['status'] ?? 'Submitted') ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px; overflow: hidden;">
        <div class="card-header text-white font-weight-bold py-3" style="background-color: #0d6efd;">
            <i class="fas fa-file-invoice mr-2"></i>Data Pengajuan
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark">Nama Mahasiswa</label>
                    <input type="text" class="form-control bg-light" value="<?= esc($tiket['nama_pemohon'] ?? 'Rafi Putra') ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark">Jenis Layanan</label>
                    <input type="text" class="form-control bg-light" value="<?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark">NIM</label>
                    <input type="text" class="form-control bg-light" value="<?= esc($tiket['nim'] ?? '231511001') ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark">Tanggal Pengajuan</label>
                    <input type="text" class="form-control bg-light" value="<?= esc($tiket['tanggal'] ?? '17 Juli 2026') ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark">Email</label>
                    <input type="email" class="form-control bg-light" value="<?= esc($tiket['email'] ?? 'rafi@student.polban.ac.id') ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark d-block">Status</label>
                    <span class="badge bg-warning text-dark px-3 py-2 font-weight-bold" style="font-size: 0.9rem;">
                        <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark">No HP</label>
                    <input type="text" class="form-control bg-light" value="<?= esc($tiket['no_hp'] ?? '081234567890') ?>" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-dark d-block">Lampiran</label>
                    <a href="#" class="btn btn-info text-white font-weight-bold">
                        <i class="fas fa-file-pdf mr-1"></i> Lihat Lampiran
                    </a>
                </div>

                <div class="col-12 mb-2">
                    <label class="form-label font-weight-bold text-dark">Deskripsi Pengajuan</label>
                    <textarea class="form-control bg-light" rows="3" readonly><?= esc($tiket['deskripsi'] ?? 'Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.') ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="font-weight-bold mb-0 text-dark">
                <i class="fas fa-history text-primary mr-2"></i>Riwayat Proses
            </h5>
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <span class="badge bg-primary px-3 py-2 text-white font-weight-bold" style="font-size: 0.85rem; border-radius: 6px;">
                    20 Juli 2026
                </span>
            </div>

            <div class="timeline-wrapper pl-2">
                <div class="d-flex align-items-center mb-3 p-3 bg-light rounded-3 border-start border-4 border-primary" style="border-radius: 8px;">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3" style="width: 38px; height: 38px; flex-shrink: 0;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold text-dark">Pengajuan dibuat mahasiswa</h6>
                        <small class="text-muted">Berkas berhasil diunggah oleh mahasiswa</small>
                    </div>
                </div>

                <div class="d-flex align-items-center p-3 bg-light rounded-3 border-start border-4 border-warning" style="border-radius: 8px;">
                    <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mr-3" style="width: 38px; height: 38px; flex-shrink: 0;">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 font-weight-bold text-dark">Menunggu Verifikasi Petugas</h6>
                        <small class="text-muted">Tiket masuk dalam antrian verifikasi</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-0 pb-4 pt-0 d-flex justify-content-between">
            <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-secondary font-weight-bold">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <div>
                <a href="<?= base_url('petugas/verifikasi/' . ($id ?? 1)) ?>" class="btn btn-success font-weight-bold mr-2">
                    <i class="fas fa-user-check mr-1"></i> Verifikasi Tiket Ini
                </a>
                <a href="<?= base_url('petugas/disposisi/' . ($id ?? 1)) ?>" class="btn btn-warning text-white font-weight-bold" style="background-color: #ff8c00; border: none;">
                    <i class="fas fa-share-square mr-1"></i> Disposisi
                </a>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>