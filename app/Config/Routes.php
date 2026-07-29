<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// ===============================
// UNIT LAYANAN
// ===============================

$routes->get(
    'unit-layanan',
    'UnitLayanan::dashboard'
);


$routes->get(
    'unit-layanan/dashboard',
    'UnitLayanan::dashboard'
);


$routes->get(
    'unit-layanan/detail/(:num)',
    'UnitLayanan::detail/$1'
);


$routes->get(
    'unit-layanan/proses/(:num)',
    'UnitLayanan::proses/$1'
);


$routes->post(
    'unit-layanan/updateProses/(:num)',
    'UnitLayanan::updateProses/$1'
);


$routes->get(
    'unit-layanan/upload/(:num)',
    'UnitLayanan::upload/$1'
);


$routes->post(
    'unit-layanan/simpanUpload/(:num)',
    'UnitLayanan::simpanUpload/$1'
);


$routes->get(
    'unit-layanan/kirim/(:num)',
    'UnitLayanan::kirim/$1'
);


$routes->get(
    'unit-layanan/riwayat',
    'UnitLayanan::riwayat'
);