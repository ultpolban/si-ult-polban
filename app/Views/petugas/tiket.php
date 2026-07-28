<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">Data Tiket Permohonan</h1>
            <p class="text-muted mb-0">Kelola dan pantau seluruh tiket permohonan layanan mahasiswa.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Tiket</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-body p-3">
            <form action="<?= base_url('petugas/tiket') ?>" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-5 col-md-12 mb-2 mb-lg-0">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" 
                                   placeholder="Cari No Tiket, Nama, NIM, Layanan..." 
                                   value="<?= esc($search ?? '') ?>">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
                        <select name="status" class="form-control custom-select">
                            <option value="">-- Semua Status --</option>
                            <option value="Submitted" <?= (isset($status) && $status == 'Submitted') ? 'selected' : '' ?>>Submitted</option>
                            <option value="Verified" <?= (isset($status) && $status == 'Verified') ? 'selected' : '' ?>>Verified</option>
                            <option value="Disposisi" <?= (isset($status) && $status == 'Disposisi') ? 'selected' : '' ?>>Disposisi</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
                        <select name="kategori" class="form-control custom-select">
                            <option value="">-- Semua Kategori --</option>
                            <option value="Akademik" <?= (isset($kategori) && $kategori == 'Akademik') ? 'selected' : '' ?>>Akademik</option>
                            <option value="Keuangan" <?= (isset($kategori) && $kategori == 'Keuangan') ? 'selected' : '' ?>>Keuangan</option>
                            <option value="Kemahasiswaan" <?= (isset($kategori) && $kategori == 'Kemahasiswaan') ? 'selected' : '' ?>>Kemahasiswaan</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-12 d-flex gap-1">
                        <button type="submit" class="btn btn-primary font-weight-bold w-100 mr-1" style="background-color: #1a237e; border: none;">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-secondary" title="Reset Filter">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 10px;">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold mb-0 text-dark">
                <i class="fas fa-ticket-alt text-primary mr-2"></i>Daftar Tiket 
                <?php if (!empty($search) || !empty($status) || !empty($kategori)): ?>
                    <span class="badge badge-info font-weight-normal ml-2">Hasil Filter</span>
                <?php endif; ?>
            </h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-white" style="background-color: #1a237e;">
                    <tr>
                        <th class="border-0 pl-4">No. Tiket</th>
                        <th class="border-0">Nama Pemohon</th>
                        <th class="border-0">NIM</th>
                        <th class="border-0">Layanan</th>
                        <th class="border-0">Kategori</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tiket_list)): ?>
                        <?php foreach ($tiket_list as $row): ?>
                            <tr>
                                <td class="pl-4 font-weight-bold text-primary"><?= esc($row['nomor_tiket']) ?></td>
                                <td class="font-weight-bold text-dark"><?= esc($row['nama_pemohon']) ?></td>
                                <td><?= esc($row['nim']) ?></td>
                                <td><?= esc($row['layanan']) ?></td>
                                <td><span class="badge badge-light border"><?= esc($row['kategori']) ?></span></td>
                                <td>
                                    <?php if ($row['status'] == 'Submitted'): ?>
                                        <span class="badge badge-warning text-white px-2 py-1">Submitted</span>
                                    <?php elseif ($row['status'] == 'Verified'): ?>
                                        <span class="badge badge-success px-2 py-1">Verified</span>
                                    <?php else: ?>
                                        <span class="badge badge-info px-2 py-1"><?= esc($row['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('petugas/detail/' . $row['id']) ?>" class="btn btn-sm btn-info text-white mr-1" title="Detail Tiket">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('petugas/verifikasi/' . $row['id']) ?>" class="btn btn-sm btn-success mr-1" title="Verifikasi">
                                        <i class="fas fa-user-check"></i>
                                    </a>
                                    <a href="<?= base_url('petugas/disposisi/' . $row['id']) ?>" class="btn btn-sm btn-warning text-white" style="background-color: #ff8c00; border: none;" title="Disposisi">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-search fa-2x mb-2 d-block opacity-50"></i>
                                Tidak ada tiket yang sesuai dengan pencarian / filter Anda.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>