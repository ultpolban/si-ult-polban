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
    $routes->get('detail/(:num)', 'PetugasController::detail/$1');

    // Verifikasi
    $routes->get('verifikasi', 'PetugasController::verifikasi');
    $routes->get('verifikasi/(:num)', 'PetugasController::verifikasi/$1');
    $routes->post('verifikasi/simpan', 'PetugasController::simpanVerifikasi');
    $routes->post('verifikasi/simpan/(:num)', 'PetugasController::simpanVerifikasi/$1');

    // Disposisi
    $routes->get('disposisi', 'PetugasController::disposisi');
    $routes->get('disposisi/(:num)', 'PetugasController::disposisi/$1');
    $routes->post('disposisi/kirim', 'PetugasController::kirimDisposisi');
    $routes->post('disposisi/kirim/(:num)', 'PetugasController::kirimDisposisi/$1');

    // Laporan & Tracking & Log
    $routes->get('laporan-tamu', 'PetugasController::laporanTamu');
    $routes->get('statistik-tiket', 'PetugasController::statistikTiket');
    $routes->get('laporan-tiket', 'PetugasController::laporanTiket');
    $routes->get('tracking-tiket', 'PetugasController::trackingTiket');
    $routes->get('log-aktivitas', 'PetugasController::log_aktivitas');
    $routes->get('log_aktivitas', 'PetugasController::log_aktivitas');

    // Export
    $routes->get('laporan/export/excel', 'PetugasController::exportExcel');
    $routes->get('laporan/export/pdf', 'PetugasController::exportPdf');
    $routes->get('laporan/export/csv', 'PetugasController::exportCsv');

    // Aksi Tamu
    $routes->get('detail-tamu/(:num)', 'PetugasController::detail_tamu/$1');
    $routes->get('verifikasi-tamu/(:num)', 'PetugasController::verifikasi_tamu/$1');
    $routes->get('disposisi-tamu/(:num)', 'PetugasController::disposisi_tamu/$1');
    $routes->get('edit-tamu/(:num)', 'PetugasController::edit_tamu/$1');
    $routes->get('delete-tamu/(:num)', 'PetugasController::delete_tamu/$1');

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
    $routes->get('update-status/(:num)', 'UnitController::updateStatus/$1');
});

$routes->get('/admin', 'AdminController::index');
$routes->get('/pimpinan', 'PimpinanController::index');