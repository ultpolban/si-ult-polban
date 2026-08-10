<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* ==========================================================================
       1. GLOBAL & TYPOGRAPHY
       ========================================================================== */
    body, .container-fluid {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        color: #2c3e50;
    }

    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* ==========================================================================
       2. STATISTIC CARDS
       ========================================================================== */
    .stat-tamu-card {
        border-radius: 16px;
        border: none;
        color: #ffffff;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .stat-tamu-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        z-index: -1;
        transition: transform 0.5s ease;
    }

    .stat-tamu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.18) !important;
    }

    .stat-tamu-card:hover::before {
        transform: scale(1.2);
    }

    .bg-tamu-navy { background: linear-gradient(135deg, #1a237e 0%, #283593 100%) !important; }
    .bg-tamu-orange { background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%) !important; }
    .bg-tamu-yellow { background: linear-gradient(135deg, #f4c400 0%, #fb8c00 100%) !important; }
    .bg-tamu-green { background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; }

    .icon-tamu-circle {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.2);
    }

    /* ==========================================================================
       3. CARD & TABEL UTAMA
       ========================================================================== */
    .card-ultra {
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
    }

    .table-ultra {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-ultra thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 16px 18px;
        border-bottom: 2px solid #e2e8f0;
        vertical-align: middle;
    }

    .table-ultra tbody td {
        padding: 14px 18px;
        vertical-align: middle;
        font-size: 0.88rem;
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s ease;
    }

    .table-ultra tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Badges */
    .badge-status {
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 0.3px;
        display: inline-block;
    }
    .badge-verified { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .badge-assigned { background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .badge-submitted { background-color: #e0f2fe; color: #075985; border: 1px solid #bae6fd; }

    .badge-layanan-tag {
        background-color: #f1f5f9;
        color: #334155;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    /* Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-action-view { background-color: #eff6ff; color: #2563eb; }
    .btn-action-view:hover { background-color: #2563eb; color: #ffffff; }

    .btn-action-edit { background-color: #f0fdf4; color: #16a34a; }
    .btn-action-edit:hover { background-color: #16a34a; color: #ffffff; }

    .btn-action-forward { background-color: #faf5ff; color: #9333ea; }
    .btn-action-forward:hover { background-color: #9333ea; color: #ffffff; }

    .btn-action-amber { background-color: #fffbebf5; color: #d97706; }
    .btn-action-amber:hover { background-color: #d97706; color: #ffffff; }

    .btn-action-delete { background-color: #fef2f2; color: #dc2626; }
    .btn-action-delete:hover { background-color: #dc2626; color: #ffffff; }

    /* ==========================================================================
       4. MODALS STYLING (PROFESSIONAL & CLEAN)
       ========================================================================== */
    .modal-content-ultra {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .modal-header-ultra {
        background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
        padding: 20px 28px;
        border: none;
    }

    .modal-icon-badge {
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.18);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-right: 15px;
    }

    .modal-footer-ultra {
        background-color: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 16px 28px;
    }

    .btn-modal-cancel {
        background-color: #e2e8f0;
        color: #475569;
        font-weight: 600;
        border-radius: 10px;
        padding: 9px 20px;
        border: none;
    }
    .btn-modal-cancel:hover { background-color: #cbd5e1; }

    .btn-modal-submit {
        background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
        color: #ffffff;
        font-weight: 600;
        border-radius: 10px;
        padding: 9px 24px;
        border: none;
        box-shadow: 0 4px 12px rgba(26, 35, 126, 0.25);
    }

    .custom-input-group {
        position: relative;
    }
    .custom-input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.95rem;
        z-index: 5;
    }
    .modal-input-field {
        padding-left: 2.5rem !important;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 0.9rem;
    }
    .modal-input-field:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    /* =========================================================
       FORM TAMBAH LAPORAN OFFLINE - STYLE BACKEND
       ========================================================= */
    .offline-form-label {
        display: block;
        margin-bottom: 7px;
        font-size: 0.82rem;
        font-weight: 800;
        color: #334155;
        text-transform: uppercase;
        letter-spacing: 0.2px;
    }

    .offline-form-label .required {
        color: #ef4444;
    }

    .offline-input-group {
        position: relative;
    }

    .offline-input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        z-index: 5;
        pointer-events: none;
    }

    .offline-input,
    .offline-select,
    .offline-textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #334155;
        border-radius: 11px;
        transition: all 0.2s ease;
    }

    .offline-input {
        height: 48px;
        padding: 10px 14px 10px 43px !important;
    }

    .offline-select {
        height: 48px;
        padding: 10px 42px 10px 43px !important;
    }

    .offline-textarea {
        min-height: 120px;
        resize: vertical;
        padding: 13px 15px !important;
        line-height: 1.5;
    }

    .offline-input::placeholder,
    .offline-textarea::placeholder {
        color: #a0aab7;
    }

    .offline-input:focus,
    .offline-select:focus,
    .offline-textarea:focus {
        border-color: #283593;
        box-shadow: 0 0 0 3px rgba(40, 53, 147, 0.12);
        outline: none;
    }

    .offline-info-box {
        background: linear-gradient(135deg, #eef4ff 0%, #e5edff 100%);
        border-left: 4px solid #1a237e;
        border-radius: 10px;
        padding: 13px 16px;
        color: #283593;
        font-size: 0.88rem;
        margin-bottom: 20px;
    }

    .offline-file-box {
        border: 1px dashed #b8c4d6;
        background: #f8fafc;
        border-radius: 11px;
        padding: 10px 12px;
    }

    .offline-file-box input[type="file"] {
        width: 100%;
        font-size: 0.86rem;
        color: #475569;
    }

    .offline-modal-body {
        padding: 24px 28px !important;
    }

    .offline-modal-footer {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 15px 28px;
    }

    .offline-btn-save {
        background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 10px 23px;
        font-weight: 700;
        box-shadow: 0 5px 14px rgba(245, 124, 0, 0.25);
        transition: all 0.2s ease;
    }

    .offline-btn-save:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(245, 124, 0, 0.32);
    }

    .offline-btn-cancel {
        background: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 10px 23px;
        font-weight: 700;
    }

    .offline-btn-cancel:hover {
        background: #f1f5f9;
        color: #334155;
    }

    @media (max-width: 767px) {
        .offline-modal-body {
            padding: 18px !important;
        }

        .offline-modal-footer {
            padding: 14px 18px;
        }
    }
</style>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Laporan Tamu & Tiket</h3>
            <p class="text-muted small mb-0">Kelola dan pantau seluruh data riwayat kunjungan tamu serta status tiket layanan.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Total Tamu</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="8">8</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Submitted</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="1">1</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-paper-plane"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Assigned / Diproses</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="5">5</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-spinner"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Verified / Selesai</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="2">2</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-ultra">
        
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <div class="d-flex align-items-center gap-2">
                <div class="position-relative" style="min-width: 260px;">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" id="quickSearchInput" class="form-control ps-5 rounded-3 border-slate" placeholder="Cari nomor tiket / nama..." style="font-size: 0.88rem; height: 40px;">
                </div>
                <button class="btn btn-outline-primary px-3 rounded-3 fw-bold d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCariTiket" style="height: 40px; font-size: 0.88rem;">
                    <i class="fas fa-filter"></i> Filter & Cari
                </button>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-muted fw-semibold" style="font-size: 0.85rem;">
                    Total Data: <span id="totalDataBadge" class="badge bg-primary text-white fs-6 ms-1 px-2 py-1" style="border-radius: 8px;">8 Tiket</span>
                </div>
                <button class="btn btn-primary px-3 rounded-3 fw-bold d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahTamu" style="background: linear-gradient(135deg, #1a237e 0%, #283593 100%); border: none; height: 40px; font-size: 0.88rem;">
                    <i class="fas fa-plus"></i> Tambah Laporan
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-ultra" id="tabelLaporanTamu">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 50px;">No</th>
                            <th class="text-start">Nomor Tiket</th>
                            <th class="text-start">Nama Pemohon</th>
                            <th class="text-start">Layanan</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                            <th style="width: 190px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tamuTableBody">
                        <?php 
                        $dummy = [
                            ['ULT-20260806074739865', 'Asep', 'Keuangan', 'Verified', '06-08-2026 07:47', 'asep@gmail.com', '081234567890', 'Universitas Padjadjaran', 'Pengajuan rekapitulasi pembayaran UKT.'],
                            ['ULT-20260805023213577', 'Apin', 'Beasiswa', 'Verified', '05-08-2026 02:32', 'apin@polban.ac.id', '082198765432', 'Politeknik Negeri Bandung', 'Penyerahan berkas Beasiswa KIP-K.'],
                            ['ULT-20260730081403481', 'Apin', 'Kemahasiswaan', 'Assigned', '30-07-2026 08:14', 'apin@polban.ac.id', '082198765432', 'Politeknik Negeri Bandung', 'Legalisir sertifikat kemahasiswaan.'],
                            ['ULT-20260730080403262', 'Ikbal', 'Kemahasiswaan', 'Assigned', '30-07-2026 08:04', 'ikbal@gmail.com', '085712345678', 'Universitas Indonesia', 'Izin kegiatan Ormawa.'],
                            ['ULT-20260730002942605', 'Rizki AM', 'Beasiswa', 'Assigned', '30-07-2026 00:29', 'rizki@gmail.com', '081311223344', 'Telkom University', 'Kendala pencairan dana beasiswa.'],
                            ['ULT-20260730002841489', 'Adit', 'Informasi Akademik', 'Assigned', '30-07-2026 00:28', 'adit@gmail.com', '089655443322', 'ITB', 'Prosedur perbaikan nilai KRS.'],
                            ['ULT-20260729065029720', 'Zein Gtg', 'Surat Aktif Kuliah', 'Assigned', '29-07-2026 06:50', 'zein@gmail.com', '081299887766', 'Universitas Pasundan', 'Cetak Surat Aktif Kuliah.'],
                            ['ULT-20260728093734525', 'Zein', 'Surat Aktif Kuliah', 'Submitted', '28-07-2026 09:37', 'zein@gmail.com', '081299887766', 'Universitas Pasundan', 'Permohonan ulang Surat Aktif Kuliah.']
                        ];
                        foreach ($dummy as $i => $d):
                        ?>
                        <tr class="text-center tamu-row" data-notiket="<?= $d[0] ?>" data-nama="<?= strtolower($d[1]) ?>" data-layanan="<?= $d[2] ?>" data-status="<?= $d[3] ?>">
                            <td class="fw-bold text-muted row-number"><?= $i+1 ?></td>
                            <td class="text-start fw-bold text-primary cell-notiket"><?= $d[0] ?></td>
                            <td class="text-start fw-semibold text-dark cell-nama"><?= $d[1] ?></td>
                            <td class="text-start"><span class="badge-layanan-tag cell-layanan"><?= $d[2] ?></span></td>
                            <td>
                                <span class="badge-status cell-status <?= ($d[3] == 'Verified') ? 'badge-verified' : (($d[3] == 'Assigned') ? 'badge-assigned' : 'badge-submitted') ?>">
                                    <?= $d[3] ?>
                                </span>
                            </td>
                            <td class="text-muted fw-medium cell-tanggal" style="font-size: 0.83rem;"><?= $d[4] ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn-action btn-action-view btn-detail-tamu" title="Detail Tiket" data-bs-toggle="modal" data-bs-target="#modalDetailTamu" data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>" data-status="<?= $d[3] ?>" data-tanggal="<?= $d[4] ?>" data-email="<?= $d[5] ?>" data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>" data-deskripsi="<?= $d[8] ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-action btn-action-edit btn-verifikasi-tamu" title="Verifikasi Tiket" data-bs-toggle="modal" data-bs-target="#modalVerifikasiTamu" data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>" data-status="<?= $d[3] ?>" data-email="<?= $d[5] ?>" data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>">
                                        <i class="fas fa-user-check"></i>
                                    </button>
                                    <button class="btn-action btn-action-forward btn-disposisi-tamu" title="Disposisi Tiket" data-bs-toggle="modal" data-bs-target="#modalDisposisiTamu" data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>" data-status="<?= $d[3] ?>" data-email="<?= $d[5] ?>" data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>" data-tanggal="<?= $d[4] ?>">
                                        <i class="fas fa-share"></i>
                                    </button>
                                    <button class="btn-action btn-action-amber btn-edit-tamu" title="Edit Tiket" data-bs-toggle="modal" data-bs-target="#modalEditTiket" data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>" data-status="<?= $d[3] ?>" data-email="<?= $d[5] ?>" data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>" data-deskripsi="<?= $d[8] ?>">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn-action btn-action-delete btn-delete-tamu" title="Delete Tiket" data-bs-toggle="modal" data-bs-target="#modalDeleteTiket" data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="emptySearchState" class="text-center py-5 d-none">
                <i class="fas fa-search-minus text-muted fa-3x mb-3"></i>
                <h6 class="fw-bold text-dark mb-1">Tiket Tidak Ditemukan</h6>
                <p class="text-muted small mb-0">Coba ubah kata kunci pencarian Anda.</p>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-file-signature text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">
                            Tambah Laporan Tamu (Walk In)
                        </h5>
                        <small class="text-white-50">
                            Form input rekapitulasi laporan pengunjung ULT POLBAN
                        </small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form id="formTambahTamu" action="#" method="post">
                <div class="modal-body offline-modal-body">
                    
                    <div class="offline-info-box">
                        <i class="fas fa-info-circle me-2"></i> Masukkan data pemohon/tamu yang berkunjung langsung ke ULT POLBAN secara offline/walk-in.
                    </div>

                    <div class="row g-3">
                        
                        <div class="col-12">
                            <label class="offline-form-label">
                                Jenis Pemohon <span class="required">*</span>
                            </label>
                            <div class="offline-input-group">
                                <i class="fas fa-user-tag offline-input-icon"></i>
                                <select id="addJenisPemohon" name="jenis_pemohon" class="offline-select" required>
                                    <option value="" selected disabled> -- Pilih Jenis Pemohon -- </option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                    <option value="Orang Tua">Orang Tua</option>
                                    <option value="Alumni">Alumni</option>
                                    <option value="Mitra">Mitra</option>
                                    <option value="Publik">Publik</option>
                                    <option value="Masyarakat">Masyarakat</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div id="dynamicFormContainer" class="row g-3">
                                </div>
                        </div>

                        <div class="col-12">
                            <label class="offline-form-label">
                                Keterangan / Deskripsi Keperluan <span class="required">*</span>
                            </label>
                            <textarea id="addDeskripsi" name="deskripsi" class="offline-textarea modal-input-field" placeholder="Tuliskan detail permohonan atau keperluan tamu di sini..." maxlength="500" required style="padding-left: 15px !important;"></textarea>
                            <div class="d-flex justify-content-end mt-1">
                                <small id="charCount" class="text-muted fw-semibold" style="font-size: 0.75rem;">0 / 500 Karakter</small>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="offline-form-label">
                                Lampiran Pendukung <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <div class="offline-file-box">
                                <input type="file" id="addLampiran" name="lampiran" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="mt-1">
                                    <small id="fileInfo" class="text-muted" style="font-size: 0.78rem;">Maksimal ukuran file 5MB. Format: PDF, JPG, JPEG, PNG.</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer offline-modal-footer">
                    <button type="button" class="btn offline-btn-cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" id="submitTambahTamuBtn" class="btn offline-btn-save">
                        <i class="fas fa-save me-1"></i> Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-ticket-alt text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Detail Informasi Tiket</h5>
                        <small class="text-white-50">Informasi lengkap riwayat dan status permohonan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Nomor Tiket</span>
                            <h6 id="dispNoTiket" class="fw-bold text-primary mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Status Saat Ini</span>
                            <div class="mt-1">
                                <span id="dispStatusCurrent" class="badge-status badge-verified">-</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Nama Pemohon</span>
                            <h6 id="dispNama" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Layanan Tujuan</span>
                            <h6 id="dispLayanan" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Email Pemohon</span>
                            <h6 id="dispEmail" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Nomor HP / WhatsApp</span>
                            <h6 id="dispHp" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Instansi / Unit Asal</span>
                            <h6 id="dispInstansi" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Deskripsi / Keperluan</span>
                            <p id="dispDeskripsi" class="text-dark mt-1 mb-0" style="font-size: 0.9rem; line-height: 1.5;">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-ultra">
                <button type="button" class="btn btn-modal-cancel w-100" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerifikasiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-user-check text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Verifikasi Tiket Tamu</h5>
                        <small class="text-white-50">Perbarui status verifikasi data tamu</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formVerifikasiTamu">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="offline-form-label">Nomor Tiket</label>
                        <input type="text" id="verifNoTiket" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 15px !important;">
                    </div>
                    <div class="mb-3">
                        <label class="offline-form-label">Status Verifikasi <span class="required">*</span></label>
                        <select class="offline-select" id="verifStatusSelect" required style="padding-left: 15px !important;">
                            <option value="Submitted">Submitted (Diajukan)</option>
                            <option value="Assigned">Assigned (Diproses)</option>
                            <option value="Verified">Verified (Selesai/Valid)</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="offline-form-label">Catatan Verifikasi</label>
                        <textarea class="offline-textarea" placeholder="Tambahkan catatan verifikasi jika diperlukan..." style="padding-left: 15px !important; min-height: 90px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDisposisiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-share text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Disposisi Tiket</h5>
                        <small class="text-white-50">Teruskan tiket ke unit atau bagian terkait</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDisposisiTamu">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="offline-form-label">Nomor Tiket</label>
                        <input type="text" id="dispNoTiketField" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 15px !important;">
                    </div>
                    <div class="mb-3">
                        <label class="offline-form-label">Tujuan Disposisi Unit <span class="required">*</span></label>
                        <select class="offline-select" required style="padding-left: 15px !important;">
                            <option value="" selected disabled>-- Pilih Unit Tujuan --</option>
                            <option value="Bagian Keuangan">Bagian Keuangan</option>
                            <option value="Bagian Akademik & Kemahasiswaan">Bagian Akademik & Kemahasiswaan</option>
                            <option value="Subbag Kerjasama & Humas">Subbag Kerjasama & Humas</option>
                            <option value="UPT TIK">UPT TIK</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="offline-form-label">Pesan / Instruksi Disposisi <span class="required">*</span></label>
                        <textarea class="offline-textarea" placeholder="Tulis instruksi tindak lanjut untuk unit terkait..." required style="padding-left: 15px !important; min-height: 90px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">Kirim Disposisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-pen text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Edit Data Tiket Tamu</h5>
                        <small class="text-white-50">Perbarui informasi laporan kunjungan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditTiket">
                <div class="modal-body offline-modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="offline-form-label">Nomor Tiket</label>
                            <input type="text" id="editNoTiket" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 15px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Nama Pemohon <span class="required">*</span></label>
                            <input type="text" id="editNama" class="offline-input" required style="padding-left: 15px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Email <span class="required">*</span></label>
                            <input type="email" id="editEmail" class="offline-input" required style="padding-left: 15px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                            <input type="text" id="editHp" class="offline-input" required style="padding-left: 15px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Instansi / Unit <span class="required">*</span></label>
                            <input type="text" id="editInstansi" class="offline-input" required style="padding-left: 15px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                            <select id="editLayanan" class="offline-select" required style="padding-left: 15px !important;">
                                <option value="Keuangan">Keuangan</option>
                                <option value="Beasiswa">Beasiswa</option>
                                <option value="Kemahasiswaan">Kemahasiswaan</option>
                                <option value="Informasi Akademik">Informasi Akademik</option>
                                <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="offline-form-label">Deskripsi Keperluan <span class="required">*</span></label>
                            <textarea id="editDeskripsi" class="offline-textarea" required style="padding-left: 15px !important;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer offline-modal-footer">
                    <button type="button" class="btn offline-btn-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn offline-btn-save">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header bg-danger text-white py-3 px-4 border-0">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge bg-white bg-opacity-25 text-white">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Konfirmasi Hapus Tiket</h5>
                        <small class="text-white-50">Tindakan ini tidak dapat dibatalkan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDeleteTiket">
                <div class="modal-body p-4 text-center">
                    <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                    <h6 class="fw-bold text-dark mb-2">Apakah Anda yakin ingin menghapus tiket ini?</h6>
                    <p class="text-muted small mb-0">Tiket atas nama <span id="delNamaText" class="fw-bold text-dark"></span> dengan nomor <span id="delTiketText" class="fw-bold text-primary"></span> akan dihapus permanen dari sistem.</p>
                </div>
                <div class="modal-footer modal-footer-ultra justify-content-center">
                    <button type="button" class="btn offline-btn-cancel px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4 rounded-3 fw-bold">Ya, Hapus Permanen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCariTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-filter text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Filter & Pencarian Lanjutan</h5>
                        <small class="text-white-50">Saring data berdasarkan status atau layanan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="offline-form-label">Filter Berdasarkan Status</label>
                    <select id="filterStatusModal" class="offline-select" style="padding-left: 15px !important;">
                        <option value="">Semua Status</option>
                        <option value="Verified">Verified</option>
                        <option value="Assigned">Assigned</option>
                        <option value="Submitted">Submitted</option>
                    </select>
                </div>
                <div class="mb-0">
                    <label class="offline-form-label">Filter Berdasarkan Layanan</label>
                    <select id="filterLayananModal" class="offline-select" style="padding-left: 15px !important;">
                        <option value="">Semua Layanan</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="Beasiswa">Beasiswa</option>
                        <option value="Kemahasiswaan">Kemahasiswaan</option>
                        <option value="Informasi Akademik">Informasi Akademik</option>
                        <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer modal-footer-ultra">
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="applyFilterBtn" class="btn btn-modal-submit" data-bs-dismiss="modal">Terapkan Filter</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Live Character Counter untuk Deskripsi
        const deskripsiInput = document.getElementById('addDeskripsi');
        const charCount = document.getElementById('charCount');
        if (deskripsiInput && charCount) {
            deskripsiInput.addEventListener('input', function () {
                const currentLength = this.value.length;
                charCount.innerText = currentLength + ' / 500 Karakter';
            });
        }

        // 2. Quick Search Table Filter
        const quickSearch = document.getElementById('quickSearchInput');
        const tableRows = document.querySelectorAll('.tamu-row');
        const emptyState = document.getElementById('emptySearchState');
        const totalDataBadge = document.getElementById('totalDataBadge');

        function filterTable() {
            const query = quickSearch.value.toLowerCase().trim();
            let visibleCount = 0;

            tableRows.forEach((row, index) => {
                const noTiket = row.dataset.notiket.toLowerCase();
                const nama = row.dataset.nama.toLowerCase();
                const layanan = row.dataset.layanan.toLowerCase();

                if (noTiket.includes(query) || nama.includes(query) || layanan.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                    row.querySelector('.row-number').innerText = visibleCount;
                } else {
                    row.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                emptyState.classList.remove('d-none');
            } else {
                emptyState.classList.add('d-none');
            }

            if (totalDataBadge) {
                totalDataBadge.innerText = visibleCount + ' Tiket';
            }
        }

        if (quickSearch) {
            quickSearch.addEventListener('input', filterTable);
        }

        // 3. Render Form Dinamis Berdasarkan Jenis Pemohon (Mahasiswa, Dosen, Tendik, Orang Tua, Alumni, Mitra, Publik, Masyarakat)
        const jenisPemohonSelect = document.getElementById('addJenisPemohon');
        const dynamicContainer = document.getElementById('dynamicFormContainer');
        const modalTambahTamuEl = document.getElementById('modalTambahTamu');
        const formTambahTamuEl = document.getElementById('formTambahTamu');

        function renderDynamicFields(jenis) {
            if (!dynamicContainer) return;
            let html = '';

            if (jenis === 'Mahasiswa') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">NIM Mahasiswa <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-id-card offline-input-icon"></i>
                            <input type="text" name="nim" class="offline-input modal-input-field" placeholder="Contoh: 211524001" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Mahasiswa <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Budi Santoso" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Program Studi <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-graduation-cap offline-input-icon"></i>
                            <input type="text" name="prodi" class="offline-input modal-input-field" placeholder="Contoh: D4 Teknik Informatika" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Kelas / Jurusan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-chalkboard offline-input-icon"></i>
                            <input type="text" name="kelas" class="offline-input modal-input-field" placeholder="Contoh: 3A - Teknik Komputer" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email Mahasiswa <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="budi@student.polban.ac.id" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="081234567890" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Beasiswa">Beasiswa</option>
                                <option value="Kemahasiswaan">Kemahasiswaan</option>
                                <option value="Informasi Akademik">Informasi Akademik</option>
                                <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                `;
            } else if (jenis === 'Dosen') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">NIP / NIDN Dosen <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-id-badge offline-input-icon"></i>
                            <input type="text" name="nip_nidn" class="offline-input modal-input-field" placeholder="Contoh: 198501012015041001" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Dosen & Gelar <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user-tie offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Dr. Ir. Ahmad, M.T." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Program Studi / Jurusan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-building offline-input-icon"></i>
                            <input type="text" name="prodi_jurusan" class="offline-input modal-input-field" placeholder="Contoh: Teknik Elektro" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Kepegawaian">Kepegawaian</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Kerjasama">Kerjasama</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email Dosen <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="ahmad@polban.ac.id" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="081298765432" required>
                        </div>
                    </div>
                `;
            } else if (jenis === 'Tenaga Kependidikan') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">NIP / NIPK <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-id-badge offline-input-icon"></i>
                            <input type="text" name="nip_tendik" class="offline-input modal-input-field" placeholder="Contoh: 199002022020121002" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Tenaga Kependidikan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user-cog offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Siti Rahma, A.Md." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Unit Kerja / Bagian <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-sitemap offline-input-icon"></i>
                            <input type="text" name="unit_kerja" class="offline-input modal-input-field" placeholder="Contoh: Bagian Keuangan / Akademik" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Kepegawaian">Kepegawaian</option>
                                <option value="Administrasi Umum">Administrasi Umum</option>
                                <option value="Keuangan & Anggaran">Keuangan & Anggaran</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email Kedinasan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="siti.rahma@polban.ac.id" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="085612345678" required>
                        </div>
                    </div>
                `;
            } else if (jenis === 'Orang Tua') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Orang Tua / Wali <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user-shield offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Drs. H. Hartono" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Mahasiswa (Anak) <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-child offline-input-icon"></i>
                            <input type="text" name="nama_mahasiswa" class="offline-input modal-input-field" placeholder="Contoh: Rian Hartono" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">NIM Mahasiswa <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-id-card offline-input-icon"></i>
                            <input type="text" name="nim" class="offline-input modal-input-field" placeholder="Contoh: 211524010" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Jurusan / Program Studi Mahasiswa <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-graduation-cap offline-input-icon"></i>
                            <input type="text" name="prodi_mahasiswa" class="offline-input modal-input-field" placeholder="Contoh: D3 Akuntansi" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email Orang Tua / Wali <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="hartono@gmail.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp Orang Tua <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="081388997766" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Keuangan / UKT">Keuangan / UKT</option>
                                <option value="Akademik & Perkuliahan">Akademik & Perkuliahan</option>
                                <option value="Kemahasiswaan">Kemahasiswaan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                `;
            } else if (jenis === 'Alumni') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Alumni <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user-graduate offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Rian Utama, S.T." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Tahun Lulus / Angkatan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-calendar-alt offline-input-icon"></i>
                            <input type="text" name="tahun_lulus" class="offline-input modal-input-field" placeholder="Contoh: 2022" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Program Studi / Jurusan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-graduation-cap offline-input-icon"></i>
                            <input type="text" name="prodi_alumni" class="offline-input modal-input-field" placeholder="Contoh: D3 Teknik Mesin" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor Ijazah / NIM Lama <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-id-card offline-input-icon"></i>
                            <input type="text" name="nomor_ijazah_nim" class="offline-input modal-input-field" placeholder="Contoh: 181511020" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email Alumni <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="rian.utama@gmail.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="081223344556" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Legalisir Ijazah / Transkrip">Legalisir Ijazah / Transkrip</option>
                                <option value="Surat Keterangan Alumni">Surat Keterangan Alumni</option>
                                <option value="Tracer Study">Tracer Study</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                `;
            } else if (jenis === 'Mitra') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Perwakilan / PIC <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user-tie offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Ir. Joko Santoso" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Instansi / Perusahaan Mitra <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-building offline-input-icon"></i>
                            <input type="text" name="nama_instansi" class="offline-input modal-input-field" placeholder="Contoh: PT Telkom Indonesia Tbk" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Jabatan Perwakilan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-briefcase offline-input-icon"></i>
                            <input type="text" name="jabatan" class="offline-input modal-input-field" placeholder="Contoh: Manager HRD / Partnership" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Bidang Kerjasama <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-handshake offline-input-icon"></i>
                            <input type="text" name="bidang_kerjasama" class="offline-input modal-input-field" placeholder="Contoh: MoU / PKL / Rekrutmen" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email Instansi / PIC <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="joko@telkom.co.id" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp PIC <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="081122334455" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Kerjasama Institusi / MoU">Kerjasama Institusi / MoU</option>
                                <option value="Kunjungan Industri">Kunjungan Industri</option>
                                <option value="Penyaluran Kerja / Job Fair">Penyaluran Kerja / Job Fair</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                `;
            } else if (jenis === 'Publik') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Pemohon <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Dedi Mulyadi" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Lembaga / Organisasi / Media <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-globe offline-input-icon"></i>
                            <input type="text" name="lembaga" class="offline-input modal-input-field" placeholder="Contoh: Media Pikiran Rakyat" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email Pemohon <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="dedi@media.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="081987654321" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Permintaan Informasi Publik (PPID)">Permintaan Informasi Publik (PPID)</option>
                                <option value="Wawancara / Liputan Media">Wawancara / Liputan Media</option>
                                <option value="Studi Banding">Studi Banding</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                `;
            } else if (jenis === 'Masyarakat') {
                html = `
                    <div class="col-md-6">
                        <label class="offline-form-label">Nama Lengkap <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-user offline-input-icon"></i>
                            <input type="text" name="nama_pemohon" class="offline-input modal-input-field" placeholder="Contoh: Wawan Gunawan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor KTP / NIK <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-id-card offline-input-icon"></i>
                            <input type="text" name="nik" class="offline-input modal-input-field" placeholder="Contoh: 3273xxxxxxxxxxxx" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Email <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-envelope offline-input-icon"></i>
                            <input type="email" name="email" class="offline-input modal-input-field" placeholder="wawan@gmail.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-phone-alt offline-input-icon"></i>
                            <input type="tel" name="no_hp" class="offline-input modal-input-field" placeholder="085222333444" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="offline-form-label">Alamat Domisili <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-map-marker-alt offline-input-icon"></i>
                            <input type="text" name="alamat" class="offline-input modal-input-field" placeholder="Contoh: Jl. Gegerkalong Hilir No. 10, Bandung" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                        <div class="offline-input-group">
                            <i class="fas fa-concierge-bell offline-input-icon"></i>
                            <select name="layanan" class="offline-select modal-input-field" required>
                                <option value="" selected disabled> -- Pilih Layanan -- </option>
                                <option value="Pengaduan / Aspirasi Masyarakat">Pengaduan / Aspirasi Masyarakat</option>
                                <option value="Penggunaan Fasilitas Umum">Penggunaan Fasilitas Umum</option>
                                <option value="Layanan Umum Lainnya">Layanan Umum Lainnya</option>
                            </select>
                        </div>
                    </div>
                `;
            }
            dynamicContainer.innerHTML = html;
        }

        if (jenisPemohonSelect) {
            jenisPemohonSelect.addEventListener('change', function() {
                renderDynamicFields(this.value);
            });
        }

        // Reset form & dynamic container saat modal ditutup (agar saat dibuka lagi kembali ke halaman awal/kosong sesuai foto 5)
        if (modalTambahTamuEl) {
            modalTambahTamuEl.addEventListener('hidden.bs.modal', function () {
                if (formTambahTamuEl) {
                    formTambahTamuEl.reset();
                }
                if (dynamicContainer) {
                    dynamicContainer.innerHTML = '';
                }
                if (charCount) {
                    charCount.innerText = '0 / 500 Karakter';
                }
                if (fileInfo) {
                    fileInfo.innerText = 'Maksimal ukuran file 5MB. Format: PDF, JPG, JPEG, PNG.';
                }
            });
        }

        // 4. Populate Detail Modal
        const detailButtons = document.querySelectorAll('.btn-detail-tamu');
        detailButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('dispNoTiket').innerText = this.dataset.notiket;
                document.getElementById('dispNama').innerText = this.dataset.nama;
                document.getElementById('dispLayanan').innerText = this.dataset.layanan;
                document.getElementById('dispEmail').innerText = this.dataset.email;
                document.getElementById('dispHp').innerText = this.dataset.hp;
                document.getElementById('dispInstansi').innerText = this.dataset.instansi;
                document.getElementById('dispDeskripsi').innerText = this.dataset.deskripsi;

                const badge = document.getElementById('dispStatusCurrent');
                const status = this.dataset.status;
                badge.innerText = status;
                badge.className = 'badge-status ' + (status === 'Verified' ? 'badge-verified' : (status === 'Assigned' ? 'badge-assigned' : 'badge-submitted'));
            });
        });

        // 5. Populate Verifikasi Modal
        const verifButtons = document.querySelectorAll('.btn-verifikasi-tamu');
        verifButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('verifNoTiket').value = this.dataset.notiket;
                document.getElementById('verifStatusSelect').value = this.dataset.status;
            });
        });

        // 6. Populate Disposisi Modal
        const disposisiButtons = document.querySelectorAll('.btn-disposisi-tamu');
        disposisiButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('dispNoTiketField').value = this.dataset.notiket;
            });
        });

        // 7. Populate Edit Modal
        const editButtons = document.querySelectorAll('.btn-edit-tamu');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('editNoTiket').value = this.dataset.notiket;
                document.getElementById('editNama').value = this.dataset.nama;
                document.getElementById('editEmail').value = this.dataset.email;
                document.getElementById('editHp').value = this.dataset.hp;
                document.getElementById('editInstansi').value = this.dataset.instansi;
                document.getElementById('editLayanan').value = this.dataset.layanan;
                document.getElementById('editDeskripsi').value = this.dataset.deskripsi;
            });
        });

        // 8. Populate Delete Modal
        const deleteButtons = document.querySelectorAll('.btn-delete-tamu');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('delTiketText').innerText = this.dataset.notiket;
                document.getElementById('delNamaText').innerText = this.dataset.nama;
            });
        });

        // 9. File Upload Validation (Client-Side)
        const addLampiran = document.getElementById('addLampiran');
        const fileInfo = document.getElementById('fileInfo');

        if (addLampiran) {
            addLampiran.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) {
                    fileInfo.innerText = 'Maksimal ukuran file 5MB. Format: PDF, JPG, JPEG, PNG.';
                    return;
                }

                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                    this.value = '';
                    fileInfo.innerText = 'Maksimal ukuran file 5MB. Format: PDF, JPG, JPEG, PNG.';
                    return;
                }

                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak valid! Harus PDF, JPG, atau PNG.');
                    this.value = '';
                    fileInfo.innerText = 'Maksimal ukuran file 5MB. Format: PDF, JPG, JPEG, PNG.';
                    return;
                }

                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                fileInfo.innerHTML = `<span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> File terpilih: ${file.name} (${sizeMB} MB)</span>`;
            });
        }

        // 10. Event Submit Forms (Alert Simulasi)
        document.getElementById('formTambahTamu')?.addEventListener('submit', function (e) {
            e.preventDefault();
            const submitBtn = document.getElementById('submitTambahTamuBtn');
            const originalContent = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.85';
            submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...`;

            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.innerHTML = originalContent;

                const modalInstance = bootstrap.Modal.getInstance(modalTambahTamuEl);
                modalInstance.hide();

                alert('✨ Laporan tamu offline berhasil tersimpan!');
                this.reset();
                if (dynamicContainer) dynamicContainer.innerHTML = '';
                if (charCount) charCount.innerText = '0 / 500 Karakter';
                if (fileInfo) fileInfo.innerText = 'Maksimal ukuran file 5MB. Format: PDF, JPG, JPEG, PNG.';
            }, 1000);
        });

        document.getElementById('formVerifikasiTamu')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('✨ Status verifikasi tiket berhasil diperbarui!');
            bootstrap.Modal.getInstance(document.getElementById('modalVerifikasiTamu')).hide();
        });

        document.getElementById('formDisposisiTamu')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('✨ Tiket berhasil didisposisikan ke unit tujuan!');
            bootstrap.Modal.getInstance(document.getElementById('modalDisposisiTamu')).hide();
        });

        document.getElementById('formEditTiket')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('✨ Data tiket berhasil diperbarui!');
            bootstrap.Modal.getInstance(document.getElementById('modalEditTiket')).hide();
        });

        document.getElementById('formDeleteTiket')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('🗑️ Tiket berhasil dihapus dari sistem!');
            bootstrap.Modal.getInstance(document.getElementById('modalDeleteTiket')).hide();
        });
    });
</script>

<?= $this->endSection() ?>