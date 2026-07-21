<?php

$routes->group('', ['filter' => 'jwt'], function ($routes) {

    // Melihat semua program studi
    $routes->get(
        'study-programs',
        'Api\V1\StudyProgramController::index'
    );

    // Detail program studi
    $routes->get(
        'study-programs/(:num)',
        'Api\V1\StudyProgramController::show/$1'
    );

    // Tambah program studi
    $routes->post(
        'study-programs',
        'Api\V1\StudyProgramController::store'
    );

    // Update program studi
    $routes->put(
        'study-programs/(:num)',
        'Api\V1\StudyProgramController::update/$1'
    );

    // Hapus program studi
    $routes->delete(
        'study-programs/(:num)',
        'Api\V1\StudyProgramController::delete/$1'
    );
});
