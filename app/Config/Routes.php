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

$routes->post('/register/gate', 'Auth\RegisterController::gate');

$routes->get('/registration-request', 'Auth\RegistrationRequestController::index');

$routes->post('/registration-request', 'Auth\RegistrationRequestController::store');

$routes->get('/registration-request/fields/(:num)', 'Auth\RegistrationRequestController::fields/$1');

$routes->get('/registration-request/status', 'Auth\RegistrationRequestController::status');





$routes->get('/unauthorized', 'Auth\AuthController::unauthorized');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'Dashboard\DashboardController::index', ['filter' => 'permission:dashboard.view']);

    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::update');

    // ============================================================
    // REALTIME API (JSON)
    // Dipakai polling JavaScript agar data selalu aktual ("real-time")
    // ============================================================
    $routes->get('realtime/notifications', 'RealtimeController::notifications');
    $routes->get('realtime/unread-count', 'RealtimeController::unreadCount');
    $routes->get('realtime/dashboard', 'RealtimeController::dashboardStats');
    $routes->get('realtime/tickets-last/(:num)', 'RealtimeController::lastTickets/$1');
});

$routes->group('users', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'Management\UserController::index', ['filter' => 'permission:user.view']);

    $routes->get('create', 'Management\UserController::create', ['filter' => 'permission:user.create']);

    $routes->get('fields/(:num)', 'Management\UserController::fields/$1', ['filter' => 'permission:user.create|user.update']);

    $routes->post('store', 'Management\UserController::store', ['filter' => 'permission:user.create']);

    $routes->get('edit/(:num)', 'Management\UserController::edit/$1', ['filter' => 'permission:user.update']);

    $routes->post('update/(:num)', 'Management\UserController::update/$1', ['filter' => 'permission:user.update']);

    $routes->get('show/(:num)', 'Management\UserController::show/$1', ['filter' => 'permission:user.view']);

    $routes->post('delete/(:num)', 'Management\UserController::delete/$1', ['filter' => 'permission:user.delete']);
});

/*
|--------------------------------------------------------------------------
| MANAJEMEN ROLE
|--------------------------------------------------------------------------
| Filter permission dipasang per-route (bukan OR pada level group) supaya
| kewenangan setiap aksi tepat sesuai jenis role.
| Lihat App\Constants\Permissions.
*/
$routes->group('roles', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'Management\RoleController::index', ['filter' => 'permission:role.view']);

    $routes->get('create', 'Management\RoleController::create', ['filter' => 'permission:role.create']);

    $routes->post('store', 'Management\RoleController::store', ['filter' => 'permission:role.create']);

    $routes->get('edit/(:num)', 'Management\RoleController::edit/$1', ['filter' => 'permission:role.update']);

    $routes->post('update/(:num)', 'Management\RoleController::update/$1', ['filter' => 'permission:role.update']);

    $routes->get('show/(:num)', 'Management\RoleController::show/$1', ['filter' => 'permission:role.view']);

    $routes->get('delete/(:num)', 'Management\RoleController::delete/$1', ['filter' => 'permission:role.delete']);

    // Mapping permission ke role => butuh role.update + permission.view
    $routes->get('permissions/(:num)', 'Master\RolePermissionController::index/$1', ['filter' => 'permission:role.update']);

    $routes->post('permissions/(:num)', 'Master\RolePermissionController::save/$1', ['filter' => 'permission:role.update']);

    $routes->post('permissions/select-all/(:num)', 'Master\RolePermissionController::selectAll/$1', ['filter' => 'permission:role.update']);

    $routes->post('permissions/clear/(:num)', 'Master\RolePermissionController::clear/$1', ['filter' => 'permission:role.update']);
});

$routes->group('permissions', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'Management\PermissionController::index', ['filter' => 'permission:permission.view']);

    $routes->get('create', 'Management\PermissionController::create', ['filter' => 'permission:permission.update']);

    $routes->post('store', 'Management\PermissionController::store', ['filter' => 'permission:permission.update']);

    $routes->get('edit/(:num)', 'Management\PermissionController::edit/$1', ['filter' => 'permission:permission.update']);

    $routes->post('update/(:num)', 'Management\PermissionController::update/$1', ['filter' => 'permission:permission.update']);

    $routes->get('show/(:num)', 'Management\PermissionController::show/$1', ['filter' => 'permission:permission.view']);

    $routes->get('delete/(:num)', 'Management\PermissionController::delete/$1', ['filter' => 'permission:permission.update']);
});

/*
|--------------------------------------------------------------------------
| MASTER DATA
|--------------------------------------------------------------------------
| Setiap sub-modul master punya permission sendiri (view/create/update/
| delete/restore). Filter dipasang per-route agar role hanya bisa
| mengakses modul yang memang menjadi kewenangannya.
*/
$routes->group('master', ['filter' => 'auth'], function ($routes) {

    /* ---- Departemen ---- */
    $routes->get('departments', 'Master\DepartmentController::index', ['filter' => 'permission:department.view']);

    $routes->get('departments/create', 'Master\DepartmentController::create', ['filter' => 'permission:department.create']);

    $routes->post('departments/store', 'Master\DepartmentController::store', ['filter' => 'permission:department.create']);

    $routes->get('departments/edit/(:num)', 'Master\DepartmentController::edit/$1', ['filter' => 'permission:department.update']);

    $routes->post('departments/update/(:num)', 'Master\DepartmentController::update/$1', ['filter' => 'permission:department.update']);

    $routes->get('departments/show/(:num)', 'Master\DepartmentController::show/$1', ['filter' => 'permission:department.view']);

    $routes->get('departments/delete/(:num)', 'Master\DepartmentController::delete/$1', ['filter' => 'permission:department.delete']);

    $routes->get('departments/restore/(:num)', 'Master\DepartmentController::restore/$1', ['filter' => 'permission:department.restore']);

    $routes->post('departments/change-status/(:num)', 'Master\DepartmentController::changeStatus/$1', ['filter' => 'permission:department.update']);

    /* ---- Program Studi ---- */
    $routes->get('study-programs', 'Master\StudyProgramController::index', ['filter' => 'permission:study_program.view']);

    $routes->get('study-programs/create', 'Master\StudyProgramController::create', ['filter' => 'permission:study_program.create']);

    $routes->post('study-programs/store', 'Master\StudyProgramController::store', ['filter' => 'permission:study_program.create']);

    $routes->get('study-programs/edit/(:num)', 'Master\StudyProgramController::edit/$1', ['filter' => 'permission:study_program.update']);

    $routes->post('study-programs/update/(:num)', 'Master\StudyProgramController::update/$1', ['filter' => 'permission:study_program.update']);

    $routes->get('study-programs/show/(:num)', 'Master\StudyProgramController::show/$1', ['filter' => 'permission:study_program.view']);

    $routes->get('study-programs/delete/(:num)', 'Master\StudyProgramController::delete/$1', ['filter' => 'permission:study_program.delete']);

    $routes->get('study-programs/restore/(:num)', 'Master\StudyProgramController::restore/$1', ['filter' => 'permission:study_program.restore']);

    $routes->post('study-programs/change-status/(:num)', 'Master\StudyProgramController::changeStatus/$1', ['filter' => 'permission:study_program.update']);

    /* ---- Kelas ---- */
    $routes->get('classes', 'Master\ClassController::index', ['filter' => 'permission:class.view']);

    $routes->get('classes/create', 'Master\ClassController::create', ['filter' => 'permission:class.create']);

    $routes->post('classes/store', 'Master\ClassController::store', ['filter' => 'permission:class.create']);

    $routes->get('classes/edit/(:num)', 'Master\ClassController::edit/$1', ['filter' => 'permission:class.update']);

    $routes->post('classes/update/(:num)', 'Master\ClassController::update/$1', ['filter' => 'permission:class.update']);

    $routes->get('classes/show/(:num)', 'Master\ClassController::show/$1', ['filter' => 'permission:class.view']);

    $routes->get('classes/delete/(:num)', 'Master\ClassController::delete/$1', ['filter' => 'permission:class.delete']);

    $routes->get('classes/restore/(:num)', 'Master\ClassController::restore/$1', ['filter' => 'permission:class.restore']);

    $routes->post('classes/change-status/(:num)', 'Master\ClassController::changeStatus/$1', ['filter' => 'permission:class.update']);

    /* ---- Jenis Pemohon ---- */
    $routes->get('applicant-types', 'Master\ApplicantTypeController::index', ['filter' => 'permission:applicant_type.view']);

    $routes->get('applicant-types/create', 'Master\ApplicantTypeController::create', ['filter' => 'permission:applicant_type.create']);

    $routes->post('applicant-types/store', 'Master\ApplicantTypeController::store', ['filter' => 'permission:applicant_type.create']);

    $routes->get('applicant-types/edit/(:num)', 'Master\ApplicantTypeController::edit/$1', ['filter' => 'permission:applicant_type.update']);

    $routes->post('applicant-types/update/(:num)', 'Master\ApplicantTypeController::update/$1', ['filter' => 'permission:applicant_type.update']);

    $routes->get('applicant-types/show/(:num)', 'Master\ApplicantTypeController::show/$1', ['filter' => 'permission:applicant_type.view']);

    $routes->get('applicant-types/delete/(:num)', 'Master\ApplicantTypeController::delete/$1', ['filter' => 'permission:applicant_type.delete']);

    $routes->get('applicant-types/restore/(:num)', 'Master\ApplicantTypeController::restore/$1', ['filter' => 'permission:applicant_type.restore']);

    $routes->post('applicant-types/change-status/(:num)', 'Master\ApplicantTypeController::changeStatus/$1', ['filter' => 'permission:applicant_type.update']);

    /* ---- Unit Layanan ---- */
    $routes->get('service-units', 'Master\ServiceUnitController::index', ['filter' => 'permission:service_unit.view']);

    $routes->get('service-units/create', 'Master\ServiceUnitController::create', ['filter' => 'permission:service_unit.create']);

    $routes->post('service-units/store', 'Master\ServiceUnitController::store', ['filter' => 'permission:service_unit.create']);

    $routes->get('service-units/edit/(:num)', 'Master\ServiceUnitController::edit/$1', ['filter' => 'permission:service_unit.update']);

    $routes->post('service-units/update/(:num)', 'Master\ServiceUnitController::update/$1', ['filter' => 'permission:service_unit.update']);

    $routes->get('service-units/show/(:num)', 'Master\ServiceUnitController::show/$1', ['filter' => 'permission:service_unit.view']);

    $routes->get('service-units/delete/(:num)', 'Master\ServiceUnitController::delete/$1', ['filter' => 'permission:service_unit.delete']);

    $routes->get('service-units/restore/(:num)', 'Master\ServiceUnitController::restore/$1', ['filter' => 'permission:service_unit.restore']);

    $routes->post('service-units/change-status/(:num)', 'Master\ServiceUnitController::changeStatus/$1', ['filter' => 'permission:service_unit.update']);

    /* ---- Kategori Layanan ---- */
    $routes->get('service-categories', 'Master\ServiceCategoryController::index', ['filter' => 'permission:service_category.view']);

    $routes->get('service-categories/create', 'Master\ServiceCategoryController::create', ['filter' => 'permission:service_category.create']);

    $routes->post('service-categories/store', 'Master\ServiceCategoryController::store', ['filter' => 'permission:service_category.create']);

    $routes->get('service-categories/edit/(:num)', 'Master\ServiceCategoryController::edit/$1', ['filter' => 'permission:service_category.update']);

    $routes->post('service-categories/update/(:num)', 'Master\ServiceCategoryController::update/$1', ['filter' => 'permission:service_category.update']);

    $routes->get('service-categories/show/(:num)', 'Master\ServiceCategoryController::show/$1', ['filter' => 'permission:service_category.view']);

    $routes->get('service-categories/delete/(:num)', 'Master\ServiceCategoryController::delete/$1', ['filter' => 'permission:service_category.delete']);

    $routes->get('service-categories/restore/(:num)', 'Master\ServiceCategoryController::restore/$1', ['filter' => 'permission:service_category.restore']);

    $routes->post('service-categories/change-status/(:num)', 'Master\ServiceCategoryController::changeStatus/$1', ['filter' => 'permission:service_category.update']);

    /* ---- Layanan ---- */
    $routes->get('services', 'Master\ServiceController::index', ['filter' => 'permission:service.view']);

    $routes->get('services/create', 'Master\ServiceController::create', ['filter' => 'permission:service.create']);

    $routes->post('services/store', 'Master\ServiceController::store', ['filter' => 'permission:service.create']);

    $routes->get('services/edit/(:num)', 'Master\ServiceController::edit/$1', ['filter' => 'permission:service.update']);

    $routes->post('services/update/(:num)', 'Master\ServiceController::update/$1', ['filter' => 'permission:service.update']);

    $routes->get('services/show/(:num)', 'Master\ServiceController::show/$1', ['filter' => 'permission:service.view']);

    $routes->get('services/delete/(:num)', 'Master\ServiceController::delete/$1', ['filter' => 'permission:service.delete']);

    $routes->get('services/restore/(:num)', 'Master\ServiceController::restore/$1', ['filter' => 'permission:service.restore']);

    $routes->post('services/change-status/(:num)', 'Master\ServiceController::changeStatus/$1', ['filter' => 'permission:service.update']);

    /* ---- Persyaratan Layanan ---- */
    $routes->get('service-requirements', 'Master\ServiceRequirementController::index', ['filter' => 'permission:service_requirement.view']);

    $routes->get('service-requirements/create', 'Master\ServiceRequirementController::create', ['filter' => 'permission:service_requirement.create']);

    $routes->post('service-requirements/store', 'Master\ServiceRequirementController::store', ['filter' => 'permission:service_requirement.create']);

    $routes->get('service-requirements/edit/(:num)', 'Master\ServiceRequirementController::edit/$1', ['filter' => 'permission:service_requirement.update']);

    $routes->post('service-requirements/update/(:num)', 'Master\ServiceRequirementController::update/$1', ['filter' => 'permission:service_requirement.update']);

    $routes->get('service-requirements/show/(:num)', 'Master\ServiceRequirementController::show/$1', ['filter' => 'permission:service_requirement.view']);

    $routes->get('service-requirements/delete/(:num)', 'Master\ServiceRequirementController::delete/$1', ['filter' => 'permission:service_requirement.delete']);

    $routes->get('service-requirements/restore/(:num)', 'Master\ServiceRequirementController::restore/$1', ['filter' => 'permission:service_requirement.restore']);

    $routes->post('service-requirements/change-status/(:num)', 'Master\ServiceRequirementController::changeStatus/$1', ['filter' => 'permission:service_requirement.update']);
});

$routes->group('faqs', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'Content\FaqController::index', ['filter' => 'permission:faq.view']);

    $routes->get('create', 'Content\FaqController::create', ['filter' => 'permission:faq.create']);

    $routes->post('store', 'Content\FaqController::store', ['filter' => 'permission:faq.create']);

    $routes->get('show/(:num)', 'Content\FaqController::show/$1', ['filter' => 'permission:faq.view']);

    $routes->get('edit/(:num)', 'Content\FaqController::edit/$1', ['filter' => 'permission:faq.update']);

    $routes->post('update/(:num)', 'Content\FaqController::update/$1', ['filter' => 'permission:faq.update']);

    $routes->post('delete/(:num)', 'Content\FaqController::delete/$1', ['filter' => 'permission:faq.delete']);

    $routes->get('restore/(:num)', 'Content\FaqController::restore/$1', ['filter' => 'permission:faq.restore']);

    $routes->post('change-status/(:num)', 'Content\FaqController::changeStatus/$1', ['filter' => 'permission:faq.update']);
});
$routes->group('units-profiles', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Content\UnitsProfileController::index', ['filter' => 'permission:unit_profile.view']);
    $routes->get('create', 'Content\UnitsProfileController::create', ['filter' => 'permission:unit_profile.create']);
    $routes->post('store', 'Content\UnitsProfileController::store', ['filter' => 'permission:unit_profile.create']);
    $routes->get('show/(:num)', 'Content\UnitsProfileController::show/$1', ['filter' => 'permission:unit_profile.view']);
    $routes->get('edit/(:num)', 'Content\UnitsProfileController::edit/$1', ['filter' => 'permission:unit_profile.update']);
    $routes->post('update/(:num)', 'Content\UnitsProfileController::update/$1', ['filter' => 'permission:unit_profile.update']);
    $routes->post('delete/(:num)', 'Content\UnitsProfileController::delete/$1', ['filter' => 'permission:unit_profile.delete']);
    $routes->get('restore/(:num)', 'Content\UnitsProfileController::restore/$1', ['filter' => 'permission:unit_profile.restore']);
    $routes->post('change-status/(:num)', 'Content\UnitsProfileController::changeStatus/$1', ['filter' => 'permission:unit_profile.update']);
});
$routes->group('registration-requests', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'Management\RegistrationRequestController::index', ['filter' => 'permission:registration_request.view']);

    $routes->get('show/(:num)', 'Management\RegistrationRequestController::show/$1', ['filter' => 'permission:registration_request.view']);

    $routes->post('approve/(:num)', 'Management\RegistrationRequestController::approve/$1', ['filter' => 'permission:registration_request.approve']);

    $routes->post('reject/(:num)', 'Management\RegistrationRequestController::reject/$1', ['filter' => 'permission:registration_request.reject']);
});


/*
|--------------------------------------------------------------------------
| PENGAJUAN LAYANAN (service-requests)
|--------------------------------------------------------------------------
| Satu sumber data dengan modul Tiket. Filter dipasang per-route agar
| pemohon hanya bisa create/cancel, sedangkan petugas/unit tujuan bisa update.
*/
$routes->group('service-requests', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'ServiceRequestController::index', ['filter' => 'permission:request.view']);

    $routes->get('create', 'ServiceRequestController::create', ['filter' => 'permission:request.create']);

    $routes->post('store', 'ServiceRequestController::store', ['filter' => 'permission:request.create']);

    $routes->get('show/(:num)', 'ServiceRequestController::show/$1', ['filter' => 'permission:request.view']);

    $routes->get('edit/(:num)', 'ServiceRequestController::edit/$1', ['filter' => 'permission:request.update']);

    $routes->post('update/(:num)', 'ServiceRequestController::update/$1', ['filter' => 'permission:request.update']);

    $routes->get('delete/(:num)', 'ServiceRequestController::delete/$1', ['filter' => 'permission:request.cancel']);
});

/*
|--------------------------------------------------------------------------
| VERIFIKASI PENGAJUAN
|--------------------------------------------------------------------------
| Hanya Petugas/Admin ULT (request.verify) yang boleh melihat & memverifikasi.
| Penolakan membutuhkan request.reject.
*/
$routes->group('verifications', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'VerificationController::index', ['filter' => 'permission:request.verify']);

    $routes->get('show/(:num)', 'VerificationController::show/$1', ['filter' => 'permission:request.verify']);

    $routes->post('verify/(:num)', 'VerificationController::verify/$1', ['filter' => 'permission:request.verify']);

    $routes->post('reject/(:num)', 'VerificationController::reject/$1', ['filter' => 'permission:request.reject']);
});

$routes->group('notifications', ['filter' => ['auth', 'permission:notification.view']], function ($routes) {

    $routes->get('/', 'NotificationController::index');

    $routes->get('read/(:num)', 'NotificationController::read/$1');

    $routes->get('read-all', 'NotificationController::readAll');
});

$routes->group('activity-logs', ['filter' => ['auth', 'permission:activity_log.view']], function ($routes) {

    $routes->get('/', 'ActivityLogController::index');

    $routes->get('show/(:num)', 'ActivityLogController::show/$1');
});

$routes->group('tickets', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'TicketController::index', ['filter' => 'permission:request.view']);

    $routes->get('create', 'TicketController::create', ['filter' => 'permission:request.create']);

    $routes->post('store', 'TicketController::store', ['filter' => 'permission:request.create']);

    $routes->get('show/(:num)', 'TicketController::show/$1', ['filter' => 'permission:request.view']);

    $routes->get('edit/(:num)', 'TicketController::edit/$1', ['filter' => 'permission:request.update']);

    $routes->post('update/(:num)', 'TicketController::update/$1', ['filter' => 'permission:request.update']);

    $routes->post('delete/(:num)', 'TicketController::delete/$1', ['filter' => 'permission:request.cancel']);

    $routes->post('change-status/(:num)', 'TicketController::changeStatus/$1', ['filter' => 'permission:request.update']);
});

/*
|--------------------------------------------------------------------------
| LACAK TIKET (tracking)
|--------------------------------------------------------------------------
| Semua role yang punya request.view boleh melacak. Controller tetap
| membatasi Pemohon hanya melihat tiket miliknya sendiri.
*/
$routes->group('tracking', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'TrackingController::index', ['filter' => 'permission:request.view']);

    $routes->get('track', 'TrackingController::track', ['filter' => 'permission:request.view']);

    $routes->get('search', 'TrackingController::search', ['filter' => 'permission:request.view']);

    $routes->get('show/(:num)', 'TrackingController::show/$1', ['filter' => 'permission:request.view']);
});

/*
|--------------------------------------------------------------------------
| LAPORAN (reports)
|--------------------------------------------------------------------------
| Melihat laporan cukup report.view; mengunduh butuh report.export.
*/
$routes->group('reports', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'ReportController::index', ['filter' => 'permission:report.view']);

    $routes->get('export', 'ReportController::export', ['filter' => 'permission:report.export']);
});

/*
|--------------------------------------------------------------------------
| STATISTIK (statistics)
|--------------------------------------------------------------------------
*/
$routes->group('statistics', ['filter' => ['auth', 'permission:statistic.view']], function ($routes) {

    $routes->get('/', 'StatisticController::index');
});
