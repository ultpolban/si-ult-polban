<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">Disposisi Tiket</h1>
            <p class="text-muted mb-0">Teruskan tiket permohonan ke Unit Tujuan yang sesuai untuk dipproses lebih lanjut.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/tiket') ?>">Data Tiket</a></li>
                <li class="breadcrumb-item active" aria-current="page">Disposisi</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #1a237e; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50 font-weight-bold d-block mb-1">Nomor Tiket</small>
                        <h6 class="mb-0 font-weight-bold"><?= esc($tiket['nomor_tiket'] ?? 'ULT-20260720-0001') ?></h6>
                    </div>
                    <i class="fas fa-ticket-alt fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #107c41; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50 font-weight-bold d-block mb-1">Status Tiket</small>
                        <h6 class="mb-0 font-weight-bold"><?= esc($tiket['status'] ?? 'Verified') ?></h6>
                    </div>
                    <i class="fas fa-check-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #f1c40f; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-dark-50 font-weight-bold d-block mb-1 text-dark">Prioritas Tiket</small>
                        <h6 class="mb-0 font-weight-bold text-dark"><?= esc($tiket['prioritas'] ?? 'High') ?></h6>
                    </div>
                    <i class="fas fa-exclamation-triangle fa-2x text-dark opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #17a2b8; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <small class="text-white-50 font-weight-bold d-block mb-1">Kategori</small>
                        <h6 class="mb-0 font-weight-bold"><?= esc($tiket['kategori'] ?? 'Akademik') ?></h6>
                    </div>
                    <i class="fas fa-university fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="font-weight-bold mb-0 text-dark">
                <i class="fas fa-info-circle text-primary mr-2"></i>Informasi Tiket
            </h5>
        </div>
        <div class="card-body pt-0">
            <div class="mb-4">
                <label class="font-weight-bold text-dark mb-1">Progress Tiket</label>
                <div class="progress" style="height: 22px; border-radius: 12px;">
                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated font-weight-bold" 
                         role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                        Verified (60%)
                    </div>
                </div>
                <small class="text-muted mt-1 d-block">Tahap berikutnya adalah mengirim tiket ke Unit Tujuan.</small>
            </div>

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
                            <th class="pl-4 text-muted">Layanan</th>
                            <td><?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?></td>
                        </tr>
                        <tr>
                            <th class="pl-4 text-muted">Status</th>
                            <td><span class="badge badge-success px-2 py-1"><?= esc($tiket['status'] ?? 'Verified') ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header text-white border-0 py-3" style="background-color: #107c41; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h5 class="font-weight-bold mb-0">
                <i class="fas fa-share-square mr-2"></i>Form Disposisi
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="<?= base_url('petugas/disposisi/kirim' . (isset($tiket['id']) ? '/'.$tiket['id'] : '')) ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark"><i class="fas fa-building text-primary mr-1"></i> Unit Tujuan</label>
                    <select name="unit_tujuan" class="form-control custom-select" required>
                        <option value="" disabled selected>-- Pilih Unit --</option>
                        <option value="Akademik">Unit Akademik</option>
                        <option value="Keuangan">Unit Keuangan</option>
                        <option value="Kemahasiswaan">Unit Kemahasiswaan</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark"><i class="fas fa-exclamation-triangle text-warning mr-1"></i> Prioritas</label>
                    <select name="prioritas" class="form-control custom-select">
                        <option value="High" selected>High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark"><i class="fas fa-calendar-alt text-success mr-1"></i> Target Penyelesaian (SLA)</label>
                    <input type="date" name="target_sla" class="form-control" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-secondary px-4 mr-2 font-weight-bold">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning text-white px-4 font-weight-bold" style="background-color: #ff8c00; border: none;">
                        <i class="fas fa-paper-plane mr-1"></i> Kirim Disposisi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 10px;">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="font-weight-bold mb-0 text-dark">
                <i class="fas fa-history text-primary mr-2"></i>Riwayat Disposisi
            </h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-white" style="background-color: #1a237e;">
                    <tr>
                        <th class="border-0 pl-4" width="220"><i class="fas fa-clock mr-2"></i>Waktu</th>
                        <th class="border-0"><i class="fas fa-tasks mr-2"></i>Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pl-4 text-muted">20 Juli 2026 08:20</td>
                        <td class="font-weight-bold text-dark">Pengajuan dibuat oleh Pemohon</td>
                    </tr>
                    <tr>
                        <td class="pl-4 text-muted">20 Juli 2026 09:10</td>
                        <td class="font-weight-bold text-dark">Diverifikasi oleh Petugas ULT</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>