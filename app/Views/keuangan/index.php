<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container py-4">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-success">
            💰 Layanan Keuangan
        </h2>
        <p class="text-muted">
            Pilih layanan keuangan yang ingin Anda ajukan.
        </p>
    </div>

    <div class="row">

        <!-- Pembayaran UKT -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <div class="display-5 mb-3">💳</div>

                    <h5 class="fw-bold">
                        Pembayaran UKT
                    </h5>

                    <p class="text-muted">
                        Informasi dan pengajuan terkait pembayaran Uang Kuliah Tunggal (UKT).
                    </p>

                    <a href="#" class="btn btn-success w-100">
                        Ajukan Layanan
                    </a>

                </div>
            </div>
        </div>

        <!-- Cicilan UKT -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <div class="display-5 mb-3">📆</div>

                    <h5 class="fw-bold">
                        Cicilan UKT
                    </h5>

                    <p class="text-muted">
                        Pengajuan pembayaran UKT secara bertahap sesuai ketentuan.
                    </p>

                    <a href="#" class="btn btn-success w-100">
                        Ajukan Layanan
                    </a>

                </div>
            </div>
        </div>

        <!-- Refund -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <div class="display-5 mb-3">💵</div>

                    <h5 class="fw-bold">
                        Refund Dana
                    </h5>

                    <p class="text-muted">
                        Pengajuan pengembalian dana sesuai kebijakan Polban.
                    </p>

                    <a href="#" class="btn btn-success w-100">
                        Ajukan Layanan
                    </a>

                </div>
            </div>
        </div>

        <!-- Verifikasi Pembayaran -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <div class="display-5 mb-3">✔️</div>

                    <h5 class="fw-bold">
                        Verifikasi Pembayaran
                    </h5>

                    <p class="text-muted">
                        Mengunggah bukti pembayaran untuk proses verifikasi.
                    </p>

                    <a href="#" class="btn btn-success w-100">
                        Ajukan Layanan
                    </a>

                </div>
            </div>
        </div>

        <!-- Informasi Tagihan -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <div class="display-5 mb-3">📄</div>

                    <h5 class="fw-bold">
                        Informasi Tagihan
                    </h5>

                    <p class="text-muted">
                        Melihat rincian tagihan dan status pembayaran mahasiswa.
                    </p>

                    <a href="#" class="btn btn-success w-100">
                        Lihat Informasi
                    </a>

                </div>
            </div>
        </div>

        <!-- Bantuan -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <div class="display-5 mb-3">📞</div>

                    <h5 class="fw-bold">
                        Bantuan Keuangan
                    </h5>

                    <p class="text-muted">
                        Hubungi petugas apabila mengalami kendala dalam layanan keuangan.
                    </p>

                    <a href="#" class="btn btn-outline-success w-100">
                        Hubungi Petugas
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>