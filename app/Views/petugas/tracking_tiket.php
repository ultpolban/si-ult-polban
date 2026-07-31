<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* Styling Tombol Filter & Reset Presisi */
    .btn-filter-orange {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        height: 42px;
        padding: 0 22px;
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
        width: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease-in-out;
    }

    .filter-group{
    display:flex;
    align-items:center;
}

.filter-group .btn-reset-grey{
    margin-left:12px;
}

    .btn-reset-grey:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.35);
        transform: translateY(-1px);
    }

    /* Stepper / Timeline Progress Bar Modern */
    .tracking-stepper-wrapper {
        position: relative;
        padding: 20px 0;
    }
    .tracking-stepper {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 20px 0 10px 0;
    }
    .tracking-stepper::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 40px;
        right: 40px;
        height: 4px;
        background-color: #e9ecef;
        z-index: 1;
    }
    .step-item {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }
    .step-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #adb5bd;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 12px;
        border: 4px solid #ffffff;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .step-item.completed .step-icon {
        background-color: #198754;
        color: #ffffff;
    }
    .step-item.active .step-icon {
        background-color: #ff8c00;
        color: #ffffff;
        box-shadow: 0 0 0 6px rgba(255, 140, 0, 0.2);
    }
    .step-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 2px;
    }
    .step-desc {
        font-size: 0.78rem;
        color: #6c757d;
    }

    /* Hover animation for Info Cards */
    .info-box-card {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        transition: all 0.2s ease;
    }
    .info-box-card:hover {
        border-color: #1a237e;
        background-color: #f8f9ff;
    }
</style>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold text-dark mb-1" style="font-size: 1.75rem; color: #1a237e;">Tracking Status Tiket</h2>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Lacak dan pantau proses penyelesaian tiket permohonan layanan secara real-time.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Tracking Tiket</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; background: #ffffff;">
        <div class="card-body p-3">
            <form action="" method="GET">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    
                    <div class="input-group flex-grow-1" style="max-width: 480px;">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-color: #ced4da; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="keyword" class="form-control border-start-0 ps-2" 
                               placeholder="Cari No Tiket, Nama, NIM..." 
                               value="<?= esc($keyword ?? '') ?>" 
                               style="border-color: #ced4da; font-size: 0.92rem; height: 42px; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                    </div>

                   <div class="filter-group">

    <button type="submit" class="btn btn-filter-orange">
        <i class="fas fa-filter"></i>
        Filter
    </button>

    <a href="<?= current_url() ?>"
       class="btn btn-reset-grey"
       title="Reset Filter">
        <i class="fas fa-undo"></i>
    </a>

</div>

                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header text-white py-3 px-4 d-flex justify-content-between align-items-center" style="background-color: #1a237e;">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-ticket-alt fs-5 me-2"></i>
                <h5 class="mb-0 font-weight-bold" style="font-size: 1.05rem;">Detail Pelacakan Tiket</h5>
            </div>
            <span class="badge bg-warning text-dark px-3 py-2 font-weight-bold" style="font-size: 0.82rem; border-radius: 6px;">
                <?= esc($tiket['status'] ?? 'Waiting Verification') ?>
            </span>
        </div>

        <div class="card-body p-4">
            
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="p-3 info-box-card bg-light">
                        <small class="text-muted d-block mb-1"><i class="fas fa-hashtag me-1"></i> Nomor Tiket</small>
                        <strong class="text-primary font-weight-bold d-block text-truncate" style="font-size: 0.98rem;">
                            <?= esc($tiket['no_tiket'] ?? ($keyword ?? 'ULT-20260730081403481')) ?>
                        </strong>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="p-3 info-box-card bg-light">
                        <small class="text-muted d-block mb-1"><i class="fas fa-user me-1"></i> Nama Pemohon</small>
                        <strong class="text-dark font-weight-bold d-block text-truncate">
                            <?= esc($tiket['nama_pemohon'] ?? 'Apin') ?>
                        </strong>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="p-3 info-box-card bg-light">
                        <small class="text-muted d-block mb-1"><i class="fas fa-concierge-bell me-1"></i> Layanan</small>
                        <strong class="text-dark font-weight-bold d-block text-truncate">
                            <?= esc($tiket['layanan'] ?? 'Kemahasiswaan') ?>
                        </strong>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="p-3 info-box-card bg-light">
                        <small class="text-muted d-block mb-1"><i class="far fa-calendar-alt me-1"></i> Tanggal Pengajuan</small>
                        <strong class="text-dark font-weight-bold d-block text-truncate">
                            <?= date('d-m-Y H:i', strtotime($tiket['created_at'] ?? '2026-07-30 08:14:00')) ?>
                        </strong>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <h6 class="font-weight-bold text-dark mb-3">
                    <i class="fas fa-route me-2" style="color: #1a237e;"></i> Alur Progres Penyelesaian Tiket:
                </h6>
                
                <div class="tracking-stepper-wrapper">
                    <div class="tracking-stepper">
                        <div class="step-item completed">
                            <div class="step-icon">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div class="step-title">Pengajuan Tiket</div>
                            <div class="step-desc">Tiket Berhasil Diajukan</div>
                        </div>

                        <div class="step-item active">
                            <div class="step-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="step-title">Verifikasi Petugas</div>
                            <div class="step-desc">Pemeriksaan Dokumen</div>
                        </div>

                        <div class="step-item">
                            <div class="step-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="step-title">Proses Unit</div>
                            <div class="step-desc">Pengerjaan Layanan</div>
                        </div>

                        <div class="step-item">
                            <div class="step-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="step-title">Selesai</div>
                            <div class="step-desc">Tiket Tuntas Diproses</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Animasi halus saat halaman tracking dimuat
        const cardTracking = document.querySelector('.card');
        if (cardTracking) {
            cardTracking.style.opacity = '0';
            cardTracking.style.transform = 'translateY(10px)';
            cardTracking.style.transition = 'all 0.4s ease-out';
            
            setTimeout(() => {
                cardTracking.style.opacity = '1';
                cardTracking.style.transform = 'translateY(0)';
            }, 50);
        }
    });
</script>

<?= $this->endSection() ?>