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
Dashboard Unit Layanan
</h3>


<table class="table table-bordered">


<tr>

<th>No Tiket</th>
<th>Judul</th>
<th>Status</th>
<th>Aksi</th>

</tr>



<?php foreach($tiket as $t): ?>


<tr>


<td>
<?= $t['no_tiket'] ?>
</td>


<td>
<?= $t['judul'] ?>
</td>


<td>

<span class="badge bg-info">

<?= $t['status'] ?>

</span>

</td>


<td>

<a href="<?= base_url('unit-layanan/detail/'.$t['id']) ?>" 
class="btn btn-primary btn-sm">

Detail

</a>

</td>


</tr>


<?php endforeach; ?>


</table>


</div>


</body>

</html>