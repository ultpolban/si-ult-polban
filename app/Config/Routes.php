<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==================================================
// HALAMAN UTAMA
// ==================================================
$routes->get('/', 'Home::index');


// ================================
// DASHBOARD PEMOHON
// ================================
$routes->get('dashboard', 'DashboardController::index');

// ==================================================
// TICKET / LAYANAN
// ==================================================
$routes->get('ticket/create', 'TicketController::create');

$routes->post('ticket/store', 'TicketController::store');

$routes->get('ticket/success', 'TicketController::success');

$routes->get('ticket/history', 'TicketController::history');

$routes->get('ticket/detail/(:num)', 'TicketController::detail/$1');


// ==================================================
// PROFILE
// ==================================================
$routes->get('profile', 'ProfileController::index');

$routes->get('profile/edit', 'ProfileController::edit');

$routes->post('profile/update', 'ProfileController::update');


// ==================================================
// NOTIFICATION
// ==================================================
$routes->get('notification', 'NotificationController::index');


// ==================================================
// HELP
// ==================================================
$routes->get('help', 'HelpController::index');


// ==================================================
// LOGOUT
// ==================================================
$routes->get('logout', 'AuthController::logout');


// =====================================================
// ROUTE DASHBOARD MAHASISWA
// =====================================================

$routes->get('dashboard-mahasiswa', 'MahasiswaController::dashboard');


// =====================================================
// ROUTE TIKET MAHASISWA
// =====================================================

$routes->get('mahasiswa/ticket/create', 'MahasiswaTicketController::create');

$routes->post('mahasiswa/ticket/store', 'MahasiswaTicketController::store');

$routes->get('mahasiswa/ticket/success', 'MahasiswaTicketController::success');

$routes->get('mahasiswa/ticket/history', 'MahasiswaTicketController::history');

$routes->get('mahasiswa/ticket/detail/(:num)', 'MahasiswaTicketController::detail/$1');


// =====================================================
// ROUTE PROFIL MAHASISWA
// =====================================================

$routes->get('mahasiswa/profile', 'MahasiswaProfileController::index');

$routes->get('mahasiswa/profile/edit', 'MahasiswaProfileController::edit');

$routes->post('mahasiswa/profile/update', 'MahasiswaProfileController::update');


// =====================================================
// ROUTE NOTIFIKASI MAHASISWA
// =====================================================

$routes->get('mahasiswa/notification', 'MahasiswaNotificationController::index');


// =====================================================
// ROUTE PUSAT BANTUAN MAHASISWA
// =====================================================

$routes->get('mahasiswa/help', 'MahasiswaHelpController::index');


// ================================
// DASHBOARD DOSEN
// ================================

$routes->get('dosen/dashboard', 'DosenController::dashboard');


// ================================
// PROFIL DOSEN
// ================================

$routes->get(
    'dosen/profile',
    'DosenProfileController::index'
);

$routes->get(
    'dosen/profile/edit',
    'DosenProfileController::edit'
);

$routes->post(
    'dosen/profile/update',
    'DosenProfileController::update'
);


// ================================
// TIKET DOSEN
// ================================

$routes->get(
    'dosen/ticket/create',
    'DosenTicketController::create'
);

$routes->post(
    'dosen/ticket/store',
    'DosenTicketController::store'
);

$routes->get(
    'dosen/ticket/history',
    'DosenTicketController::history'
);

$routes->get(
    'dosen/ticket/detail/(:num)',
    'DosenTicketController::detail/$1'
);


// ================================
// NOTIFIKASI DOSEN
// ================================

$routes->get(
    'dosen/notification',
    'DosenNotificationController::index'
);