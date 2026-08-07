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
                                    <button class="btn-action btn-action-view btn-detail-tamu" title="Detail Tiket"
                                            data-bs-toggle="modal" data-bs-target="#modalDetailTamu"
                                            data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>"
                                            data-status="<?= $d[3] ?>" data-tanggal="<?= $d[4] ?>" data-email="<?= $d[5] ?>"
                                            data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>" data-deskripsi="<?= $d[8] ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button class="btn-action btn-action-edit btn-verifikasi-tamu" title="Verifikasi Tiket"
                                            data-bs-toggle="modal" data-bs-target="#modalVerifikasiTamu"
                                            data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>"
                                            data-status="<?= $d[3] ?>" data-email="<?= $d[5] ?>" data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>">
                                        <i class="fas fa-user-check"></i>
                                    </button>

                                    <button class="btn-action btn-action-forward btn-disposisi-tamu" title="Disposisi Tiket"
                                            data-bs-toggle="modal" data-bs-target="#modalDisposisiTamu"
                                            data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>"
                                            data-status="<?= $d[3] ?>" data-email="<?= $d[5] ?>" data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>" data-tanggal="<?= $d[4] ?>">
                                        <i class="fas fa-share"></i>
                                    </button>

                                    <button class="btn-action btn-action-amber btn-edit-tamu" title="Edit Tiket"
                                            data-bs-toggle="modal" data-bs-target="#modalEditTiket"
                                            data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>" data-layanan="<?= $d[2] ?>"
                                            data-status="<?= $d[3] ?>" data-email="<?= $d[5] ?>" data-hp="<?= $d[6] ?>" data-instansi="<?= $d[7] ?>" data-deskripsi="<?= $d[8] ?>">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button class="btn-action btn-action-delete btn-delete-tamu" title="Delete Tiket"
                                            data-bs-toggle="modal" data-bs-target="#modalDeleteTiket"
                                            data-notiket="<?= $d[0] ?>" data-nama="<?= $d[1] ?>">
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

<!-- =========================================================
     MODAL TAMBAH LAPORAN OFFLINE
     ========================================================= -->
<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content modal-content-ultra">

            <!-- HEADER -->
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

                <button
                    type="button"
                    class="btn-close btn-close-white opacity-100"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            <!-- FORM -->
            <form id="formTambahTamu" action="#" method="post">

                <div class="modal-body offline-modal-body">

                    <!-- INFO -->
                    <div class="offline-info-box">
                        <i class="fas fa-info-circle me-2"></i>
                        Masukkan data pemohon/tamu yang berkunjung langsung ke ULT POLBAN secara offline/walk-in.
                    </div>


                    <div class="row g-3">

                        <!-- JENIS PEMOHON -->
                        <div class="col-md-6">

                            <label class="offline-form-label">
                                Jenis Pemohon
                                <span class="required">*</span>
                            </label>

                            <div class="offline-input-group">

                                <i class="fas fa-user-tag offline-input-icon"></i>

                                <select
                                    id="addJenisPemohon"
                                    name="jenis_pemohon"
                                    class="offline-select"
                                    required>

                                    <option value="" selected disabled>
                                        -- Pilih Jenis Pemohon --
                                    </option>

                                    <option value="Mahasiswa">
                                        Mahasiswa
                                    </option>

                                    <option value="Dosen">
                                        Dosen
                                    </option>

                                    <option value="Tenaga Kependidikan">
                                        Tenaga Kependidikan
                                    </option>

                                    <option value="Alumni">
                                        Alumni
                                    </option>

                                    <option value="Masyarakat Umum">
                                        Masyarakat Umum
                                    </option>

                                    <option value="Instansi">
                                        Instansi
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- NAMA PEMOHON -->
                        <div class="col-md-6">

                            <label class="offline-form-label">
                                Nama Pemohon
                                <span class="required">*</span>
                            </label>

                            <div class="offline-input-group">

                                <i class="fas fa-user offline-input-icon"></i>

                                <input
                                    type="text"
                                    id="addNama"
                                    name="nama"
                                    class="offline-input"
                                    placeholder="Masukkan nama pemohon"
                                    required>

                            </div>

                        </div>


                        <!-- NIM / NIP / NIK -->
                        <div class="col-md-6">

                            <label class="offline-form-label">
                                NIM / NIP / NIK
                            </label>

                            <div class="offline-input-group">

                                <i class="fas fa-id-card offline-input-icon"></i>

                                <input
                                    type="text"
                                    id="addIdentitas"
                                    name="identitas"
                                    class="offline-input"
                                    placeholder="Masukkan NIM / NIP / NIK">

                            </div>

                        </div>


                        <!-- EMAIL -->
                        <div class="col-md-6">

                            <label class="offline-form-label">
                                Email
                                <span class="required">*</span>
                            </label>

                            <div class="offline-input-group">

                                <i class="fas fa-envelope offline-input-icon"></i>

                                <input
                                    type="email"
                                    id="addEmail"
                                    name="email"
                                    class="offline-input"
                                    placeholder="Contoh: email@domain.com"
                                    required>

                            </div>

                        </div>


                        <!-- NO HP -->
                        <div class="col-md-6">

                            <label class="offline-form-label">
                                No HP / WhatsApp
                                <span class="required">*</span>
                            </label>

                            <div class="offline-input-group">

                                <i class="fas fa-phone offline-input-icon"></i>

                                <input
                                    type="tel"
                                    id="addHp"
                                    name="no_hp"
                                    class="offline-input"
                                    placeholder="08xxxxxxxxxx"
                                    required>

                            </div>

                        </div>


                        <!-- JENIS LAYANAN -->
                        <div class="col-md-6">

                            <label class="offline-form-label">
                                Jenis Layanan
                                <span class="required">*</span>
                            </label>

                            <div class="offline-input-group">

                                <i class="fas fa-concierge-bell offline-input-icon"></i>

                                <select
                                    id="addLayanan"
                                    name="layanan"
                                    class="offline-select"
                                    required>

                                    <option value="" selected disabled>
                                        -- Pilih Jenis Layanan --
                                    </option>

                                    <option value="Keuangan">
                                        Keuangan
                                    </option>

                                    <option value="Beasiswa">
                                        Beasiswa
                                    </option>

                                    <option value="Kemahasiswaan">
                                        Kemahasiswaan
                                    </option>

                                    <option value="Informasi Akademik">
                                        Informasi Akademik
                                    </option>

                                    <option value="Surat Aktif Kuliah">
                                        Surat Aktif Kuliah
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- JUDUL TIKET -->
                        <div class="col-12">

                            <label class="offline-form-label">
                                Judul Tiket
                                <span class="required">*</span>
                            </label>

                            <div class="offline-input-group">

                                <i class="fas fa-heading offline-input-icon"></i>

                                <input
                                    type="text"
                                    id="addJudul"
                                    name="judul"
                                    class="offline-input"
                                    placeholder="Masukkan judul tiket"
                                    required>

                            </div>

                        </div>


                        <!-- DESKRIPSI -->
                        <div class="col-12">

                            <div class="d-flex justify-content-between align-items-center mb-1">

                                <label class="offline-form-label mb-0">
                                    Deskripsi / Keperluan
                                    <span class="required">*</span>
                                </label>

                                <small
                                    class="text-muted"
                                    id="charCount"
                                    style="font-size: 0.78rem;">
                                    0 / 500 Karakter
                                </small>

                            </div>

                            <textarea
                                id="addDeskripsi"
                                name="deskripsi"
                                class="offline-textarea"
                                maxlength="500"
                                placeholder="Tuliskan deskripsi detail laporan atau keperluan tamu..."
                                required></textarea>

                        </div>


                        <!-- LAMPIRAN -->
                        <div class="col-12">

                            <label class="offline-form-label">
                                Lampiran (PDF/JPG/PNG maks. 5MB)
                            </label>

                            <div class="offline-file-box">

                                <div class="d-flex align-items-center gap-2">

                                    <i class="fas fa-paperclip text-secondary"></i>

                                    <input
                                        type="file"
                                        id="addLampiran"
                                        name="lampiran"
                                        accept=".pdf,.jpg,.jpeg,.png">

                                </div>

                                <small
                                    id="fileInfo"
                                    class="text-muted d-block mt-2">
                                    Maksimal ukuran file 5MB.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- FOOTER -->
                <div class="modal-footer offline-modal-footer justify-content-end gap-2">

                    <button
                        type="button"
                        class="btn offline-btn-cancel"
                        data-bs-dismiss="modal">

                        <i class="fas fa-times me-1"></i>
                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn offline-btn-save">

                        <i class="fas fa-save me-1"></i>
                        Simpan Laporan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<div class="modal fade" id="modalDetailTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge"><i class="fas fa-file-invoice text-white"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Detail Informasi Tiket</h5>
                        <small class="text-white-50">Informasi lengkap riwayat pengajuan layanan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">NOMOR TIKET</label>
                        <p id="dispNoTiket" class="fw-bold text-primary fs-6 mb-2">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">STATUS SAAT INI</label>
                        <p class="mb-2"><span id="dispStatusCurrent" class="badge-status badge-verified">-</span></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">NAMA PEMOHON</label>
                        <p id="dispNama" class="fw-semibold text-dark mb-2">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">INSTANSI / JABATAN</label>
                        <p id="dispInstansi" class="fw-semibold text-dark mb-2">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">EMAIL PEMOHON</label>
                        <p id="dispEmail" class="text-dark mb-2">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">NOMOR HP / WHATSAPP</label>
                        <p id="dispHp" class="text-dark mb-2">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">KATEGORI LAYANAN</label>
                        <p class="mb-2"><span id="dispLayanan" class="badge-layanan-tag">-</span></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold">TANGGAL MASUK</label>
                        <p id="dispTanggal" class="text-dark mb-2">-</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small fw-bold">DESKRIPSI / KEPERLUAN</label>
                        <div class="p-3 bg-light rounded-3 border text-dark" id="dispDeskripsi" style="font-size: 0.9rem;">-</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-ultra justify-content-end">
                <button type="button" class="btn btn-modal-submit" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerifikasiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge"><i class="fas fa-user-check text-white"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Verifikasi Tiket</h5>
                        <small class="text-white-50">Perbarui status verifikasi permohonan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formVerifikasiTamu" action="#" method="post">
                <div class="modal-body p-4">
                    <input type="hidden" id="verifNoTiket" name="no_tiket">
                    <div class="mb-3">
                        <label class="text-muted small fw-bold">NOMOR TIKET DIPROSES</label>
                        <p id="verifDisplayTiket" class="fw-bold text-success fs-6 mb-1">-</p>
                        <p class="text-muted small mb-0">Pemohon: <strong id="verifDisplayNama" class="text-dark">-</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Status Verifikasi <span class="text-danger">*</span></label>
                        <select id="verifStatusSelect" name="status" class="form-select modal-input-field" required>
                            <option value="Verified">Verified (Selesai & Valid)</option>
                            <option value="Assigned">Assigned (Sedang Diproses)</option>
                            <option value="Submitted">Submitted (Menunggu Verifikasi)</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">Catatan Verifikator</label>
                        <textarea name="catatan_verifikasi" class="form-control" rows="3" placeholder="Tuliskan catatan verifikasi (opsional)..." style="border-radius: 10px; border: 1px solid #cbd5e1;"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra justify-content-end gap-2">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold px-4" style="border-radius: 10px; background-color: #059669; border: none;">
                        <i class="fas fa-check-circle me-1"></i> Simpan Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDisposisiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra" style="background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%);">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge"><i class="fas fa-share text-white"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Disposisi Tiket</h5>
                        <small class="text-white-50">Teruskan penanganan tiket ke unit / bagian terkait</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDisposisiTamu" action="#" method="post">
                <div class="modal-body p-4">
                    <input type="hidden" id="dispNoTiketVal" name="no_tiket">
                    <div class="mb-3">
                        <label class="text-muted small fw-bold">NOMOR TIKET</label>
                        <p id="dispDisposisiTiketText" class="fw-bold fs-6 mb-1 text-purple" style="color: #9333ea;">-</p>
                        <p class="text-muted small mb-0">Pemohon: <strong id="dispDisposisiNamaText" class="text-dark">-</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tujuan Unit / Bagian <span class="text-danger">*</span></label>
                        <select id="disposisiUnit" name="unit_tujuan" class="form-select modal-input-field" required>
                            <option value="" selected disabled>-- Pilih Unit Tujuan Disposisi --</option>
                            <option value="Subbag Keuangan & Akuntansi">Subbag Keuangan & Akuntansi</option>
                            <option value="Bagian Akademik & Kemahasiswaan">Bagian Akademik & Kemahasiswaan</option>
                            <option value="Pusat Layanan Beasiswa">Pusat Layanan Beasiswa</option>
                            <option value="Bagian Umum & Perlengkapan">Bagian Umum & Perlengkapan</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">Pesan / Instruksi Disposisi <span class="text-danger">*</span></label>
                        <textarea name="pesan_disposisi" class="form-control" rows="3" placeholder="Tuliskan instruksi penanganan untuk unit terkait..." style="border-radius: 10px; border: 1px solid #cbd5e1;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra justify-content-end gap-2">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn fw-bold px-4 text-white" style="border-radius: 10px; background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%); border: none;">
                        <i class="fas fa-paper-plane me-1"></i> Kirim Disposisi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra" style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%);">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge"><i class="fas fa-edit text-white"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Edit Data Tiket</h5>
                        <small class="text-white-50">Perbarui informasi pengajuan tiket pemohon</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditTiket" action="#" method="post">
                <div class="modal-body p-4">
                    <input type="hidden" id="editNoTiket" name="no_tiket">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Lengkap Pemohon</label>
                            <input type="text" id="editNama" name="nama" class="form-control modal-input-field" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Instansi / Jabatan</label>
                            <input type="text" id="editInstansi" name="instansi" class="form-control modal-input-field" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kategori Layanan</label>
                            <select id="editLayanan" name="layanan" class="form-select modal-input-field" required>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Beasiswa">Beasiswa</option>
                                <option value="Kemahasiswaan">Kemahasiswaan</option>
                                <option value="Informasi Akademik">Informasi Akademik</option>
                                <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status Tiket</label>
                            <select id="editStatus" name="status" class="form-select modal-input-field" required>
                                <option value="Submitted">Submitted</option>
                                <option value="Assigned">Assigned</option>
                                <option value="Verified">Verified</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" id="editEmail" name="email" class="form-control modal-input-field" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">No. WhatsApp / HP</label>
                            <input type="tel" id="editHp" name="no_hp" class="form-control modal-input-field" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Deskripsi Kebutuhan</label>
                            <textarea id="editDeskripsi" name="deskripsi" class="form-control" rows="3" style="border-radius: 10px; border: 1px solid #cbd5e1; padding: 12px;" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra justify-content-end gap-2">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit" style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%);">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge"><i class="fas fa-exclamation-triangle text-white"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Konfirmasi Hapus Tiket</h5>
                        <small class="text-white-50">Tindakan ini tidak dapat dibatalkan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3" style="width: 70px; height: 70px;">
                    <i class="fas fa-trash-alt fa-2x"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">Apakah Anda yakin ingin menghapus tiket ini?</h6>
                <p class="text-muted small mb-0">Tiket <strong id="deleteDisplayNoTiket" class="text-danger">ULT-XXXXX</strong> milik <strong id="deleteDisplayNama" class="text-dark">Pemohon</strong> akan dihapus permanen.</p>
            </div>
            <div class="modal-footer modal-footer-ultra justify-content-center gap-2">
                <button type="button" class="btn btn-modal-cancel px-4" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnConfirmDelete" class="btn btn-danger px-4 fw-bold" style="border-radius: 10px; padding: 9px 24px;">
                    <i class="fas fa-trash-alt me-1"></i> Ya, Hapus Tiket
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCariTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge"><i class="fas fa-search text-white"></i></div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Cari Tiket</h5>
                        <small class="text-white-50">Filter laporan berdasarkan kata kunci</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Nomor Tiket / Nama Pemohon</label>
                    <input type="text" id="filterKeyword" class="form-control modal-input-field" placeholder="Contoh: ULT-2026 / Asep">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Kategori Layanan</label>
                    <select id="filterLayanan" class="form-select modal-input-field">
                        <option value="">-- Semua Layanan --</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="Beasiswa">Beasiswa</option>
                        <option value="Kemahasiswaan">Kemahasiswaan</option>
                        <option value="Informasi Akademik">Informasi Akademik</option>
                        <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer modal-footer-ultra justify-content-between">
                <button type="button" id="btnResetFilter" class="btn btn-link text-danger text-decoration-none fw-bold p-0"><i class="fas fa-undo me-1"></i> Reset</button>
                <div>
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="button" id="btnApplyFilter" class="btn btn-primary" style="border-radius: 8px; background-color: #1a237e;"><i class="fas fa-search me-1"></i> Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // 1. FUNGSI UPDATE NOMOR URUT REALTIME
        function updateRowNumbers() {
            const visibleRows = document.querySelectorAll('#tamuTableBody tr.tamu-row:not(.d-none)');
            let count = 0;

            visibleRows.forEach((row) => {
                count++;
                const cellNum = row.querySelector('.row-number');
                if (cellNum) {
                    cellNum.innerText = count;
                }
            });

            const totalBadge = document.getElementById('totalDataBadge');
            if (totalBadge) {
                totalBadge.innerText = `${count} Tiket`;
            }

            const emptyState = document.getElementById('emptySearchState');
            if (emptyState) {
                if (count === 0) {
                    emptyState.classList.remove('d-none');
                } else {
                    emptyState.classList.add('d-none');
                }
            }
        }

        updateRowNumbers();

        // 2. STATS COUNTER ANIMATION
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let current = 0;
            const increment = target / 25;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.innerText = target;
                    clearInterval(timer);
                } else {
                    counter.innerText = Math.ceil(current);
                }
            }, 30);
        });

        // 3. FITUR PENCARIAN & FILTER
        const quickSearchInput = document.getElementById('quickSearchInput');
        const filterKeyword = document.getElementById('filterKeyword');
        const filterLayanan = document.getElementById('filterLayanan');
        const btnApplyFilter = document.getElementById('btnApplyFilter');
        const btnResetFilter = document.getElementById('btnResetFilter');

        function applyFilter() {
            const kw = (quickSearchInput.value || filterKeyword.value || '').toLowerCase().trim();
            const selectedLayanan = (filterLayanan.value || '').toLowerCase().trim();
            const rows = document.querySelectorAll('#tamuTableBody tr.tamu-row');

            rows.forEach(row => {
                const noTiket = (row.getAttribute('data-notiket') || '').toLowerCase();
                const nama = (row.getAttribute('data-nama') || '').toLowerCase();
                const layanan = (row.getAttribute('data-layanan') || '').toLowerCase();

                const matchKeyword = !kw || noTiket.includes(kw) || nama.includes(kw);
                const matchLayanan = !selectedLayanan || layanan === selectedLayanan;

                if (matchKeyword && matchLayanan) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            });

            updateRowNumbers();
        }

        quickSearchInput?.addEventListener('input', function() {
            if (filterKeyword) filterKeyword.value = this.value;
            applyFilter();
        });

        btnApplyFilter?.addEventListener('click', function() {
            if (quickSearchInput && filterKeyword) quickSearchInput.value = filterKeyword.value;
            applyFilter();
            const modalCari = bootstrap.Modal.getInstance(document.getElementById('modalCariTiket'));
            if (modalCari) modalCari.hide();
        });

        btnResetFilter?.addEventListener('click', function() {
            if (quickSearchInput) quickSearchInput.value = '';
            if (filterKeyword) filterKeyword.value = '';
            if (filterLayanan) filterLayanan.value = '';
            applyFilter();
        });

        // 4. KARAKTER COUNTER TAMBAH LAPORAN
        const addDeskripsi = document.getElementById('addDeskripsi');
        const charCount = document.getElementById('charCount');
        if (addDeskripsi && charCount) {
            addDeskripsi.addEventListener('input', function () {
                charCount.innerText = `${this.value.length} / 500 Karakter`;
            });
        }

        // 5. EVENT BINDING UNTUK SEMUA TOMBOL AKSI DI TIAP BARIS TABEL
        function bindRowEvents(row) {
            // A. Tombol Detail
            const btnDetail = row.querySelector('.btn-detail-tamu');
            if (btnDetail) {
                btnDetail.addEventListener('click', function () {
                    document.getElementById('dispNoTiket').innerText = this.dataset.notiket;
                    document.getElementById('dispNama').innerText = this.dataset.nama;
                    document.getElementById('dispInstansi').innerText = this.dataset.instansi || '-';
                    document.getElementById('dispEmail').innerText = this.dataset.email;
                    document.getElementById('dispHp').innerText = this.dataset.hp;
                    document.getElementById('dispLayanan').innerText = this.dataset.layanan;
                    document.getElementById('dispTanggal').innerText = this.dataset.tanggal;
                    document.getElementById('dispDeskripsi').innerText = this.dataset.deskripsi || '-';
                    
                    const statusBadge = document.getElementById('dispStatusCurrent');
                    const st = this.dataset.status;
                    statusBadge.innerText = st;
                    statusBadge.className = `badge-status ${st === 'Verified' ? 'badge-verified' : (st === 'Assigned' ? 'badge-assigned' : 'badge-submitted')}`;
                });
            }

            // B. Tombol Verifikasi
            const btnVerif = row.querySelector('.btn-verifikasi-tamu');
            if (btnVerif) {
                btnVerif.addEventListener('click', function () {
                    document.getElementById('verifNoTiket').value = this.dataset.notiket;
                    document.getElementById('verifDisplayTiket').innerText = this.dataset.notiket;
                    document.getElementById('verifDisplayNama').innerText = this.dataset.nama;
                    document.getElementById('verifStatusSelect').value = this.dataset.status;
                });
            }

            // C. Tombol Disposisi
            const btnDisp = row.querySelector('.btn-disposisi-tamu');
            if (btnDisp) {
                btnDisp.addEventListener('click', function () {
                    document.getElementById('dispNoTiketVal').value = this.dataset.notiket;
                    document.getElementById('dispDisposisiTiketText').innerText = this.dataset.notiket;
                    document.getElementById('dispDisposisiNamaText').innerText = this.dataset.nama;
                });
            }

            // D. Tombol Edit
            const btnEdit = row.querySelector('.btn-edit-tamu');
            if (btnEdit) {
                btnEdit.addEventListener('click', function () {
                    currentRowEditing = row;
                    document.getElementById('editNoTiket').value = this.dataset.notiket;
                    document.getElementById('editNama').value = this.dataset.nama;
                    document.getElementById('editInstansi').value = this.dataset.instansi || '';
                    document.getElementById('editLayanan').value = this.dataset.layanan;
                    document.getElementById('editEmail').value = this.dataset.email;
                    document.getElementById('editHp').value = this.dataset.hp;
                    document.getElementById('editStatus').value = this.dataset.status;
                    document.getElementById('editDeskripsi').value = this.dataset.deskripsi || '';
                });
            }

            // E. Tombol Delete
            const btnDelete = row.querySelector('.btn-delete-tamu');
            if (btnDelete) {
                btnDelete.addEventListener('click', function () {
                    rowToDelete = row;
                    document.getElementById('deleteDisplayNoTiket').innerText = this.dataset.notiket;
                    document.getElementById('deleteDisplayNama').innerText = this.dataset.nama;
                });
            }
        }

        // Terapkan binding ke baris awal
        document.querySelectorAll('#tamuTableBody tr.tamu-row').forEach(bindRowEvents);

       // =========================================================
// 6. SUBMIT FORM TAMBAH LAPORAN OFFLINE
// =========================================================

const formTambah = document.getElementById('formTambahTamu');

if (formTambah) {

    formTambah.addEventListener('submit', function (e) {

        e.preventDefault();

        const jenisPemohon =
            document.getElementById('addJenisPemohon').value;

        const nama =
            document.getElementById('addNama').value.trim();

        const identitas =
            document.getElementById('addIdentitas').value.trim();

        const hp =
            document.getElementById('addHp').value.trim();

        const email =
            document.getElementById('addEmail').value.trim();

        const layanan =
            document.getElementById('addLayanan').value;

        const judul =
            document.getElementById('addJudul').value.trim();

        const deskripsi =
            document.getElementById('addDeskripsi').value.trim();


        // ==============================
        // VALIDASI
        // ==============================

        if (
            !jenisPemohon ||
            !nama ||
            !hp ||
            !email ||
            !layanan ||
            !judul ||
            !deskripsi
        ) {

            alert('Mohon lengkapi seluruh data yang wajib diisi.');

            return;
        }


        // ==============================
        // NOMOR TIKET SEMENTARA
        // ==============================

        const randomNum =
            Math.floor(
                1000000000000 +
                Math.random() * 9000000000000
            );

        const noTiket =
            `ULT-20260807${randomNum}`.substring(0, 20);


        // ==============================
        // WAKTU
        // ==============================

        const now = new Date();

        const tglString =
            `${String(now.getDate()).padStart(2, '0')}-` +
            `${String(now.getMonth() + 1).padStart(2, '0')}-` +
            `${now.getFullYear()} ` +
            `${String(now.getHours()).padStart(2, '0')}:` +
            `${String(now.getMinutes()).padStart(2, '0')}`;


        // ==============================
        // TAMBAHKAN KE TABEL
        // ==============================

        const tbody =
            document.getElementById('tamuTableBody');

        const newTr =
            document.createElement('tr');

        newTr.className =
            'text-center tamu-row';


        newTr.setAttribute(
            'data-notiket',
            noTiket
        );

        newTr.setAttribute(
            'data-nama',
            nama.toLowerCase()
        );

        newTr.setAttribute(
            'data-layanan',
            layanan
        );

        newTr.setAttribute(
            'data-status',
            'Submitted'
        );


        newTr.innerHTML = `

            <td class="fw-bold text-muted row-number">
                0
            </td>

            <td class="text-start fw-bold text-primary cell-notiket">
                ${noTiket}
            </td>

            <td class="text-start fw-semibold text-dark cell-nama">
                ${nama}
            </td>

            <td class="text-start">
                <span class="badge-layanan-tag cell-layanan">
                    ${layanan}
                </span>
            </td>

            <td>
                <span class="badge-status cell-status badge-submitted">
                    Submitted
                </span>
            </td>

            <td
                class="text-muted fw-medium cell-tanggal"
                style="font-size: 0.83rem;">

                ${tglString}

            </td>

            <td>

                <div class="d-flex justify-content-center gap-1">

                    <button
                        class="btn-action btn-action-view btn-detail-tamu"
                        title="Detail Tiket"

                        data-bs-toggle="modal"
                        data-bs-target="#modalDetailTamu"

                        data-notiket="${noTiket}"
                        data-nama="${nama}"
                        data-layanan="${layanan}"
                        data-status="Submitted"
                        data-tanggal="${tglString}"
                        data-email="${email}"
                        data-hp="${hp}"
                        data-instansi="${jenisPemohon}"
                        data-deskripsi="${deskripsi}">

                        <i class="fas fa-eye"></i>

                    </button>


                    <button
                        class="btn-action btn-action-edit btn-verifikasi-tamu"
                        title="Verifikasi Tiket"

                        data-bs-toggle="modal"
                        data-bs-target="#modalVerifikasiTamu"

                        data-notiket="${noTiket}"
                        data-nama="${nama}"
                        data-layanan="${layanan}"
                        data-status="Submitted"
                        data-email="${email}"
                        data-hp="${hp}"
                        data-instansi="${jenisPemohon}">

                        <i class="fas fa-user-check"></i>

                    </button>


                    <button
                        class="btn-action btn-action-forward btn-disposisi-tamu"
                        title="Disposisi Tiket"

                        data-bs-toggle="modal"
                        data-bs-target="#modalDisposisiTamu"

                        data-notiket="${noTiket}"
                        data-nama="${nama}"
                        data-layanan="${layanan}"
                        data-status="Submitted"
                        data-email="${email}"
                        data-hp="${hp}"
                        data-instansi="${jenisPemohon}"
                        data-tanggal="${tglString}">

                        <i class="fas fa-share"></i>

                    </button>


                    <button
                        class="btn-action btn-action-amber btn-edit-tamu"
                        title="Edit Tiket"

                        data-bs-toggle="modal"
                        data-bs-target="#modalEditTiket"

                        data-notiket="${noTiket}"
                        data-nama="${nama}"
                        data-layanan="${layanan}"
                        data-status="Submitted"
                        data-email="${email}"
                        data-hp="${hp}"
                        data-instansi="${jenisPemohon}"
                        data-deskripsi="${deskripsi}">

                        <i class="fas fa-pen"></i>

                    </button>


                    <button
                        class="btn-action btn-action-delete btn-delete-tamu"
                        title="Delete Tiket"

                        data-bs-toggle="modal"
                        data-bs-target="#modalDeleteTiket"

                        data-notiket="${noTiket}"
                        data-nama="${nama}">

                        <i class="fas fa-trash-alt"></i>

                    </button>

                </div>

            </td>

        `;


        tbody.insertBefore(
            newTr,
            tbody.firstChild
        );


        // Aktifkan event tombol pada row baru
        bindRowEvents(newTr);


        // Update nomor
        updateRowNumbers();


        // Pesan berhasil
        alert(
            '✨ Laporan tamu offline berhasil ditambahkan ke tabel!'
        );


        // Tutup modal
        const modalElem =
            document.getElementById('modalTambahTamu');

        bootstrap.Modal
            .getInstance(modalElem)
            ?.hide();


        // Reset form
        formTambah.reset();


        if (charCount) {
            charCount.innerText =
                '0 / 500 Karakter';
        }

    });

}

        // 7. SUBMIT VERIFIKASI & DISPOSISI MODAL
        document.getElementById('formVerifikasiTamu')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('✨ Status verifikasi tiket berhasil diperbarui!');
            bootstrap.Modal.getInstance(document.getElementById('modalVerifikasiTamu'))?.hide();
        });

        document.getElementById('formDisposisiTamu')?.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('✨ Tiket berhasil didisposisikan ke unit tujuan!');
            bootstrap.Modal.getInstance(document.getElementById('modalDisposisiTamu'))?.hide();
        });

        // 8. SUBMIT EDIT TIKET
        let currentRowEditing = null;
        document.getElementById('formEditTiket')?.addEventListener('submit', function (e) {
            e.preventDefault();
            if (currentRowEditing) {
                const newNama = document.getElementById('editNama').value;
                const newInstansi = document.getElementById('editInstansi').value;
                const newLayanan = document.getElementById('editLayanan').value;
                const newStatus = document.getElementById('editStatus').value;

                currentRowEditing.setAttribute('data-nama', newNama.toLowerCase());
                currentRowEditing.setAttribute('data-layanan', newLayanan);
                currentRowEditing.setAttribute('data-status', newStatus);

                currentRowEditing.querySelector('.cell-nama').innerText = newNama;
                currentRowEditing.querySelector('.cell-layanan').innerText = newLayanan;

                const statusSpan = currentRowEditing.querySelector('.cell-status');
                statusSpan.innerText = newStatus;
                statusSpan.className = `badge-status cell-status ${newStatus === 'Verified' ? 'badge-verified' : (newStatus === 'Assigned' ? 'badge-assigned' : 'badge-submitted')}`;

                alert('✨ Perubahan data tiket berhasil disimpan!');
                bootstrap.Modal.getInstance(document.getElementById('modalEditTiket'))?.hide();
            }
        });

        // 9. KONFIRMASI HAPUS TIKET & RE-INDEX NOMOR URUT
        let rowToDelete = null;
        document.getElementById('btnConfirmDelete')?.addEventListener('click', function () {
            if (rowToDelete) {
                rowToDelete.style.transition = 'all 0.3s ease';
                rowToDelete.style.opacity = '0';
                setTimeout(() => {
                    rowToDelete.remove();
                    rowToDelete = null;
                    updateRowNumbers();
                    alert('✨ Tiket berhasil dihapus!');
                    bootstrap.Modal.getInstance(document.getElementById('modalDeleteTiket'))?.hide();
                }, 300);
            }
        });

        // =========================================================
// VALIDASI FILE LAMPIRAN
// =========================================================

const addLampiran =
    document.getElementById('addLampiran');

const fileInfo =
    document.getElementById('fileInfo');

if (addLampiran) {

    addLampiran.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {

            fileInfo.innerText =
                'Maksimal ukuran file 5MB.';

            return;

        }


        const maxSize =
            5 * 1024 * 1024;


        if (file.size > maxSize) {

            alert(
                'Ukuran file terlalu besar. Maksimal 5MB.'
            );

            this.value = '';

            fileInfo.innerText =
                'Maksimal ukuran file 5MB.';

            return;

        }


        const allowed =
            [
                'application/pdf',
                'image/jpeg',
                'image/png'
            ];


        if (!allowed.includes(file.type)) {

            alert(
                'Format file harus PDF, JPG, JPEG, atau PNG.'
            );

            this.value = '';

            fileInfo.innerText =
                'Maksimal ukuran file 5MB.';

            return;

        }


        const sizeMB =
            (file.size / (1024 * 1024))
            .toFixed(2);


        fileInfo.innerHTML =
            `<i class="fas fa-check-circle text-success me-1"></i>
             ${file.name} (${sizeMB} MB)`;

    });

}


    });
</script>

<?= $this->endSection() ?>