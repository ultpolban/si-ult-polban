<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ============================================================
// HALAMAN AWAL
// ============================================================
$routes->get('/', 'Home::index');


// ============================================================
// AUTHENTICATION
// ============================================================

// Mengakses /login selalu diarahkan ke Landing Page (Beranda) dulu.
// Form login-nya ada di /login/form.
$routes->get('login', 'Auth\AuthController::index');
$routes->post('login', 'Auth\AuthController::authenticate');

$routes->get('login/form', 'Auth\AuthController::showLoginForm');
$routes->get('login/masuk', 'Auth\AuthController::showLoginForm');

$routes->get('login/mfa', 'Auth\AuthController::mfa');
$routes->post('login/mfa/verify', 'Auth\AuthController::verifyMfa');


// ============================================================
// REGISTER
// ------------------------------------------------------------
// Alur resmi (satu-satunya):
//   1. /registration-request        -> pemohon mengirim permintaan izin
//   2. Admin menyetujui              -> user dibuat (is_active = 0)
//   3. /register (gate)             -> pemohon verifikasi email
//   4. /register/mfa                -> QR + recovery codes
//   5. /register/mfa/verify         -> akun aktif -> bisa login
//
// Pendaftaran langsung (register/daftar) DITUTUP karena
// melewati persetujuan admin dan membuka celah penyalahgunaan
// akun. Method daftar()/store() di RegisterController menjadi
// tidak dapat dipanggil lewat route.
// ============================================================

// Halaman registrasi = gerbang verifikasi izin
$routes->get('register', 'Auth\RegisterController::index');

// Verifikasi izin registrasi (email yang sudah disetujui admin)
$routes->get('register/gate', 'Auth\RegisterController::index');
$routes->post('register/gate', 'Auth\RegisterController::gate');
$routes->post('register', 'Auth\RegisterController::gate');

$routes->get('register/mfa', 'Auth\RegisterController::mfaSetup');
$routes->post('register/mfa/verify', 'Auth\RegisterController::verify');

$routes->get(
    'register/fields/(:num)',
    'Auth\RegisterController::fields/$1'
);

$routes->get('registration-request', 'Auth\RegistrationRequestController::index');
$routes->post('registration-request', 'Auth\RegistrationRequestController::store');
$routes->get('registration-request/fields/(:num)', 'Auth\RegistrationRequestController::fields/$1');
$routes->get('registration-request/status', 'Auth\RegistrationRequestController::status');

// Catatan: 'register/daftar' sengaja TIDAK didaftarkan.
// Forms di /register/daftar kini juga memvalidasi persetujuan izin
// (lihat RegisterController::daftar / store).
$routes->get('logout', 'Auth\AuthController::logout');


// ============================================================
// ROUTE DENGAN FILTER AUTH
// ============================================================
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // ========================================================
    // DASHBOARD & PROFIL
    // ========================================================

    $routes->get(
        'dashboard',
        'DashboardController::index'
    );

    // AJAX statistik dashboard
    $routes->get(
        'dashboard/api/statistik-data',
        'DashboardController::statistikData'
    );

    $routes->get(
        'profile',
        'ProfileController::index'
    );

    $routes->get(
        'profile/edit',
        'ProfileController::edit'
    );

    $routes->post(
        'profile/update',
        'ProfileController::update'
    );


    // ========================================================
    // DATA TIKET
    // ========================================================

    $routes->get(
        'datatiket',
        'DataTicketController::index'
    );

    $routes->get(
        'datatiket/detail/(:num)',
        'DataTicketController::detail/$1'
    );

    $routes->get(
        'datatiket/export/pdf',
        'DataTicketController::exportPdf'
    );

    $routes->get(
        'datatiket/export/excel',
        'DataTicketController::exportExcel'
    );

    $routes->get(
        'datatiket/export/csv',
        'DataTicketController::exportCsv'
    );


    // ========================================================
    // VERIFIKASI TIKET
    // ========================================================

    $routes->group('verification', function ($routes) {

        $routes->get(
            '/',
            'VerificationController::index'
        );

        $routes->get(
            'detail/(:num)',
            'VerificationController::detail/$1'
        );

        $routes->get(
            'verify/(:num)',
            'VerificationController::verify/$1'
        );

        $routes->post(
            'process/(:num)',
            'VerificationController::process/$1'
        );

        // Hasil verifikasi: revisi & penolakan (dikirim dari form verifikasi)
        $routes->post(
            'revision/(:num)',
            'VerificationController::revision/$1'
        );

        $routes->post(
            'reject/(:num)',
            'VerificationController::reject/$1'
        );
    });


    // ========================================================
    // DISPOSISI TIKET
    // ========================================================

    $routes->group('disposition', function ($routes) {

        $routes->get(
            '/',
            'DispositionController::index'
        );

        $routes->get(
            'create/(:num)',
            'DispositionController::create/$1'
        );

        $routes->get(
            'detail/(:num)',
            'DispositionController::detail/$1'
        );

        $routes->post(
            'process/(:num)',
            'DispositionController::process/$1'
        );
    });


    // ========================================================
    // UNIT LAYANAN
    // ========================================================

    $routes->get(
        'unit',
        'UnitController::index'
    );

    $routes->get(
        'unit/process/(:num)',
        'UnitController::process/$1'
    );

    $routes->get(
        'unit/complete/(:num)',
        'UnitController::complete/$1'
    );

    // Alias "Data Tiket Unit" (dipakai menu sidebar unit)
    $routes->get(
        'unit/tiket',
        'UnitController::tiket'
    );

    // Export Data Tiket Unit (CSV / Excel / PDF)
    $routes->get(
        'unit/tiket/export/csv',
        'UnitController::exportCsv'
    );

    $routes->get(
        'unit/tiket/export/excel',
        'UnitController::exportExcel'
    );

    $routes->get(
        'unit/tiket/export/pdf',
        'UnitController::exportPdf'
    );

    $routes->get(
        'unit/dashboard',
        'UnitController::dashboard'
    );

    // Laporan / rekap tiket unit
    $routes->get(
        'unit/laporan',
        'UnitController::laporan'
    );

    // Log aktivitas unit (dipakai menu sidebar unit)
    $routes->get(
        'unit/log-aktivitas',
        'UnitController::logAktivitas'
    );

    // Update status tiket unit
    $routes->get(
        'unit/update-status/(:num)',
        'UnitController::updateStatusForm/$1'
    );

    $routes->post(
        'unit/update-status/(:num)',
        'UnitController::updateStatus/$1'
    );

    $routes->get(
        'unit/detail/(:num)',
        'UnitController::detail/$1'
    );


    // ========================================================
    // USER MANAGEMENT
    // ========================================================

    $routes->get(
        'users',
        'UserController::index'
    );

    $routes->get(
        'users/create',
        'UserController::create'
    );

    $routes->post(
        'users/store',
        'UserController::store'
    );

    $routes->get(
        'users/edit/(:num)',
        'UserController::edit/$1'
    );

    $routes->post(
        'users/update/(:num)',
        'UserController::update/$1'
    );

    $routes->get(
        'users/delete/(:num)',
        'UserController::delete/$1'
    );


    // ========================================================
    // LAPORAN TIKET
    // ========================================================

    $routes->get(
        'report',
        'ReportController::index'
    );

    $routes->get(
        'report/csv',
        'ReportController::csv'
    );

    $routes->get(
        'report/excel',
        'ReportController::excel'
    );

    $routes->get(
        'report/pdf',
        'ReportController::pdf'
    );


    // ========================================================
    // LAPORAN TAMU / WALK IN
    // ========================================================

    $routes->get(
        'guest-report',
        'GuestReportController::index'
    );

    $routes->get(
        'guest-report/create',
        'GuestReportController::create'
    );

    $routes->post(
        'guest-report/store',
        'GuestReportController::store'
    );

    $routes->get(
        'guest-report/detail/(:num)',
        'GuestReportController::detail/$1'
    );

    $routes->get(
        'guest-report/edit/(:num)',
        'GuestReportController::edit/$1'
    );

    $routes->post(
        'guest-report/update/(:num)',
        'GuestReportController::update/$1'
    );

    $routes->get(
        'guest-report/delete/(:num)',
        'GuestReportController::delete/$1'
    );

    $routes->get(
        'guest-report/services-by-unit/(:num)',
        'GuestReportController::servicesByUnit/$1'
    );

    $routes->get(
        'guest-report/requirements/(:num)',
        'GuestReportController::requirements/$1'
    );


    // ========================================================
    // PENGAJUAN ONLINE
    // ----------------------------------------------------------------
    // Catatan: modul "online" (OnlineController) sudah TIDAK dipakai.
    // Controller tersebut memakai kolom `tickets.attachment` yang tidak
    // ada di database dan view-nya (`online/*`) juga tidak pernah ada,
    // sehingga setiap request menghasilkan error 500.
    //
    // Fitur yang setara & sudah berjalan:
    //   - Pengajuan pemohon      : service-requests
    //   - Pengajuan tamu / walk-in: guest-report
    // ========================================================


    // ========================================================
    // STATISTIK & TRACKING
    // ========================================================

    $routes->get(
        'statistics',
        'StatisticsController::index'
    );

    $routes->get(
    'statistics/api/statistik-data',
    'StatisticsController::statistikData'
);

    $routes->get(
        'tracking',
        'TrackingController::index'
    );

    $routes->get(
        'tracking/search',
        'TrackingController::search'
    );

    $routes->post(
        'tracking/search',
        'TrackingController::search'
    );

    $routes->get(
        'tracking/detail/(:segment)',
        'TrackingController::detail/$1'
    );

    $routes->get(
        'tracking/dummy/(:segment)/(:segment)',
        'TrackingController::dummy/$1/$2'
    );


    // ========================================================
    // LOG AKTIVITAS
    // ========================================================

    $routes->get(
        'log-aktivitas',
        'LogAktivitasController::index'
    );
});


    /**
     * Rute tambahan hasil integrasi branch backend1, backend2,
     * frontend1, frontend2, frontend3, dan frontend4 ke main.
     *
     * Dihasilkan dari tabel rute ter-resolve setiap branch, sudah
     * di-deduplikasi dan dibebaskan dari konflik (rute milik main
     * diprioritaskan bila path-nya sama).
     *
     * Filter global (ratelimit, securityheaders) tidak diulang di sini
     * karena sudah ditangani Config\Filters::$globals.
     */
    
    
    // ============================================================
    // activity-logs
    // ============================================================
    $routes->get('activity-logs', 'ActivityLogController::index', ['filter' => ['auth', 'permission:activity_log.view']]);
    $routes->get('activity-logs/show/([0-9]+)', 'ActivityLogController::show/$1', ['filter' => ['auth', 'permission:activity_log.view']]);
    
    // ============================================================
    // administrasi-umum
    // ============================================================
    $routes->get('administrasi-umum', 'AdministrasiUmum::dashboard', ['filter' => 'auth']);
    $routes->get('administrasi-umum/dashboard', 'AdministrasiUmum::dashboard', ['filter' => 'auth']);
    $routes->get('administrasi-umum/data-tiket', 'AdministrasiUmum::dataTiket', ['filter' => 'auth']);
    $routes->get('administrasi-umum/detail/([0-9]+)', 'AdministrasiUmum::detail/$1', ['filter' => 'auth']);
    $routes->get('administrasi-umum/download/([^/]+)', 'AdministrasiUmum::downloadFile/$1', ['filter' => 'auth']);
    $routes->get('administrasi-umum/kirim/([0-9]+)', 'AdministrasiUmum::kirim/$1', ['filter' => 'auth']);
    $routes->get('administrasi-umum/kirim-pemohon/([0-9]+)', 'AdministrasiUmum::kirimPemohon/$1', ['filter' => 'auth']);
    $routes->get('administrasi-umum/lihat/([^/]+)', 'AdministrasiUmum::lihatFile/$1', ['filter' => 'auth']);
    $routes->get('administrasi-umum/log-aktivitas', 'AdministrasiUmum::logAktivitas', ['filter' => 'auth']);
    $routes->get('administrasi-umum/profile', 'AdministrasiUmum::profile', ['filter' => 'auth']);
    $routes->post('administrasi-umum/profile/update', 'AdministrasiUmum::updateProfile', ['filter' => 'auth']);
    $routes->get('administrasi-umum/proses/([0-9]+)', 'AdministrasiUmum::proses/$1', ['filter' => 'auth']);
    $routes->post('administrasi-umum/proses/update/([0-9]+)', 'AdministrasiUmum::updateProses/$1', ['filter' => 'auth']);
    $routes->get('administrasi-umum/statistik', 'AdministrasiUmum::statistik', ['filter' => 'auth']);
    $routes->get('administrasi-umum/upload/([0-9]+)', 'AdministrasiUmum::upload/$1', ['filter' => 'auth']);
    $routes->post('administrasi-umum/upload/([0-9]+)', 'AdministrasiUmum::simpanUpload/$1', ['filter' => 'auth']);
    
    // ============================================================
    // akademik
    // ============================================================
    $routes->get('akademik', 'Akademik::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/dashboard', 'Akademik::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/data-tiket', 'Akademik::dataTiket', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/detail/([0-9]+)', 'Akademik::detail/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/download/([^/]+)', 'Akademik::download/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/hapus-dokumen/([0-9]+)', 'Akademik::hapusDokumen/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/kirim/([0-9]+)', 'Akademik::kirim/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/kirim-pemohon/([0-9]+)', 'Akademik::kirimKePemohon/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/lihat/([^/]+)', 'Akademik::lihat/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/log-aktivitas', 'Akademik::logAktivitas', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/log-aktivitas/download/([0-9]+)', 'Akademik::downloadLog/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/log-aktivitas/lihat/([0-9]+)', 'Akademik::lihatLog/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/profile', 'Akademik::profile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->post('akademik/profile/update', 'Akademik::updateProfile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/proses/([0-9]+)', 'Akademik::proses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/riwayat', 'Akademik::riwayat', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->post('akademik/simpanUpload/([0-9]+)', 'Akademik::simpanUpload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/statistik', 'Akademik::statistik', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->post('akademik/updateProses/([0-9]+)', 'Akademik::updateProses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    $routes->get('akademik/upload/([0-9]+)', 'Akademik::upload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK']]);
    
    // ============================================================
    // alumni
    // ============================================================
    $routes->get('alumni/notification', 'AlumniNotificationController::index', ['filter' => 'auth']);
    $routes->get('alumni/notification/read/([0-9]+)', 'AlumniNotificationController::read/$1', ['filter' => 'auth']);
    $routes->get('alumni/notification/read-all', 'AlumniNotificationController::readAll', ['filter' => 'auth']);
    $routes->get('alumni/profile', 'AlumniProfileController::index', ['filter' => 'auth']);
    $routes->get('alumni/profile/edit', 'AlumniProfileController::edit', ['filter' => 'auth']);
    $routes->post('alumni/profile/update', 'AlumniProfileController::update', ['filter' => 'auth']);
    $routes->get('alumni/ticket/create', 'AlumniTicketController::create', ['filter' => 'auth']);
    $routes->get('alumni/ticket/delete-draft/([0-9]+)', 'AlumniTicketController::deleteDraft/$1', ['filter' => 'auth']);
    $routes->get('alumni/ticket/detail/(.*)', 'AlumniTicketController::detail/$1', ['filter' => 'auth']);
    $routes->get('alumni/ticket/draft', 'AlumniTicketController::draft', ['filter' => 'auth']);
    $routes->get('alumni/ticket/edit-draft/([0-9]+)', 'AlumniTicketController::editDraft/$1', ['filter' => 'auth']);
    $routes->get('alumni/ticket/history', 'AlumniTicketController::history', ['filter' => 'auth']);
    $routes->get('alumni/ticket/jenis-layanan', 'AlumniTicketController::jenisLayanan', ['filter' => 'auth']);
    $routes->get('alumni/ticket/persyaratan', 'AlumniTicketController::persyaratan', ['filter' => 'auth']);
    $routes->post('alumni/ticket/save-draft', 'AlumniTicketController::saveDraft', ['filter' => 'auth']);
    $routes->post('alumni/ticket/store', 'AlumniTicketController::store', ['filter' => 'auth']);
    $routes->get('alumni/ticket/success', 'AlumniTicketController::success', ['filter' => 'auth']);
    $routes->post('alumni/ticket/update-draft/([0-9]+)', 'AlumniTicketController::updateDraft/$1', ['filter' => 'auth']);
    
    // ============================================================
    // dashboard
    // ============================================================
    $routes->get('dashboard/detail', 'Dashboard::detail', ['filter' => 'auth']);
    $routes->get('dashboard/layanan', 'Dashboard::layanan', ['filter' => 'auth']);
    $routes->get('dashboard/profile', 'Dashboard::profile', ['filter' => 'auth']);
    $routes->get('dashboard/tiket', 'Dashboard::tiket', ['filter' => 'auth']);
    
    // ============================================================
    // dashboard-alumni
    // ============================================================
    $routes->get('dashboard-alumni', 'AlumniController::dashboard', ['filter' => 'auth']);
    
    // ============================================================
    // dashboard-dosen
    // ============================================================
    $routes->get('dashboard-dosen', 'DosenController::dashboard', ['filter' => 'auth']);
    
    // ============================================================
    // dashboard-mahasiswa
    // ============================================================
    $routes->get('dashboard-mahasiswa', 'MahasiswaController::dashboard', ['filter' => 'auth']);
    
    // ============================================================
    // dashboard-orangtua
    // ============================================================
    $routes->get('dashboard-orangtua', 'OrangtuaController::dashboard', ['filter' => 'auth']);
    
    // ============================================================
    // dashboard-tendik
    // ============================================================
    $routes->get('dashboard-tendik', 'TendikController::dashboard', ['filter' => 'auth']);
    
    // ============================================================
    // dosen
    // ============================================================
    $routes->get('dosen/dashboard', 'DosenController::dashboard', ['filter' => 'auth']);
    $routes->get('dosen/notification', 'DosenNotificationController::index', ['filter' => 'auth']);
    $routes->get('dosen/notification/read/([0-9]+)', 'DosenNotificationController::read/$1', ['filter' => 'auth']);
    $routes->get('dosen/notification/read-all', 'DosenNotificationController::readAll', ['filter' => 'auth']);
    $routes->get('dosen/profile', 'DosenProfileController::index', ['filter' => 'auth']);
    $routes->get('dosen/profile/edit', 'DosenProfileController::edit', ['filter' => 'auth']);
    $routes->post('dosen/profile/update', 'DosenProfileController::update', ['filter' => 'auth']);
    $routes->get('dosen/ticket/create', 'DosenTicketController::create', ['filter' => 'auth']);
    $routes->get('dosen/ticket/detail/([0-9]+)', 'DosenTicketController::detail/$1', ['filter' => 'auth']);
    $routes->get('dosen/ticket/draft', 'DosenTicketController::draft', ['filter' => 'auth']);
    $routes->get('dosen/ticket/draft/delete/([0-9]+)', 'DosenTicketController::deleteDraft/$1', ['filter' => 'auth']);
    $routes->get('dosen/ticket/draft/edit/([0-9]+)', 'DosenTicketController::editDraft/$1', ['filter' => 'auth']);
    $routes->post('dosen/ticket/draft/update/([0-9]+)', 'DosenTicketController::updateDraft/$1', ['filter' => 'auth']);
    $routes->get('dosen/ticket/draft-success', 'DosenTicketController::draftSuccess', ['filter' => 'auth']);
    $routes->get('dosen/ticket/history', 'DosenTicketController::history', ['filter' => 'auth']);
    $routes->get('dosen/ticket/jenis-layanan', 'DosenTicketController::jenisLayanan', ['filter' => 'auth']);
    $routes->get('dosen/ticket/persyaratan', 'DosenTicketController::persyaratan', ['filter' => 'auth']);
    $routes->post('dosen/ticket/reply/([0-9]+)', 'DosenTicketController::reply/$1', ['filter' => 'auth']);
    $routes->post('dosen/ticket/save-draft', 'DosenTicketController::saveDraft', ['filter' => 'auth']);
    $routes->post('dosen/ticket/store', 'DosenTicketController::store', ['filter' => 'auth']);
    $routes->get('dosen/ticket/success', 'DosenTicketController::success', ['filter' => 'auth']);
    
    // ============================================================
    // faqs
    // ============================================================
    $routes->get('faqs', 'Content\FaqController::index', ['filter' => ['auth', 'permission:faq.view']]);
    $routes->post('faqs/change-status/([0-9]+)', 'Content\FaqController::changeStatus/$1', ['filter' => ['auth', 'permission:faq.update']]);
    $routes->get('faqs/create', 'Content\FaqController::create', ['filter' => ['auth', 'permission:faq.create']]);
    $routes->post('faqs/delete/([0-9]+)', 'Content\FaqController::delete/$1', ['filter' => ['auth', 'permission:faq.delete']]);
    $routes->get('faqs/edit/([0-9]+)', 'Content\FaqController::edit/$1', ['filter' => ['auth', 'permission:faq.update']]);
    $routes->get('faqs/restore/([0-9]+)', 'Content\FaqController::restore/$1', ['filter' => ['auth', 'permission:faq.restore']]);
    $routes->get('faqs/show/([0-9]+)', 'Content\FaqController::show/$1', ['filter' => ['auth', 'permission:faq.view']]);
    $routes->post('faqs/store', 'Content\FaqController::store', ['filter' => ['auth', 'permission:faq.create']]);
    $routes->post('faqs/update/([0-9]+)', 'Content\FaqController::update/$1', ['filter' => ['auth', 'permission:faq.update']]);
    
    // ============================================================
    // jurusan
    // ============================================================
    $routes->get('jurusan', 'Jurusan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/dashboard', 'Jurusan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/data-tiket', 'Jurusan::dataTiket', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/detail/([0-9]+)', 'Jurusan::detail/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/download/([^/]+)', 'Jurusan::downloadFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/kirim/([0-9]+)', 'Jurusan::kirim/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/kirim-pemohon/([0-9]+)', 'Jurusan::kirimKePemohon/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/lihat/([^/]+)', 'Jurusan::lihatFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/log-aktivitas', 'Jurusan::logAktivitas', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/profile', 'Jurusan::profile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->post('jurusan/profile/update', 'Jurusan::updateProfile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/proses/([0-9]+)', 'Jurusan::proses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->post('jurusan/simpanUpload/([0-9]+)', 'Jurusan::simpanUpload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/statistik', 'Jurusan::statistik', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->post('jurusan/updateProses/([0-9]+)', 'Jurusan::updateProses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    $routes->get('jurusan/upload/([0-9]+)', 'Jurusan::upload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN']]);
    
    // ============================================================
    // kemahasiswaan
    // ============================================================
    $routes->get('kemahasiswaan', 'Kemahasiswaan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/dashboard', 'Kemahasiswaan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/data-tiket', 'Kemahasiswaan::dataTiket', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/detail/([0-9]+)', 'Kemahasiswaan::detail/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/download/([^/]+)', 'Kemahasiswaan::downloadFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/hapus-dokumen/([0-9]+)', 'Kemahasiswaan::hapusDokumen/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/kirim/([0-9]+)', 'Kemahasiswaan::kirim/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/kirim-pemohon/([0-9]+)', 'Kemahasiswaan::kirimKePemohon/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/lihat/([^/]+)', 'Kemahasiswaan::lihatFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/log-aktivitas', 'Kemahasiswaan::logAktivitas', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/profile', 'Kemahasiswaan::profile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->post('kemahasiswaan/profile/update', 'Kemahasiswaan::updateProfile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/proses/([0-9]+)', 'Kemahasiswaan::proses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/riwayat', 'Kemahasiswaan::riwayat', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->post('kemahasiswaan/simpanUpload/([0-9]+)', 'Kemahasiswaan::simpanUpload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/statistik', 'Kemahasiswaan::statistik', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->post('kemahasiswaan/updateProses/([0-9]+)', 'Kemahasiswaan::updateProses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    $routes->get('kemahasiswaan/upload/([0-9]+)', 'Kemahasiswaan::upload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN']]);
    
    // ============================================================
    // keuangan
    // ============================================================
    $routes->get('keuangan', 'Keuangan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/dashboard', 'Keuangan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/data-tiket', 'Keuangan::dataTiket', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/detail/([0-9]+)', 'Keuangan::detail/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/download/([^/]+)', 'Keuangan::downloadFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/hapus-dokumen/([0-9]+)', 'Keuangan::hapusDokumen/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/kirim/([0-9]+)', 'Keuangan::kirim/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/kirim-pemohon/([0-9]+)', 'Keuangan::kirimKePemohon/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/lihat/([^/]+)', 'Keuangan::lihatFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/log-aktivitas', 'Keuangan::logAktivitas', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/profile', 'Keuangan::profile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->post('keuangan/profile/update', 'Keuangan::updateProfile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/proses/([0-9]+)', 'Keuangan::proses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/riwayat', 'Keuangan::riwayat', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->post('keuangan/simpanUpload/([0-9]+)', 'Keuangan::simpanUpload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/statistik', 'Keuangan::statistik', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->post('keuangan/updateProses/([0-9]+)', 'Keuangan::updateProses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    $routes->get('keuangan/upload/([0-9]+)', 'Keuangan::upload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN']]);
    
    // ============================================================
    // layanan
    // ============================================================
    $routes->get('layanan/([0-9]+)', 'ServiceController::detail/$1');
    $routes->get('layanan/akademik', 'ServiceController::akademik');
    $routes->get('layanan/detail/([0-9]+)', 'ServiceController::detail/$1');
    $routes->get('layanan/kemahasiswaan', 'ServiceController::kemahasiswaan');
    $routes->get('layanan/keuangan', 'ServiceController::keuangan');
    $routes->get('layanan/upa', 'ServiceController::upa');
    
    // ============================================================
    // mahasiswa
    // ============================================================
    $routes->get('mahasiswa/help', 'MahasiswaHelpController::index', ['filter' => 'auth']);
    $routes->get('mahasiswa/notification', 'MahasiswaNotificationController::index', ['filter' => 'auth']);
    $routes->get('mahasiswa/notification/read/([0-9]+)', 'MahasiswaNotificationController::read/$1', ['filter' => 'auth']);
    $routes->get('mahasiswa/notification/read-all', 'MahasiswaNotificationController::readAll', ['filter' => 'auth']);
    $routes->get('mahasiswa/profile', 'MahasiswaProfileController::index', ['filter' => 'auth']);
    $routes->get('mahasiswa/profile/edit', 'MahasiswaProfileController::edit', ['filter' => 'auth']);
    $routes->post('mahasiswa/profile/update', 'MahasiswaProfileController::update', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/create', 'MahasiswaTicketController::create', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/delete-draft/([0-9]+)', 'MahasiswaTicketController::deleteDraft/$1', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/detail/([0-9]+)', 'MahasiswaTicketController::detail/$1', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/draft', 'MahasiswaTicketController::draft', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/draft-success', 'MahasiswaTicketController::draftSuccess', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/edit-draft/([0-9]+)', 'MahasiswaTicketController::editDraft/$1', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/history', 'MahasiswaTicketController::history', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/jenis-layanan', 'MahasiswaTicketController::jenisLayanan', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/persyaratan', 'MahasiswaTicketController::persyaratan', ['filter' => 'auth']);
    $routes->post('mahasiswa/ticket/reply/([0-9]+)', 'MahasiswaTicketController::reply/$1', ['filter' => 'auth']);
    $routes->post('mahasiswa/ticket/save-draft', 'MahasiswaTicketController::saveDraft', ['filter' => 'auth']);
    $routes->post('mahasiswa/ticket/store', 'MahasiswaTicketController::store', ['filter' => 'auth']);
    $routes->get('mahasiswa/ticket/success', 'MahasiswaTicketController::success', ['filter' => 'auth']);
    $routes->post('mahasiswa/ticket/update-draft/([0-9]+)', 'MahasiswaTicketController::updateDraft/$1', ['filter' => 'auth']);
    
    // ============================================================
    // master
    // ============================================================
    $routes->get('master/applicant-types', 'Master\ApplicantTypeController::index', ['filter' => ['auth', 'permission:applicant_type.view']]);
    $routes->post('master/applicant-types/change-status/([0-9]+)', 'Master\ApplicantTypeController::changeStatus/$1', ['filter' => ['auth', 'permission:applicant_type.update']]);
    $routes->get('master/applicant-types/create', 'Master\ApplicantTypeController::create', ['filter' => ['auth', 'permission:applicant_type.create']]);
    $routes->get('master/applicant-types/delete/([0-9]+)', 'Master\ApplicantTypeController::delete/$1', ['filter' => ['auth', 'permission:applicant_type.delete']]);
    $routes->get('master/applicant-types/edit/([0-9]+)', 'Master\ApplicantTypeController::edit/$1', ['filter' => ['auth', 'permission:applicant_type.update']]);
    $routes->get('master/applicant-types/restore/([0-9]+)', 'Master\ApplicantTypeController::restore/$1', ['filter' => ['auth', 'permission:applicant_type.restore']]);
    $routes->get('master/applicant-types/show/([0-9]+)', 'Master\ApplicantTypeController::show/$1', ['filter' => ['auth', 'permission:applicant_type.view']]);
    $routes->post('master/applicant-types/store', 'Master\ApplicantTypeController::store', ['filter' => ['auth', 'permission:applicant_type.create']]);
    $routes->post('master/applicant-types/update/([0-9]+)', 'Master\ApplicantTypeController::update/$1', ['filter' => ['auth', 'permission:applicant_type.update']]);
    $routes->get('master/classes', 'Master\ClassController::index', ['filter' => ['auth', 'permission:class.view']]);
    $routes->post('master/classes/change-status/([0-9]+)', 'Master\ClassController::changeStatus/$1', ['filter' => ['auth', 'permission:class.update']]);
    $routes->get('master/classes/create', 'Master\ClassController::create', ['filter' => ['auth', 'permission:class.create']]);
    $routes->get('master/classes/delete/([0-9]+)', 'Master\ClassController::delete/$1', ['filter' => ['auth', 'permission:class.delete']]);
    $routes->get('master/classes/edit/([0-9]+)', 'Master\ClassController::edit/$1', ['filter' => ['auth', 'permission:class.update']]);
    $routes->get('master/classes/restore/([0-9]+)', 'Master\ClassController::restore/$1', ['filter' => ['auth', 'permission:class.restore']]);
    $routes->get('master/classes/show/([0-9]+)', 'Master\ClassController::show/$1', ['filter' => ['auth', 'permission:class.view']]);
    $routes->post('master/classes/store', 'Master\ClassController::store', ['filter' => ['auth', 'permission:class.create']]);
    $routes->post('master/classes/update/([0-9]+)', 'Master\ClassController::update/$1', ['filter' => ['auth', 'permission:class.update']]);
    $routes->get('master/departments', 'Master\DepartmentController::index', ['filter' => ['auth', 'permission:department.view']]);
    $routes->post('master/departments/change-status/([0-9]+)', 'Master\DepartmentController::changeStatus/$1', ['filter' => ['auth', 'permission:department.update']]);
    $routes->get('master/departments/create', 'Master\DepartmentController::create', ['filter' => ['auth', 'permission:department.create']]);
    $routes->get('master/departments/delete/([0-9]+)', 'Master\DepartmentController::delete/$1', ['filter' => ['auth', 'permission:department.delete']]);
    $routes->get('master/departments/edit/([0-9]+)', 'Master\DepartmentController::edit/$1', ['filter' => ['auth', 'permission:department.update']]);
    $routes->get('master/departments/restore/([0-9]+)', 'Master\DepartmentController::restore/$1', ['filter' => ['auth', 'permission:department.restore']]);
    $routes->get('master/departments/show/([0-9]+)', 'Master\DepartmentController::show/$1', ['filter' => ['auth', 'permission:department.view']]);
    $routes->post('master/departments/store', 'Master\DepartmentController::store', ['filter' => ['auth', 'permission:department.create']]);
    $routes->post('master/departments/update/([0-9]+)', 'Master\DepartmentController::update/$1', ['filter' => ['auth', 'permission:department.update']]);
    $routes->get('master/service-categories', 'Master\ServiceCategoryController::index', ['filter' => ['auth', 'permission:service_category.view']]);
    $routes->post('master/service-categories/change-status/([0-9]+)', 'Master\ServiceCategoryController::changeStatus/$1', ['filter' => ['auth', 'permission:service_category.update']]);
    $routes->get('master/service-categories/create', 'Master\ServiceCategoryController::create', ['filter' => ['auth', 'permission:service_category.create']]);
    $routes->get('master/service-categories/delete/([0-9]+)', 'Master\ServiceCategoryController::delete/$1', ['filter' => ['auth', 'permission:service_category.delete']]);
    $routes->get('master/service-categories/edit/([0-9]+)', 'Master\ServiceCategoryController::edit/$1', ['filter' => ['auth', 'permission:service_category.update']]);
    $routes->get('master/service-categories/restore/([0-9]+)', 'Master\ServiceCategoryController::restore/$1', ['filter' => ['auth', 'permission:service_category.restore']]);
    $routes->get('master/service-categories/show/([0-9]+)', 'Master\ServiceCategoryController::show/$1', ['filter' => ['auth', 'permission:service_category.view']]);
    $routes->post('master/service-categories/store', 'Master\ServiceCategoryController::store', ['filter' => ['auth', 'permission:service_category.create']]);
    $routes->post('master/service-categories/update/([0-9]+)', 'Master\ServiceCategoryController::update/$1', ['filter' => ['auth', 'permission:service_category.update']]);
    $routes->get('master/service-requirements', 'Master\ServiceRequirementController::index', ['filter' => ['auth', 'permission:service_requirement.view']]);
    $routes->get('master/service-requirements/create', 'Master\ServiceRequirementController::create', ['filter' => ['auth', 'permission:service_requirement.create']]);
    $routes->get('master/service-requirements/delete/([0-9]+)', 'Master\ServiceRequirementController::delete/$1', ['filter' => ['auth', 'permission:service_requirement.delete']]);
    $routes->get('master/service-requirements/edit/([0-9]+)', 'Master\ServiceRequirementController::edit/$1', ['filter' => ['auth', 'permission:service_requirement.update']]);
    $routes->get('master/service-requirements/restore/([0-9]+)', 'Master\ServiceRequirementController::restore/$1', ['filter' => ['auth', 'permission:service_requirement.restore']]);
    $routes->get('master/service-requirements/show/([0-9]+)', 'Master\ServiceRequirementController::show/$1', ['filter' => ['auth', 'permission:service_requirement.view']]);
    $routes->post('master/service-requirements/store', 'Master\ServiceRequirementController::store', ['filter' => ['auth', 'permission:service_requirement.create']]);
    $routes->post('master/service-requirements/update/([0-9]+)', 'Master\ServiceRequirementController::update/$1', ['filter' => ['auth', 'permission:service_requirement.update']]);
    $routes->get('master/services', 'Master\ServiceController::index', ['filter' => ['auth', 'permission:service.view']]);
    $routes->post('master/services/change-status/([0-9]+)', 'Master\ServiceController::changeStatus/$1', ['filter' => ['auth', 'permission:service.update']]);
    $routes->get('master/services/create', 'Master\ServiceController::create', ['filter' => ['auth', 'permission:service.create']]);
    $routes->get('master/services/delete/([0-9]+)', 'Master\ServiceController::delete/$1', ['filter' => ['auth', 'permission:service.delete']]);
    $routes->get('master/services/edit/([0-9]+)', 'Master\ServiceController::edit/$1', ['filter' => ['auth', 'permission:service.update']]);
    $routes->get('master/services/restore/([0-9]+)', 'Master\ServiceController::restore/$1', ['filter' => ['auth', 'permission:service.restore']]);
    $routes->get('master/services/show/([0-9]+)', 'Master\ServiceController::show/$1', ['filter' => ['auth', 'permission:service.view']]);
    $routes->post('master/services/store', 'Master\ServiceController::store', ['filter' => ['auth', 'permission:service.create']]);
    $routes->post('master/services/update/([0-9]+)', 'Master\ServiceController::update/$1', ['filter' => ['auth', 'permission:service.update']]);
    $routes->get('master/service-units', 'Master\ServiceUnitController::index', ['filter' => ['auth', 'permission:service_unit.view']]);
    $routes->post('master/service-units/change-status/([0-9]+)', 'Master\ServiceUnitController::changeStatus/$1', ['filter' => ['auth', 'permission:service_unit.update']]);
    $routes->get('master/service-units/create', 'Master\ServiceUnitController::create', ['filter' => ['auth', 'permission:service_unit.create']]);
    $routes->get('master/service-units/delete/([0-9]+)', 'Master\ServiceUnitController::delete/$1', ['filter' => ['auth', 'permission:service_unit.delete']]);
    $routes->get('master/service-units/edit/([0-9]+)', 'Master\ServiceUnitController::edit/$1', ['filter' => ['auth', 'permission:service_unit.update']]);
    $routes->get('master/service-units/restore/([0-9]+)', 'Master\ServiceUnitController::restore/$1', ['filter' => ['auth', 'permission:service_unit.restore']]);
    $routes->get('master/service-units/show/([0-9]+)', 'Master\ServiceUnitController::show/$1', ['filter' => ['auth', 'permission:service_unit.view']]);
    $routes->post('master/service-units/store', 'Master\ServiceUnitController::store', ['filter' => ['auth', 'permission:service_unit.create']]);
    $routes->post('master/service-units/update/([0-9]+)', 'Master\ServiceUnitController::update/$1', ['filter' => ['auth', 'permission:service_unit.update']]);
    $routes->get('master/study-programs', 'Master\StudyProgramController::index', ['filter' => ['auth', 'permission:study_program.view']]);
    $routes->post('master/study-programs/change-status/([0-9]+)', 'Master\StudyProgramController::changeStatus/$1', ['filter' => ['auth', 'permission:study_program.update']]);
    $routes->get('master/study-programs/create', 'Master\StudyProgramController::create', ['filter' => ['auth', 'permission:study_program.create']]);
    $routes->get('master/study-programs/delete/([0-9]+)', 'Master\StudyProgramController::delete/$1', ['filter' => ['auth', 'permission:study_program.delete']]);
    $routes->get('master/study-programs/edit/([0-9]+)', 'Master\StudyProgramController::edit/$1', ['filter' => ['auth', 'permission:study_program.update']]);
    $routes->get('master/study-programs/restore/([0-9]+)', 'Master\StudyProgramController::restore/$1', ['filter' => ['auth', 'permission:study_program.restore']]);
    $routes->get('master/study-programs/show/([0-9]+)', 'Master\StudyProgramController::show/$1', ['filter' => ['auth', 'permission:study_program.view']]);
    $routes->post('master/study-programs/store', 'Master\StudyProgramController::store', ['filter' => ['auth', 'permission:study_program.create']]);
    $routes->post('master/study-programs/update/([0-9]+)', 'Master\StudyProgramController::update/$1', ['filter' => ['auth', 'permission:study_program.update']]);
    
    // ============================================================
    // mitra
    // ============================================================
    $routes->get('mitra/dashboard', 'MitraController::dashboard', ['filter' => 'auth']);
    $routes->get('mitra/notification', 'MitraNotificationController::index', ['filter' => 'auth']);
    $routes->get('mitra/notification/read/([0-9]+)', 'MitraNotificationController::read/$1', ['filter' => 'auth']);
    $routes->get('mitra/notification/read-all', 'MitraNotificationController::readAll', ['filter' => 'auth']);
    $routes->get('mitra/profile', 'MitraProfileController::index', ['filter' => 'auth']);
    $routes->get('mitra/profile/edit', 'MitraProfileController::edit', ['filter' => 'auth']);
    $routes->post('mitra/profile/update', 'MitraProfileController::update', ['filter' => 'auth']);
    $routes->get('mitra/ticket/create', 'MitraTicketController::create', ['filter' => 'auth']);
    $routes->get('mitra/ticket/delete-draft/([0-9]+)', 'MitraTicketController::deleteDraft/$1', ['filter' => 'auth']);
    $routes->get('mitra/ticket/detail/([0-9]+)', 'MitraTicketController::detail/$1', ['filter' => 'auth']);
    $routes->get('mitra/ticket/draft', 'MitraTicketController::draft', ['filter' => 'auth']);
    $routes->get('mitra/ticket/draft-success', 'MitraTicketController::draftSuccess', ['filter' => 'auth']);
    $routes->get('mitra/ticket/edit-draft/([0-9]+)', 'MitraTicketController::editDraft/$1', ['filter' => 'auth']);
    $routes->get('mitra/ticket/history', 'MitraTicketController::history', ['filter' => 'auth']);
    $routes->get('mitra/ticket/jenis-layanan', 'MitraTicketController::jenisLayanan', ['filter' => 'auth']);
    $routes->get('mitra/ticket/layanan', 'MitraTicketController::layanan', ['filter' => 'auth']);
    $routes->get('mitra/ticket/persyaratan', 'MitraTicketController::persyaratan', ['filter' => 'auth']);
    $routes->get('mitra/ticket/reply/([0-9]+)', 'MitraTicketController::reply/$1', ['filter' => 'auth']);
    $routes->post('mitra/ticket/save-draft', 'MitraTicketController::saveDraft', ['filter' => 'auth']);
    $routes->post('mitra/ticket/store', 'MitraTicketController::store', ['filter' => 'auth']);
    $routes->get('mitra/ticket/success', 'MitraTicketController::success', ['filter' => 'auth']);
    $routes->post('mitra/ticket/update-draft/([0-9]+)', 'MitraTicketController::updateDraft/$1', ['filter' => 'auth']);
    
    // ============================================================
    // notifications
    // ============================================================
    $routes->get('notifications', 'NotificationController::index', ['filter' => ['auth', 'permission:notification.view']]);
    $routes->get('notifications/read/([0-9]+)', 'NotificationController::read/$1', ['filter' => ['auth', 'permission:notification.view']]);
    $routes->get('notifications/read-all', 'NotificationController::readAll', ['filter' => ['auth', 'permission:notification.view']]);
    
    // ============================================================
    // orangtua
    // ============================================================
    $routes->get('orangtua/notification', 'OrangTuaNotificationController::index', ['filter' => 'auth']);
    $routes->get('orangtua/notification/read/([0-9]+)', 'OrangTuaNotificationController::read/$1', ['filter' => 'auth']);
    $routes->get('orangtua/notification/read-all', 'OrangTuaNotificationController::readAll', ['filter' => 'auth']);
    $routes->get('orangtua/profile', 'OrangTuaProfileController::index', ['filter' => 'auth']);
    $routes->get('orangtua/profile/edit', 'OrangTuaProfileController::edit', ['filter' => 'auth']);
    $routes->post('orangtua/profile/update', 'OrangTuaProfileController::update', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/create', 'OrangTuaTicketController::create', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/detail/(.*)', 'OrangTuaTicketController::detail/$1', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/draft', 'OrangTuaTicketController::draft', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/draft/delete/([0-9]+)', 'OrangTuaTicketController::deleteDraft/$1', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/draft/edit/([0-9]+)', 'OrangTuaTicketController::editDraft/$1', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/draft/success', 'OrangTuaTicketController::draftSuccess', ['filter' => 'auth']);
    $routes->post('orangtua/ticket/draft/update/([0-9]+)', 'OrangTuaTicketController::updateDraft/$1', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/history', 'OrangTuaTicketController::history', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/jenis-layanan', 'OrangTuaTicketController::jenisLayanan', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/persyaratan', 'OrangTuaTicketController::persyaratan', ['filter' => 'auth']);
    $routes->post('orangtua/ticket/save-draft', 'OrangTuaTicketController::saveDraft', ['filter' => 'auth']);
    $routes->post('orangtua/ticket/store', 'OrangTuaTicketController::store', ['filter' => 'auth']);
    $routes->get('orangtua/ticket/success', 'OrangTuaTicketController::success', ['filter' => 'auth']);
    
    // ============================================================
    // permissions
    // ============================================================
    $routes->get('permissions', 'Management\PermissionController::index', ['filter' => ['auth', 'permission:permission.view']]);
    $routes->get('permissions/create', 'Management\PermissionController::create', ['filter' => ['auth', 'permission:permission.update']]);
    $routes->get('permissions/delete/([0-9]+)', 'Management\PermissionController::delete/$1', ['filter' => ['auth', 'permission:permission.update']]);
    $routes->get('permissions/edit/([0-9]+)', 'Management\PermissionController::edit/$1', ['filter' => ['auth', 'permission:permission.update']]);
    $routes->get('permissions/show/([0-9]+)', 'Management\PermissionController::show/$1', ['filter' => ['auth', 'permission:permission.view']]);
    $routes->post('permissions/store', 'Management\PermissionController::store', ['filter' => ['auth', 'permission:permission.update']]);
    $routes->post('permissions/update/([0-9]+)', 'Management\PermissionController::update/$1', ['filter' => ['auth', 'permission:permission.update']]);
    
    // ============================================================
    // perpustakaan
    // ============================================================
    $routes->get('perpustakaan', 'Perpustakaan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/dashboard', 'Perpustakaan::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/data-tiket', 'Perpustakaan::dataTiket', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/detail/([0-9]+)', 'Perpustakaan::detail/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/download/([^/]+)', 'Perpustakaan::downloadFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/hapus-dokumen/([0-9]+)', 'Perpustakaan::hapusDokumen/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/kirim/([0-9]+)', 'Perpustakaan::kirim/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/kirim-pemohon/([0-9]+)', 'Perpustakaan::kirimKePemohon/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/lihat/([^/]+)', 'Perpustakaan::lihatFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/log-aktivitas', 'Perpustakaan::logAktivitas', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/profile', 'Perpustakaan::profile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->post('perpustakaan/profile/update', 'Perpustakaan::updateProfile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/proses/([0-9]+)', 'Perpustakaan::proses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/riwayat', 'Perpustakaan::riwayat', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->post('perpustakaan/simpanUpload/([0-9]+)', 'Perpustakaan::simpanUpload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/statistik', 'Perpustakaan::statistik', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->post('perpustakaan/updateProses/([0-9]+)', 'Perpustakaan::updateProses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    $routes->get('perpustakaan/upload/([0-9]+)', 'Perpustakaan::upload/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN']]);
    
    // ============================================================
    // petugas
    // ============================================================
    $routes->get('petugas', 'PetugasController::dashboard', ['filter' => 'auth']);
    $routes->get('petugas/api/statistik-data', 'PetugasController::apiStatistikData', ['filter' => 'auth']);
    $routes->get('petugas/dashboard', 'PetugasController::dashboard', ['filter' => 'auth']);
    $routes->get('petugas/detail/([0-9]+)', 'PetugasController::detail/$1', ['filter' => 'auth']);
    $routes->get('petugas/disposisi', 'PetugasController::disposisi', ['filter' => 'auth']);
    $routes->get('petugas/disposisi/([0-9]+)', 'PetugasController::disposisi/$1', ['filter' => 'auth']);
    $routes->post('petugas/disposisi/([0-9]+)', 'PetugasController::kirimDisposisi/$1', ['filter' => 'auth']);
    $routes->post('petugas/disposisi/kirim', 'PetugasController::kirimDisposisi', ['filter' => 'auth']);
    $routes->post('petugas/disposisi/kirim/([0-9]+)', 'PetugasController::kirimDisposisi/$1', ['filter' => 'auth']);
    $routes->get('petugas/laporan-tamu', 'PetugasController::laporanTamu', ['filter' => 'auth']);
    $routes->get('petugas/laporan-tiket', 'PetugasController::laporanTiket', ['filter' => 'auth']);
    $routes->get('petugas/log_aktivitas', 'PetugasController::log_aktivitas', ['filter' => 'auth']);
    $routes->get('petugas/log-aktivitas', 'PetugasController::log_aktivitas', ['filter' => 'auth']);
    $routes->get('petugas/mfa', 'Auth\AuthController::mfaSetup', ['filter' => 'auth']);
    $routes->post('petugas/mfa/verify', 'Auth\AuthController::verifyMfaSetup', ['filter' => 'auth']);
    $routes->get('petugas/profile', 'PetugasController::profile', ['filter' => 'auth']);
    $routes->get('petugas/statistik-tiket', 'PetugasController::statistikTiket', ['filter' => 'auth']);
    $routes->get('petugas/tiket', 'PetugasController::tiket', ['filter' => 'auth']);
    $routes->get('petugas/tiket/detail/([0-9]+)', 'PetugasController::detail/$1', ['filter' => 'auth']);
    $routes->get('petugas/tiket/disposisi/([0-9]+)', 'PetugasController::disposisi/$1', ['filter' => 'auth']);
    $routes->get('petugas/tiket/verifikasi/([0-9]+)', 'PetugasController::verifikasi/$1', ['filter' => 'auth']);
    $routes->get('petugas/tracking-tiket', 'PetugasController::trackingTiket', ['filter' => 'auth']);
    $routes->get('petugas/verifikasi', 'PetugasController::verifikasi', ['filter' => 'auth']);
    $routes->get('petugas/verifikasi/([0-9]+)', 'PetugasController::verifikasi/$1', ['filter' => 'auth']);
    $routes->post('petugas/verifikasi/([0-9]+)', 'PetugasController::simpanVerifikasi/$1', ['filter' => 'auth']);
    $routes->post('petugas/verifikasi/simpan', 'PetugasController::simpanVerifikasi', ['filter' => 'auth']);
    $routes->post('petugas/verifikasi/simpan/([0-9]+)', 'PetugasController::simpanVerifikasi/$1', ['filter' => 'auth']);
    
    // ============================================================
    // realtime
    // ============================================================
    $routes->get('realtime/dashboard', 'RealtimeController::dashboardStats', ['filter' => 'auth']);
    $routes->get('realtime/notifications', 'RealtimeController::notifications', ['filter' => 'auth']);
    $routes->get('realtime/tickets-last/([0-9]+)', 'RealtimeController::lastTickets/$1', ['filter' => 'auth']);
    $routes->get('realtime/unread-count', 'RealtimeController::unreadCount', ['filter' => 'auth']);
    
    // ============================================================
    // register
    // ============================================================
    $routes->get('register/mfa-setup', 'Auth\RegisterController::mfaSetup');
    $routes->post('register/mfa-setup', 'Auth\RegisterController::verify');
    
    // ============================================================
    // registration-requests
    // ============================================================
    $routes->get('registration-requests', 'Management\RegistrationRequestController::index', ['filter' => ['auth', 'permission:registration_request.view']]);
    $routes->post('registration-requests/approve/([0-9]+)', 'Management\RegistrationRequestController::approve/$1', ['filter' => ['auth', 'permission:registration_request.approve']]);
    $routes->post('registration-requests/reject/([0-9]+)', 'Management\RegistrationRequestController::reject/$1', ['filter' => ['auth', 'permission:registration_request.reject']]);
    $routes->get('registration-requests/show/([0-9]+)', 'Management\RegistrationRequestController::show/$1', ['filter' => ['auth', 'permission:registration_request.view']]);
    
    // ============================================================
    // reports
    // ============================================================
    $routes->get('reports', 'ReportController::index', ['filter' => ['auth', 'permission:report.view']]);
    
    // ============================================================
    // reset-password-mhs
    // ============================================================
    $routes->get('reset-password-mhs', 'ResetPasswordController::reset');
    
    // ============================================================
    // roles
    // ============================================================
    $routes->get('roles', 'Management\RoleController::index', ['filter' => ['auth', 'permission:role.view']]);
    $routes->get('roles/create', 'Management\RoleController::create', ['filter' => ['auth', 'permission:role.create']]);
    $routes->get('roles/delete/([0-9]+)', 'Management\RoleController::delete/$1', ['filter' => ['auth', 'permission:role.delete']]);
    $routes->get('roles/edit/([0-9]+)', 'Management\RoleController::edit/$1', ['filter' => ['auth', 'permission:role.update']]);
    $routes->get('roles/permissions/([0-9]+)', 'Master\RolePermissionController::index/$1', ['filter' => ['auth', 'permission:role.update']]);
    $routes->post('roles/permissions/([0-9]+)', 'Master\RolePermissionController::save/$1', ['filter' => ['auth', 'permission:role.update']]);
    $routes->post('roles/permissions/clear/([0-9]+)', 'Master\RolePermissionController::clear/$1', ['filter' => ['auth', 'permission:role.update']]);
    $routes->post('roles/permissions/select-all/([0-9]+)', 'Master\RolePermissionController::selectAll/$1', ['filter' => ['auth', 'permission:role.update']]);
    $routes->get('roles/show/([0-9]+)', 'Management\RoleController::show/$1', ['filter' => ['auth', 'permission:role.view']]);
    $routes->post('roles/store', 'Management\RoleController::store', ['filter' => ['auth', 'permission:role.create']]);
    $routes->post('roles/update/([0-9]+)', 'Management\RoleController::update/$1', ['filter' => ['auth', 'permission:role.update']]);
    
    // ============================================================
    // service-requests
    // ============================================================
    $routes->get('service-requests', 'ServiceRequestController::index', ['filter' => ['auth', 'permission:request.view']]);
    $routes->get('service-requests/create', 'ServiceRequestController::create', ['filter' => ['auth', 'permission:request.create']]);
    $routes->get('service-requests/delete/([0-9]+)', 'ServiceRequestController::delete/$1', ['filter' => ['auth', 'permission:request.cancel']]);
    $routes->get('service-requests/edit/([0-9]+)', 'ServiceRequestController::edit/$1', ['filter' => ['auth', 'permission:request.update']]);
    $routes->get('service-requests/show/([0-9]+)', 'ServiceRequestController::show/$1', ['filter' => ['auth', 'permission:request.view']]);
    $routes->post('service-requests/store', 'ServiceRequestController::store', ['filter' => ['auth', 'permission:request.create']]);
    $routes->post('service-requests/update/([0-9]+)', 'ServiceRequestController::update/$1', ['filter' => ['auth', 'permission:request.update']]);
    
    // ============================================================
    // services
    // ============================================================
    $routes->get('services', 'ServiceController::index');
    
    // ============================================================
    // tendik
    // ============================================================
    $routes->get('tendik/notification', 'TendikNotificationController::index', ['filter' => 'auth']);
    $routes->get('tendik/notification/read-all', 'TendikNotificationController::markAllRead', ['filter' => 'auth']);
    $routes->get('tendik/profile', 'TendikProfileController::index', ['filter' => 'auth']);
    $routes->get('tendik/profile/edit', 'TendikProfileController::edit', ['filter' => 'auth']);
    $routes->post('tendik/profile/update', 'TendikProfileController::update', ['filter' => 'auth']);
    $routes->get('tendik/ticket/create', 'TendikTicketController::create', ['filter' => 'auth']);
    $routes->get('tendik/ticket/detail/(.*)', 'TendikTicketController::detail/$1', ['filter' => 'auth']);
    $routes->get('tendik/ticket/draft', 'TendikTicketController::draft', ['filter' => 'auth']);
    $routes->get('tendik/ticket/draft/delete/([0-9]+)', 'TendikTicketController::deleteDraft/$1', ['filter' => 'auth']);
    $routes->get('tendik/ticket/draft/edit/([0-9]+)', 'TendikTicketController::editDraft/$1', ['filter' => 'auth']);
    $routes->post('tendik/ticket/draft/update/([0-9]+)', 'TendikTicketController::updateDraft/$1', ['filter' => 'auth']);
    $routes->get('tendik/ticket/history', 'TendikTicketController::history', ['filter' => 'auth']);
    $routes->get('tendik/ticket/jenis-layanan', 'TendikTicketController::jenisLayanan', ['filter' => 'auth']);
    $routes->get('tendik/ticket/persyaratan', 'TendikTicketController::persyaratan', ['filter' => 'auth']);
    $routes->post('tendik/ticket/reply/(.*)', 'TendikTicketController::reply/$1', ['filter' => 'auth']);
    $routes->post('tendik/ticket/save-draft', 'TendikTicketController::saveDraft', ['filter' => 'auth']);
    $routes->post('tendik/ticket/store', 'TendikTicketController::store', ['filter' => 'auth']);
    $routes->get('tendik/ticket/success', 'TendikTicketController::success', ['filter' => 'auth']);
    
    // ============================================================
    // tickets
    // ============================================================
    $routes->get('tickets', 'TicketController::index', ['filter' => ['auth', 'permission:request.view']]);
    $routes->post('tickets/change-status/([0-9]+)', 'TicketController::changeStatus/$1', ['filter' => ['auth', 'permission:request.update']]);
    $routes->get('tickets/create', 'TicketController::create', ['filter' => ['auth', 'permission:request.create']]);
    $routes->post('tickets/delete/([0-9]+)', 'TicketController::delete/$1', ['filter' => ['auth', 'permission:request.cancel']]);
    $routes->get('tickets/edit/([0-9]+)', 'TicketController::edit/$1', ['filter' => ['auth', 'permission:request.update']]);
    $routes->get('tickets/show/([0-9]+)', 'TicketController::show/$1', ['filter' => ['auth', 'permission:request.view']]);
    $routes->post('tickets/store', 'TicketController::store', ['filter' => ['auth', 'permission:request.create']]);
    $routes->post('tickets/update/([0-9]+)', 'TicketController::update/$1', ['filter' => ['auth', 'permission:request.update']]);
    
    // ============================================================
    // umum
    // ============================================================
    $routes->get('umum/dashboard', 'UmumController::index', ['filter' => 'auth']);
    $routes->get('umum/notification', 'UmumNotificationController::index', ['filter' => 'auth']);
    $routes->get('umum/notification/read/([0-9]+)', 'UmumNotificationController::read/$1', ['filter' => 'auth']);
    $routes->get('umum/notification/read-all', 'UmumNotificationController::readAll', ['filter' => 'auth']);
    $routes->get('umum/profile', 'UmumProfileController::index', ['filter' => 'auth']);
    $routes->get('umum/profile/edit', 'UmumProfileController::edit', ['filter' => 'auth']);
    $routes->post('umum/profile/update', 'UmumProfileController::update', ['filter' => 'auth']);
    $routes->get('umum/ticket/create', 'UmumTicketController::create', ['filter' => 'auth']);
    $routes->get('umum/ticket/delete-draft/([0-9]+)', 'UmumTicketController::deleteDraft/$1', ['filter' => 'auth']);
    $routes->get('umum/ticket/detail/([0-9]+)', 'UmumTicketController::detail/$1', ['filter' => 'auth']);
    $routes->get('umum/ticket/draft', 'UmumTicketController::draft', ['filter' => 'auth']);
    $routes->get('umum/ticket/draft-success', 'UmumTicketController::draftSuccess', ['filter' => 'auth']);
    $routes->get('umum/ticket/edit-draft/([0-9]+)', 'UmumTicketController::editDraft/$1', ['filter' => 'auth']);
    $routes->get('umum/ticket/history', 'UmumTicketController::history', ['filter' => 'auth']);
    $routes->get('umum/ticket/jenis-layanan', 'UmumTicketController::jenisLayanan', ['filter' => 'auth']);
    $routes->get('umum/ticket/layanan', 'UmumTicketController::layanan', ['filter' => 'auth']);
    $routes->get('umum/ticket/persyaratan', 'UmumTicketController::persyaratan', ['filter' => 'auth']);
    $routes->get('umum/ticket/reply/([0-9]+)', 'UmumTicketController::reply/$1', ['filter' => 'auth']);
    $routes->post('umum/ticket/save-draft', 'UmumTicketController::saveDraft', ['filter' => 'auth']);
    $routes->post('umum/ticket/store', 'UmumTicketController::store', ['filter' => 'auth']);
    $routes->get('umum/ticket/success', 'UmumTicketController::success', ['filter' => 'auth']);
    $routes->post('umum/ticket/update-draft/([0-9]+)', 'UmumTicketController::updateDraft/$1', ['filter' => 'auth']);
    
    // ============================================================
    // unauthorized
    // ============================================================
    $routes->get('unauthorized', 'Auth\AuthController::unauthorized');
    
    // ============================================================
    // units-profiles
    // ============================================================
    $routes->get('units-profiles', 'Content\UnitsProfileController::index', ['filter' => ['auth', 'permission:unit_profile.view']]);
    $routes->post('units-profiles/change-status/([0-9]+)', 'Content\UnitsProfileController::changeStatus/$1', ['filter' => ['auth', 'permission:unit_profile.update']]);
    $routes->get('units-profiles/create', 'Content\UnitsProfileController::create', ['filter' => ['auth', 'permission:unit_profile.create']]);
    $routes->post('units-profiles/delete/([0-9]+)', 'Content\UnitsProfileController::delete/$1', ['filter' => ['auth', 'permission:unit_profile.delete']]);
    $routes->get('units-profiles/edit/([0-9]+)', 'Content\UnitsProfileController::edit/$1', ['filter' => ['auth', 'permission:unit_profile.update']]);
    $routes->get('units-profiles/restore/([0-9]+)', 'Content\UnitsProfileController::restore/$1', ['filter' => ['auth', 'permission:unit_profile.restore']]);
    $routes->get('units-profiles/show/([0-9]+)', 'Content\UnitsProfileController::show/$1', ['filter' => ['auth', 'permission:unit_profile.view']]);
    $routes->post('units-profiles/store', 'Content\UnitsProfileController::store', ['filter' => ['auth', 'permission:unit_profile.create']]);
    $routes->post('units-profiles/update/([0-9]+)', 'Content\UnitsProfileController::update/$1', ['filter' => ['auth', 'permission:unit_profile.update']]);
    
    // ============================================================
    // upt-tik
    // ============================================================
    $routes->get('upt-tik', 'UptTik::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/dashboard', 'UptTik::dashboard', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/data-tiket', 'UptTik::dataTiket', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/detail/([0-9]+)', 'UptTik::detail/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/download/([^/]+)', 'UptTik::downloadFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/kirim/([0-9]+)', 'UptTik::kirim/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/kirim-pemohon/([0-9]+)', 'UptTik::kirimKePemohon/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/lihat/([^/]+)', 'UptTik::lihatFile/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
$routes->get('upt-tik/hapus-dokumen/([0-9]+)', 'UptTik::hapusDokumen/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/log-aktivitas', 'UptTik::logAktivitas', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/profile', 'UptTik::profile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->post('upt-tik/profile/update', 'UptTik::updateProfile', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/proses/([0-9]+)', 'UptTik::proses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->post('upt-tik/proses/update/([0-9]+)', 'UptTik::updateProses/$1', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    $routes->get('upt-tik/statistik', 'UptTik::statistik', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK']]);
    
    // ============================================================
    // users
    // ============================================================
    $routes->get('users/fields/([0-9]+)', 'Management\UserController::fields/$1', ['filter' => ['auth', 'permission:user.create']]);
    $routes->get('users/show/([0-9]+)', 'Management\UserController::show/$1', ['filter' => ['auth', 'permission:user.view']]);
    
    // ============================================================
    // verifications
    // ============================================================
    $routes->get('verifications', 'VerificationController::index', ['filter' => ['auth', 'permission:request.verify']]);
    $routes->post('verifications/reject/([0-9]+)', 'VerificationController::reject/$1', ['filter' => ['auth', 'permission:request.reject']]);
    $routes->post('verifications/verify/([0-9]+)', 'VerificationController::verify/$1', ['filter' => ['auth', 'permission:request.verify']]);
    
    
// KHUSUS ADMIN
// ============================================================

$routes->group(
    'admin-users',
    ['filter' => 'role'],
    function ($routes) {

        $routes->get(
            '/',
            'UserController::index'
        );

        $routes->get(
            'create',
            'UserController::create'
        );

        $routes->post(
            'store',
            'UserController::store'
        );

        $routes->get(
            'edit/(:num)',
            'UserController::edit/$1'
        );

        $routes->post(
            'update/(:num)',
            'UserController::update/$1'
        );

        $routes->get(
            'delete/(:num)',
            'UserController::delete/$1'
        );

        $routes->post('notifications/read/(:num)', 'NotificationController::read/$1');
$routes->post('notifications/read-all', 'NotificationController::readAll');
    }


    
);


/**
 * =====================================================================
 *  DASHBOARD PER ROLE & PER JENIS PEMOHON
 * =====================================================================
 *
 *  Setiap role memiliki dashboard dan menu sendiri:
 *   - SUPER_ADMIN / ADMIN_ULT  -> /admin/dashboard
 *   - PETUGAS_ULT              -> /petugas/dashboard
 *   - PIMPINAN                 -> /pimpinan/dashboard
 *   - UNIT_TUJUAN              -> /unit/dashboard
 *   - PEMOHON (per jenis)      -> /{jenis}/dashboard
 *
 *  Alias dashboard/{jenis} yang lama tetap dipertahankan agar
 *  tautan lama tidak rusak.
 */

// ---------------------------------------------------------------------
// ADMIN (SUPER_ADMIN & ADMIN_ULT)
// ---------------------------------------------------------------------
$routes->get('admin', 'Admin\DashboardController::index', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT']]);
$routes->get('admin/dashboard', 'Admin\DashboardController::index', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT']]);

// ---------------------------------------------------------------------
// PIMPINAN
// ---------------------------------------------------------------------
$routes->get('pimpinan', 'PimpinanController::dashboard', ['filter' => ['auth', 'role:PIMPINAN,SUPER_ADMIN,ADMIN_ULT']]);
$routes->get('pimpinan/dashboard', 'PimpinanController::dashboard', ['filter' => ['auth', 'role:PIMPINAN,SUPER_ADMIN,ADMIN_ULT']]);
$routes->get('pimpinan/ringkasan', 'PimpinanController::ringkasan', ['filter' => ['auth', 'role:PIMPINAN,SUPER_ADMIN,ADMIN_ULT']]);

// ---------------------------------------------------------------------
// PETUGAS ULT & UNIT TUJUAN (shortcut eksplisit)
// ---------------------------------------------------------------------
$routes->get('petugas-ult/dashboard', 'PetugasController::dashboard', ['filter' => ['auth', 'role:PETUGAS_ULT,SUPER_ADMIN,ADMIN_ULT']]);
$routes->get('unit-tujuan/dashboard', 'UnitController::dashboard', ['filter' => ['auth', 'role:UNIT_TUJUAN,SUPER_ADMIN,ADMIN_ULT']]);

// ---------------------------------------------------------------------
// DASHBOARD JENIS PEMOHON (canonical: /{prefix}/dashboard)
// ---------------------------------------------------------------------
$routes->get('mahasiswa/dashboard', 'MahasiswaController::dashboard', ['filter' => 'auth']);
$routes->get('dosen/dashboard', 'DosenController::dashboard', ['filter' => 'auth']);
$routes->get('tendik/dashboard', 'TendikController::dashboard', ['filter' => 'auth']);
$routes->get('alumni/dashboard', 'AlumniController::dashboard', ['filter' => 'auth']);
$routes->get('mitra/dashboard', 'MitraController::dashboard', ['filter' => 'auth']);
$routes->get('orangtua/dashboard', 'OrangtuaController::dashboard', ['filter' => 'auth']);
$routes->get('umum/dashboard', 'UmumController::index', ['filter' => 'auth']);