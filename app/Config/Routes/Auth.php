<?php

// Public
$routes->post('register', 'Api\V1\AuthController::register');

$routes->post('login', 'Api\V1\AuthController::login');


// Protected
$routes->group('', ['filter' => 'jwt'], function ($routes) {

    $routes->get('profile', 'Api\V1\AuthController::profile');

    $routes->post('logout', 'Api\V1\AuthController::logout');

    $routes->post('change-password', 'Api\V1\AuthController::changePassword');
});
