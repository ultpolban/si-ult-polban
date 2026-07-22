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

$routes->get('register', 'RegisterController::index');
$routes->post('register', 'RegisterController::store');

$routes->get(
    'study-programs/(:num)',
    'RegisterController::getStudyPrograms/$1'
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

            $routes->get('delete/(:num)', 'RoleController::delete/$1');
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

            $routes->get('delete/(:num)', 'UserTypeController::delete/$1');
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

            $routes->get('delete/(:num)', 'DepartmentController::delete/$1');
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

            $routes->get('delete/(:num)', 'StudyProgramController::delete/$1');
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

            $routes->get('delete/(:num)', 'WorkUnitController::delete/$1');
        });
    });
});

$routes->get('study-programs/by-department/(:num)', 'StudyProgramController::byDepartment/$1');
$routes->get('users/partial/(:any)', 'UserController::partial/$1');
