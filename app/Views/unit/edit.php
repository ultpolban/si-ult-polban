<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Edit Unit</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Edit Unit Kerja</h2>

<hr>

<form action="<?= base_url('unit/update/'.$unit['id']) ?>" method="post">

<?= csrf_field() ?>

<div class="mb-3">

<label>Nama Unit</label>

<input
type="text"
name="nama_unit"
class="form-control"
value="<?= $unit['nama_unit'] ?>">

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"><?= $unit['deskripsi'] ?></textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="Aktif"
<?= $unit['status']=='Aktif'?'selected':'' ?>>

Aktif

</option>

<option value="Tidak Aktif"
<?= $unit['status']=='Tidak Aktif'?'selected':'' ?>>

Tidak Aktif

</option>

</select>

</div>

<button class="btn btn-primary">

Update

</button>

<a href="<?= base_url('unit') ?>"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</body>

</html>