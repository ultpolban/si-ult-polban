<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================================
// PUBLIC & AUTH
// ======================================
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::storeRegister');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register/fields/(:num)', 'AuthController::fields/$1');

// ======================================
// USER MANAGEMENT
// ======================================
$routes->group('users', ['filter' => 'role'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

// ======================================
// DASHBOARD PEMOHON
// ======================================
$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('layanan', 'Dashboard::layanan');
    $routes->get('tiket', 'Dashboard::tiket');
    $routes->get('detail', 'Dashboard::detail');
    $routes->get('profile', 'Dashboard::profile');
});

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
$routes->group('petugas', function($routes){
    $routes->get('/', 'PetugasController::dashboard');
    $routes->get('dashboard', 'PetugasController::dashboard');
    $routes->get('tiket', 'PetugasController::tiket');
    $routes->get('tiket/detail/(:num)', 'PetugasController::detail/$1');
    $routes->get('detail/(:num)', 'PetugasController::detail/$1');

    // Verifikasi (GET & POST)
    $routes->get('verifikasi', 'PetugasController::verifikasi');
    $routes->get('verifikasi/(:num)', 'PetugasController::verifikasi/$1');
    $routes->get('tiket/verifikasi/(:num)', 'PetugasController::verifikasi/$1');
    $routes->post('verifikasi/simpan', 'PetugasController::simpanVerifikasi');
    $routes->post('verifikasi/simpan/(:num)', 'PetugasController::simpanVerifikasi/$1');
    $routes->post('verifikasi/(:num)', 'PetugasController::simpanVerifikasi/$1');

    // Disposisi (GET & POST)
    $routes->get('disposisi', 'PetugasController::disposisi');
    $routes->get('disposisi/(:num)', 'PetugasController::disposisi/$1');
    $routes->get('tiket/disposisi/(:num)', 'PetugasController::disposisi/$1');
    $routes->post('disposisi/kirim', 'PetugasController::kirimDisposisi');
    $routes->post('disposisi/kirim/(:num)', 'PetugasController::kirimDisposisi/$1');
    $routes->post('disposisi/(:num)', 'PetugasController::kirimDisposisi/$1');

    // Laporan & Tracking & Log
    $routes->get('laporan-tamu', 'PetugasController::laporanTamu');
    $routes->get('statistik-tiket', 'PetugasController::statistikTiket');
    $routes->get('laporan-tiket', 'PetugasController::laporanTiket');
    $routes->get('tracking-tiket', 'PetugasController::trackingTiket');
    $routes->get('log-aktivitas', 'PetugasController::log_aktivitas');
    $routes->get('log_aktivitas', 'PetugasController::log_aktivitas');

    // Endpoint API Response AJAX Statistik (Periode Filter)
    $routes->get('api/statistik-data', 'PetugasController::apiStatistikData');

    // Export
    $routes->get('laporan/export/excel', 'PetugasController::exportExcel');
    $routes->get('laporan/export/pdf', 'PetugasController::exportPdf');
    $routes->get('laporan/export/csv', 'PetugasController::exportCsv');

    // Aksi Tamu (Gunakan POST/DELETE untuk aksi hapus/simpan)
    $routes->get('detail-tamu/(:num)', 'PetugasController::detail_tamu/$1');
    $routes->get('verifikasi-tamu/(:num)', 'PetugasController::verifikasi_tamu/$1');
    $routes->get('disposisi-tamu/(:num)', 'PetugasController::disposisi_tamu/$1');
    $routes->get('edit-tamu/(:num)', 'PetugasController::edit_tamu/$1');
    $routes->match(['get', 'post'], 'delete-tamu/(:num)', 'PetugasController::delete_tamu/$1');

    // Profile Petugas
    $routes->get('profile', 'PetugasController::profile');
});

/*
|--------------------------------------------------------------------------
| UNIT TUJUAN, ADMIN, & PIMPINAN
|--------------------------------------------------------------------------
*/
$routes->group('unit', function($routes){
    $routes->get('/', 'UnitController::dashboard');
    $routes->get('dashboard', 'UnitController::dashboard');
    $routes->get('detail/(:num)', 'UnitController::detail/$1');
    $routes->match(['get', 'post'], 'update-status/(:num)', 'UnitController::updateStatus/$1');
});

$routes->get('/admin', 'AdminController::index');
$routes->get('/pimpinan', 'PimpinanController::index');