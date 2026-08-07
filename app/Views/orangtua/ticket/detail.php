<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 style="font-weight:700;color:#0b3d91;">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    Detail Tiket
                </h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard-orangtua') ?>">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="<?= base_url('orangtua/ticket/history') ?>">
                            Tracking Tiket
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Detail
                    </li>

                </ol>

            </div>

        </div>

    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm mb-4"
style="border-radius:15px;">

<div class="card-body">

<div class="d-flex justify-content-between align-items-start flex-wrap">

<div>

<h2
style="
font-weight:700;
color:#0b3d91;
margin-bottom:10px;
">

<?= $ticket['nomor'] ?>

</h2>

<p class="text-muted mb-0">

<i class="fas fa-calendar-alt mr-2"></i>

<?= $ticket['tanggal'] ?>

</p>

</div>

<span
class="badge badge-primary"
style="
padding:10px 18px;
font-size:14px;
background:#0b3d91;
">

Submitted

</span>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-8">

<div
class="card shadow-sm mb-4"
style="border-radius:15px;">

<div
class="card-header"
style="
background:#0b3d91;
color:white;
border-bottom:4px solid #f28c28;
">

<h5 class="mb-0">

<i class="fas fa-file-alt mr-2"></i>

Informasi Pengajuan

</h5>

</div>

<div class="card-body p-0">

<table class="table table-bordered mb-0">

<tr>

<th width="35%">

<i class="fas fa-user text-primary mr-2"></i>

Nama Pengaju

</th>

<td>

<?= $ticket['nama_ortu'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-id-card text-primary mr-2"></i>

NIK

</th>

<td>

<?= $ticket['nik'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-file-signature text-primary mr-2"></i>

Jenis Layanan

</th>

<td>

<?= $ticket['layanan'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-building text-primary mr-2"></i>

Unit Tujuan

</th>

<td>

<?= $ticket['unit'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-calendar text-primary mr-2"></i>

Tanggal Pengajuan

</th>

<td>

<?= $ticket['tanggal'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-comment text-primary mr-2"></i>

Keterangan

</th>

<td>

<?= $ticket['keterangan'] ?>

</td>

</tr>

</table>

</div>

</div>

</div> <!-- END COL-8 -->

<!-- ===========================================
     RIWAYAT STATUS
=========================================== -->
<div class="col-lg-4">

    <div class="card shadow-sm mb-4" style="border-radius:15px;">

        <div class="card-header"
            style="
                background:#0b3d91;
                color:white;
                border-bottom:4px solid #f28c28;
            ">

            <h5 class="mb-0">
                <i class="fas fa-history mr-2"></i>
                Riwayat Status
            </h5>

        </div>

        <div class="card-body">

            <div class="mb-4">

                <h5 class="font-weight-bold text-primary">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Pengajuan Dikirim
                </h5>

                <small class="text-muted">
                    Pengajuan berhasil dikirim oleh Orang Tua.
                </small>

            </div>

            <div class="mb-4">

                <h5 class="font-weight-bold text-secondary">
                    <i class="fas fa-check-circle mr-2"></i>
                    Diverifikasi
                </h5>

                <small class="text-muted">
                    Menunggu verifikasi petugas.
                </small>

            </div>

            <div class="mb-4">

                <h5 class="font-weight-bold text-secondary">
                    <i class="fas fa-share mr-2"></i>
                    Diteruskan ke Unit
                </h5>

                <small class="text-muted">
                    Akan diteruskan ke unit terkait.
                </small>

            </div>

            <div class="mb-4">

                <h5 class="font-weight-bold text-secondary">
                    <i class="fas fa-spinner mr-2"></i>
                    Sedang Diproses
                </h5>

                <small class="text-muted">
                    Unit akan memproses pengajuan.
                </small>

            </div>

            <div class="mb-4">

                <h5 class="font-weight-bold text-secondary">
                    <i class="fas fa-check mr-2"></i>
                    Selesai
                </h5>

                <small class="text-muted">
                    Pengajuan selesai diproses.
                </small>

            </div>

            <div>

                <h5 class="font-weight-bold text-secondary">
                    <i class="fas fa-lock mr-2"></i>
                    Ditutup
                </h5>

                <small class="text-muted">
                    Tiket ditutup oleh sistem.
                </small>

            </div>

        </div>

    </div>

    <!-- ===========================================
         BANTUAN
    =========================================== -->

    <div class="card shadow-sm"
        style="
            border-left:5px solid #0b3d91;
            border-radius:12px;
        ">

        <div class="card-body">

            <h4
                style="
                    color:#0b3d91;
                    font-weight:700;
                ">

                <i class="fas fa-headset mr-2"></i>

                Butuh Bantuan?

            </h4>

            <p class="text-muted mb-0">

                Jika ada kendala terkait pengajuan,
                silakan balas catatan petugas
                pada form di bawah.

            </p>

        </div>

    </div>

</div>

</div>

<!-- ===========================================
     DOKUMEN PENGAJUAN
=========================================== -->

<div class="card shadow-sm mb-4"
style="border-radius:15px;">

    <div class="card-header"
        style="
            background:#0b3d91;
            color:white;
            border-bottom:4px solid #f28c28;
        ">

        <h5 class="mb-0">

            <i class="fas fa-paperclip mr-2"></i>

            Dokumen Pengajuan

        </h5>

    </div>

    <div
        class="card-body text-center py-5">

        <i
            class="fas fa-file-times"
            style="
                font-size:70px;
                color:#9aa7b3;
            "></i>

        <h4
            class="mt-3 text-muted">

            Tidak ada dokumen yang diunggah.

        </h4>

    </div>

</div>

<!-- ===========================================
     CATATAN PETUGAS
=========================================== -->
<div class="card shadow-sm mb-4" style="border-radius:15px;">

    <div class="card-header"
        style="
            background:#0b3d91;
            color:white;
            border-bottom:4px solid #f28c28;
        ">

        <h5 class="mb-0">
            <i class="fas fa-comments mr-2"></i>
            Catatan Petugas
        </h5>

    </div>

    <div class="card-body text-center py-5">

        <i class="fas fa-comment-slash"
            style="
                font-size:70px;
                color:#6c757d;
            "></i>

        <h4 class="mt-3 text-muted">
            Belum ada catatan dari petugas.
        </h4>

    </div>

</div>


<!-- ===========================================
     BALASAN ORANG TUA
=========================================== -->

<div class="card shadow-sm mb-5"
    style="border-radius:15px;">

    <div class="card-header"
        style="
            background:#0b3d91;
            color:white;
            border-bottom:4px solid #f28c28;
        ">

        <h5 class="mb-0">
            <i class="fas fa-reply mr-2"></i>
            Balasan Anda
        </h5>

    </div>

    <div class="card-body">

        <form action="#" method="post">

            <?= csrf_field() ?>

            <div class="form-group">

                <label class="font-weight-bold">

                    Tulis Balasan

                </label>

                <textarea
                    class="form-control"
                    rows="5"
                    placeholder="Tulis balasan Anda..."></textarea>

            </div>

            <div class="text-right">

                <button
                    type="submit"
                    class="btn"
                    style="
                        background:#0b3d91;
                        color:white;
                        font-weight:600;
                        border-radius:8px;
                        padding:10px 25px;
                    ">

                    <i class="fas fa-paper-plane mr-2"></i>

                    Kirim Balasan

                </button>

            </div>

        </form>

    </div>

</div>

</div>
</section>

</div>

<?= $this->include('layouts/footer') ?>