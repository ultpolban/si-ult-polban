<!DOCTYPE html>
<html>

<head>

<title>
<?= $title ?>
</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet">


</head>


<body>


<div class="container mt-4">


<h3>
Upload Hasil Dokumen
</h3>



<form method="post"
enctype="multipart/form-data"
action="<?= base_url('unit-layanan/simpan-upload/'.$tiket['id']) ?>">



<div class="mb-3">

<label>
Pilih File
</label>


<input type="file"
name="file_hasil"
class="form-control"
accept=".pdf,.doc,.docx">


</div>


<button class="btn btn-success">

Upload

</button>


<a href="<?= base_url('unit-layanan/detail/'.$tiket['id']) ?>" 
class="btn btn-secondary">
Kembali
</a>


</form>


</div>


</body>

</html>