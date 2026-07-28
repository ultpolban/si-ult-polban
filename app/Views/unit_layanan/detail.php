<?= $this->extend('layouts/template') ?>


<?= $this->section('content') ?>


<div class="container-fluid">


<h3 class="mb-3">
Detail Tiket Unit Layanan
</h3>



<div class="card">

<div class="card-body">


<h5>
Data Tiket
</h5>


<hr>


<p>
<b>No Tiket :</b>

<?= $tiket['no_tiket'] ?? '-' ?>

</p>



<p>
<b>Nama Pemohon :</b>

<?= $tiket['nama_pemohon'] ?? '-' ?>

</p>



<p>
<b>NIM :</b>

<?= $tiket['nim'] ?? '-' ?>

</p>



<p>
<b>Email :</b>

<?= $tiket['email'] ?? '-' ?>

</p>



<p>
<b>No HP :</b>

<?= $tiket['no_hp'] ?? '-' ?>

</p>



<hr>


<h5>
Data Layanan
</h5>


<p>
<b>Kategori :</b>

<?= $tiket['nama_kategori'] ?? '-' ?>

</p>



<p>
<b>Jenis Layanan :</b>

<?= $tiket['nama_layanan'] ?? '-' ?>

</p>



<p>
<b>Judul :</b>

<?= $tiket['judul'] ?? '-' ?>

</p>



<p>
<b>Deskripsi :</b>

<br>

<?= $tiket['deskripsi'] ?? '-' ?>

</p>



<hr>


<h5>
Dokumen Pemohon
</h5>



<?php if(!empty($tiket['file_pendukung'])): ?>


<a href="<?= base_url('uploads/'.$tiket['file_pendukung']) ?>"
target="_blank"
class="btn btn-info">

Lihat Lampiran

</a>


<?php else: ?>


<span>
Tidak ada lampiran
</span>


<?php endif; ?>



<hr>



<h5>
Proses Unit Layanan
</h5>



<p>
<b>Status Unit :</b>

<span class="badge bg-warning">

<?= $tiket['status'] ?? '-' ?>

</span>

</p>



<p>
<b>Catatan Unit :</b>

<br>

<?= $tiket['catatan'] ?? '-' ?>

</p>




<hr>


<h5>
Dokumen Hasil
</h5>



<?php if(!empty($tiket['file_hasil'])): ?>


<a href="<?= base_url('uploads/hasil/'.$tiket['file_hasil']) ?>"
target="_blank"
class="btn btn-success">

Download Hasil

</a>


<?php else: ?>


<span>
Belum ada hasil
</span>


<?php endif; ?>



<hr>



<a href="<?= base_url('unit-layanan/proses/'.$tiket['id']) ?>"
class="btn btn-warning">

Proses Tiket

</a>



<a href="<?= base_url('unit-layanan/upload/'.$tiket['id']) ?>"
class="btn btn-success">

Upload Hasil

</a>



<a href="<?= base_url('unit-layanan/kirim/'.$tiket['id']) ?>"
class="btn btn-primary"
onclick="return confirm('Kirim hasil ke Petugas ULT?')">

Kirim ke Petugas ULT

</a>



<a href="<?= base_url('unit-layanan/dashboard') ?>"
class="btn btn-secondary">

Kembali

</a>



</div>

</div>


</div>


<?= $this->endSection() ?>