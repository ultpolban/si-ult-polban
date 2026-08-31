<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==================================================
// HALAMAN UTAMA
// ==================================================
$routes->get('/', 'Home::index');

// ==========================================
// AUTH
// ==========================================

$routes->get('login', 'Auth\AuthController::index');
$routes->post('login', 'Auth\AuthController::authenticate');

// MFA Login
$routes->get('login/mfa', 'Auth\AuthController::mfa');
$routes->post('login/mfa/verify', 'Auth\AuthController::verifyMfa');

$routes->get('register', 'Auth\RegisterController::index');
$routes->post('register', 'Auth\RegisterController::store');

// MFA Register
$routes->get('register/mfa', 'Auth\RegisterController::mfaSetup');
$routes->post('register/mfa/verify', 'Auth\RegisterController::verify');

$routes->get('register/fields/(:num)', 'Auth\RegisterController::fields/$1');

$routes->get('logout', 'Auth\AuthController::logout');

$routes->get(
    'reset-password-mhs',
    'ResetPasswordController::reset'
);

/*
|--------------------------------------------------------------------------
| DASHBOARD ORANG TUA
|--------------------------------------------------------------------------
*/

$routes->get(
    'dashboard-orangtua',
    'OrangTuaDashboardController::index'
);

$routes->get(
    'orangtua/ticket/create',
    'OrangTuaTicketController::create'
);

$routes->post(
    'orangtua/ticket/store',
    'OrangTuaTicketController::store'
);

$routes->get(
    'orangtua/ticket/history',
    'OrangTuaTicketController::history'
);

$routes->get(
    'orangtua/ticket/success',
    'OrangTuaTicketController::success'
);

$routes->get(
    'orangtua/ticket/detail/(:any)',
    'OrangTuaTicketController::detail/$1'
);

$routes->get(
    'orangtua/ticket/draft',
    'OrangTuaTicketController::draft'
);
// =========================
// PROFILE ORANG TUA
// =========================

$routes->get(
    'orangtua/profile',
    'OrangTuaProfileController::index'
);

$routes->get(
    'orangtua/profile/edit',
    'OrangTuaProfileController::edit'
);

$routes->post(
    'orangtua/profile/update',
    'OrangTuaProfileController::update'
);


// =========================
// DRAFT ORANG TUA
// =========================

$routes->get(
    'orangtua/draft',
    'OrangTuaDraftController::index'
);

$routes->get(
    'orangtua/draft/edit/(:num)',
    'OrangTuaDraftController::edit/$1'
);

$routes->get(
    'orangtua/draft/delete/(:num)',
    'OrangTuaDraftController::delete/$1'
);
// =====================================
// NOTIFIKASI ORANG TUA
// =====================================

$routes->get(
    'orangtua/notification',
    'OrangTuaNotificationController::index'
);

// =====================================
// PUSAT BANTUAN ORANG TUA
// =====================================

$routes->get(
    'orangtua/help',
    'OrangTuaHelpController::index'
);

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
    'mahasiswa/ticket/delete-draft/(:num)',
    'MahasiswaTicketController::deleteDraft/$1'
);

$routes->get(
    'mahasiswa/ticket/edit-draft/(:num)',
    'MahasiswaTicketController::editDraft/$1'
);

$routes->post(
    'mahasiswa/ticket/update-draft/(:num)',
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

$routes->get(
    'mahasiswa/ticket/jenis-layanan',
    'MahasiswaTicketController::jenisLayanan'
);

$routes->get(
    'mahasiswa/ticket/persyaratan',
    'MahasiswaTicketController::persyaratan'
);

$routes->post(
    'mahasiswa/ticket/save-draft',
    'MahasiswaTicketController::saveDraft'
);

// =====================================================
// ROUTE PROFILE MAHASISWA
// =====================================================

// Menampilkan profil mahasiswa
$routes->get(
    'mahasiswa/profile',
    'MahasiswaProfileController::index'
);

// Halaman edit profil mahasiswa
$routes->get(
    'mahasiswa/profile/edit',
    'MahasiswaProfileController::edit'
);

// Proses menyimpan perubahan profil mahasiswa
$routes->post(
    'mahasiswa/profile/update',
    'MahasiswaProfileController::update'
);


// =====================================================
// ROUTE NOTIFIKASI MAHASISWA
// =====================================================

$routes->get(
    'mahasiswa/notification',
    'MahasiswaNotificationController::index'
);

$routes->get(
    'mahasiswa/notification/read/(:num)',
    'MahasiswaNotificationController::read/$1'
);

$routes->get(
    'mahasiswa/notification/read-all',
    'MahasiswaNotificationController::readAll'
);
// =====================================================
// ROUTE PUSAT BANTUAN MAHASISWA
// =====================================================

$routes->get('mahasiswa/help', 'MahasiswaHelpController::index');


// ================================
// DASHBOARD DOSEN
// ================================

$routes->get('dosen/dashboard', 'DosenController::dashboard');


// =============================
// PROFILE DOSEN
// =============================
$routes->group('dosen/profile', function ($routes) {

    $routes->get('/', 'DosenProfileController::index');

    $routes->get('edit', 'DosenProfileController::edit');

    $routes->post('update', 'DosenProfileController::update');
});

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

// NOTIFIKASII//===============

$routes->get(
    'tendik/notification',
    'TendikNotificationController::index'
);

$routes->get(
    'tendik/notification/read-all',
    'TendikNotificationController::markAllRead'
);

// ==========================================
// PROFILE TENDIK
// ==========================================

$routes->get(
    'tendik/profile',
    'TendikProfileController::index'
);

$routes->get(
    'tendik/profile/edit',
    'TendikProfileController::edit'
);

$routes->post(
    'tendik/profile/update',
    'TendikProfileController::update'
);
