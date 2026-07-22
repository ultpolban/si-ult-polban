<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('DashboardController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);



/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

$routes->get('/', 'DashboardController::index');

$routes->get(
    'dashboard',
    'DashboardController::index'
);





/*
|--------------------------------------------------------------------------
| UNIT KERJA
|--------------------------------------------------------------------------
*/

$routes->get(
    'unit',
    'UnitController::index'
);


$routes->get(
    'unit/create',
    'UnitController::create'
);


$routes->post(
    'unit/store',
    'UnitController::store'
);


$routes->get(
    'unit/edit/(:num)',
    'UnitController::edit/$1'
);


$routes->post(
    'unit/update/(:num)',
    'UnitController::update/$1'
);


$routes->get(
    'unit/delete/(:num)',
    'UnitController::delete/$1'
);







/*
|--------------------------------------------------------------------------
| KATEGORI LAYANAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'kategori',
    'KategoriController::index'
);


$routes->get(
    'kategori/create',
    'KategoriController::create'
);


$routes->post(
    'kategori/store',
    'KategoriController::store'
);


$routes->get(
    'kategori/edit/(:num)',
    'KategoriController::edit/$1'
);


$routes->post(
    'kategori/update/(:num)',
    'KategoriController::update/$1'
);


$routes->get(
    'kategori/delete/(:num)',
    'KategoriController::delete/$1'
);







/*
|--------------------------------------------------------------------------
| LAYANAN
|--------------------------------------------------------------------------
*/

$routes->get(
    'layanan',
    'Layanan::index'
);


$routes->get(
    'layanan/create',
    'Layanan::create'
);


$routes->post(
    'layanan/store',
    'Layanan::store'
);


$routes->get(
    'layanan/edit/(:num)',
    'Layanan::edit/$1'
);


$routes->post(
    'layanan/update/(:num)',
    'Layanan::update/$1'
);


$routes->get(
    'layanan/delete/(:num)',
    'Layanan::delete/$1'
);


/*
|--------------------------------------------------------------------------
| PERSYARATAN LAYANAN
|--------------------------------------------------------------------------
*/


$routes->get(
    'persyaratan',
    'Persyaratan::index'
);


$routes->get(
    'persyaratan/create',
    'Persyaratan::create'
);


$routes->post(
    'persyaratan/store',
    'Persyaratan::store'
);


$routes->get(
    'persyaratan/edit/(:num)',
    'Persyaratan::edit/$1'
);


$routes->post(
    'persyaratan/update/(:num)',
    'Persyaratan::update/$1'
);


$routes->get(
    'persyaratan/delete/(:num)',
    'Persyaratan::delete/$1'
);