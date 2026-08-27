<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title><?= esc($title ?? 'Detail Tiket') ?></title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

<style>

body{
    background:#f8f9fa;
}

.card{
    border-radius:12px;
}

label{
    color:#293582;
    margin-bottom:5px;
}

p{
    margin-bottom:15px;
}

.btn-primary{
    background:#293582;
    border:none;
}

.btn-primary:hover{
    background:#ff7f00;
}

</style>

</head>

<body>

<div class="container mt-4">

<h3 class="mb-4">
    Detail Pengajuan Tiket
</h3>


<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>

<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>

<?php endif; ?>


<div class="card shadow">

<div class="card-body">


<h5 class="mb-3">
    Informasi Tiket
</h5>


<!-- NOMOR TIKET -->

<div class="mb-3">

<label class="fw-bold">
    Nomor Tiket
</label>

<p>
    <?= esc($tiket['no_tiket'] ?? 'Nomor tiket belum tersedia') ?>
</p>

</div>


<!-- TANGGAL PENGAJUAN -->

<div class="mb-3">

<label class="fw-bold">
    Tanggal Pengajuan
</label>

<p>
    <?= esc($tiket['created_at'] ?? 'Tanggal belum tersedia') ?>
</p>

</div>


<!-- NAMA PEMOHON -->

<div class="mb-3">

<label class="fw-bold">
    Nama Pemohon
</label>

<p>
    <?= esc($tiket['nama_pemohon'] ?? 'Nama pemohon belum tersedia') ?>
</p>

</div>


<!-- NIK -->

<div class="mb-3">

<label class="fw-bold">
    NIK
</label>

<p>

<?php

$nik = $tiket['nik']
    ?? $tiket['nim']
    ?? null;

?>

<?= !empty($nik)
    ? esc($nik)
    : 'NIK belum tersedia'
?>

</p>

</div>


<!-- UNIT LAYANAN -->

<div class="mb-3">

<label class="fw-bold">
    Unit Layanan
</label>

<p>
    <?= esc(
        $tiket['nama_unit']
        ?? 'Unit layanan belum tersedia'
    ) ?>
</p>

</div>


<!-- JENIS LAYANAN -->

<div class="mb-3">

<label class="fw-bold">
    Jenis Layanan
</label>

<p>
    <?= esc(
        $tiket['nama_layanan']
        ?? 'Jenis layanan belum tersedia'
    ) ?>
</p>

</div>


<!-- DESKRIPSI -->

<div class="mb-3">

<label class="fw-bold">
    Deskripsi Pengajuan
</label>

<div class="border rounded p-3 bg-light">

<?= nl2br(
    esc(
        $tiket['deskripsi']
        ?? 'Deskripsi belum tersedia'
    )
) ?>

</div>

</div>


<!-- ====================================== -->
<!-- DOKUMEN DARI PEMOHON -->
<!-- ====================================== -->

<hr>

<h5 class="mb-3">
    Dokumen dari Pemohon
</h5>


<div class="mb-3">

<label class="fw-bold">
    File Pendukung
</label>

<br>


<?php

$filePendukung =
    $tiket['file_pendukung']
    ?? null;

?>


<?php if(!empty($filePendukung)): ?>

<a
    href="<?= base_url(
        'uploads/pendukung/' .
        $filePendukung
    ) ?>"
    target="_blank"
    class="btn btn-info text-white mt-2"
>

    Lihat Dokumen Pemohon

</a>


<div class="mt-2">

<small class="text-muted">

<?= esc($filePendukung) ?>

</small>

</div>


<?php else: ?>

<p class="text-muted mt-2">

    Pemohon belum mengupload file.

</p>

<?php endif; ?>

</div>


<!-- ====================================== -->
<!-- STATUS TIKET -->
<!-- ====================================== -->

<hr>

<h5 class="mb-3">
    Status Tiket
</h5>


<div class="mb-3">

<label class="fw-bold">
    Status
</label>


<p>

<?php

/*
|--------------------------------------------------------------------------
| NORMALISASI STATUS DATABASE
|--------------------------------------------------------------------------
|
| Database menggunakan:
|
| submitted
| verification
| processing
| completed
| rejected
| cancelled
|
| Tampilan menggunakan:
|
| Menunggu
| Diproses
| Selesai
| Ditolak
| Dibatalkan
|
*/

$statusDatabase = strtolower(
    trim(
        (string) (
            $tiket['status']
            ?? ''
        )
    )
);


switch ($statusDatabase) {


    // ==========================================
    // MENUNGGU
    // ==========================================

    case 'draft':
    case 'submitted':
    case 'revision':
    case 'menunggu':

        $statusLabel = 'Menunggu';

        $statusClass = 'bg-secondary';

        break;


    // ==========================================
    // DIPROSES
    // ==========================================

    case 'verification':
    case 'processing':
    case 'in_progress':
    case 'diproses':

        $statusLabel = 'Diproses';

        $statusClass = 'bg-warning text-dark';

        break;


    // ==========================================
    // SELESAI
    // ==========================================

    case 'completed':
    case 'complete':
    case 'selesai':

        $statusLabel = 'Selesai';

        $statusClass = 'bg-success';

        break;


    // ==========================================
    // DITOLAK
    // ==========================================

    case 'rejected':
    case 'ditolak':

        $statusLabel = 'Ditolak';

        $statusClass = 'bg-danger';

        break;


    // ==========================================
    // DIBATALKAN
    // ==========================================

    case 'cancelled':
    case 'canceled':
    case 'dibatalkan':

        $statusLabel = 'Dibatalkan';

        $statusClass = 'bg-dark';

        break;


    // ==========================================
    // DEFAULT
    // ==========================================

    default:

        $statusLabel = 'Menunggu';

        $statusClass = 'bg-secondary';

        break;
}

?>

<span class="badge <?= $statusClass ?>">

<?= esc($statusLabel) ?>

</span>

</p>

</div>


<!-- ====================================== -->
<!-- HASIL PENANGANAN -->
<!-- ====================================== -->

<hr>

<h5 class="mb-3">
    Hasil Penanganan
</h5>


<!-- CATATAN PETUGAS -->

<div class="mb-3">

<label class="fw-bold">
    Catatan Petugas Layanan
</label>

<div class="border rounded p-3 bg-light">

<?php

$catatan =
    $tiket['catatan']
    ?? $tiket['admin_note']
    ?? '';

?>

<?php if(!empty(trim((string)$catatan))): ?>

<?= nl2br(esc($catatan)) ?>

<?php else: ?>

<span class="text-muted">
    Belum ada catatan
</span>

<?php endif; ?>

</div>

</div>


<!-- ====================================== -->
<!-- DOKUMEN HASIL -->
<!-- ====================================== -->

<div class="mb-3">

<label class="fw-bold">
    Dokumen Hasil
</label>

<br>


<?php

$files =
    $tiket['dokumen_hasil']
    ?? [];

?>


<?php if(!empty($files) && is_array($files)): ?>


<?php foreach($files as $file): ?>

<?php if(
    !empty($file['nama_file'])
): ?>

<a
    href="<?= base_url(
        'uploads/hasil/' .
        $file['nama_file']
    ) ?>"
    target="_blank"
    class="btn btn-success mt-2 me-2"
>

    <?= esc(
        $file['nama_asli']
        ?? $file['nama_file']
    ) ?>

</a>

<?php endif; ?>

<?php endforeach; ?>


<?php else: ?>

<p class="text-muted mt-2">

    Belum ada dokumen hasil.

</p>

<?php endif; ?>

</div>


<!-- ====================================== -->
<!-- TOMBOL AKSI -->
<!-- ====================================== -->

<hr>

<div class="mt-4">


<!-- PROSES TIKET -->

<a
    href="<?= base_url(
        'kemahasiswaan/proses/' .
        $tiket['id']
    ) ?>"
    class="btn btn-primary"
>

    Proses Tiket

</a>


<?php

/*
|--------------------------------------------------------------------------
| TOMBOL KIRIM
|--------------------------------------------------------------------------
|
| Tombol ditampilkan jika status database
| benar-benar completed/selesai.
|
*/

$statusBisaKirim =
    in_array(
        $statusDatabase,
        [
            'completed',
            'complete',
            'selesai'
        ],
        true
    );

?>


<?php if($statusBisaKirim): ?>


<!-- KIRIM KE PETUGAS ULT -->

<a
    href="<?= base_url(
        'kemahasiswaan/kirim/' .
        $tiket['id']
    ) ?>"
    class="btn btn-warning ms-2"
    onclick="return confirm(
        'Kirim tiket ini ke Petugas ULT?'
    )"
>

    Kirim ke Petugas ULT

</a>


<!-- KIRIM KE PEMOHON -->

<a
    href="<?= base_url(
        'kemahasiswaan/kirim-pemohon/' .
        $tiket['id']
    ) ?>"
    class="btn btn-success ms-2"
    onclick="return confirm(
        'Kirim tiket ini ke pemohon?'
    )"
>

    Kirim ke Pemohon

</a>


<?php endif; ?>


<!-- KEMBALI -->

<a
    href="<?= base_url(
        'kemahasiswaan'
    ) ?>"
    class="btn btn-secondary ms-2"
>

    Kembali

</a>


</div>


</div>

</div>

</div>

</body>

</html>