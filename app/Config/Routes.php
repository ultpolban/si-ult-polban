<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::storeRegister');

$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('/dashboard', 'DashboardController::index');
    $routes->get('users/create', 'UserController::create');
    $routes->post('users/store', 'UserController::store');
});

$routes->group('users',['filter'=>'role'],function($routes){

    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');

});

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('/dashboard', 'DashboardController::index');

    $routes->get('/users', 'UserController::index');

    $routes->get('/users/create', 'UserController::create');
    $routes->post('/users/store', 'UserController::store');

    $routes->get('/users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('/users/update/(:num)', 'UserController::update/$1');

    $routes->get('/users/delete/(:num)', 'UserController::delete/$1');
    $routes->get('verification', 'VerificationController::index');
    $routes->get('verification/detail/(:num)', 'VerificationController::detail/$1');
    $routes->get('verification/verify/(:num)', 'VerificationController::verify/$1');
    $routes->get('verification/disposition/(:num)', 'VerificationController::disposition/$1');
    $routes->get('report', 'ReportController::index');
    $routes->get('statistics', 'StatisticsController::index');

    
    
});
