<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =========================
// HALAMAN UTAMA
// =========================
$routes->get('/', 'Home::index');

// =========================
// LOGIN & REGISTER
// =========================
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::storeRegister');

$routes->get('/logout', 'AuthController::logout');

// =========================
// DASHBOARD ADMIN (TUGAS ANDA)
// =========================
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/layanan', 'Admin::layanan');
$routes->get('/admin/laporan', 'Admin::laporan');
$routes->get('/admin/statistik', 'Admin::statistik');
$routes->get('/admin/tiket', 'Admin::tiket');
$routes->get('/admin/verifikasi-tiket', 'Admin::verifikasiTiket');
$routes->get('/admin/tracking', 'Admin::tracking');
$routes->get('/pimpinan/dashboard', 'Admin::dashboardPimpinan');


// =========================
// SEMUA USER YANG SUDAH LOGIN
// =========================
$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('/dashboard', 'DashboardController::index');

    // User CRUD
    $routes->get('/users', 'UserController::index');
    $routes->get('/users/create', 'UserController::create');
    $routes->post('/users/store', 'UserController::store');
    $routes->get('/users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('/users/update/(:num)', 'UserController::update/$1');
    $routes->get('/users/delete/(:num)', 'UserController::delete/$1');
    $routes->get('/users/toggle/(:num)', 'UserController::toggleStatus/$1');

    // Role CRUD
    $routes->get('/roles', 'RoleController::index');
    $routes->get('/roles/create', 'RoleController::create');
    $routes->post('/roles/store', 'RoleController::store');
    $routes->get('/roles/edit/(:num)', 'RoleController::edit/$1');
    $routes->post('/roles/update/(:num)', 'RoleController::update/$1');
    $routes->get('/roles/delete/(:num)', 'RoleController::delete/$1');

    // Unit CRUD
    $routes->get('/units', 'UnitController::index');
    $routes->get('/unit-kerja', 'UnitController::index');
    $routes->post('/units/store', 'UnitController::store');
    $routes->get('/units/edit/(:num)', 'UnitController::edit/$1');
    $routes->post('/units/update/(:num)', 'UnitController::update/$1');
    $routes->get('/units/delete/(:num)', 'UnitController::delete/$1');

    // Jurusan CRUD
    $routes->get('/jurusan', 'JurusanController::index');
    $routes->post('/jurusan/store', 'JurusanController::store');
    $routes->get('/jurusan/edit/(:num)', 'JurusanController::edit/$1');
    $routes->post('/jurusan/update/(:num)', 'JurusanController::update/$1');
    $routes->get('/jurusan/delete/(:num)', 'JurusanController::delete/$1');

    // Program Studi CRUD
    $routes->get('/program-studi', 'ProgramStudiController::index');
    $routes->post('/program-studi/store', 'ProgramStudiController::store');
    $routes->get('/program-studi/edit/(:num)', 'ProgramStudiController::edit/$1');
    $routes->post('/program-studi/update/(:num)', 'ProgramStudiController::update/$1');
    $routes->get('/program-studi/delete/(:num)', 'ProgramStudiController::delete/$1');

    // Debug endpoint (no auth) for quick checks
    $routes->get('/debug/status', 'DebugController::status');
});

// =========================
// KHUSUS ROLE ADMIN
// =========================
$routes->group('users', ['filter' => 'role'], function ($routes) {

    $routes->get('/', 'UserController::index');

    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');

    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');

    $routes->get('delete/(:num)', 'UserController::delete/$1');
    $routes->get('toggle/(:num)', 'UserController::toggleStatus/$1');
});
