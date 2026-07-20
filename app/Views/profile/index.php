<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Profil Pengguna</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-md-4">

<div class="card card-danger card-outline">

<div class="card-body text-center">

<img src="<?= base_url('assets/img/user.png') ?>"
class="img-circle elevation-2"
width="150">

<h3 class="mt-3">
Alvin
</h3>

<p class="text-muted">
Mahasiswa POLBAN
</p>

</div>

</div>

</div>

<div class="col-md-8">

<div class="card shadow">

<div class="card-header bg-danger text-white">

Informasi Pengguna

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
<th width="35%">Nama</th>
<td>Alvin</td>
</tr>

<tr>
<th>NIM</th>
<td>231511001</td>
</tr>

<tr>
<th>Email</th>
<td>alvin@student.polban.ac.id</td>
</tr>

<tr>
<th>Program Studi</th>
<td>D4 Teknik Informatika</td>
</tr>

<tr>
<th>No HP</th>
<td>081234567890</td>
</tr>

</table>

<a href="<?= base_url('profile/edit') ?>" class="btn btn-warning">
    <i class="fas fa-edit"></i>
    Edit Profil
</a>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>