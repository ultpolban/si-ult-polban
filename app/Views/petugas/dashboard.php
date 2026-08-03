<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* Global Card & Smooth Transition */
    .dashboard-card {
        border-radius: 12px !important;
        border: none !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    /* Stat Cards Hover & Dynamic Design */
    .stat-card-modern {
        border-radius: 12px !important;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .stat-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }
    .stat-card-icon {
        opacity: 0.25;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }
    .stat-card-modern:hover .stat-card-icon {
        opacity: 0.45;
        transform: scale(1.1);
    }
    .stat-badge-number {
        font-size: 1.1rem !important;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    /* Quick Action Button Styling */
    .btn-quick-action {
        border-radius: 10px !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: none !important;
    }
    .btn-quick-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2) !important;
        filter: brightness(1.05);
    }

    /* Form Filter Controls */
    .form-filter-card {
        border-radius: 12px !important;
        background: #ffffff;
    }
    .custom-select-dashboard, .custom-input-dashboard {
        border-radius: 8px !important;
        border: 1px solid #ced4da;
        height: 42px;
        font-size: 0.9rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .custom-select-dashboard:focus, .custom-input-dashboard:focus {
        border-color: #1a237e;
        box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.15);
    }

    /* Custom Table Header & Rows */
    .table-header-navy {
        background-color: #1a237e !important;
        color: #ffffff;
    }
    .table-hover-custom tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover-custom tbody tr:hover {
        background-color: #f8f9ff !important;
    }

    /* Timeline Indicator untuk Aktivitas Terbaru */
    .activity-timeline {
        position: relative;
        padding-left: 10px;
    }
    .activity-item {
        border-radius: 10px;
        transition: background-color 0.2s ease;
        background: #fdfdfd;
    }
    .activity-item:hover {
        background-color: #f4f6ff;
    }
</style>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1" style="color: #1a237e !important;">Dashboard Petugas ULT</h1>
            <p class="text-muted mb-0">Kelola tiket layanan mahasiswa Politeknik Negeri Bandung.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>" class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Home</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #1a237e;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-primary font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="120">0</span>
                        <h6 class="mb-0 font-weight-bold">Tiket Masuk</h6>
                    </div>
                    <i class="fas fa-envelope fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #ff8c00;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-warning font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="95">0</span>
                        <h6 class="mb-0 font-weight-bold">Diverifikasi</h6>
                    </div>
                    <i class="fas fa-check-circle fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #f1c40f;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-dark font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="20">0</span>
                        <h6 class="mb-0 font-weight-bold text-white">Diproses Unit</h6>
                    </div>
                    <i class="fas fa-spinner fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #107c41;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-success font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="5">0</span>
                        <h6 class="mb-0 font-weight-bold">Terlambat SLA</h6>
                    </div>
                    <i class="fas fa-clock fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm mb-4 dashboard-card">
        <div class="card-header text-white border-0 py-2 px-3" style="background-color: #1a237e; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <h6 class="font-weight-bold mb-0">
                <i class="fas fa-bolt mr-2"></i>Quick Action
            </h6>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="<?= base_url('petugas/tiket') ?>"
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action"
                       style="background:#ff8c00;">
                        <i class="fas fa-ticket-alt fa-2x mr-3"></i>
                        Data Tiket
                    </a>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="<?= base_url('petugas/tiket?status=Submitted') ?>"
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action"
                       style="background:#107c41;">
                        <i class="fas fa-user-check fa-2x mr-3"></i>
                        Verifikasi
                    </a>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="<?= base_url('petugas/tiket?status=Verified') ?>"
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action"
                       style="background:#f1c40f;">
                        <i class="fas fa-share-square fa-2x mr-3"></i>
                        Disposisi
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="javascript:location.reload()" 
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action" 
                       style="background-color: #343a40;">
                        <i class="fas fa-sync-alt fa-2x mr-3"></i> Refresh
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4 dashboard-card form-filter-card">
        <div class="card-body p-3">
            <h6 class="font-weight-bold mb-3" style="color: #1a237e;"><i class="fas fa-filter mr-2"></i>Filter Tiket</h6>
            <form id="formCari" method="GET" action="<?= base_url('petugas/dashboard') ?>">
                <div class="form-row align-items-end">
                    
                    <div class="form-group col-md-3 mb-md-0">
                        <label class="small text-muted font-weight-bold">Status</label>
                        <select name="status" class="form-control custom-select custom-select-dashboard">
                            <option value="">Semua Status</option>
                            <option value="Submitted">Submitted</option>
                            <option value="Verified">Verified</option>
                            <option value="Diproses">Diproses</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3 mb-md-0">
                        <label class="small text-muted font-weight-bold">Kategori</label>
                        <select name="kategori" class="form-control custom-select custom-select-dashboard">
                            <option value="">Semua Kategori</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Keuangan">Keuangan</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-md-0">
                        <label class="small text-muted font-weight-bold">Prioritas</label>
                        <select name="prioritas" class="form-control custom-select custom-select-dashboard">
                            <option value="">Semua Prioritas</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-md-0">
                        <label class="small text-muted font-weight-bold">Unit Tujuan</label>
                        <select name="unit" class="form-control custom-select custom-select-dashboard">
                            <option value="">Semua Unit</option>
                            <option value="ULT">ULT</option>
                            <option value="Akademik">Akademik</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 mb-md-0">
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold btn-quick-action" style="background-color: #1a237e; height: 42px;">
                            <i class="fas fa-search mr-1"></i> Cari
                        </button>
                    </div>

                </div>

                <div class="form-row mt-3">
                    <div class="form-group col-md-12 mb-0">
                        <label class="small text-muted font-weight-bold">Pencarian Keyword</label>
                        <input type="text" name="q" class="form-control custom-input-dashboard" placeholder="Cari Nama / NIM / Nomor Tiket...">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4 dashboard-card overflow-hidden">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3 px-4">
            <h5 class="font-weight-bold mb-0 text-dark">
                <i class="fas fa-inbox text-primary mr-2"></i>Antrian Tiket Terbaru
            </h5>
            <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 font-weight-semibold">
                <i class="fas fa-list mr-1"></i>Lihat Semua
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-hover-custom align-middle mb-0">
                <thead class="table-header-navy">
                    <tr>
                        <th class="border-0 px-4 py-3">No Tiket</th>
                        <th class="border-0 py-3">Mahasiswa</th>
                        <th class="border-0 py-3">Layanan</th>
                        <th class="border-0 py-3">Prioritas</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Tanggal</th>
                        <th class="border-0 text-center py-3" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-weight-bold text-primary px-4">ULT-001</td>
                        <td class="font-weight-semibold text-dark">Rafi Putra</td>
                        <td>Surat Aktif Kuliah</td>
                        <td><span class="badge badge-danger px-2 py-1 font-weight-semibold">High</span></td>
                        <td><span class="badge badge-warning text-white px-2 py-1 font-weight-semibold">Menunggu Verifikasi</span></td>
                        <td class="text-muted">20 Juli 2026</td>
                        <td class="text-center">
                            <a href="<?= base_url('petugas/detail/1') ?>" class="btn btn-info btn-sm rounded-circle mr-1 shadow-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-success btn-sm rounded-circle shadow-sm" title="Verifikasi">
                                <i class="fas fa-check"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-primary px-4">ULT-002</td>
                        <td class="font-weight-semibold text-dark">Siti Nurhaliza</td>
                        <td>Legalisir Ijazah</td>
                        <td><span class="badge badge-warning text-white px-2 py-1 font-weight-semibold">Medium</span></td>
                        <td><span class="badge badge-success px-2 py-1 font-weight-semibold">Terverifikasi</span></td>
                        <td class="text-muted">20 Juli 2026</td>
                        <td class="text-center">
                            <a href="<?= base_url('petugas/detail/2') ?>" class="btn btn-info btn-sm rounded-circle mr-1 shadow-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('petugas/disposisi/2') ?>" class="btn btn-primary btn-sm rounded-circle shadow-sm" title="Disposisi">
                                <i class="fas fa-share"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-primary px-4">ULT-003</td>
                        <td class="font-weight-semibold text-dark">Andi Saputra</td>
                        <td>Surat Keterangan Lulus</td>
                        <td><span class="badge badge-secondary px-2 py-1 font-weight-semibold">Low</span></td>
                        <td><span class="badge badge-info px-2 py-1 font-weight-semibold">Diproses Unit</span></td>
                        <td class="text-muted">19 Juli 2026</td>
                        <td class="text-center">
                            <a href="<?= base_url('petugas/detail/3') ?>" class="btn btn-info btn-sm rounded-circle shadow-sm" title="Detail">
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
            <div class="card border-0 shadow-sm h-100 dashboard-card overflow-hidden">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="font-weight-bold mb-0 text-dark">
                        <i class="fas fa-exclamation-triangle text-danger mr-2"></i>Tiket Prioritas Tinggi
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-hover-custom align-middle mb-0">
                        <thead class="table-header-navy">
                            <tr>
                                <th class="border-0 px-4 py-3">No Tiket</th>
                                <th class="border-0 py-3">Mahasiswa</th>
                                <th class="border-0 py-3">Layanan</th>
                                <th class="border-0 py-3">SLA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold text-primary px-4">ULT-004</td>
                                <td class="font-weight-semibold text-dark">Rafi Putra</td>
                                <td>Surat Aktif Kuliah</td>
                                <td><span class="badge badge-danger px-2 py-1 font-weight-semibold">1 Hari</span></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-primary px-4">ULT-005</td>
                                <td class="font-weight-semibold text-dark">Siti Nurhaliza</td>
                                <td>Legalisir</td>
                                <td><span class="badge badge-danger px-2 py-1 font-weight-semibold">Hari Ini</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100 dashboard-card overflow-hidden">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="font-weight-bold mb-0 text-dark">
                        <i class="fas fa-clock text-warning mr-2"></i>Monitoring SLA
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-hover-custom align-middle mb-0">
                        <thead class="table-header-navy">
                            <tr>
                                <th class="border-0 px-4 py-3">Status SLA</th>
                                <th class="border-0 py-3">Jumlah</th>
                                <th class="border-0 py-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4"><span class="badge badge-success px-2 py-1 font-weight-semibold">Aman</span></td>
                                <td class="font-weight-bold text-dark">96</td>
                                <td class="text-muted">Masih dalam batas SLA</td>
                            </tr>
                            <tr>
                                <td class="px-4"><span class="badge badge-warning text-white px-2 py-1 font-weight-semibold">Mendekati Deadline</span></td>
                                <td class="font-weight-bold text-dark">14</td>
                                <td class="text-muted">&lt; 24 Jam</td>
                            </tr>
                            <tr>
                                <td class="px-4"><span class="badge badge-danger px-2 py-1 font-weight-semibold">Melewati SLA</span></td>
                                <td class="font-weight-bold text-dark">3</td>
                                <td class="text-muted">Harus segera diproses</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm dashboard-card overflow-hidden">
        <div class="card-header text-white border-0 py-3 px-4" style="background-color: #007bff;">
            <h5 class="font-weight-bold mb-0">
                <i class="fas fa-history mr-2"></i>Aktivitas Terbaru
            </h5>
        </div>
        <div class="card-body p-4 activity-timeline">
            <span class="badge badge-primary px-3 py-1 mb-3 shadow-sm" style="font-size: 0.85rem; border-radius: 6px;">20 Juli 2026</span>
            
            <div class="media mb-3 p-3 border rounded activity-item shadow-sm">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3 p-2" style="width: 48px; height: 48px; border: 1px solid #e0e0e0;">
                    <i class="fas fa-file-alt fa-lg text-primary"></i>
                </div>
                <div class="media-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1 text-dark">Pengajuan Baru</h6>
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>08:15</small>
                    </div>
                    <p class="mb-0 text-muted"><strong class="text-dark">Rafi Putra</strong> mengajukan Surat Aktif Kuliah.</p>
                </div>
            </div>

            <div class="media p-3 border rounded activity-item shadow-sm">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3 p-2" style="width: 48px; height: 48px; border: 1px solid #e0e0e0;">
                    <i class="fas fa-check-circle fa-lg text-success"></i>
                </div>
                <div class="media-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold mb-1 text-dark">Tiket Diverifikasi</h6>
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>09:00</small>
                    </div>
                    <p class="mb-0 text-muted">Tiket <strong class="text-primary">ULT-001</strong> berhasil diverifikasi.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // 1. Animasi Counter Angka Berjalan (Number Count-Up Animation)
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1000;
            const stepTime = 25;
            const steps = duration / stepTime;
            const increment = target / steps;
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.innerText = target;
                    clearInterval(timer);
                } else {
                    counter.innerText = Math.ceil(current);
                }
            }, stepTime);
        });

        // 2. Fade In Effect Saat Halaman Dimuat
        const cards = document.querySelectorAll('.dashboard-card, .stat-card-modern');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            card.style.transition = `all 0.3s ease-out ${index * 0.05}s`;
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        });

    });
</script>

<?= $this->endSection() ?>