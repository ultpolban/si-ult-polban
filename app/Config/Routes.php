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
// ==========================
// DATA TIKET
// ==========================

$routes->get('datatiket', 'DataTicket::index');
// ==============================
// ROUTE LOGIN (FILTER AUTH)
// ==============================

$routes->group('', ['filter' => 'auth'], function ($routes) {

    // ==========================
    // DASHBOARD
    // ==========================

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
// VERIFIKASI TIKET
// ==========================

$routes->get('verification', 'VerificationController::index');

// Detail tiket
$routes->get('verification/detail/(:num)', 'VerificationController::detail/$1');

// Halaman form verifikasi
$routes->get('verification/verify/(:num)', 'VerificationController::verify/$1');

// Simpan hasil verifikasi
$routes->post('verification/process/(:num)', 'VerificationController::process/$1');

// Komentar
$routes->post('verification/comment/(:num)', 'VerificationController::comment/$1');

// Revisi
$routes->get('verification/revision/(:num)', 'VerificationController::revision/$1');

// Tolak
$routes->get('verification/reject/(:num)', 'VerificationController::reject/$1');

    // ==========================
    // DISPOSISI
    // ==========================

    $routes->get('disposition', 'DispositionController::index');
    $routes->get('disposition/detail/(:num)', 'DispositionController::detail/$1');
    $routes->post('disposition/process/(:num)', 'DispositionController::process/$1');

    // ==========================
    // UNIT
    // ==========================

    $routes->get('unit', 'UnitController::index');
    $routes->get('unit/process/(:num)', 'UnitController::process/$1');
    $routes->get('unit/complete/(:num)', 'UnitController::complete/$1');

    // ==========================
    // LAPORAN TIKET
    // ==========================

    $routes->get('report', 'ReportController::index');
    $routes->get('report/csv', 'ReportController::csv');
    $routes->get('report/excel', 'ReportController::excel');
    $routes->get('report/pdf', 'ReportController::pdf');

    // ==========================
    // LAPORAN TAMU (CRUD)
    // ==========================

    $routes->get('guest-report', 'GuestReportController::index');
    $routes->get('guest-report/create', 'GuestReportController::create');
    $routes->post('guest-report/store', 'GuestReportController::store');
    $routes->get('guest-report/detail/(:num)', 'GuestReportController::detail/$1');
    $routes->get('guest-report/edit/(:num)', 'GuestReportController::edit/$1');
    $routes->post('guest-report/update/(:num)', 'GuestReportController::update/$1');
    $routes->get('guest-report/delete/(:num)', 'GuestReportController::delete/$1');

    // ==========================
    // PENGAJUAN ONLINE
    // ==========================

    $routes->get('online', 'OnlineController::index');
    $routes->get('online/create', 'OnlineController::create');
    $routes->post('online/store', 'OnlineController::store');
    $routes->get('online/success/(:any)', 'OnlineController::success/$1');
    $routes->get('online/history', 'OnlineController::history');
    $routes->get('online/detail/(:num)', 'OnlineController::detail/$1');
    $routes->get('online/edit/(:num)', 'OnlineController::edit/$1');
    $routes->post('online/update/(:num)', 'OnlineController::update/$1');
    $routes->get('online/delete/(:num)', 'OnlineController::delete/$1');

    // ==========================
    // STATISTIK
    // ==========================

    $routes->get('statistics', 'StatisticsController::index');
// ==========================
// TRACKING
// ==========================

$routes->get('tracking', 'TrackingController::index');

$routes->get('tracking/search', 'TrackingController::search');
$routes->post('tracking/search', 'TrackingController::search');

$routes->get('tracking/detail/(:segment)', 'TrackingController::detail/$1');
});

// ==============================
// KHUSUS ADMIN (FILTER ROLE)
// ==============================

$routes->group('admin-users', ['filter' => 'role'], function ($routes) {

    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');

});