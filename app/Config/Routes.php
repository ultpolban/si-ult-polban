<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// =====================================================
// UNIT LAYANAN
// =====================================================

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

// =====================================================
// UPDATE PROFIL PETUGAS UNIT LAYANAN
// =====================================================

$routes->post(
    'unit-layanan/profile/update',
    'UnitLayanan::updateProfile'
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


// =====================================================
// HAPUS FILE HASIL
// =====================================================

$routes->get(
    'unit-layanan/hapus-file/(:num)/(:num)',
    'UnitLayanan::hapusFile/$1/$2'
);

$routes->get(
    'unit-layanan/hapus-dokumen/(:num)',
    'UnitLayanan::hapusDokumen/$1'
);


// =====================================================
// KEMAHASISWAAN
// =====================================================

$routes->get(
    'kemahasiswaan',
    'Kemahasiswaan::index'
);

$routes->get(
    'kemahasiswaan/dashboard',
    'Kemahasiswaan::index'
);

$routes->get(
    'kemahasiswaan/profile',
    'Kemahasiswaan::profile'
);

// =====================================================
// EDIT & UPDATE PROFIL PETUGAS KEMAHASISWAAN
// =====================================================

$routes->get(
    'kemahasiswaan/profile/edit',
    'Kemahasiswaan::editProfil'
);

$routes->post(
    'kemahasiswaan/profile/update',
    'Kemahasiswaan::updateProfil'
);

// Alternatif URL update profil
$routes->post(
    'kemahasiswaan/update-profil',
    'Kemahasiswaan::updateProfil'
);

$routes->get(
    'kemahasiswaan/detail/(:num)',
    'Kemahasiswaan::detail/$1'
);

$routes->get(
    'kemahasiswaan/proses/(:num)',
    'Kemahasiswaan::proses/$1'
);

$routes->post(
    'kemahasiswaan/updateProses/(:num)',
    'Kemahasiswaan::updateProses/$1'
);

$routes->get(
    'kemahasiswaan/kirim/(:num)',
    'Kemahasiswaan::kirim/$1'
);

$routes->get(
    'kemahasiswaan/kirim-pemohon/(:num)',
    'Kemahasiswaan::kirimKePemohon/$1'
);

$routes->get(
    'kemahasiswaan/hapus-dokumen/(:num)',
    'Kemahasiswaan::hapusDokumen/$1'
);


// =====================================================
// KEUANGAN
// =====================================================

// Dashboard
$routes->get(
    'keuangan',
    'Keuangan::index'
);

$routes->get(
    'keuangan/dashboard',
    'Keuangan::dashboard'
);


// =====================================================
// PROFIL PETUGAS KEUANGAN
// =====================================================

$routes->get(
    'keuangan/profile',
    'Keuangan::profil'
);

// Halaman edit profil
$routes->get(
    'keuangan/edit-profil',
    'Keuangan::editProfil'
);

// Proses update profil
$routes->post(
    'keuangan/update-profil',
    'Keuangan::updateProfil'
);

// Alternatif URL update profil
$routes->post(
    'keuangan/profile/update',
    'Keuangan::updateProfil'
);


// =====================================================
// DETAIL TIKET
// =====================================================

$routes->get(
    'keuangan/detail/(:num)',
    'Keuangan::detail/$1'
);


// =====================================================
// PROSES TIKET
// =====================================================

$routes->get(
    'keuangan/proses/(:num)',
    'Keuangan::proses/$1'
);


// =====================================================
// UPDATE PROSES TIKET
// =====================================================

$routes->post(
    'keuangan/updateProses/(:num)',
    'Keuangan::updateProses/$1'
);


// =====================================================
// KIRIM KE PETUGAS ULT
// =====================================================

$routes->get(
    'keuangan/kirim/(:num)',
    'Keuangan::kirim/$1'
);


// =====================================================
// KIRIM KE PEMOHON
// =====================================================

$routes->get(
    'keuangan/kirim-pemohon/(:num)',
    'Keuangan::kirimKePemohon/$1'
);


// =====================================================
// HAPUS DOKUMEN
// =====================================================

$routes->get(
    'keuangan/hapus-dokumen/(:num)',
    'Keuangan::hapusDokumen/$1'
);