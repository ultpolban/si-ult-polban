<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Manajemen Layanan</h3>
            <p class="text-muted mb-0">Kelola data layanan yang tersedia</p>
        </div>
        <div>
            <button class="btn btn-filter-submit d-flex align-items-center">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Layanan
            </button>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="card card-premium card-orange-top">
        <div class="card-body p-3">
            <form action="" method="get" class="search-filter-container m-0">
                <div class="search-input-group">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari layanan..." value="<?= esc($search ?? '') ?>">
                </div>
                
                <select name="kategori" class="select-filter">
                    <option value="">Semua Kategori</option>
                    <option value="Akademik">Akademik</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="Umum">Umum</option>
                    <option value="Lainnya">Lainnya</option>
                </select>

                <select name="unit" class="select-filter">
                    <option value="">Semua Unit</option>
                    <option value="Akademik">Akademik</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="Umum">Umum</option>
                    <option value="Lainnya">Lainnya</option>
                </select>

                <button type="submit" class="btn-filter-submit">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Services Table Card -->
    <div class="card card-premium card-orange-top">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Layanan</th>
                            <th>Kategori</th>
                            <th>Unit</th>
                            <th>SLA</th>
                            <th>Status</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($layanan as $l): 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($l['nama']) ?></td>
                            <td><?= esc($l['kategori']) ?></td>
                            <td><?= esc($l['unit']) ?></td>
                            <td>
                                <span class="badge bg-light text-dark font-weight-normal px-2 py-1" style="border: 1px solid #cbd5e1; border-radius: 4px;">
                                    <i class="far fa-clock text-orange mr-1"></i> <?= esc($l['sla']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge badge-aktif">
                                    <?= esc($l['status']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn-action btn-action-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-action-delete" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($layanan)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Tidak ada data layanan ditemukan.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
