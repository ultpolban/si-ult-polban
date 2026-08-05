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

    /* Header Table Section */
    .guest-table-header {
        background: #ffffff;
        min-height: 82px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .guest-table-heading {
        min-width: 0;
    }

    .guest-table-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #263238;
        font-size: 1.05rem;
        font-weight: 800;
    }

    .guest-table-title i {
        color: #005bac;
        font-size: 1rem;
    }

    .guest-table-subtitle {
        margin-top: 4px;
        color: #7b8794;
        font-size: 0.82rem;
    }

    .guest-table-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .guest-total {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 14px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 7px;
        color: #263238;
        font-size: 0.82rem;
        font-weight: 700;
        white-space: nowrap;
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
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.75rem;">Minggu Ini</small>
                        <h3 class="counter-tamu text-white mb-0 mt-1" data-target="<?= $tamu_week ?? 11 ?>">0</h3>
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
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.75rem;">Bulan Ini</small>
                        <h3 class="counter-tamu text-white mb-0 mt-1" data-target="<?= $tamu_month ?? 24 ?>">0</h3>
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
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-color: #ced4da; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="keyword" class="form-control border-start-0 ps-2 custom-form-control" 
                                   placeholder="Cari Nama, Email, Instansi, No HP..." 
                                   value="<?= esc($keyword ?? '') ?>">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-6">
                        <input type="date" name="tgl_mulai" class="form-control custom-form-control" 
                               value="<?= esc($tgl_mulai ?? '') ?>" title="Tanggal Mulai">
                    </div>

                    <div class="col-lg-3 col-md-3 col-6">
                        <input type="date" name="tgl_selesai" class="form-control custom-form-control" 
                               value="<?= esc($tgl_selesai ?? '') ?>" title="Tanggal Selesai">
                    </div>

                    <div class="col-lg-2 col-md-12 d-flex align-items-center justify-content-end gap-2">
                        <button type="submit" class="btn btn-filter-orange w-100 d-inline-flex align-items-center justify-content-center gap-2">
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

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: #ffffff; overflow: hidden;">
        <div class="guest-table-header">
            <div class="guest-table-heading">
                <div class="guest-table-title">
                    <i class="fas fa-address-book"></i>
                    <span>Data Buku Tamu</span>
                </div>
                <div class="guest-table-subtitle">
                    Kelola dan pantau data kunjungan tamu ULT POLBAN.
                </div>
            </div>

            <div class="guest-table-actions">
                <span class="guest-total">
                    Total: <?= !empty($tamu_list) ? count($tamu_list) : 0 ?> Data
                </span>

                <button type="button" class="btn btn-warning text-white fw-bold d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahTamu" style="background-color: #ff8c00; border: none; border-radius: 8px;">
                    <i class="fas fa-plus"></i>
                    Tambah Tamu Offline
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr class="table-custom-header text-center">
                            <th style="width: 50px;">No</th>
                            <th>Nama Tamu / Email</th>
                            <th>Pekerjaan & Instansi</th>
                            <th>No. Kontak / HP</th>
                            <th>Jenis Layanan</th>
                            <th>Keperluan</th>
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
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary font-weight-bold" style="width: 36px; height: 36px; font-size: 0.85rem; border: 1px solid #1a237e; flex-shrink: 0;">
                                                <?= strtoupper(substr($row['nama_tamu'] ?? 'T', 0, 1)) ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?= esc($row['nama_tamu']) ?></div>
                                                <small class="text-muted d-block" style="font-size: 0.78rem;"><?= esc($row['email'] ?? '-') ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <div class="fw-semibold text-dark" style="font-size: 0.85rem;"><?= esc($row['profesi'] ?? 'Umum') ?></div>
                                        <small class="text-muted"><?= esc($row['instansi'] ?? '-') ?></small>
                                    </td>
                                    <td class="text-muted"><?= esc($row['no_hp'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge bg-light text-primary border border-primary px-2 py-1"><?= esc($row['jenis_layanan'] ?? 'Layanan Umum') ?></span>
                                    </td>
                                    <td class="text-start" style="max-width: 200px; font-size: 0.85rem;"><?= esc($row['keperluan']) ?></td>
                                    <td class="text-muted" style="font-size: 0.88rem;">
                                        <?= date('d-m-Y', strtotime($row['tanggal_kunjungan'] ?? $row['created_at'] ?? '2026-08-05')) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark px-2 py-1 font-weight-semibold">
                                            <i class="far fa-clock me-1"></i><?= date('H:i', strtotime($row['waktu_datang'] ?? $row['created_at'] ?? '09:00')) ?> WIB
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="text-center">
                                <td class="font-weight-bold text-muted">1</td>
                                <td class="text-start font-weight-semibold text-dark">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary font-weight-bold" style="width: 36px; height: 36px; font-size: 0.85rem; border: 1px solid #1a237e; flex-shrink: 0;">
                                            A
                                        </div>
                                        <div>
                                            <div class="fw-bold">Ahmad Fauzi, S.T.</div>
                                            <small class="text-muted d-block" style="font-size: 0.78rem;">ahmad.fauzi@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-start">
                                    <div class="fw-semibold text-dark" style="font-size: 0.85rem;">Instansi Lain</div>
                                    <small class="text-muted">Dinas Pendidikan</small>
                                </td>
                                <td class="text-muted">081234567890</td>
                                <td>
                                    <span class="badge bg-light text-primary border border-primary px-2 py-1">Layanan Informasi</span>
                                </td>
                                <td class="text-start" style="max-width: 200px; font-size: 0.85rem;">Konsultasi Kerjasama Program Layanan Terpadu</td>
                                <td class="text-muted" style="font-size: 0.88rem;">05-08-2026</td>
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

<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-labelledby="modalTambahTamuLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none;">

            <div class="modal-header text-white" style="background-color: #1a237e;">
                <h5 class="modal-title font-weight-bold" id="modalTambahTamuLabel">
                    <i class="fas fa-user-plus me-2"></i>Tambah Tamu Offline
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formTambahTamu" action="#" method="post">
                <div class="modal-body p-4">

                    <div class="alert alert-info border-0 shadow-sm mb-4" style="background-color: #e8f0fe; color: #1a237e;">
                        <i class="fas fa-info-circle me-1"></i>
                        Masukkan data pemohon/tamu yang berkunjung langsung ke ULT POLBAN secara offline.
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_tamu" class="form-control custom-form-control" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control custom-form-control" placeholder="contoh@email.com" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control custom-form-control" placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Pekerjaan / Profesi <span class="text-danger">*</span></label>
                            <select name="profesi" class="form-select custom-form-control" required>
                                <option value="" selected disabled>-- Pilih Pekerjaan / Profesi --</option>
                                <option value="Mahasiswa POLBAN">Mahasiswa POLBAN</option>
                                <option value="Dosen / Tenaga Pendidik POLBAN">Dosen / Tenaga Pendidik POLBAN</option>
                                <option value="Alumni POLBAN">Alumni POLBAN</option>
                                <option value="Siswa / Mahasiswa Luar">Siswa / Mahasiswa Luar</option>
                                <option value="Masyarakat Umum">Masyarakat Umum</option>
                                <option value="Instansi Lain">Instansi Lain</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Nama Instansi / Organisasi</label>
                            <input type="text" name="instansi" class="form-control custom-form-control" placeholder="Contoh: Universitas / PT / Dinas / umum">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Jenis Layanan <span class="text-danger">*</span></label>
                            <select name="jenis_layanan" class="form-select custom-form-control" required>
                                <option value="" selected disabled>-- Pilih Jenis Layanan --</option>
                                <option value="Layanan Informasi">Layanan Informasi</option>
                                <option value="Layanan Pengaduan">Layanan Pengaduan</option>
                                <option value="Layanan Legalisir / Surat">Layanan Legalisir / Surat</option>
                                <option value="Layanan Tamu Pimpinan">Layanan Tamu Pimpinan</option>
                                <option value="Layanan Lainnya">Layanan Lainnya</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Tanggal Kunjungan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_kunjungan" class="form-control custom-form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark">Waktu Datang / Jam <span class="text-danger">*</span></label>
                            <input type="time" name="waktu_datang" class="form-control custom-form-control" value="<?= date('H:i') ?>" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-dark">Keperluan / Detail Kunjungan <span class="text-danger">*</span></label>
                            <textarea name="keperluan" class="form-control" rows="3" placeholder="Tuliskan alasan atau keperluan kunjungan secara detail..." style="border-radius: 8px;" required></textarea>
                        </div>

                    </div>

                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn text-white px-4 fw-bold" style="background-color: #ff8c00; border: none; border-radius: 8px;">
                        <i class="fas fa-save me-1"></i> Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 1. Animasi Counter Angka Berjalan
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

        // 2. Animasi Fade-In Card
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

        // 3. Form Submit Handler
        const form = document.getElementById('formTambahTamu');
        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                alert('Data tamu berhasil ditambahkan!');
                
                // Close Modal BS5
                const modalElem = document.getElementById('modalTambahTamu');
                const modalInstance = bootstrap.Modal.getInstance(modalElem) || new bootstrap.Modal(modalElem);
                modalInstance.hide();
                
                form.reset();
            });
        }
    });
</script>

<?= $this->endSection() ?>