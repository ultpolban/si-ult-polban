<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Web');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
require APPPATH . 'Config/Routes/Api.php';

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Web::login');

$routes->get('login', 'Web::login');
$routes->post('login', 'AuthController::authenticate');

$routes->get('logout', 'AuthController::logout');

/*
|--------------------------------------------------------------------------
| Management Kelas
|--------------------------------------------------------------------------
*/

$routes->group('classes', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'ClassController::index');

    $routes->get('create', 'ClassController::create');
    $routes->post('store', 'ClassController::store');

    $routes->get('show/(:num)', 'ClassController::show/$1');

    $routes->get('edit/(:num)', 'ClassController::edit/$1');
    $routes->post('update/(:num)', 'ClassController::update/$1');

    $routes->post('delete/(:num)', 'ClassController::delete/$1');
});

/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/

$routes->get('register', 'AuthController::register');

$routes->post('register/store', 'AuthController::storeRegister');

/*
|--------------------------------------------------------------------------
| Ajax
|--------------------------------------------------------------------------
*/

$routes->get(
    'study-programs/(:num)',
    'AuthController::getStudyPrograms/$1'
);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

$routes->group('', ['filter' => 'auth'], function ($routes) {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    $routes->get('dashboard', 'DashboardController::index');

    /*
    |--------------------------------------------------------------------------
    | ADMINISTRATOR SAJA (role_id = 1)
    |--------------------------------------------------------------------------
    */

    $routes->group('', ['filter' => 'role:1'], function ($routes) {

        /*
        | User Management
        */

        $routes->group('users', function ($routes) {

            $routes->get('/', 'UserController::index');

            $routes->get('create', 'UserController::create');

            $routes->get('study-programs/(:num)', 'UserController::getStudyPrograms/$1');

            $routes->post('store', 'UserController::store');

            $routes->get('show/(:num)', 'UserController::show/$1');

            $routes->get('edit/(:num)', 'UserController::edit/$1');

            $routes->post('update/(:num)', 'UserController::update/$1');

            $routes->post('delete/(:num)', 'UserController::delete/$1');

            $routes->get('toggle/(:num)', 'UserController::toggle/$1');
        });

        /*
        | Role
        */

        $routes->group('roles', function ($routes) {

            $routes->get('/', 'RoleController::index');

            $routes->get('create', 'RoleController::create');
            $routes->post('store', 'RoleController::store');

            $routes->get('edit/(:num)', 'RoleController::edit/$1');
            $routes->post('update/(:num)', 'RoleController::update/$1');

            $routes->post('delete/(:num)', 'RoleController::delete/$1');
        });

        /*
        | User Type
        */

        $routes->group('user-types', function ($routes) {

            $routes->get('/', 'UserTypeController::index');

            $routes->get('create', 'UserTypeController::create');
            $routes->post('store', 'UserTypeController::store');

            $routes->get('edit/(:num)', 'UserTypeController::edit/$1');
            $routes->post('update/(:num)', 'UserTypeController::update/$1');

            $routes->post('delete/(:num)', 'UserTypeController::delete/$1');
        });

        /*
        | Department
        */

        $routes->group('departments', function ($routes) {

            $routes->get('/', 'DepartmentController::index');

            $routes->get('create', 'DepartmentController::create');
            $routes->post('store', 'DepartmentController::store');

            $routes->get('edit/(:num)', 'DepartmentController::edit/$1');
            $routes->post('update/(:num)', 'DepartmentController::update/$1');

            $routes->post('delete/(:num)', 'DepartmentController::delete/$1');
        });

        /*
        | Study Program
        */

        $routes->group('study-programs', function ($routes) {

            $routes->get('/', 'StudyProgramController::index');

            $routes->get('create', 'StudyProgramController::create');
            $routes->post('store', 'StudyProgramController::store');

            $routes->get('edit/(:num)', 'StudyProgramController::edit/$1');
            $routes->post('update/(:num)', 'StudyProgramController::update/$1');

            $routes->post('delete/(:num)', 'StudyProgramController::delete/$1');
        });

        /*
        | Work Unit
        */

        $routes->group('work-units', function ($routes) {

            $routes->get('/', 'WorkUnitController::index');

            $routes->get('create', 'WorkUnitController::create');
            $routes->post('store', 'WorkUnitController::store');

            $routes->get('edit/(:num)', 'WorkUnitController::edit/$1');
            $routes->post('update/(:num)', 'WorkUnitController::update/$1');

            $routes->post('delete/(:num)', 'WorkUnitController::delete/$1');
        });

        // Kategori Layanan
        $routes->group('kategori-layanan', function($routes) {
            $routes->get('/', 'KategoriLayananController::index');
            $routes->post('store', 'KategoriLayananController::store');
            $routes->post('update/(:num)', 'KategoriLayananController::update/$1');
            $routes->get('delete/(:num)', 'KategoriLayananController::delete/$1');
        });

        // Layanan
        $routes->group('layanan', function($routes) {
            $routes->get('/', 'LayananController::index');
            $routes->post('store', 'LayananController::store');
            $routes->post('update/(:num)', 'LayananController::update/$1');
            $routes->get('delete/(:num)', 'LayananController::delete/$1');
        });

        // Persyaratan Layanan
        $routes->group('persyaratan-layanan', function($routes) {
            $routes->get('/', 'PersyaratanLayananController::index');
            $routes->post('store', 'PersyaratanLayananController::store');
            $routes->post('update/(:num)', 'PersyaratanLayananController::update/$1');
            $routes->get('delete/(:num)', 'PersyaratanLayananController::delete/$1');
        });
    });
});

// Unit Layanan
$routes->group('unit-layanan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UnitLayananController::index');
    $routes->post('store', 'UnitLayananController::store');
    $routes->post('update/(:num)', 'UnitLayananController::update/$1');
    $routes->get('delete/(:num)', 'UnitLayananController::delete/$1');
});
$routes->group('pengajuan-layanan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PengajuanLayananController::index');
    $routes->get('create', 'PengajuanLayananController::create');
    $routes->post('store', 'PengajuanLayananController::store');
});

$routes->get('verifikasi', 'VerifikasiController::index', ['filter' => 'auth']);
$routes->get('activity-log', 'ActivityLogController::index', ['filter' => 'auth']);

$routes->get('study-programs/by-department/(:num)', 'StudyProgramController::byDepartment/$1');
$routes->get('users/partial/(:any)', 'UserController::partial/$1');

// Dashboard Jurusan (AJAX-based)
$routes->group('jurusan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'JurusanController::index');
    $routes->post('store', 'JurusanController::store');
    $routes->get('edit/(:num)', 'JurusanController::edit/$1');
    $routes->post('update/(:num)', 'JurusanController::update/$1');
    $routes->get('delete/(:num)', 'JurusanController::delete/$1');
});


// -----------------------------------------------------------------------------
// Frontend4 compatibility routes for Backend1 modules
// -----------------------------------------------------------------------------
$routes->get('permissions', 'PermissionController::index', ['filter' => 'auth']);

$routes->get('notifikasi', 'NotificationController::index', ['filter' => 'auth']);
$routes->get('notifikasi/read/(:num)', 'NotificationController::read/$1', ['filter' => 'auth']);
$routes->get('notifikasi/read-all', 'NotificationController::readAll', ['filter' => 'auth']);

$routes->get('tiket/manajemen', 'Admin::tiket', ['filter' => 'auth']);
$routes->get('tiket/buat', 'Admin::tiket', ['filter' => 'auth']);
$routes->get('tiket/lacak', 'Admin::tracking', ['filter' => 'auth']);
$routes->get('laporan', 'Admin::laporan', ['filter' => 'auth']);
$routes->get('statistik', 'Admin::statistik', ['filter' => 'auth']);
$routes->get('profil', 'ProfileController::index', ['filter' => 'auth']);
$routes->post('profil/update', 'ProfileController::update', ['filter' => 'auth']);

// Dashboard Program Studi (AJAX-based)
$routes->group('program-studi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ProgramStudiController::index');
    $routes->post('store', 'ProgramStudiController::store');
    $routes->get('edit/(:num)', 'ProgramStudiController::edit/$1');
    $routes->post('update/(:num)', 'ProgramStudiController::update/$1');
    $routes->get('delete/(:num)', 'ProgramStudiController::delete/$1');
});
