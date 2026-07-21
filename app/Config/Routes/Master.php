<?php

$routes->group('', ['filter' => 'jwt'], function ($routes) {

    $routes->get('departments', 'Api\V1\DepartmentController::index');

    $routes->get('departments/(:num)', 'Api\V1\DepartmentController::show/$1');

    $routes->get('study-programs', 'Api\V1\StudyProgramController::index');

    $routes->get('work-units', 'Api\V1\WorkUnitController::index');

    $routes->get('roles', 'Api\V1\RoleController::index');

    $routes->get('user-types', 'Api\V1\UserTypeController::index');

    $routes->post('departments', 'Api\V1\DepartmentController::store');

    $routes->put('departments/(:num)', 'Api\V1\DepartmentController::update/$1');

    $routes->delete('departments/(:num)', 'Api\V1\DepartmentController::delete/$1');
});
