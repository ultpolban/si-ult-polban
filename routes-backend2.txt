<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*
|--------------------------------------------------------------------------
| UNIT LAYANAN UMUM
|--------------------------------------------------------------------------
*/

$routes->get(
    'unit-layanan',
    'UnitLayanan::dashboard'
);

$routes->get(
    'unit-layanan/dashboard',
    'UnitLayanan::dashboard'
);

$routes->get(
    'unit-layanan/profile',
    'UnitLayanan::profile'
);

$routes->post(
    'unit-layanan/profile/update',
    'UnitLayanan::updateProfile'
);

$routes->get(
    'unit-layanan/data-tiket',
    'UnitLayanan::dataTiket'
);

$routes->get(
    'unit-layanan/detail/(:num)',
    'UnitLayanan::detail/$1'
);

$routes->get(
    'unit-layanan/proses/(:num)',
    'UnitLayanan::proses/$1'
);

$routes->post(
    'unit-layanan/updateProses/(:num)',
    'UnitLayanan::updateProses/$1'
);

$routes->get(
    'unit-layanan/upload/(:num)',
    'UnitLayanan::upload/$1'
);

$routes->post(
    'unit-layanan/simpanUpload/(:num)',
    'UnitLayanan::simpanUpload/$1'
);

$routes->get(
    'unit-layanan/kirim/(:num)',
    'UnitLayanan::kirim/$1'
);

$routes->get(
    'unit-layanan/kirim-pemohon/(:num)',
    'UnitLayanan::kirimKePemohon/$1'
);

$routes->get(
    'unit-layanan/riwayat',
    'UnitLayanan::riwayat'
);

$routes->get(
    'unit-layanan/hapus-dokumen/(:num)',
    'UnitLayanan::hapusDokumen/$1'
);


/*
|--------------------------------------------------------------------------
| AKADEMIK
|--------------------------------------------------------------------------
*/

$routes->get(
    'akademik',
    'UnitLayanan::akademik'
);

$routes->get(
    'akademik/dashboard',
    'UnitLayanan::akademik'
);


/*
|--------------------------------------------------------------------------
| PROFILE AKADEMIK
|--------------------------------------------------------------------------
*/

$routes->get(
    'akademik/profile',
    'UnitLayanan::profile'
);

$routes->post(
    'akademik/profile/update',
    'UnitLayanan::updateProfile'
);


/*
|--------------------------------------------------------------------------
| STATISTIK AKADEMIK
|--------------------------------------------------------------------------
*/

$routes->get(
    'akademik/statistik',
    'UnitLayanan::statistik'
);


/*
|--------------------------------------------------------------------------
| DATA TIKET AKADEMIK
|--------------------------------------------------------------------------
*/

$routes->get(
    'akademik/data-tiket',
    'UnitLayanan::dataTiketAkademik'
);

$routes->get(
    'akademik/detail/(:num)',
    'UnitLayanan::detailAkademik/$1'
);

$routes->get(
    'akademik/proses/(:num)',
    'UnitLayanan::proses/$1'
);

$routes->post(
    'akademik/updateProses/(:num)',
    'UnitLayanan::updateProses/$1'
);

$routes->get(
    'akademik/upload/(:num)',
    'UnitLayanan::upload/$1'
);

$routes->post(
    'akademik/simpanUpload/(:num)',
    'UnitLayanan::simpanUpload/$1'
);

$routes->get(
    'akademik/kirim/(:num)',
    'UnitLayanan::kirim/$1'
);

$routes->get(
    'akademik/kirim-pemohon/(:num)',
    'UnitLayanan::kirimKePemohon/$1'
);

$routes->get(
    'akademik/riwayat',
    'UnitLayanan::riwayat'
);

$routes->get(
    'akademik/hapus-dokumen/(:num)',
    'UnitLayanan::hapusDokumen/$1'
);


/*
|--------------------------------------------------------------------------
| KEUANGAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'keuangan',
    'UnitLayanan::keuangan'
);

$routes->get(
    'keuangan/dashboard',
    'UnitLayanan::keuangan'
);


/*
|--------------------------------------------------------------------------
| PROFILE KEUANGAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'keuangan/profile',
    'UnitLayanan::profile'
);

$routes->post(
    'keuangan/profile/update',
    'UnitLayanan::updateProfile'
);


/*
|--------------------------------------------------------------------------
| STATISTIK KEUANGAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'keuangan/statistik',
    'UnitLayanan::statistik'
);


/*
|--------------------------------------------------------------------------
| DATA TIKET KEUANGAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'keuangan/data-tiket',
    'UnitLayanan::dataTiketKeuangan'
);

$routes->get(
    'keuangan/detail/(:num)',
    'UnitLayanan::detail/$1'
);

$routes->get(
    'keuangan/proses/(:num)',
    'UnitLayanan::proses/$1'
);

$routes->post(
    'keuangan/updateProses/(:num)',
    'UnitLayanan::updateProses/$1'
);

$routes->get(
    'keuangan/upload/(:num)',
    'UnitLayanan::upload/$1'
);

$routes->post(
    'keuangan/simpanUpload/(:num)',
    'UnitLayanan::simpanUpload/$1'
);

$routes->get(
    'keuangan/kirim/(:num)',
    'UnitLayanan::kirim/$1'
);

$routes->get(
    'keuangan/kirim-pemohon/(:num)',
    'UnitLayanan::kirimKePemohon/$1'
);

$routes->get(
    'keuangan/riwayat',
    'UnitLayanan::riwayat'
);

$routes->get(
    'keuangan/hapus-dokumen/(:num)',
    'UnitLayanan::hapusDokumen/$1'
);


/*
|--------------------------------------------------------------------------
| KEMAHASISWAAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'kemahasiswaan',
    'UnitLayanan::kemahasiswaan'
);

$routes->get(
    'kemahasiswaan/dashboard',
    'UnitLayanan::kemahasiswaan'
);


/*
|--------------------------------------------------------------------------
| PROFILE KEMAHASISWAAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'kemahasiswaan/profile',
    'UnitLayanan::profile'
);

$routes->post(
    'kemahasiswaan/profile/update',
    'UnitLayanan::updateProfile'
);


/*
|--------------------------------------------------------------------------
| STATISTIK KEMAHASISWAAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'kemahasiswaan/statistik',
    'UnitLayanan::statistik'
);


/*
|--------------------------------------------------------------------------
| DATA TIKET KEMAHASISWAAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'kemahasiswaan/data-tiket',
    'UnitLayanan::dataTiketKemahasiswaan'
);

$routes->get(
    'kemahasiswaan/detail/(:num)',
    'UnitLayanan::detail/$1'
);

$routes->get(
    'kemahasiswaan/proses/(:num)',
    'UnitLayanan::proses/$1'
);

$routes->post(
    'kemahasiswaan/updateProses/(:num)',
    'UnitLayanan::updateProses/$1'
);

$routes->get(
    'kemahasiswaan/upload/(:num)',
    'UnitLayanan::upload/$1'
);

$routes->post(
    'kemahasiswaan/simpanUpload/(:num)',
    'UnitLayanan::simpanUpload/$1'
);

$routes->get(
    'kemahasiswaan/kirim/(:num)',
    'UnitLayanan::kirim/$1'
);

$routes->get(
    'kemahasiswaan/kirim-pemohon/(:num)',
    'UnitLayanan::kirimKePemohon/$1'
);

$routes->get(
    'kemahasiswaan/riwayat',
    'UnitLayanan::riwayat'
);

$routes->get(
    'kemahasiswaan/hapus-dokumen/(:num)',
    'UnitLayanan::hapusDokumen/$1'
);