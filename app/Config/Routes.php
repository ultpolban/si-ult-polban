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
    'OrangtuaController::dashboard'
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
    'orangtua/ticket/jenis-layanan',
    'OrangTuaTicketController::jenisLayanan'
);

$routes->get(
    'orangtua/ticket/persyaratan',
    'OrangTuaTicketController::persyaratan'
);

$routes->get(
    'orangtua/ticket/detail/(:any)',
    'OrangTuaTicketController::detail/$1'
);

// =====================================================
// TICKET DRAFT ORANGTUA
// =====================================================

$routes->post(
    'orangtua/ticket/save-draft',
    'OrangTuaTicketController::saveDraft'
);

$routes->get(
    'orangtua/ticket/draft',
    'OrangTuaTicketController::draft'
);

$routes->get(
    'orangtua/ticket/draft/edit/(:num)',
    'OrangTuaTicketController::editDraft/$1'
);

$routes->post(
    'orangtua/ticket/draft/update/(:num)',
    'OrangTuaTicketController::updateDraft/$1'
);

$routes->get(
    'orangtua/ticket/draft/delete/(:num)',
    'OrangTuaTicketController::deleteDraft/$1'
);

$routes->get(
    'orangtua/ticket/draft/success',
    'OrangTuaTicketController::draftSuccess'
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

// =====================================
// NOTIFIKASI ORANG TUA
// =====================================

$routes->get(
    'orangtua/notification',
    'OrangTuaNotificationController::index'
);

$routes->get(
    'orangtua/notification/read/(:num)',
    'OrangTuaNotificationController::read/$1'
);

$routes->get(
    'orangtua/notification/read-all',
    'OrangTuaNotificationController::readAll'
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

$routes->get('dashboard-dosen', 'DosenController::dashboard');

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

$routes->post(
    'dosen/ticket/save-draft',
    'DosenTicketController::saveDraft'
);

$routes->get(
    'dosen/ticket/jenis-layanan',
    'DosenTicketController::jenisLayanan'
);

$routes->get(
    'dosen/ticket/persyaratan',
    'DosenTicketController::persyaratan'
);

// Halaman Success
$routes->get(
    'dosen/ticket/success',
    'DosenTicketController::success'
);

// Halaman Draft Success
$routes->get(
    'dosen/ticket/draft-success',
    'DosenTicketController::draftSuccess'
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

// ================================
// TIKET DOSEN DRAFT
// ================================

$routes->get(
    'dosen/ticket/draft',
    'DosenTicketController::draft'
);

$routes->get(
    'dosen/ticket/draft/edit/(:num)',
    'DosenTicketController::editDraft/$1'
);

$routes->post(
    'dosen/ticket/draft/update/(:num)',
    'DosenTicketController::updateDraft/$1'
);

$routes->get(
    'dosen/ticket/draft/delete/(:num)',
    'DosenTicketController::deleteDraft/$1'
);

// =====================================================
// ROUTE NOTIFIKASI DOSEN
// =====================================================

$routes->get(
    'dosen/notification',
    'DosenNotificationController::index'
);

$routes->get(
    'dosen/notification/read/(:num)',
    'DosenNotificationController::read/$1'
);

$routes->get(
    'dosen/notification/read-all',
    'DosenNotificationController::readAll'
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

$routes->post(
    'tendik/ticket/save-draft',
    'TendikTicketController::saveDraft'
);

$routes->get(
    'tendik/ticket/jenis-layanan',
    'TendikTicketController::jenisLayanan'
);

$routes->get(
    'tendik/ticket/persyaratan',
    'TendikTicketController::persyaratan'
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

// ==========================================
// DASHBOARD ALUMNI
// ==========================================
$routes->get(
    'dashboard-alumni',
    'AlumniController::dashboard'
);

// ==========================================
// TICKET ALUMNI
// ==========================================
$routes->get(
    'alumni/ticket/create',
    'AlumniTicketController::create'
);

$routes->post(
    'alumni/ticket/store',
    'AlumniTicketController::store'
);

$routes->get(
    'alumni/ticket/success',
    'AlumniTicketController::success'
);

$routes->get(
    'alumni/ticket/history',
    'AlumniTicketController::history'
);

$routes->get(
    'alumni/ticket/detail/(:any)',
    'AlumniTicketController::detail/$1'
);

$routes->get(
    'alumni/ticket/jenis-layanan',
    'AlumniTicketController::jenisLayanan'
);

$routes->get(
    'alumni/ticket/persyaratan',
    'AlumniTicketController::persyaratan'
);

$routes->post(
    'alumni/ticket/save-draft',
    'AlumniTicketController::saveDraft'
);

$routes->get(
    'alumni/ticket/draft',
    'AlumniTicketController::draft'
);

$routes->get(
    'alumni/ticket/edit-draft/(:num)',
    'AlumniTicketController::editDraft/$1'
);

$routes->post(
    'alumni/ticket/update-draft/(:num)',
    'AlumniTicketController::updateDraft/$1'
);

$routes->get(
    'alumni/ticket/delete-draft/(:num)',
    'AlumniTicketController::deleteDraft/$1'
);

// ==========================================
// PROFILE ALUMNI
// ==========================================

$routes->get(
    'alumni/profile',
    'AlumniProfileController::index'
);

$routes->get(
    'alumni/profile/edit',
    'AlumniProfileController::edit'
);

$routes->post(
    'alumni/profile/update',
    'AlumniProfileController::update'
);

// ==========================================
// NOTIFICATION ALUMNI
// ==========================================

$routes->get(
    'alumni/notification',
    'AlumniNotificationController::index'
);

$routes->get(
    'alumni/notification/read/(:num)',
    'AlumniNotificationController::read/$1'
);

$routes->get(
    'alumni/notification/read-all',
    'AlumniNotificationController::readAll'
);

// ==========================================
// DASHBOARD MITRA
// ==========================================

$routes->get(
    'mitra/dashboard',
    'MitraController::dashboard'
);

/// =====================================================
// ROUTE MITRA - TICKET
// =====================================================

$routes->get(
    'mitra/ticket/create',
    'MitraTicketController::create'
);

$routes->post(
    'mitra/ticket/save-draft',
    'MitraTicketController::saveDraft'
);

$routes->get(
    'mitra/ticket/jenis-layanan',
    'MitraTicketController::jenisLayanan'
);

$routes->get(
    'mitra/ticket/persyaratan',
    'MitraTicketController::persyaratan'
);

$routes->post(
    'mitra/ticket/store',
    'MitraTicketController::store'
);

$routes->get(
    'mitra/ticket/layanan',
    'MitraTicketController::layanan'
);

$routes->get(
    'mitra/ticket/draft',
    'MitraTicketController::draft'
);

$routes->get(
    'mitra/ticket/edit-draft/(:num)',
    'MitraTicketController::editDraft/$1'
);

$routes->post(
    'mitra/ticket/update-draft/(:num)',
    'MitraTicketController::updateDraft/$1'
);

$routes->get(
    'mitra/ticket/delete-draft/(:num)',
    'MitraTicketController::deleteDraft/$1'
);

$routes->get(
    'mitra/ticket/draft-success',
    'MitraTicketController::draftSuccess'
);

$routes->get(
    'mitra/ticket/success',
    'MitraTicketController::success'
);

$routes->get(
    'mitra/ticket/history',
    'MitraTicketController::history'
);

$routes->get(
    'mitra/ticket/detail/(:num)',
    'MitraTicketController::detail/$1'
);

$routes->get(
    'mitra/ticket/reply/(:num)',
    'MitraTicketController::reply/$1'
);

// ===============================
// MITRA PROFILE
// ===============================
$routes->get('mitra/profile', 'MitraProfileController::index');
$routes->get('mitra/profile/edit', 'MitraProfileController::edit');
$routes->post('mitra/profile/update', 'MitraProfileController::update');

// ===============================
// MITRA NOTIFICATION
// ===============================
$routes->get(
    'mitra/notification',
    'MitraNotificationController::index'
);

$routes->get(
    'mitra/notification/read/(:num)',
    'MitraNotificationController::read/$1'
);

$routes->get(
    'mitra/notification/read-all',
    'MitraNotificationController::readAll'
);

// ===============================
// DASHBOARD UMUM
// ===============================
$routes->get('umum/dashboard', 'UmumController::index');

/// =====================================================
// ROUTE UMUM - TICKET
// =====================================================

$routes->get(
    'umum/ticket/create',
    'UmumTicketController::create'
);

$routes->get(
    'umum/ticket/jenis-layanan',
    'UmumTicketController::jenisLayanan'
);

$routes->get(
    'umum/ticket/persyaratan',
    'UmumTicketController::persyaratan'
);

$routes->post(
    'umum/ticket/store',
    'UmumTicketController::store'
);

$routes->get(
    'umum/ticket/layanan',
    'UmumTicketController::layanan'
);

$routes->get(
    'umum/ticket/draft',
    'UmumTicketController::draft'
);

$routes->post(
    'umum/ticket/save-draft',
    'UmumTicketController::saveDraft'
);

$routes->get(
    'umum/ticket/edit-draft/(:num)',
    'UmumTicketController::editDraft/$1'
);

$routes->post(
    'umum/ticket/update-draft/(:num)',
    'UmumTicketController::updateDraft/$1'
);

$routes->get(
    'umum/ticket/delete-draft/(:num)',
    'UmumTicketController::deleteDraft/$1'
);

$routes->get(
    'umum/ticket/draft-success',
    'UmumTicketController::draftSuccess'
);

$routes->get(
    'umum/ticket/success',
    'UmumTicketController::success'
);

$routes->get(
    'umum/ticket/history',
    'UmumTicketController::history'
);

$routes->get(
    'umum/ticket/detail/(:num)',
    'UmumTicketController::detail/$1'
);

$routes->get(
    'umum/ticket/reply/(:num)',
    'UmumTicketController::reply/$1'
);

// =====================================================
// ROUTE UMUM - PROFILE
// =====================================================

$routes->get(
    'umum/profile',
    'UmumProfileController::index'
);

$routes->get(
    'umum/profile/edit',
    'UmumProfileController::edit'
);

$routes->post(
    'umum/profile/update',
    'UmumProfileController::update'
);


// =====================================================
// ROUTE UMUM - NOTIFICATION
// =====================================================

$routes->get(
    'umum/notification',
    'UmumNotificationController::index'
);

$routes->get(
    'umum/notification/read/(:num)',
    'UmumNotificationController::read/$1'
);

$routes->get(
    'umum/notification/read-all',
    'UmumNotificationController::readAll'
);
