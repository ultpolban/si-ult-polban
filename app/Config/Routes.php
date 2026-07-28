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


// ==========================================
// TIKET MAHASISWA
// ==========================================

$routes->get(
    'mahasiswa/ticket/create',
    'MahasiswaTicketController::create'
);

$routes->post(
    'mahasiswa/ticket/store',
    'MahasiswaTicketController::store'
);

$routes->get(
    'mahasiswa/ticket/success',
    'MahasiswaTicketController::success'
);

$routes->get(
    'mahasiswa/ticket/draft-success',
    'MahasiswaTicketController::draftSuccess'
);

$routes->get(
    'mahasiswa/ticket/draft',
    'MahasiswaTicketController::draft'
);

$routes->get(
    'mahasiswa/ticket/draft/delete/(:num)',
    'MahasiswaTicketController::deleteDraft/$1'
);

$routes->get(
    'mahasiswa/ticket/draft/edit/(:num)',
    'MahasiswaTicketController::editDraft/$1'
);

$routes->post(
    'mahasiswa/ticket/draft/update/(:num)',
    'MahasiswaTicketController::updateDraft/$1'
);

$routes->get(
    'mahasiswa/ticket/history',
    'MahasiswaTicketController::history'
);

$routes->get(
    'mahasiswa/ticket/detail/(:num)',
    'MahasiswaTicketController::detail/$1'
);

$routes->post(
    'mahasiswa/ticket/reply/(:num)',
    'MahasiswaTicketController::reply/$1'
);


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

// Form Ajukan Layanan
$routes->get(
    'dosen/ticket/create',
    'DosenTicketController::create'
);

// Proses Ajukan Layanan / Simpan Draft
$routes->post(
    'dosen/ticket/store',
    'DosenTicketController::store'
);

// Halaman Success
$routes->get(
    'dosen/ticket/success',
    'DosenTicketController::success'
);

// Halaman Draft
$routes->get(
    'dosen/ticket/draft',
    'DosenTicketController::draft'
);

// Edit / Lanjutkan Draft
$routes->get(
    'dosen/ticket/draft/edit/(:num)',
    'DosenTicketController::editDraft/$1'
);

// Update Draft menjadi Pengajuan
$routes->post(
    'dosen/ticket/draft/update/(:num)',
    'DosenTicketController::updateDraft/$1'
);

// Tracking / History Tiket
$routes->get(
    'dosen/ticket/history',
    'DosenTicketController::history'
);

// Detail Tiket
$routes->get(
    'dosen/ticket/detail/(:num)',
    'DosenTicketController::detail/$1'
);

$routes->post(
    'dosen/ticket/reply/(:num)',
    'DosenTicketController::reply/$1'
);

$routes->get(
    'dosen/ticket/draft/delete/(:num)',
    'DosenTicketController::deleteDraft/$1'
);


// ================================
// NOTIFIKASI DOSEN
// ================================

$routes->get(
    'dosen/notification',
    'DosenNotificationController::index'
);


// ================================
// DASHBOARD TENDIK
// ================================

$routes->get(
    'dashboard-tendik',
    'TendikController::dashboard'
);

// ==========================================
// TIKET TENDIK
// ==========================================

$routes->get(
    'tendik/ticket/create',
    'TendikTicketController::create'
);

$routes->post(
    'tendik/ticket/store',
    'TendikTicketController::store'
);

$routes->get(
    'tendik/ticket/success',
    'TendikTicketController::success'
);

$routes->get(
    'tendik/ticket/history',
    'TendikTicketController::history'
);

$routes->get(
    'tendik/ticket/draft',
    'TendikTicketController::draft'
);

// edit dan hapus

$routes->get(
    'tendik/ticket/draft/edit/(:num)',
    'TendikTicketController::editDraft/$1'
);

$routes->post(
    'tendik/ticket/draft/update/(:num)',
    'TendikTicketController::updateDraft/$1'
);

$routes->get(
    'tendik/ticket/draft/delete/(:num)',
    'TendikTicketController::deleteDraft/$1'
);

$routes->get(
    'tendik/ticket/detail/(:any)',
    'TendikTicketController::detail/$1'
);

$routes->post(
    'tendik/ticket/reply/(:any)',
    'TendikTicketController::reply/$1'
);