<!DOCTYPE html>
<html>

<head>

<title><?= $title ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>


<body>


<div class="container mt-4">


<h3>Proses Tiket Unit Layanan</h3>


<div class="card">

<div class="card-body">


<form action="<?= base_url('unit-layanan/updateProses/'.$tiket['id']) ?>"
method="post">



<div class="mb-3">

<label>No Tiket</label>

<input type="text"
class="form-control"
value="<?= $tiket['no_tiket'] ?>"
readonly>

</div>




<div class="mb-3">

<label>Judul</label>

<input type="text"
class="form-control"
value="<?= $tiket['judul'] ?>"
readonly>

</div>





<div class="mb-3">


<label>Status</label>


<select name="status"
class="form-control">


<option value="Diproses">
Diproses
</option>


<option value="Menunggu Pemohon">
Menunggu Pemohon
</option>


<option value="Selesai">
Selesai
</option>


</select>


</div>





<div class="mb-3">

<label>Catatan Unit</label>


<textarea name="catatan"
class="form-control"
rows="4"
placeholder="Masukkan catatan proses">

</textarea>


</div>





<button class="btn btn-primary">

Simpan Proses

</button>


<a href="<?= base_url('unit-layanan/detail/'.$tiket['id']) ?>" 
class="btn btn-secondary">
    Kembali
</a>


</form>



</div>

</div>


</div>


</body>

</html>