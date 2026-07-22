<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==============================
// HALAMAN AWAL
// ==============================

$routes->get('/', 'Home::index');

// ==============================
// AUTH
// ==============================

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');

$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::storeRegister');

$routes->get('logout', 'AuthController::logout');

// ==============================
// ROUTE LOGIN
// ==============================

$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'DashboardController::index');

    // ==========================
    // USER
    // ==========================

    $routes->get('users', 'UserController::index');
    $routes->get('users/create', 'UserController::create');
    $routes->post('users/store', 'UserController::store');
    $routes->get('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/update/(:num)', 'UserController::update/$1');
    $routes->get('users/delete/(:num)', 'UserController::delete/$1');

    // ==========================
    // VERIFIKASI
    // ==========================

    $routes->get('verification', 'VerificationController::index');
    $routes->get('verification/detail/(:num)', 'VerificationController::detail/$1');
    $routes->post('verification/process/(:num)', 'VerificationController::process/$1');
    $routes->post('verification/comment/(:num)', 'VerificationController::comment/$1');

    // ==========================
    // UNIT
    // ==========================

    $routes->get('unit', 'UnitController::index');
    $routes->get('unit/process/(:num)', 'UnitController::process/$1');
    $routes->get('unit/complete/(:num)', 'UnitController::complete/$1');

    // ==========================
    // LAPORAN
    // ==========================

    $routes->get('report', 'ReportController::index');
    $routes->get('report/print', 'ReportController::print');

    // ==========================
    // STATISTIK
    // ==========================

    $routes->get('statistics', 'StatisticsController::index');

    // ==========================
    // LAPORAN TAMU
    // ==========================

    $routes->get('guest-report', 'GuestReportController::index');
    $routes->post('guest-report/store', 'GuestReportController::store');

    // ==========================
    // TRACKING TIKET
    // ==========================

    $routes->get('tracking', 'TrackingController::index');
    $routes->post('tracking/search', 'TrackingController::search');

});

// ==============================
// KHUSUS ADMIN
// ==============================

$routes->group('users', ['filter' => 'role'], function ($routes) {

    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');

});