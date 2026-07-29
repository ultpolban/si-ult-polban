<!DOCTYPE html>
<html>

<head>

<title><?= $title ?? 'Proses Tiket Unit Layanan' ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>


<body>


<div class="container mt-4">



<?php if(session()->getFlashdata('error')): ?>

<div class="alert alert-danger">
<?= session()->getFlashdata('error') ?>
</div>

<?php endif; ?>



<?php if(session()->getFlashdata('success')): ?>

<div class="alert alert-success">
<?= session()->getFlashdata('success') ?>
</div>

<?php endif; ?>





<h3>
Proses Tiket Unit Layanan
</h3>





<div class="card mt-3">


<div class="card-body">



<form action="<?= base_url('unit-layanan/updateProses/'.($tiket['id'] ?? '')) ?>"
method="post"
enctype="multipart/form-data">



<?= csrf_field() ?>






<!-- NO TIKET -->

<div class="mb-3">

<label class="form-label">
No Tiket
</label>


<input type="text"
class="form-control"
value="<?= $tiket['no_tiket'] ?? '-' ?>"
readonly>

</div>









<!-- UNIT LAYANAN -->

<div class="mb-3">

<label class="form-label">
Unit Layanan
</label>


<input type="text"
class="form-control"
value="<?= $tiket['nama_unit'] ?? '-' ?>"
readonly>

</div>









<!-- KATEGORI -->

<div class="mb-3">

<label class="form-label">
Kategori Layanan
</label>


<input type="text"
class="form-control"
value="<?= $tiket['nama_kategori'] ?? '-' ?>"
readonly>

</div>









<!-- JENIS LAYANAN -->

<div class="mb-3">

<label class="form-label">
Jenis Layanan
</label>


<input type="text"
class="form-control"
value="<?= $tiket['nama_layanan'] ?? '-' ?>"
readonly>

</div>









<!-- JUDUL -->

<div class="mb-3">

<label class="form-label">
Judul Pengajuan
</label>


<input type="text"
class="form-control"
value="<?= $tiket['judul'] ?? '-' ?>"
readonly>

</div>









<!-- DESKRIPSI -->

<div class="mb-3">

<label class="form-label">
Deskripsi Pengajuan
</label>


<textarea
class="form-control"
rows="4"
readonly><?= $tiket['deskripsi'] ?? '-' ?></textarea>


</div>









<!-- STATUS -->

<div class="mb-3">

<label class="form-label">
Status Tiket
</label>



<select name="status"
id="status"
class="form-select"
required>



<option value="Menunggu"
<?= (($tiket['status'] ?? '') == 'Menunggu') ? 'selected':'' ?>>
Menunggu
</option>




<option value="Diproses"
<?= (($tiket['status'] ?? '') == 'Diproses') ? 'selected':'' ?>>
Diproses
</option>





<option value="Selesai"
<?= (($tiket['status'] ?? '') == 'Selesai') ? 'selected':'' ?>>
Selesai
</option>



</select>


</div>









<!-- CATATAN -->

<div class="mb-3">

<label class="form-label">
Catatan Unit
</label>



<textarea 
name="catatan"
class="form-control"
rows="4"
placeholder="Masukkan catatan proses tiket..."><?= $tiket['catatan'] ?? '' ?></textarea>


</div>









<!-- UPLOAD -->

<div class="mb-3">

<label class="form-label">
Upload Dokumen Hasil
</label>



<input type="file"
name="file_hasil"
id="file_hasil"
class="form-control"
accept=".pdf,.jpg,.jpeg,.png">





<small class="text-muted">

Format PDF, JPG, JPEG, PNG.
Maksimal 5 MB.

</small>




<div id="fileInfo"
class="text-primary mt-2">

</div>









<?php if(!empty($tiket['file_hasil'])): ?>


<br>


<a href="<?= base_url('uploads/hasil/'.$tiket['file_hasil']) ?>"
target="_blank"
class="btn btn-success btn-sm">

Lihat Dokumen Hasil

</a>



<?php endif; ?>


</div>









<button type="submit"
class="btn btn-primary">

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









<script>


const form = document.querySelector('form');


form.addEventListener('submit', function(e){


let status =
document.querySelector('#status').value;


let fileInput =
document.querySelector('#file_hasil');


let file =
fileInput.files[0];


let fileLama =
"<?= !empty($tiket['file_hasil']) ? 'ada':'kosong' ?>";





// Jika selesai wajib upload

if(status === "Selesai"
&& fileInput.files.length === 0
&& fileLama === "kosong"){


e.preventDefault();


alert(
"Dokumen hasil wajib diupload sebelum tiket diselesaikan."
);


return false;


}







// Validasi file

if(file){


let ukuran =
file.size / 1024 / 1024;



if(ukuran > 5){


e.preventDefault();


alert(
"Ukuran file maksimal 5 MB."
);


return false;


}






let ext =
file.name.split('.').pop().toLowerCase();



let format =
[
"pdf",
"jpg",
"jpeg",
"png"
];



if(!format.includes(ext)){


e.preventDefault();


alert(
"Format file harus PDF, JPG, JPEG, atau PNG."
);


return false;


}


}



});









document.querySelector('#file_hasil')
.addEventListener('change',function(){


let file=this.files[0];


if(file){


document.querySelector('#fileInfo').innerHTML =
"File dipilih : "+file.name;


}


});



</script>








</body>

</html>