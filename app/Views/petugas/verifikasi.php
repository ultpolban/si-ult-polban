<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-2">

                <div>
                    <h2>Verifikasi Tiket</h2>
                    <p class="text-muted mb-0">
                        Verifikasi data permohonan sebelum diproses
                    </p>
                </div>

               <nav aria-label="breadcrumb">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="<?= base_url('petugas') ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?= base_url('petugas/tiket') ?>">Data Tiket</a>
        </li>
        <li class="breadcrumb-item active">
            Verifikasi
        </li>
    </ol>
</nav>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        Form Verifikasi Tiket
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nomor Tiket</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="ULT-20260715-0001"
                                    readonly>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nama Pemohon</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="Budi Santoso"
                                    readonly>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Layanan</label>

                        <input
                            type="text"
                            class="form-control"
                            value="Surat Aktif Kuliah"
                            readonly>

                    </div>

                    <div class="form-group">

                        <label>Hasil Verifikasi</label>

                        <select class="form-control">

                            <option selected disabled>
                                -- Pilih Hasil Verifikasi --
                            </option>

                            <option>Disetujui</option>

                            <option>Perlu Revisi</option>

                            <option>Ditolak</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Catatan Petugas</label>

                        <textarea
                            class="form-control"
                            rows="5"
                            placeholder="Masukkan catatan verifikasi..."></textarea>

                    </div>

                </div>

                <div class="card-footer">

                    <a href="/petugas/tiket"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                   <form>

....

<button type="submit"
class="btn btn-success">

<i class="fas fa-check-circle"></i>

Simpan Verifikasi

</button>

</form>

                </div>

            </div>

        </div>

    </section>

</div>

<?= view('layouts/footer') ?>