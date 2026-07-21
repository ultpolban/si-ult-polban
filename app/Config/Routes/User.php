<?php

$routes->group('', ['filter' => 'jwt'], function ($routes) {

    $routes->get('users', 'Api\V1\UserController::index');

    $routes->get('users/(:num)', 'Api\V1\UserController::show/$1');

    $routes->put('users/(:num)', 'Api\V1\UserController::update/$1');

    $routes->delete('users/(:num)', 'Api\V1\UserController::delete/$1');

    $routes->put(
        'users/(:num)/toggle-status',
        'Api\V1\UserController::toggleStatus/$1'
    );
});
