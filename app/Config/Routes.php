<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth\AuthController::index');

$routes->get('/login', 'Auth\AuthController::index');

$routes->post('/login', 'Auth\AuthController::authenticate');
$routes->get('/login/mfa', 'Auth\\AuthController::mfa');

$routes->post('/login/mfa/verify', 'Auth\\AuthController::verifyMfa');

$routes->get('/logout', 'Auth\AuthController::logout');

$routes->get('/register', 'Auth\RegisterController::index');

$routes->post('/register', 'Auth\RegisterController::store');

$routes->get('/register/mfa', 'Auth\RegisterController::mfaSetup');

$routes->post('/register/mfa/verify', 'Auth\RegisterController::verify');

$routes->get('/register/fields/(:num)', 'Auth\RegisterController::fields/$1');





$routes->get('/unauthorized', 'Auth\AuthController::unauthorized');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'Dashboard\DashboardController::index');

    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::update');
});

$routes->group('users', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT']], function ($routes) {

    $routes->get('/', 'Management\UserController::index');

    $routes->get('create', 'Management\UserController::create');

    $routes->get('fields/(:num)', 'Management\UserController::fields/$1');

    $routes->post('store', 'Management\UserController::store');

    $routes->get('edit/(:num)', 'Management\UserController::edit/$1');

    $routes->post('update/(:num)', 'Management\UserController::update/$1');

    $routes->get('show/(:num)', 'Management\UserController::show/$1');

    $routes->post('delete/(:num)', 'Management\UserController::delete/$1');
});

$routes->group('roles', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT']], function ($routes) {

    $routes->get('/', 'Management\RoleController::index');

    $routes->get('create', 'Management\RoleController::create');

    $routes->post('store', 'Management\RoleController::store');

    $routes->get('edit/(:num)', 'Management\RoleController::edit/$1');

    $routes->post('update/(:num)', 'Management\RoleController::update/$1');

    $routes->get('show/(:num)', 'Management\RoleController::show/$1');

    $routes->get('delete/(:num)', 'Management\RoleController::delete/$1');

    $routes->get('permissions/(:num)', 'Master\RolePermissionController::index/$1');

    $routes->post('permissions/(:num)', 'Master\RolePermissionController::save/$1');

    $routes->post('permissions/select-all/(:num)', 'Master\RolePermissionController::selectAll/$1');

    $routes->post('permissions/clear/(:num)', 'Master\RolePermissionController::clear/$1');
});

$routes->group('permissions', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT']], function ($routes) {

    $routes->get('/', 'Management\PermissionController::index');

    $routes->get('create', 'Management\PermissionController::create');

    $routes->post('store', 'Management\PermissionController::store');

    $routes->get('edit/(:num)', 'Management\PermissionController::edit/$1');

    $routes->post('update/(:num)', 'Management\PermissionController::update/$1');

    $routes->get('show/(:num)', 'Management\PermissionController::show/$1');

    $routes->get('delete/(:num)', 'Management\PermissionController::delete/$1');
});

$routes->group('master', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT']], function ($routes) {

    $routes->get('departments', 'Master\DepartmentController::index');

    $routes->get('departments/create', 'Master\DepartmentController::create');

    $routes->post('departments/store', 'Master\DepartmentController::store');

    $routes->get('departments/edit/(:num)', 'Master\DepartmentController::edit/$1');

    $routes->post('departments/update/(:num)', 'Master\DepartmentController::update/$1');

    $routes->get('departments/show/(:num)', 'Master\DepartmentController::show/$1');

    $routes->get('departments/delete/(:num)', 'Master\DepartmentController::delete/$1');

    $routes->get('departments/restore/(:num)', 'Master\DepartmentController::restore/$1');

    $routes->post('departments/change-status/(:num)', 'Master\DepartmentController::changeStatus/$1');

    $routes->get('study-programs', 'Master\StudyProgramController::index');

    $routes->get('study-programs/create', 'Master\StudyProgramController::create');

    $routes->post('study-programs/store', 'Master\StudyProgramController::store');

    $routes->get('study-programs/edit/(:num)', 'Master\StudyProgramController::edit/$1');

    $routes->post('study-programs/update/(:num)', 'Master\StudyProgramController::update/$1');

    $routes->get('study-programs/show/(:num)', 'Master\StudyProgramController::show/$1');

    $routes->get('study-programs/delete/(:num)', 'Master\StudyProgramController::delete/$1');

    $routes->get('study-programs/restore/(:num)', 'Master\StudyProgramController::restore/$1');

    $routes->post('study-programs/change-status/(:num)', 'Master\StudyProgramController::changeStatus/$1');

    $routes->get('classes', 'Master\ClassController::index');

    $routes->get('classes/create', 'Master\ClassController::create');

    $routes->post('classes/store', 'Master\ClassController::store');

    $routes->get('classes/edit/(:num)', 'Master\ClassController::edit/$1');

    $routes->post('classes/update/(:num)', 'Master\ClassController::update/$1');

    $routes->get('classes/show/(:num)', 'Master\ClassController::show/$1');

    $routes->get('classes/delete/(:num)', 'Master\ClassController::delete/$1');

    $routes->get('classes/restore/(:num)', 'Master\ClassController::restore/$1');

    $routes->post('classes/change-status/(:num)', 'Master\ClassController::changeStatus/$1');

    $routes->get('applicant-types', 'Master\ApplicantTypeController::index');

    $routes->get('applicant-types/create', 'Master\ApplicantTypeController::create');

    $routes->post('applicant-types/store', 'Master\ApplicantTypeController::store');

    $routes->get('applicant-types/edit/(:num)', 'Master\ApplicantTypeController::edit/$1');

    $routes->post('applicant-types/update/(:num)', 'Master\ApplicantTypeController::update/$1');

    $routes->get('applicant-types/show/(:num)', 'Master\ApplicantTypeController::show/$1');

    $routes->get('applicant-types/delete/(:num)', 'Master\ApplicantTypeController::delete/$1');

    $routes->get('applicant-types/restore/(:num)', 'Master\ApplicantTypeController::restore/$1');

    $routes->post('applicant-types/change-status/(:num)', 'Master\ApplicantTypeController::changeStatus/$1');

    $routes->get('service-units', 'Master\ServiceUnitController::index');

    $routes->get('service-units/create', 'Master\ServiceUnitController::create');

    $routes->post('service-units/store', 'Master\ServiceUnitController::store');

    $routes->get('service-units/edit/(:num)', 'Master\ServiceUnitController::edit/$1');

    $routes->post('service-units/update/(:num)', 'Master\ServiceUnitController::update/$1');

    $routes->get('service-units/show/(:num)', 'Master\ServiceUnitController::show/$1');

    $routes->get('service-units/delete/(:num)', 'Master\ServiceUnitController::delete/$1');

    $routes->get('service-units/restore/(:num)', 'Master\ServiceUnitController::restore/$1');

    $routes->post('service-units/change-status/(:num)', 'Master\ServiceUnitController::changeStatus/$1');

    $routes->get('service-categories', 'Master\ServiceCategoryController::index');

    $routes->get('service-categories/create', 'Master\ServiceCategoryController::create');

    $routes->post('service-categories/store', 'Master\ServiceCategoryController::store');

    $routes->get('service-categories/edit/(:num)', 'Master\ServiceCategoryController::edit/$1');

    $routes->post('service-categories/update/(:num)', 'Master\ServiceCategoryController::update/$1');

    $routes->get('service-categories/show/(:num)', 'Master\ServiceCategoryController::show/$1');

    $routes->get('service-categories/delete/(:num)', 'Master\ServiceCategoryController::delete/$1');

    $routes->get('service-categories/restore/(:num)', 'Master\ServiceCategoryController::restore/$1');

    $routes->post('service-categories/change-status/(:num)', 'Master\ServiceCategoryController::changeStatus/$1');

    $routes->get('services', 'Master\ServiceController::index');

    $routes->get('services/create', 'Master\ServiceController::create');

    $routes->post('services/store', 'Master\ServiceController::store');

    $routes->get('services/edit/(:num)', 'Master\ServiceController::edit/$1');

    $routes->post('services/update/(:num)', 'Master\ServiceController::update/$1');

    $routes->get('services/show/(:num)', 'Master\ServiceController::show/$1');

    $routes->get('services/delete/(:num)', 'Master\ServiceController::delete/$1');

    $routes->get('services/restore/(:num)', 'Master\ServiceController::restore/$1');

    $routes->post('services/change-status/(:num)', 'Master\ServiceController::changeStatus/$1');

    $routes->get('service-requirements', 'Master\ServiceRequirementController::index');

    $routes->get('service-requirements/create', 'Master\ServiceRequirementController::create');

    $routes->post('service-requirements/store', 'Master\ServiceRequirementController::store');

    $routes->get('service-requirements/edit/(:num)', 'Master\ServiceRequirementController::edit/$1');

    $routes->post('service-requirements/update/(:num)', 'Master\ServiceRequirementController::update/$1');

    $routes->get('service-requirements/show/(:num)', 'Master\ServiceRequirementController::show/$1');

    $routes->get('service-requirements/delete/(:num)', 'Master\ServiceRequirementController::delete/$1');

    $routes->get('service-requirements/restore/(:num)', 'Master\ServiceRequirementController::restore/$1');

    $routes->post('service-requirements/change-status/(:num)', 'Master\ServiceRequirementController::changeStatus/$1');
});

$routes->group('faqs', ['filter' => ['auth', 'role:SUPER_ADMIN,ADMIN_ULT']], function ($routes) {

    $routes->get('/', 'Content\FaqController::index');

    $routes->get('create', 'Content\FaqController::create');

    $routes->post('store', 'Content\FaqController::store');

    $routes->get('show/(:num)', 'Content\FaqController::show/$1');

    $routes->get('edit/(:num)', 'Content\FaqController::edit/$1');

    $routes->post('update/(:num)', 'Content\FaqController::update/$1');

    $routes->post('delete/(:num)', 'Content\FaqController::delete/$1');

    $routes->get('restore/(:num)', 'Content\FaqController::restore/$1');

    $routes->post('change-status/(:num)', 'Content\FaqController::changeStatus/$1');
});

$routes->group('service-requests', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'ServiceRequestController::index');

    $routes->get('create', 'ServiceRequestController::create');

    $routes->post('store', 'ServiceRequestController::store');

    $routes->get('show/(:num)', 'ServiceRequestController::show/$1');

    $routes->get('edit/(:num)', 'ServiceRequestController::edit/$1');

    $routes->post('update/(:num)', 'ServiceRequestController::update/$1');

    $routes->get('delete/(:num)', 'ServiceRequestController::delete/$1');
});

$routes->group('verifications', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'VerificationController::index');

    $routes->get('show/(:num)', 'VerificationController::show/$1');

    $routes->post('verify/(:num)', 'VerificationController::verify/$1');

    $routes->post('reject/(:num)', 'VerificationController::reject/$1');
});

$routes->group('notifications', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'NotificationController::index');

    $routes->get('read/(:num)', 'NotificationController::read/$1');

    $routes->get('read-all', 'NotificationController::readAll');
});

$routes->group('activity-logs', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'ActivityLogController::index');

    $routes->get('show/(:num)', 'ActivityLogController::show/$1');
});

$routes->group('tickets', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'TicketController::index');

    $routes->get('create', 'TicketController::create');

    $routes->post('store', 'TicketController::store');

    $routes->get('show/(:num)', 'TicketController::show/$1');

    $routes->get('edit/(:num)', 'TicketController::edit/$1');

    $routes->post('update/(:num)', 'TicketController::update/$1');

    $routes->post('delete/(:num)', 'TicketController::delete/$1');

    $routes->post('change-status/(:num)', 'TicketController::changeStatus/$1');
});

$routes->group('tracking', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'TrackingController::index');

    $routes->get('track', 'TrackingController::track');

    $routes->get('search', 'TrackingController::search');

    $routes->get('show/(:num)', 'TrackingController::show/$1');
});

$routes->group('reports', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'ReportController::index');

    $routes->get('export', 'ReportController::export');
});

$routes->group('statistics', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'StatisticController::index');
});
