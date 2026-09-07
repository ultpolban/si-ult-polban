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
$routes->get('login', 'Auth\AuthController::index');
$routes->post('login', 'Auth\AuthController::authenticate');
$routes->get('login/mfa', 'Auth\AuthController::mfa');
$routes->post('login/mfa/verify', 'Auth\AuthController::verifyMfa');

// ============================================================
// REGISTER
// ============================================================
$routes->get('register', 'Auth\RegisterController::index');
$routes->post('register', 'Auth\RegisterController::store');

$routes->get('register/mfa', 'Auth\RegisterController::mfaSetup');
$routes->post('register/mfa/verify', 'Auth\RegisterController::verify');

$routes->get(
    'register/fields/(:num)',
    'Auth\RegisterController::fields/$1'
);

$routes->get('logout', 'Auth\AuthController::logout');


// ============================================================
// ROUTE DENGAN FILTER AUTH
// ============================================================
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // ========================================================
    // DASHBOARD & PROFIL
    // ========================================================
    $routes->get('dashboard', 'DashboardController::index');

    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/edit', 'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');


    // ========================================================
    // DATA TIKET UTAMA
    // ========================================================
    $routes->get(
        'datatiket',
        'DataTicketController::index'
    );

    // EXPORT DATA TIKET
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

        // ----------------------------------------------------
        // DAFTAR TIKET MENUNGGU VERIFIKASI
        // GET /verification
        // ----------------------------------------------------
        $routes->get(
            '/',
            'VerificationController::index'
        );

        // ----------------------------------------------------
        // DETAIL TIKET
        // GET /verification/detail/22
        // ----------------------------------------------------
        $routes->get(
            'detail/(:num)',
            'VerificationController::detail/$1'
        );

        // ----------------------------------------------------
        // FORM VERIFIKASI
        // GET /verification/verify/22
        // ----------------------------------------------------
        $routes->get(
            'verify/(:num)',
            'VerificationController::verify/$1'
        );

        // ----------------------------------------------------
        // PROSES SIMPAN VERIFIKASI
        // POST /verification/process/22
        // ----------------------------------------------------
        $routes->post(
            'process/(:num)',
            'VerificationController::process/$1'
        );

    });


    // ========================================================
    // DISPOSISI TIKET
    // ========================================================
    $routes->group('disposition', function ($routes) {

        // Daftar disposisi
        $routes->get(
            '/',
            'DispositionController::index'
        );

        // Form disposisi
        $routes->get(
            'create/(:num)',
            'DispositionController::create/$1'
        );

        // Detail disposisi
        $routes->get(
            'detail/(:num)',
            'DispositionController::detail/$1'
        );

        // Proses disposisi
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
    // ========================================================
    $routes->get(
        'online',
        'OnlineController::index'
    );

    $routes->get(
        'online/create',
        'OnlineController::create'
    );

    $routes->post(
        'online/store',
        'OnlineController::store'
    );

    $routes->get(
        'online/success/(:any)',
        'OnlineController::success/$1'
    );

    $routes->get(
        'online/history',
        'OnlineController::history'
    );

    $routes->get(
        'online/detail/(:num)',
        'OnlineController::detail/$1'
    );

    $routes->get(
        'online/edit/(:num)',
        'OnlineController::edit/$1'
    );

    $routes->post(
        'online/update/(:num)',
        'OnlineController::update/$1'
    );

    $routes->get(
        'online/delete/(:num)',
        'OnlineController::delete/$1'
    );


    // ========================================================
    // STATISTIK & TRACKING
    // ========================================================
    $routes->get(
        'statistics',
        'StatisticsController::index'
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


// ============================================================
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
    }
);