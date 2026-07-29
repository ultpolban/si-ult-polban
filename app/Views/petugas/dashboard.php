<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">Dashboard Petugas ULT</h1>
            <p class="text-muted mb-0">Kelola tiket layanan mahasiswa Politeknik Negeri Bandung.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #1a237e; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-primary font-weight-bold px-2 py-1 mb-2" style="font-size: 0.9rem;">120</span>
                        <h6 class="mb-0 font-weight-bold">Tiket Masuk</h6>
                    </div>
                    <i class="fas fa-envelope fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #ff8c00; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-warning font-weight-bold px-2 py-1 mb-2" style="font-size: 0.9rem;">95</span>
                        <h6 class="mb-0 font-weight-bold">Diverifikasi</h6>
                    </div>
                    <i class="fas fa-check-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #f1c40f; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-dark font-weight-bold px-2 py-1 mb-2" style="font-size: 0.9rem;">20</span>
                        <h6 class="mb-0 font-weight-bold">Diproses Unit</h6>
                    </div>
                    <i class="fas fa-spinner fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #107c41; border-radius: 10px;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-success font-weight-bold px-2 py-1 mb-2" style="font-size: 0.9rem;">5</span>
                        <h6 class="mb-0 font-weight-bold">Terlambat SLA</h6>
                    </div>
                    <i class="fas fa-clock fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header text-white border-0 py-2 px-3" style="background-color: #1a237e; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h6 class="font-weight-bold mb-0">
                <i class="fas fa-bolt mr-2"></i>Quick Action
            </h6>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-3 mb-2 mb-md-0">
                   <!-- Data Tiket -->
<a href="<?= base_url('petugas/tiket') ?>"
   class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center"
   style="background:#ff8c00;border-radius:8px;">
    <i class="fas fa-ticket-alt fa-2x mr-3"></i>
    Data Tiket
</a>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                   <a href="<?= base_url('petugas/tiket?status=Submitted') ?>"
   class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center"
   style="background:#107c41;border-radius:8px;">
    <i class="fas fa-user-check fa-2x mr-3"></i>
    Verifikasi
</a>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="<?= base_url('petugas/tiket?status=Verified') ?>"
   class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center"
   style="background:#f1c40f;border-radius:8px;">
    <i class="fas fa-share-square fa-2x mr-3"></i>
    Disposisi
</a>
                </div>
                <div class="col-md-3">
                    <a href="javascript:location.reload()" class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center" style="background-color: #343a40; border-radius: 8px;">
                        <i class="fas fa-sync-alt fa-2x mr-3"></i> Refresh
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-body p-3">
            <h6 class="font-weight-bold mb-3"><i class="fas fa-filter mr-2"></i>Filter Tiket</h6>
            <form id="formCari" method="GET" action="<?= base_url('petugas/dashboard') ?>">
                <div class="form-row align-items-end">
                    
                    <div class="form-group col-md-3 mb-md-0">
                        <label class="small text-muted font-weight-bold">Status</label>
                        <select name="status" class="form-control custom-select">
                            <option value="">Semua Status</option>
                            <option value="Submitted">Submitted</option>
                            <option value="Verified">Verified</option>
                            <option value="Diproses">Diproses</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3 mb-md-0">
                        <label class="small text-muted font-weight-bold">Kategori</label>
                        <select name="kategori" class="form-control custom-select">
                            <option value="">Semua Kategori</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Keuangan">Keuangan</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-md-0">
                        <label class="small text-muted font-weight-bold">Prioritas</label>
                        <select name="prioritas" class="form-control custom-select">
                            <option value="">Semua Prioritas</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-md-0">
                        <label class="small text-muted font-weight-bold">Unit Tujuan</label>
                        <select name="unit" class="form-control custom-select">
                            <option value="">Semua Unit</option>
                            <option value="ULT">ULT</option>
                            <option value="Akademik">Akademik</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-md-0">
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="background-color: #1a237e; border: none;">
                            <i class="fas fa-search mr-1"></i> Cari
                        </button>
                    </div>

                </div>

                <div class="form-row mt-3">
                    <div class="form-group col-md-12 mb-0">
                        <label class="small text-muted font-weight-bold">Pencarian Keyword</label>
                        <input type="text" name="q" class="form-control" placeholder="Cari Nama / NIM / Nomor Tiket...">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
            <h5 class="font-weight-bold mb-0 text-dark">
                <i class="fas fa-inbox text-primary mr-2"></i>Antrian Tiket Terbaru
            </h5>
            <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                <i class="fas fa-list mr-1"></i>Lihat Semua
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-white" style="background-color: #1a237e;">
                    <tr>
                        <th class="border-0">No Tiket</th>
                        <th class="border-0">Mahasiswa</th>
                        <th class="border-0">Layanan</th>
                        <th class="border-0">Prioritas</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Tanggal</th>
                        <th class="border-0 text-center" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-weight-bold text-primary">ULT-001</td>
                        <td>Rafi Putra</td>
                        <td>Surat Aktif Kuliah</td>
                        <td><span class="badge badge-danger px-2 py-1">High</span></td>
                        <td><span class="badge badge-warning text-white px-2 py-1">Menunggu Verifikasi</span></td>
                        <td>20 Juli 2026</td>
                        <td class="text-center">
                            <a href="<?= base_url('petugas/detail/1') ?>" class="btn btn-info btn-sm rounded-circle mr-1" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-success btn-sm rounded-circle" title="Verifikasi">
                                <i class="fas fa-check"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-primary">ULT-002</td>
                        <td>Siti Nurhaliza</td>
                        <td>Legalisir Ijazah</td>
                        <td><span class="badge badge-warning text-white px-2 py-1">Medium</span></td>
                        <td><span class="badge badge-success px-2 py-1">Terverifikasi</span></td>
                        <td>20 Juli 2026</td>
                        <td class="text-center">
                            <a href="<?= base_url('petugas/detail/2') ?>" class="btn btn-info btn-sm rounded-circle mr-1" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('petugas/disposisi/2') ?>" class="btn btn-primary btn-sm rounded-circle" title="Disposisi">
                                <i class="fas fa-share"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-primary">ULT-003</td>
                        <td>Andi Saputra</td>
                        <td>Surat Keterangan Lulus</td>
                        <td><span class="badge badge-secondary px-2 py-1">Low</span></td>
                        <td><span class="badge badge-info px-2 py-1">Diproses Unit</span></td>
                        <td>19 Juli 2026</td>
                        <td class="text-center">
                            <a href="<?= base_url('petugas/detail/3') ?>" class="btn btn-info btn-sm rounded-circle" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 10px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="font-weight-bold mb-0 text-dark">
                        <i class="fas fa-exclamation-triangle text-danger mr-2"></i>Tiket Prioritas Tinggi
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-white" style="background-color: #1a237e;">
                            <tr>
                                <th class="border-0">No Tiket</th>
                                <th class="border-0">Mahasiswa</th>
                                <th class="border-0">Layanan</th>
                                <th class="border-0">SLA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold text-primary">ULT-004</td>
                                <td>Rafi Putra</td>
                                <td>Surat Aktif Kuliah</td>
                                <td><span class="badge badge-danger px-2 py-1">1 Hari</span></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-primary">ULT-005</td>
                                <td>Siti Nurhaliza</td>
                                <td>Legalisir</td>
                                <td><span class="badge badge-danger px-2 py-1">Hari Ini</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 10px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="font-weight-bold mb-0 text-dark">
                        <i class="fas fa-clock text-warning mr-2"></i>Monitoring SLA
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-white" style="background-color: #1a237e;">
                            <tr>
                                <th class="border-0">Status SLA</th>
                                <th class="border-0">Jumlah</th>
                                <th class="border-0">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-success px-2 py-1">Aman</span></td>
                                <td class="font-weight-bold">96</td>
                                <td class="text-muted">Masih dalam batas SLA</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-warning text-white px-2 py-1">Mendekati Deadline</span></td>
                                <td class="font-weight-bold">14</td>
                                <td class="text-muted">&lt; 24 Jam</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-danger px-2 py-1">Melewati SLA</span></td>
                                <td class="font-weight-bold">3</td>
                                <td class="text-muted">Harus segera diproses</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 10px;">
        <div class="card-header text-white border-0 py-3" style="background-color: #007bff; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h5 class="font-weight-bold mb-0">
                <i class="fas fa-history mr-2"></i>Aktivitas Terbaru
            </h5>
        </div>
        <div class="card-body p-4">
            <span class="badge badge-primary px-3 py-1 mb-3" style="font-size: 0.85rem;">20 Juli 2026</span>
            
            <div class="media mb-3 p-3 border rounded">
                <i class="fas fa-file-alt fa-2x text-primary mr-3 align-self-center"></i>
                <div class="media-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-bold mb-1">Pengajuan Baru</h6>
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>08:15</small>
                    </div>
                    <p class="mb-0 text-muted"><strong class="text-dark">Rafi Putra</strong> mengajukan Surat Aktif Kuliah.</p>
                </div>
            </div>

            <div class="media p-3 border rounded">
                <i class="fas fa-check-circle fa-2x text-success mr-3 align-self-center"></i>
                <div class="media-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-bold mb-1">Tiket Diverifikasi</h6>
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>09:00</small>
                    </div>
                    <p class="mb-0 text-muted">Tiket <strong class="text-primary">ULT-001</strong> berhasil diverifikasi.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>