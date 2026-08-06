<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title><?= $title ?? 'Detail Tiket' ?></title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">


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
<?= session()->getFlashdata('success') ?>
</div>

<?php endif; ?>



<?php if(session()->getFlashdata('error')): ?>

<div class="alert alert-danger">
<?= session()->getFlashdata('error') ?>
</div>

<?php endif; ?>





<div class="card shadow">

<div class="card-body">



<h5 class="mb-3">
Informasi Tiket
</h5>




<div class="mb-3">

<label class="fw-bold">
Nomor Tiket
</label>

<p>
<?= $tiket['no_tiket'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
Tanggal Pengajuan
</label>

<p>
<?= $tiket['created_at'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
Nama Pemohon
</label>

<p>
<?= $tiket['nama_pemohon'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
NIM
</label>

<p>
<?= $tiket['nim'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
Unit Layanan
</label>

<p>
<?= $tiket['nama_unit'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
Kategori Layanan
</label>

<p>
<?= $tiket['nama_kategori'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
Jenis Layanan
</label>

<p>
<?= $tiket['nama_layanan'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
Judul Pengajuan
</label>

<p>
<?= $tiket['judul'] ?? '-' ?>
</p>

</div>





<div class="mb-3">

<label class="fw-bold">
Deskripsi Pengajuan
</label>


<div class="border rounded p-3 bg-light">

<?= nl2br($tiket['deskripsi'] ?? '-') ?>

</div>


</div>





<hr>




<h5 class="mb-3">
Status Tiket
</h5>




<div class="mb-3">

<label class="fw-bold">
Status
</label>


<p>


<?php if(($tiket['status'] ?? '')=="Selesai"): ?>


<span class="badge bg-success">
Selesai
</span>



<?php elseif(($tiket['status'] ?? '')=="Diproses"): ?>


<span class="badge bg-warning text-dark">
Diproses
</span>



<?php elseif(($tiket['status'] ?? '')=="Ditolak"): ?>


<span class="badge bg-danger">
Ditolak
</span>



<?php else: ?>


<span class="badge bg-secondary">
Menunggu
</span>



<?php endif; ?>


</p>


</div>





<hr>





<h5 class="mb-3">
Hasil Penanganan
</h5>





<div class="mb-3">

<label class="fw-bold">
Catatan Petugas
</label>


<div class="border rounded p-3 bg-light">

<?= nl2br($tiket['catatan'] ?? 'Belum ada catatan') ?>


</div>


</div>







<div class="mb-3">

<label class="fw-bold">
Dokumen Hasil
</label>

<br>




<?php $files = $tiket['dokumen_hasil'] ?? []; ?>

<?php if(!empty($files)): ?>

<?php foreach($files as $file): ?>

<a href="<?= base_url('uploads/hasil/'.$file['nama_file']) ?>"
target="_blank"
class="btn btn-success mt-2 me-2">

<?= esc($file['nama_file']) ?>

</a>

<?php endforeach; ?>

<?php else: ?>

<p class="text-muted mt-2">
Belum ada dokumen
</p>

<?php endif; ?>


</div>





<hr>





<div class="mt-4">

    <a href="<?= base_url('kemahasiswaan/proses/'.$tiket['id']) ?>"
       class="btn btn-primary">
        Proses Tiket
    </a>

    <?php if(($tiket['status'] ?? '') === 'Selesai'): ?>

    <a href="<?= base_url('kemahasiswaan/kirim/'.$tiket['id']) ?>"
       class="btn btn-warning ms-2"
       onclick="return confirm('Kirim tiket ini ke Petugas ULT?')">

        Kirim ke Petugas ULT

    </a>

    <?php endif; ?>

    <a href="<?= base_url('kemahasiswaan') ?>"
       class="btn btn-secondary ms-2">

        Kembali

    </a>

</div>



</div>

</div>





</div>


</body>

</html>