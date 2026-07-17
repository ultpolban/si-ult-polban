<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('dashboard', function($routes){

    $routes->get('/', 'DashboardController::index');

});

$routes->group('ticket', function($routes){

    $routes->get('create', 'TicketController::create');

    $routes->post('store', 'TicketController::store');

    $routes->get('detail/(:num)', 'TicketController::detail/$1');

    $routes->get('history', 'TicketController::history');

});

$routes->group('profile', function($routes){

    $routes->get('/', 'ProfileController::index');

    $routes->get('edit', 'ProfileController::edit');

});

// Dashboard
$routes->get('/dashboard', 'DashboardController::index');

// Ticket
$routes->get('/ticket/create', 'TicketController::create');
$routes->post('/ticket/store', 'TicketController::store');
$routes->get('/ticket/history', 'TicketController::history');
$routes->get('/ticket/detail/(:num)', 'TicketController::detail/$1');

// Profile
$routes->get('/profile', 'ProfileController::index');
$routes->get('/profile/edit', 'ProfileController::edit');
$routes->post('/profile/update', 'ProfileController::update');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('ticket/create', 'TicketController::create');

$routes->post('ticket/store', 'TicketController::store');

$routes->get('ticket/success', 'TicketController::success');

$routes->get('ticket/history', 'TicketController::history');
$routes->get('ticket/detail/(:num)', 'TicketController::detail/$1');

$routes->get('profile','ProfileController::index');

$routes->get('profile/edit','ProfileController::edit');

$routes->post('profile/update','ProfileController::update');

$routes->get('dashboard/pemohon', 'DashboardController::pemohon');

$routes->get('profile', 'ProfileController::index');

$routes->get('/notification', 'NotificationController::index');

$routes->get('faq', 'FaqController::index');

$routes->get('help', 'HelpController::index');