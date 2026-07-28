<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">Verifikasi Tiket</h1>
            <p class="text-muted mb-0">Verifikasi berkas dan kelengkapan persyaratan tiket permohonan mahasiswa.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/tiket') ?>">Data Tiket</a></li>
                <li class="breadcrumb-item active" aria-current="page">Verifikasi</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #1a237e; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50 font-weight-bold d-block mb-1">Status Saat Ini</small>
                        <h6 class="mb-0 font-weight-bold">Sedang Memverifikasi</h6>
                    </div>
                    <i class="fas fa-paper-plane fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #ff8c00; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50 font-weight-bold d-block mb-1">Petugas ULT</small>
                        <h6 class="mb-0 font-weight-bold">Verifikator</h6>
                    </div>
                    <i class="fas fa-user-check fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #17a2b8; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50 font-weight-bold d-block mb-1">Unit Tujuan</small>
                        <h6 class="mb-0 font-weight-bold"><?= esc($tiket['unit_tujuan'] ?? 'Akademik') ?></h6>
                    </div>
                    <i class="fas fa-building fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #107c41; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50 font-weight-bold d-block mb-1">Prioritas Tiket</small>
                        <h6 class="mb-0 font-weight-bold"><?= esc($tiket['prioritas'] ?? 'High') ?></h6>
                    </div>
                    <i class="fas fa-exclamation-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="font-weight-bold mb-0 text-dark">
                <i class="fas fa-id-card text-primary mr-2"></i>Informasi Permohonan
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th width="200" class="pl-4 text-muted">Nomor Tiket</th>
                            <td class="font-weight-bold text-primary"><?= esc($tiket['nomor_tiket'] ?? 'ULT-20260720-0001') ?></td>
                        </tr>
                        <tr>
                            <th class="pl-4 text-muted">Nama Pemohon</th>
                            <td class="font-weight-bold text-dark"><?= esc($tiket['nama_pemohon'] ?? 'Rafi Putra') ?></td>
                        </tr>
                        <tr>
                            <th class="pl-4 text-muted">NIM</th>
                            <td><?= esc($tiket['nim'] ?? '231511001') ?></td>
                        </tr>
                        <tr>
                            <th class="pl-4 text-muted">Jenis Layanan</th>
                            <td><?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?></td>
                        </tr>
                        <tr>
                            <th class="pl-4 text-muted">Kategori</th>
                            <td><?= esc($tiket['kategori'] ?? 'Akademik') ?></td>
                        </tr>
                        <tr>
                            <th class="pl-4 text-muted">Prioritas</th>
                            <td><span class="badge badge-danger px-2 py-1"><?= esc($tiket['prioritas'] ?? 'High') ?></span></td>
                        </tr>
                        <tr>
                            <th class="pl-4 text-muted">Status</th>
                            <td><span class="badge badge-warning text-white px-2 py-1"><?= esc($tiket['status'] ?? 'Submitted') ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header text-white border-0 py-3" style="background-color: #17a2b8; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h5 class="font-weight-bold mb-0">
                <i class="fas fa-file-pdf mr-2"></i>Lampiran Pemohon
            </h5>
        </div>
        <div class="card-body text-center py-5">
            <i class="fas fa-file-pdf text-danger fa-4x mb-3"></i>
            <h6 class="font-weight-bold text-dark mb-3">Dokumen Persyaratan (.pdf)</h6>
            <a href="<?= base_url('uploads/' . ($tiket['lampiran'] ?? 'sample.pdf')) ?>" target="_blank" class="btn btn-primary px-4 py-2 font-weight-bold" style="background-color: #007bff; border-radius: 8px;">
                <i class="fas fa-eye mr-2"></i>Lihat Lampiran
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header text-white border-0 py-3" style="background-color: #107c41; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h5 class="font-weight-bold mb-0">
                <i class="fas fa-check-double mr-2"></i>Verifikasi Tiket
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="<?= base_url('petugas/verifikasi/simpan' . (isset($tiket['id']) ? '/'.$tiket['id'] : '')) ?>" method="POST">
                <?= csrf_field() ?>

                <h6 class="font-weight-bold text-dark mb-3">Checklist Kelengkapan</h6>
                <div class="form-group pl-1 mb-4">
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="checkMahasiswa" name="check_mahasiswa" value="1">
                        <label class="custom-control-label text-dark" for="checkMahasiswa">Data Mahasiswa Sesuai</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="checkLampiran" name="check_lampiran" value="1">
                        <label class="custom-control-label text-dark" for="checkLampiran">Lampiran Lengkap</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="checkPersyaratan" name="check_persyaratan" value="1">
                        <label class="custom-control-label text-dark" for="checkPersyaratan">Persyaratan Sudah Sesuai</label>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark">Status Verifikasi</label>
                    <select name="status_verifikasi" class="form-control custom-select" required>
                        <option value="" disabled selected>Pilih Keputusan...</option>
                        <option value="Verified">Disetujui / Terverifikasi</option>
                        <option value="Rejected">Ditolak / Perlu Perbaikan</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark">Catatan Petugas</label>
                    <textarea name="catatan" class="form-control" rows="4" placeholder="Tambahkan catatan atau alasan verifikasi di sini..."></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-secondary px-4 mr-2 font-weight-bold">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success px-4 font-weight-bold" style="background-color: #107c41; border: none;">
                        <i class="fas fa-save mr-1"></i> Simpan Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>