<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Tracking Tiket</h3>
            <p class="text-muted mb-0">Cari dan pantau status tiket layanan secara real time.</p>
        </div>
    </div>

    <div class="card card-premium">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-8">
                    <label for="ticketNumber" class="form-label">Nomor Tiket</label>
                    <input type="text" class="form-control" id="ticketNumber" placeholder="Masukkan nomor tiket...">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search mr-2"></i> Cari Tiket
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center text-muted">
                <p class="mb-1">Masukkan nomor tiket untuk menampilkan status.</p>
                <p class="small">Contoh: ULT-2024-001</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>