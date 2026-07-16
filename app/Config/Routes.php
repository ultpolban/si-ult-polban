<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================================
// PUBLIC
// ======================================

$routes->get('/', 'Home::index');

// ======================================
// AUTH
// ======================================

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::storeRegister');

$routes->get('/logout', 'AuthController::logout');

// ======================================
// USER MANAGEMENT (ROLE)
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
// DASHBOARD (LOGIN)
// ======================================

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('/dashboard', 'Dashboard::index');

    $routes->get('/dashboard/layanan', 'Dashboard::layanan');
    $routes->get('/dashboard/tiket', 'Dashboard::tiket');
    $routes->get('/dashboard/detail', 'Dashboard::detail');
    $routes->get('/dashboard/profile', 'Dashboard::profile');

});

// ======================================
// PETUGAS ULT
// ======================================

$routes->group('petugas', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('/', 'PetugasController::dashboard');

    // Data Tiket
    $routes->get('tiket', 'PetugasController::tiket');

    // Detail Tiket
    $routes->get('detail/(:num)', 'PetugasController::detail/$1');

    // Verifikasi Tiket
    $routes->get('verifikasi/(:num)', 'PetugasController::verifikasi/$1');

    // Disposisi Tiket
    $routes->get('disposisi/(:num)', 'PetugasController::disposisi/$1');

    // Update Status
    $routes->get('update-status/(:num)', 'PetugasController::updateStatus/$1');

});

// ======================================
// UNIT TUJUAN
// ======================================

$routes->group('unit', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'UnitController::dashboard');

    $routes->get('tiket', 'UnitController::tiket');

    $routes->get('laporan', 'UnitController::laporan');

    $routes->get('detail/(:num)', 'UnitController::detail/$1');

    $routes->get('update-status/(:num)', 'UnitController::updateStatus/$1');

});

$routes->get('/', 'LoginController::index');

$routes->get('/login/petugas', 'LoginController::petugas');
$routes->get('/login/unit', 'LoginController::unit');
$routes->get('/login/admin', 'LoginController::admin');
$routes->get('/login/pimpinan', 'LoginController::pimpinan');