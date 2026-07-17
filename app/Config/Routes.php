<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ==============================
// Public Routes
// ==============================
$routes->get('/', 'Home::index');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::storeRegister');

$routes->get('/logout', 'AuthController::logout');

$routes->get('services', 'ServiceController::index');
$routes->get('/akademik', 'ServiceController::akademik');
$routes->get('/keuangan', 'ServiceController::keuangan');
$routes->get('layanan/(:num)', 'ServiceController::detail/$1');
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