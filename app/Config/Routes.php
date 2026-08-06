<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// ===============================
// UNIT LAYANAN
// ===============================


$routes->get(
    'unit-layanan',
    'UnitLayanan::dashboard'
);


$routes->get(
    'unit-layanan/dashboard',
    'UnitLayanan::dashboard'
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
    'unit-layanan/riwayat',
    'UnitLayanan::riwayat'
);


// ===============================
// HAPUS FILE HASIL
// ===============================

$routes->get(
    'unit-layanan/hapus-file/(:num)/(:num)',
    'UnitLayanan::hapusFile/$1/$2'
);

$routes->get(
    'unit-layanan/hapus-dokumen/(:num)',
    'UnitLayanan::hapusDokumen/$1'
);

$routes->get('kemahasiswaan/dashboard', 'Kemahasiswaan::index');
$routes->get('keuangan/dashboard', 'Keuangan::index');

// ===============================
// KEMAHASISWAAN
// ===============================

$routes->get('kemahasiswaan', 'Kemahasiswaan::index');
$routes->get('kemahasiswaan/dashboard', 'Kemahasiswaan::index');
$routes->get('kemahasiswaan/detail/(:num)', 'Kemahasiswaan::detail/$1');
$routes->get('kemahasiswaan/proses/(:num)', 'Kemahasiswaan::proses/$1');
$routes->post('kemahasiswaan/updateProses/(:num)', 'Kemahasiswaan::updateProses/$1');
$routes->get('kemahasiswaan/kirim/(:num)', 'Kemahasiswaan::kirim/$1');
$routes->get('kemahasiswaan/hapus-dokumen/(:num)', 'Kemahasiswaan::hapusDokumen/$1');


// ===============================
// KEUANGAN
// ===============================

$routes->get('keuangan', 'Keuangan::index');
$routes->get('keuangan/dashboard', 'Keuangan::index');
$routes->get('keuangan/detail/(:num)', 'Keuangan::detail/$1');
$routes->get('keuangan/proses/(:num)', 'Keuangan::proses/$1');
$routes->post('keuangan/updateProses/(:num)', 'Keuangan::updateProses/$1');
$routes->get('keuangan/kirim/(:num)', 'Keuangan::kirim/$1');
$routes->get('keuangan/hapus-dokumen/(:num)', 'Keuangan::hapusDokumen/$1');
$routes->get('keuangan', 'Keuangan::index');
$routes->get('keuangan/dashboard', 'Keuangan::dashboard');
$routes->get('keuangan/detail/(:num)', 'Keuangan::detail/$1');
$routes->get('keuangan/proses/(:num)', 'Keuangan::proses/$1');

$routes->post(
    'keuangan/updateProses/(:num)',
    'Keuangan::updateProses/$1'
);