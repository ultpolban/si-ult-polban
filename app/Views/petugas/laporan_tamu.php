<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* Stat Mini Cards Berwarna Solid Konsisten Tema Dashboard */
.stat-tamu-card {
    border-radius: 12px;
    border: none;
    color: #ffffff;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.stat-tamu-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
}


/* Warna Cards - Tema Dashboard Petugas */
.bg-tamu-navy {
    background-color: #1a237e !important;
}

.bg-tamu-orange {
    background-color: #ff8c00 !important;
}

.bg-tamu-yellow {
    background-color: #f4c400 !important;
}

.bg-tamu-green {
    background-color: #198754 !important;
}


/* Container Ikon Lingkaran */
.icon-tamu-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.22);
    display: flex;
    align-items: center;
    justify-content: center;
}


/* Counter Text */
.counter-tamu {
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.1;
}

    /* Form Controls & Filter Styling */
    .custom-form-control, .custom-select {
        border-color: #ced4da;
        font-size: 0.9rem;
        height: 42px;
        border-radius: 8px;
    }
    .custom-form-control:focus, .custom-select:focus {
        border-color: #1a237e;
        box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.15);
    }

    /* Button Styling */
    .btn-filter-orange {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        height: 42px;
        padding: 0 20px;
        transition: all 0.25s ease-in-out;
    }
    .btn-filter-orange:hover {
        background-color: #e07b00;
        border-color: #e07b00;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(255, 140, 0, 0.35);
        transform: translateY(-1px);
    }
    
    .btn-reset-grey {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #ffffff;
        border-radius: 8px;
        height: 42px;
        width: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease-in-out;
    }
    .btn-reset-grey:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.35);
        transform: translateY(-1px);
    }

    .btn-export-green:hover {
        background-color: #146c43;
        border-color: #13653f;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.35);
        transform: translateY(-1px);
    }

    /* Custom Table Styling */
    .table-custom-header {
        background-color: #1a237e !important;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .table-custom tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-custom tbody tr:hover {
        background-color: #f8f9ff !important;
    }
</style>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-1" style="color: #1a237e; font-size: 1.75rem;">Laporan Tamu</h2>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Kelola, pantau rekapitulasi, dan ekspor data buku kunjungan tamu ULT POLBAN.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas') ?>" class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Laporan Tamu</li>
            </ol>
        </nav>
    </div>

    <div class="row g-3 mb-4">
        
        <div class="col-md-3 col-sm-6">
            <div class="card stat-tamu-card bg-tamu-navy shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.75rem;">Total Tamu</small>
                        <h3 class="counter-tamu text-white mb-0 mt-1" data-target="<?= $total_tamu ?? 24 ?>">0</h3>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-users fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card stat-tamu-card bg-tamu-orange shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.75rem;">Hari Ini</small>
                        <h3 class="counter-tamu text-white mb-0 mt-1" data-target="<?= $tamu_today ?? 3 ?>">0</h3>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-user-clock fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
    <div class="card stat-tamu-card bg-tamu-yellow shadow-sm p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.75rem;">
                    Minggu Ini
                </small>

                <h3 class="counter-tamu text-white mb-0 mt-1" data-target="<?= $tamu_week ?? 11 ?>">
                    0
                </h3>
            </div>

            <div class="icon-tamu-circle text-white">
                <i class="fas fa-calendar-week fs-5"></i>
            </div>
        </div>
    </div>
</div>

        <div class="col-md-3 col-sm-6">
    <div class="card stat-tamu-card bg-tamu-green shadow-sm p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.75rem;">
                    Bulan Ini
                </small>

                <h3 class="counter-tamu text-white mb-0 mt-1" data-target="<?= $tamu_month ?? 24 ?>">
                    0
                </h3>
            </div>

            <div class="icon-tamu-circle text-white">
                <i class="fas fa-calendar-alt fs-5"></i>
            </div>
        </div>
    </div>
</div>

    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: #ffffff;">
        <div class="card-body p-3">
            <form action="" method="GET">
                <div class="row g-2 align-items-center">
                    
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-color: #ced4da; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="keyword" class="form-control border-start-0 ps-2 custom-form-control" 
                                   placeholder="Cari Nama Tamu, Instansi, No HP..." 
                                   value="<?= esc($keyword ?? '') ?>">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-6">
                        <input type="date" name="tgl_mulai" class="form-control custom-form-control" 
                               value="<?= esc($tgl_mulai ?? '') ?>" title="Tanggal Mulai">
                    </div>

                    <div class="col-lg-2 col-md-3 col-6">
                        <input type="date" name="tgl_selesai" class="form-control custom-form-control" 
                               value="<?= esc($tgl_selesai ?? '') ?>" title="Tanggal Selesai">
                    </div>

                    <div class="col-lg-auto col-md-6 d-flex align-items-center">
    <button type="submit" class="btn btn-filter-orange d-inline-flex align-items-center gap-2 mr-3">
        <i class="fas fa-filter"></i>
        <span>Filter</span>
    </button>

    <a href="<?= current_url() ?>" class="btn btn-reset-grey" title="Reset Filter">
        <i class="fas fa-undo" style="font-size: 0.95rem;"></i>
    </a>
</div>


                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header text-white py-3 px-4 d-flex justify-content-between align-items-center" style="background-color: #1a237e;">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-address-book fs-5 me-2"></i>
                <h5 class="mb-0 font-weight-bold" style="font-size: 1.05rem;">Data Buku Tamu</h5>
            </div>
            <span class="badge bg-light text-dark px-3 py-2 font-weight-bold" style="font-size: 0.8rem; border-radius: 6px;">
                Total: <?= count($tamu_list ?? [1]) ?> Data
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr class="table-custom-header text-center">
                            <th style="width: 50px;">No</th>
                            <th>Nama Tamu</th>
                            <th>Instansi / Jabatan</th>
                            <th>No. Kontak / HP</th>
                            <th>Tujuan / Keperluan</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Waktu Datang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tamu_list)): ?>
                            <?php $no = 1; foreach ($tamu_list as $row): ?>
                                <tr class="text-center">
                                    <td class="font-weight-bold text-muted"><?= $no++ ?></td>
                                    <td class="text-start font-weight-semibold text-dark">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary font-weight-bold" style="width: 34px; height: 34px; font-size: 0.85rem; border: 1px solid #1a237e;">
                                                <?= strtoupper(substr($row['nama_tamu'] ?? 'T', 0, 1)) ?>
                                            </div>
                                            <span><?= esc($row['nama_tamu']) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <span class="badge bg-light text-dark border px-2 py-1 me-1"><?= esc($row['instansi'] ?? 'Umum') ?></span>
                                    </td>
                                    <td class="text-muted"><?= esc($row['no_hp'] ?? '-') ?></td>
                                    <td class="text-start" style="max-width: 250px;"><?= esc($row['keperluan']) ?></td>
                                    <td class="text-muted" style="font-size: 0.88rem;">
                                        <?= date('d-m-Y', strtotime($row['created_at'] ?? '2026-07-31')) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark px-2 py-1 font-weight-semibold">
                                            <i class="far fa-clock me-1"></i><?= date('H:i', strtotime($row['created_at'] ?? '14:30')) ?> WIB
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="text-center">
                                <td class="font-weight-bold text-muted">1</td>
                                <td class="text-start font-weight-semibold text-dark">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary font-weight-bold" style="width: 34px; height: 34px; font-size: 0.85rem; border: 1px solid #1a237e;">
                                            A
                                        </div>
                                        <span>Ahmad Fauzi, S.T.</span>
                                    </div>
                                </td>
                                <td class="text-start">
                                    <span class="badge bg-light text-dark border px-2 py-1">Dinas Pendidikan</span>
                                </td>
                                <td class="text-muted">081234567890</td>
                                <td class="text-start">Konsultasi Kerjasama Program Layanan Terpadu</td>
                                <td class="text-muted" style="font-size: 0.88rem;">31-07-2026</td>
                                <td>
                                    <span class="badge bg-info text-dark px-2 py-1 font-weight-semibold">
                                        <i class="far fa-clock me-1"></i>09:15 WIB
                                    </span>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // 1. Animasi Counter Angka Berjalan (Number Count-Up Animation)
        const counters = document.querySelectorAll('.counter-tamu');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1000;
            const stepTime = 30;
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

        // 2. Animasi Fade-In Halus Saat Memuat Kartu
        const mainCards = document.querySelectorAll('.card');
        mainCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(12px)';
            card.style.transition = `all 0.35s ease-out ${index * 0.07}s`;
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        });
    });
</script>

<?= $this->endSection() ?>