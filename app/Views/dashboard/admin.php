<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">


<h3>
Dashboard SI ULT POLBAN
</h3>


<hr>


<div class="alert alert-success">

Selamat datang 
<b>
<?= session()->get('name') ?>
</b>

<br>

Role :
<?= session()->get('role_id') ?>

</div>



<div class="row">


<div class="col-md-3 mb-3">

<div class="card bg-primary text-white">

<div class="card-body">


<h5>
Unit Kerja
</h5>


<h2>
<?= $jumlah_unit ?>
</h2>


<a href="<?= base_url('unit') ?>"
class="btn btn-light">

Buka

</a>


</div>

</div>

</div>




<div class="col-md-3 mb-3">

<div class="card bg-success text-white">

<div class="card-body">


<h5>
Kategori Layanan
</h5>


<h2>
<?= $jumlah_kategori ?>
</h2>


<a href="<?= base_url('kategori') ?>"
class="btn btn-light">

Buka

</a>


</div>

</div>

</div>





<div class="col-md-3 mb-3">

<div class="card bg-warning">

<div class="card-body">


<h5>
Layanan
</h5>


<h2>
<?= $jumlah_layanan ?>
</h2>


<a href="<?= base_url('layanan') ?>"
class="btn btn-light">

Buka

</a>


</div>

</div>

</div>





<div class="col-md-3 mb-3">

<div class="card bg-danger text-white">

<div class="card-body">


<h5>
Persyaratan
</h5>


<h2>
<?= $jumlah_persyaratan ?>
</h2>


<a href="<?= base_url('persyaratan') ?>"
class="btn btn-light">

Buka

</a>


</div>

</div>

</div>



</div>


</div>


<?= $this->endSection() ?>