<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ==============================
// Public Routes
// ==============================
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth\AuthController::index');
$routes->post('/login', 'Auth\AuthController::authenticate');

$routes->get('/login/mfa', 'Auth\AuthController::mfa');
$routes->post('/login/mfa/verify', 'Auth\AuthController::verifyMfa');

$routes->get('/register', 'Auth\RegisterController::index');
$routes->post('/register', 'Auth\RegisterController::store');

$routes->get('/register/fields/(:num)', 'Auth\RegisterController::fields/$1');

$routes->get('/register/mfa', 'Auth\RegisterController::mfaSetup');
$routes->post('/register/mfa/verify', 'Auth\RegisterController::verify');

$routes->get('/logout', 'Auth\AuthController::logout');

$routes->get('services', 'ServiceController::index');
$routes->get('layanan/akademik', 'ServiceController::akademik');
$routes->get('layanan/keuangan', 'ServiceController::keuangan');
$routes->get('layanan/upa', 'ServiceController::upa');
$routes->get('layanan/(:num)', 'ServiceController::detail/$1');
$routes->get('layanan/detail/(:num)', 'ServiceController::detail/$1');
$routes->get('layanan/kemahasiswaan', 'ServiceController::kemahasiswaan');
// ==============================
// Routes yang harus login
// ==============================
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('/dashboard', 'DashboardController::index');

    // Users
    $routes->get('/users', 'UserController::index');

    $routes->get('/users/create', 'UserController::create');
    $routes->post('/users/store', 'UserController::store');

    $routes->get('/users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('/users/update/(:num)', 'UserController::update/$1');

    $routes->get('/users/delete/(:num)', 'UserController::delete/$1');

    
});

// ==============================
// Routes khusus Admin (Role)
// ==============================
$routes->group('users', ['filter' => 'role'], function ($routes) {

    $routes->get('/', 'UserController::index');

    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');

    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');

    $routes->get('delete/(:num)', 'UserController::delete/$1');
});