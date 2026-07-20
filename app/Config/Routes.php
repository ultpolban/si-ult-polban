<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================================
// PUBLIC
// ======================================

$routes->get('/', 'AuthController::login');

// ======================================
// AUTH
// ======================================

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

    $routes->get('verifikasi/(:num)', 'PetugasController::verifikasi/$1');

    $routes->get('disposisi/(:num)', 'PetugasController::disposisi/$1');

});


/*
|--------------------------------------------------------------------------
| UNIT TUJUAN
|--------------------------------------------------------------------------
*/

$routes->group('unit', function($routes){

    $routes->get('/', 'UnitController::dashboard');

    $routes->get('dashboard', 'UnitController::dashboard');

    $routes->get('detail/(:num)', 'UnitController::detail/$1');

    $routes->get('update-status/(:num)', 'UnitController::updateStatus/$1');

});

// Admin
$routes->get('/admin', 'AdminController::index');

// Pimpinan
$routes->get('/pimpinan', 'PimpinanController::index');