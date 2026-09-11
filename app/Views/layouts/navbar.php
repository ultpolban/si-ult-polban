<?php
$uriPath = strtolower(service('request')->getUri()->getPath());
$dashboardTitle = str_contains($uriPath, 'akademik')
	? 'Dashboard Akademik'
	: (str_contains($uriPath, 'keuangan')
		? 'Dashboard Keuangan'
		: (str_contains($uriPath, 'kemahasiswaan')
			? 'Dashboard Kemahasiswaan'
			: (str_contains($uriPath, 'perpustakaan')
				? 'Dashboard Perpustakaan'
				: (str_contains($uriPath, 'jurusan')
					? 'Dashboard Layanan Jurusan'
					: 'Dashboard'))));
?>

<nav class="navbar navbar-ult">


<div class="container-fluid">


<h5 class="text-white mb-0">
<?= esc($dashboardTitle) ?>
</h5>



<div class="text-white">


<i class="fas fa-user"></i>

<?= session()->get('name') ?? 'Petugas' ?>


</div>



</div>


</nav>