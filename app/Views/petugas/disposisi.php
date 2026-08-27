<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* =====================================================
       DISPOSISI TIKET
       Tema mengikuti Dashboard SI-ULT POLBAN
       ===================================================== */

    :root {
        --polban-blue: #1a237e;
        --polban-blue-dark: #151b63;
        --polban-orange: #ff8c00;
        --polban-green: #198754;
        --polban-info: #17a2b8;
        --soft-bg: #f8f9fc;
        --border-soft: #e8ebf0;
    }

    body, .container-fluid {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    /* Page Header */
    .disposisi-page-title {
        color: #212529;
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    .disposisi-page-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
    }

    /* General Card */
    .disposisi-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: all 0.25s ease;
    }

    .disposisi-card:hover {
        box-shadow: 0 6px 22px rgba(0, 0, 0, 0.08);
    }

    /* =========================================================
       SUMMARY CARDS (DISAMAKAN DENGAN FOTO HASIL REVISI)
    ========================================================= */

    .stat-tamu-card {
        border-radius: 18px;
        border: none;
        color: #ffffff;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
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
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .stat-tamu-card:hover::before {
        transform: scale(1.25);
    }

    .bg-tamu-navy {
        background: linear-gradient(135deg, #1b2e85 0%, #283593 100%) !important;
    }

    .bg-tamu-orange {
        background: linear-gradient(135deg, #ff7a00 0%, #ff8c00 100%) !important;
    }

    .bg-tamu-yellow {
        background: linear-gradient(135deg, #ffb300 0%, #f4c400 100%) !important;
    }

    .bg-tamu-green {
        background: linear-gradient(135deg, #00a86b 0%, #10b981 100%) !important;
    }

    .icon-tamu-circle {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        box-shadow: inset 0 0 12px rgba(255, 255, 255, 0.25);
    }

    /* Card Header */
    .section-header {
        background: #fff;
        border-bottom: 1px solid var(--border-soft);
        padding: 17px 22px;
    }

    .section-title {
        margin: 0;
        font-size: 1.02rem;
        font-weight: 700;
        color: #212529;
    }

    .section-title i {
        color: var(--polban-blue);
        margin-right: 8px;
    }

    .section-header-blue {
        background: var(--polban-blue);
        color: #fff;
        border: 0;
    }

    .section-header-blue .section-title {
        color: #fff;
    }

    .section-header-blue .section-title i {
        color: #fff;
    }

    .section-header-orange {
        background: var(--polban-orange);
        color: #fff;
        border: 0;
    }

    .section-header-orange .section-title {
        color: #fff;
    }

    .section-header-orange .section-title i {
        color: #fff;
    }

    /* Information Cards */
    .info-mini-card {
        background: var(--soft-bg);
        border: 1px solid var(--border-soft);
        border-radius: 10px;
        padding: 15px;
        height: 100%;
        transition: all 0.2s ease;
    }

    .info-mini-card:hover {
        border-color: rgba(26, 35, 126, 0.3);
        background: #fff;
        transform: translateY(-2px);
    }

    .info-label {
        display: block;
        color: #6c757d;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .info-value {
        color: #212529;
        font-size: 0.94rem;
        font-weight: 700;
    }

    /* Progress */
    .progress-wrapper {
        background: #f8f9fc;
        border: 1px solid var(--border-soft);
        border-radius: 10px;
        padding: 17px;
    }

    .progress {
        height: 18px;
        border-radius: 20px;
        background-color: #e9ecef;
        overflow: hidden;
    }

    .progress-bar-custom {
        background: linear-gradient(
            90deg,
            var(--polban-green),
            #2ca66f
        );
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 700;
        transition: width 1s ease;
    }

    /* Detail Table */
    .ticket-detail-table {
        margin-bottom: 0;
    }

    .ticket-detail-table tr {
        border-bottom: 1px solid #f0f1f3;
    }

    .ticket-detail-table tr:last-child {
        border-bottom: 0;
    }

    .ticket-detail-table th {
        width: 190px;
        color: #6c757d;
        font-weight: 600;
        padding: 13px 20px;
        background: #fff;
    }

    .ticket-detail-table td {
        color: #212529;
        padding: 13px 20px;
        font-weight: 500;
    }

    .ticket-number {
        color: #0d6efd;
        font-weight: 700;
    }

    /* Form */
    .disposisi-form-label {
        font-size: 0.88rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 7px;
    }

    .disposisi-form-label i {
        color: var(--polban-blue);
        margin-right: 5px;
    }

    .disposisi-form-control {
        min-height: 45px;
        border: 1px solid #dfe3e8;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .disposisi-form-control:focus {
        border-color: var(--polban-blue);
        box-shadow: 0 0 0 0.18rem rgba(26, 35, 126, 0.12);
    }

    .sla-info {
        background: #fff8ed;
        border: 1px solid #ffe0b2;
        border-radius: 8px;
        padding: 11px 13px;
        color: #6c4a14;
        font-size: 0.8rem;
        margin-top: 8px;
    }

    /* Buttons */
    .btn-polban-blue {
        background-color: var(--polban-blue);
        border-color: var(--polban-blue);
        color: #fff;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-polban-blue:hover {
        background-color: var(--polban-blue-dark);
        border-color: var(--polban-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-polban-orange {
        background-color: var(--polban-orange);
        border-color: var(--polban-orange);
        color: #fff;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-polban-orange:hover {
        background-color: #e07b00;
        border-color: #e07b00;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-back {
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    /* History */
    .history-table thead {
        background-color: var(--polban-blue);
        color: #fff;
    }

    .history-table th {
        border: 0 !important;
        padding: 13px 18px;
        font-size: 0.82rem;
    }

    .history-table td {
        padding: 14px 18px;
        vertical-align: middle;
        border-color: #edf0f3;
        font-size: 0.86rem;
    }

    .history-table tbody tr {
        transition: background 0.2s ease;
    }

    .history-table tbody tr:hover {
        background-color: #f8f9ff;
    }

    .history-time {
        color: #6c757d;
        white-space: nowrap;
    }

    .history-dot {
        width: 9px;
        height: 9px;
        display: inline-block;
        border-radius: 50%;
        background: var(--polban-blue);
        margin-right: 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ticket-detail-table th {
            width: 130px;
            padding-left: 12px;
            padding-right: 8px;
        }

        .ticket-detail-table td {
            padding-left: 8px;
            padding-right: 12px;
        }
    }
</style>


<div class="container-fluid px-4 py-4">

    <!-- =====================================================
         HEADER
         ===================================================== -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 disposisi-page-title mb-1">
                Disposisi Tiket Permohonan
            </h1>

            <p class="disposisi-page-subtitle mb-0">
                Teruskan tiket permohonan ke Unit Tujuan untuk diproses lebih lanjut.
            </p>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('petugas/dashboard') ?>">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('petugas/tiket') ?>">
                        Data Tiket
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Disposisi
                </li>
            </ol>
        </nav>
    </div>


    <!-- =====================================================
         SUMMARY CARDS (PERSIS DENGAN HAFALAN TAMPILAN FOTO)
         ===================================================== -->
    <div class="row g-3 mb-4">
        <!-- TOTAL TAMU -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">TOTAL TAMU</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['total'] ?? '8') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- SUBMITTED -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">SUBMITTED</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['submitted'] ?? '1') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ASSIGNED / DIPROSES -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">ASSIGNED / DIPROSES</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['assigned'] ?? '5') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- VERIFIED / SELESAI -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">VERIFIED / SELESAI</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['verified'] ?? '2') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- =====================================================
         INFORMASI TIKET
         ===================================================== -->
    <div class="disposisi-card mb-4">

        <div class="section-header">
            <h5 class="section-title">
                <i class="fas fa-info-circle"></i>
                Informasi Tiket
            </h5>
        </div>


        <div class="card-body p-4">

            <!-- Mini Information -->
            <div class="row mb-4">

                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-mini-card">

                        <span class="info-label">
                            <i class="fas fa-calendar-plus me-1"></i>
                            Tanggal Pengajuan
                        </span>

                        <div class="info-value">
                            <?= esc($tiket['tanggal'] ?? date('d F Y')) ?>
                        </div>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-mini-card">

                        <span class="info-label">
                            <i class="fas fa-user-check me-1"></i>
                            Tanggal Verifikasi
                        </span>

                        <div class="info-value">
                            <?= date('d F Y') ?>
                        </div>

                    </div>
                </div>


                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="info-mini-card">

                        <span class="info-label">
                            <i class="fas fa-flag me-1"></i>
                            Prioritas
                        </span>

                        <div class="info-value">
                            <?= esc($tiket['prioritas'] ?? 'High') ?>
                        </div>

                    </div>
                </div>

            </div>


            <!-- Progress -->
            <div class="progress-wrapper mb-4">

                <div class="d-flex justify-content-between align-items-center mb-2">

                    <span class="fw-bold text-dark">
                        <i class="fas fa-tasks text-primary me-1"></i>
                        Progress Tiket
                    </span>

                    <span class="badge bg-success px-2 py-1">
                        Verified
                    </span>

                </div>

                <div class="progress">

                    <div
                        class="progress-bar progress-bar-custom"
                        id="disposisiProgress"
                        role="progressbar"
                        style="width: 60%;"
                        aria-valuenow="60"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        60%
                    </div>

                </div>

                <small class="text-muted d-block mt-2">
                    Tiket sudah diverifikasi dan siap diteruskan ke Unit Tujuan.
                </small>

            </div>


            <!-- Detail Table -->
            <div class="table-responsive">

                <table class="table ticket-detail-table">

                    <tbody>

                        <tr>
                            <th>
                                Nomor Tiket
                            </th>

                            <td class="ticket-number">
                                <?= esc($tiket['nomor_tiket'] ?? 'ULT-20260720-0001') ?>
                            </td>
                        </tr>


                        <tr>
                            <th>
                                Nama Pemohon
                            </th>

                            <td class="fw-bold">
                                <?= esc($tiket['nama_pemohon'] ?? 'Rafi Putra') ?>
                            </td>
                        </tr>


                        <tr>
                            <th>
                                NIM
                            </th>

                            <td>
                                <?= esc($tiket['nim'] ?? '231511001') ?>
                            </td>
                        </tr>


                        <tr>
                            <th>
                                Layanan
                            </th>

                            <td>
                                <?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?>
                            </td>
                        </tr>


                        <tr>
                            <th>
                                Status
                            </th>

                            <td>

                                <span class="badge bg-success px-3 py-2">
                                    <?= esc($tiket['status'] ?? 'Verified') ?>
                                </span>

                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- =====================================================
         FORM DISPOSISI
         ===================================================== -->
    <div class="disposisi-card mb-4">

        <div class="section-header section-header-orange">

            <h5 class="section-title">
                <i class="fas fa-share-square"></i>
                Form Disposisi
            </h5>

        </div>


        <div class="card-body p-4">

            <form
                id="formDisposisi"
                action="<?= base_url('petugas/disposisi/kirim' . (isset($tiket['id']) ? '/'.$tiket['id'] : '')) ?>"
                method="POST"
            >

                <?= csrf_field() ?>


                <!-- Unit Tujuan -->
                <div class="form-group mb-4">

                    <label class="disposisi-form-label">
                        <i class="fas fa-building"></i>
                        Unit Tujuan
                    </label>

                    <select
                        name="unit_tujuan"
                        id="unit_tujuan"
                        class="form-select disposisi-form-control"
                        required
                    >

                        <option value="" selected disabled>
                            -- Pilih Unit Tujuan --
                        </option>

                        <option value="Akademik">
                            Unit Akademik
                        </option>

                        <option value="Keuangan">
                            Unit Keuangan
                        </option>

                        <option value="Kemahasiswaan">
                            Unit Kemahasiswaan
                        </option>

                    </select>

                    <small class="text-muted">
                        Pilih unit yang bertanggung jawab menyelesaikan permohonan ini.
                    </small>

                </div>


                <!-- Prioritas -->
                <div class="form-group mb-4">

                    <label class="disposisi-form-label">
                        <i class="fas fa-exclamation-triangle"></i>
                        Prioritas
                    </label>

                    <select
                        name="prioritas"
                        id="prioritas"
                        class="form-select disposisi-form-control"
                        required
                    >

                        <option value="High"
                            <?= (($tiket['prioritas'] ?? '') == 'High') ? 'selected' : '' ?>>
                            High
                        </option>

                        <option value="Medium"
                            <?= (($tiket['prioritas'] ?? '') == 'Medium') ? 'selected' : '' ?>>
                            Medium
                        </option>

                        <option value="Low"
                            <?= (($tiket['prioritas'] ?? '') == 'Low') ? 'selected' : '' ?>>
                            Low
                        </option>

                    </select>

                </div>


                <!-- Target SLA -->
                <div class="form-group mb-4">

                    <label class="disposisi-form-label">
                        <i class="fas fa-calendar-check"></i>
                        Target Penyelesaian / SLA
                    </label>

                    <input
                        type="date"
                        name="target_sla"
                        id="target_sla"
                        class="form-control disposisi-form-control"
                        value="<?= date('Y-m-d', strtotime('+3 days')) ?>"
                        min="<?= date('Y-m-d') ?>"
                        required
                    >

                    <div class="sla-info">

                        <i class="fas fa-info-circle me-1"></i>

                        Hari ini:
                        <strong><?= date('d F Y') ?></strong>

                        <br>

                        Disarankan target penyelesaian maksimal
                        <strong>3 hari kerja</strong>
                        setelah verifikasi.

                    </div>

                </div>


                <!-- Action -->
                <div class="d-flex justify-content-end align-items-center pt-2">

                    <a
                        href="<?= base_url('petugas/tiket') ?>"
                        class="btn btn-secondary btn-back px-4 me-2"
                    >
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali
                    </a>

                    <button
                        type="submit"
                        id="btnKirimDisposisi"
                        class="btn btn-polban-orange px-4"
                    >
                        <i class="fas fa-paper-plane me-1"></i>
                        Kirim Disposisi
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- =====================================================
         RIWAYAT DISPOSISI
         ===================================================== -->
    <div class="disposisi-card">

        <div class="section-header">

            <h5 class="section-title">
                <i class="fas fa-history"></i>
                Riwayat Proses Tiket
            </h5>

        </div>


        <div class="table-responsive">

            <table class="table history-table mb-0">

                <thead>

                    <tr>

                        <th width="230">
                            <i class="fas fa-clock me-1"></i>
                            Waktu
                        </th>

                        <th>
                            <i class="fas fa-tasks me-1"></i>
                            Aktivitas
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td class="history-time">
                            20 Juli 2026 08:20
                        </td>

                        <td class="fw-bold">

                            <span class="history-dot"></span>

                            Pengajuan dibuat oleh Pemohon

                        </td>

                    </tr>


                    <tr>

                        <td class="history-time">
                            20 Juli 2026 09:10
                        </td>

                        <td class="fw-bold">

                            <span
                                class="history-dot"
                                style="background-color: #198754;"
                            ></span>

                            Diverifikasi oleh Petugas ULT

                        </td>

                    </tr>


                    <tr id="historyDisposisi" style="display: none;">

                        <td class="history-time">
                            <?= date('d F Y H:i') ?>
                        </td>

                        <td class="fw-bold">

                            <span
                                class="history-dot"
                                style="background-color: #ff8c00;"
                            ></span>

                            Tiket sedang dipersiapkan untuk disposisi

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT
     ===================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* Animasi Halaman */
    const cards = document.querySelectorAll('.disposisi-card, .stat-tamu-card');

    cards.forEach(function (card, index) {

        card.style.opacity = '0';
        card.style.transform = 'translateY(12px)';

        setTimeout(function () {

            card.style.transition = 'all 0.4s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';

        }, 80 * index);

    });


    /* Progress animation */
    const progress = document.getElementById('disposisiProgress');

    if (progress) {

        const targetWidth = progress.style.width;

        progress.style.width = '0%';

        setTimeout(function () {
            progress.style.width = targetWidth;
        }, 400);

    }


    /* Form Disposisi */
    const form = document.getElementById('formDisposisi');
    const unit = document.getElementById('unit_tujuan');
    const targetSla = document.getElementById('target_sla');
    const button = document.getElementById('btnKirimDisposisi');

    if (form) {

        form.addEventListener('submit', function (event) {

            if (!unit.value) {
                event.preventDefault();
                unit.focus();
                unit.style.borderColor = '#dc3545';
                alert('Silakan pilih Unit Tujuan terlebih dahulu.');
                return;
            }

            if (!targetSla.value) {
                event.preventDefault();
                targetSla.focus();
                targetSla.style.borderColor = '#dc3545';
                alert('Silakan tentukan Target Penyelesaian / SLA.');
                return;
            }

            const unitText = unit.options[unit.selectedIndex].text;
            const konfirmasi = confirm(
                'Kirim tiket ini ke ' +
                unitText +
                '?\n\nPastikan Unit Tujuan dan Target SLA sudah benar.'
            );

            if (!konfirmasi) {
                event.preventDefault();
                return;
            }

            button.disabled = true;
            button.innerHTML =
                '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';

        });

    }

    if (unit) {
        unit.addEventListener('change', function () {
            unit.style.borderColor = '';
        });
    }

    if (targetSla) {
        targetSla.addEventListener('change', function () {
            targetSla.style.borderColor = '';
        });
    }

});
</script>


<?= $this->endSection() ?>