<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*
|-------------------------------------------------------------------------- 
| AUTH - LOGIN
|-------------------------------------------------------------------------- 
*/

$routes->get(
    'login',
    'Auth\AuthController::index'
);

$routes->post(
    'login',
    'Auth\AuthController::authenticate'
);


/*
|-------------------------------------------------------------------------- 
| LOGIN MFA
|-------------------------------------------------------------------------- 
*/

$routes->get(
    'login/mfa',
    'Auth\AuthController::mfa'
);

$routes->post(
    'login/mfa/verify',
    'Auth\AuthController::verifyMfa'
);


/*
|-------------------------------------------------------------------------- 
| REGISTER
|-------------------------------------------------------------------------- 
*/

$routes->get(
    'register',
    'Auth\RegisterController::index'
);

$routes->post(
    'register',
    'Auth\RegisterController::store'
);


/*
|-------------------------------------------------------------------------- 
| REGISTER MFA
|-------------------------------------------------------------------------- 
*/

$routes->get(
    'register/mfa',
    'Auth\RegisterController::mfaSetup'
);

$routes->post(
    'register/mfa/verify',
    'Auth\RegisterController::verify'
);


/*
|-------------------------------------------------------------------------- 
| REGISTER DYNAMIC FIELDS
|-------------------------------------------------------------------------- 
*/

$routes->get(
    'register/fields/(:num)',
    'Auth\RegisterController::fields/$1'
);


/*
|-------------------------------------------------------------------------- 
| LOGOUT
|-------------------------------------------------------------------------- 
*/

$routes->get(
    'logout',
    'Auth\AuthController::logout'
);


/*
|-------------------------------------------------------------------------- 
| DEFAULT DASHBOARD
|-------------------------------------------------------------------------- 
|
| Untuk:
| - SUPER_ADMIN
| - ADMIN_ULT
| - PEMOHON
|
*/

$routes->get(
    'dashboard',
    'DashboardController::index'
);


/*
|-------------------------------------------------------------------------- 
| UPT TEKNOLOGI INFORMASI DAN KOMUNIKASI
|-------------------------------------------------------------------------- 
*/

$routes->group(
    'upt-tik',
    [
        'filter' => [
            'auth',
            'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_TIK',
        ],
    ],
    static function ($routes) {

        /*
        |-------------------------------------------------------------------------- 
        | Dashboard
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            '',
            'UptTik::dashboard'
        );

        $routes->get(
            'dashboard',
            'UptTik::dashboard'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Profile
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'profile',
            'UptTik::profile'
        );

        $routes->post(
            'profile/update',
            'UptTik::updateProfile'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Data Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'data-tiket',
            'UptTik::dataTiket'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Detail Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'detail/(:num)',
            'UptTik::detail/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | PROSES TIKET
        |-------------------------------------------------------------------------- 
        |
        | GET  = membuka halaman proses
        | POST = menyimpan proses
        |
        */

        $routes->get(
            'proses/(:num)',
            'UptTik::proses/$1'
        );

        $routes->post(
            'proses/update/(:num)',
            'UptTik::updateProses/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Statistik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'statistik',
            'UptTik::statistik'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Log Aktivitas
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'log-aktivitas',
            'UptTik::logAktivitas'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Lihat File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'lihat/(:segment)',
            'UptTik::lihatFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Download File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'download/(:segment)',
            'UptTik::downloadFile/$1'
        );
    }
);


/*
|-------------------------------------------------------------------------- 
| ADMINISTRASI UMUM
|-------------------------------------------------------------------------- 
|
| Route ini menggunakan filter auth.
| Pengecekan role dilakukan di Controller AdministrasiUmum.
|
*/

$routes->group(
    'administrasi-umum',
    [
        'filter' => 'auth',
    ],
    static function ($routes) {

        /*
        |-------------------------------------------------------------------------- 
        | Dashboard
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            '',
            'AdministrasiUmum::dashboard'
        );

        $routes->get(
            'dashboard',
            'AdministrasiUmum::dashboard'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Profile
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'profile',
            'AdministrasiUmum::profile'
        );

        $routes->post(
            'profile/update',
            'AdministrasiUmum::updateProfile'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Data Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'data-tiket',
            'AdministrasiUmum::dataTiket'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Detail Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'detail/(:num)',
            'AdministrasiUmum::detail/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Proses Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'proses/(:num)',
            'AdministrasiUmum::proses/$1'
        );

        $routes->post(
            'proses/update/(:num)',
            'AdministrasiUmum::updateProses/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Upload Hasil
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'upload/(:num)',
            'AdministrasiUmum::upload/$1'
        );

        $routes->post(
            'upload/(:num)',
            'AdministrasiUmum::simpanUpload/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Lihat File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'lihat/(:segment)',
            'AdministrasiUmum::lihatFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Download File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'download/(:segment)',
            'AdministrasiUmum::downloadFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Statistik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'statistik',
            'AdministrasiUmum::statistik'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Log Aktivitas
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'log-aktivitas',
            'AdministrasiUmum::logAktivitas'
        );
    }
);


/*
|-------------------------------------------------------------------------- 
| AKADEMIK
|-------------------------------------------------------------------------- 
|
| Role:
| - SUPER_ADMIN
| - ADMIN_ULT
| - PETUGAS_AKADEMIK
|
*/

$routes->group(
    'akademik',
    [
        'filter' => [
            'auth',
            'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_AKADEMIK',
        ],
    ],
    static function ($routes) {

        /*
        |-------------------------------------------------------------------------- 
        | Dashboard Akademik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            '',
            'Akademik::dashboard'
        );

        $routes->get(
            'dashboard',
            'Akademik::dashboard'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Profile
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'profile',
            'Akademik::profile'
        );

        $routes->post(
            'profile/update',
            'Akademik::updateProfile'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Statistik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'statistik',
            'Akademik::statistik'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Log Aktivitas
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'log-aktivitas',
            'Akademik::logAktivitas'
        );

        /*
         * DIPERBAIKI:
         *
         * Controller Akademik.php memiliki:
         * - lihatLog()
         * - downloadLog()
         *
         * BUKAN:
         * - lihatDokumenLog()
         * - downloadDokumenLog()
         */

        $routes->get(
            'log-aktivitas/lihat/(:num)',
            'Akademik::lihatLog/$1'
        );

        $routes->get(
            'log-aktivitas/download/(:num)',
            'Akademik::downloadLog/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Data Tiket Akademik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'data-tiket',
            'Akademik::dataTiket'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Detail Tiket Akademik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'detail/(:num)',
            'Akademik::detail/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Proses
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'proses/(:num)',
            'Akademik::proses/$1'
        );

        $routes->post(
            'updateProses/(:num)',
            'Akademik::updateProses/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Upload
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'upload/(:num)',
            'Akademik::upload/$1'
        );

        $routes->post(
            'simpanUpload/(:num)',
            'Akademik::simpanUpload/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Lihat File
        |-------------------------------------------------------------------------- 
        */

        /*
         * DIPERBAIKI:
         *
         * Controller Akademik.php yang kamu kirim
         * memiliki method:
         *
         * public function lihat($filename)
         *
         * Jadi route harus menuju:
         * Akademik::lihat/$1
         */

        $routes->get(
            'lihat/(:segment)',
            'Akademik::lihat/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Download File
        |-------------------------------------------------------------------------- 
        */

        /*
         * DIPERBAIKI:
         *
         * Controller Akademik.php memiliki:
         *
         * public function download($filename)
         */

        $routes->get(
            'download/(:segment)',
            'Akademik::download/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Kirim
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'kirim/(:num)',
            'Akademik::kirim/$1'
        );

        $routes->get(
            'kirim-pemohon/(:num)',
            'Akademik::kirimKePemohon/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Riwayat
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'riwayat',
            'Akademik::riwayat'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Hapus Dokumen
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'hapus-dokumen/(:num)',
            'Akademik::hapusDokumen/$1'
        );
    }
);


/*
|-------------------------------------------------------------------------- 
| KEUANGAN
|-------------------------------------------------------------------------- 
|
| Role:
| - SUPER_ADMIN
| - ADMIN_ULT
| - PETUGAS_KEUANGAN
|
*/

$routes->group(
    'keuangan',
    [
        'filter' => [
            'auth',
            'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEUANGAN',
        ],
    ],
    static function ($routes) {

        /*
        |-------------------------------------------------------------------------- 
        | Dashboard Keuangan
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            '',
            'Keuangan::dashboard'
        );

        $routes->get(
            'dashboard',
            'Keuangan::dashboard'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Profile
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'profile',
            'Keuangan::profile'
        );

        $routes->post(
            'profile/update',
            'Keuangan::updateProfile'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Statistik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'statistik',
            'Keuangan::statistik'
        );

        $routes->get(
            'log-aktivitas',
            'Keuangan::logAktivitas'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Data Tiket Keuangan
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'data-tiket',
            'Keuangan::dataTiket'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Detail Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'detail/(:num)',
            'Keuangan::detail/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Proses
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'proses/(:num)',
            'Keuangan::proses/$1'
        );

        $routes->post(
            'updateProses/(:num)',
            'Keuangan::updateProses/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Upload
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'upload/(:num)',
            'Keuangan::upload/$1'
        );

        $routes->post(
            'simpanUpload/(:num)',
            'Keuangan::simpanUpload/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Lihat File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'lihat/(:segment)',
            'Keuangan::lihatFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Download File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'download/(:segment)',
            'Keuangan::downloadFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Kirim
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'kirim/(:num)',
            'Keuangan::kirim/$1'
        );

        $routes->get(
            'kirim-pemohon/(:num)',
            'Keuangan::kirimKePemohon/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Riwayat
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'riwayat',
            'Keuangan::riwayat'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Hapus Dokumen
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'hapus-dokumen/(:num)',
            'Keuangan::hapusDokumen/$1'
        );
    }
);


/*
|-------------------------------------------------------------------------- 
| KEMAHASISWAAN
|-------------------------------------------------------------------------- 
|
| Role:
| - SUPER_ADMIN
| - ADMIN_ULT
| - PETUGAS_KEMAHASISWAAN
|
*/

$routes->group(
    'kemahasiswaan',
    [
        'filter' => [
            'auth',
            'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_KEMAHASISWAAN',
        ],
    ],
    static function ($routes) {

        /*
        |-------------------------------------------------------------------------- 
        | Dashboard Kemahasiswaan
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            '',
            'Kemahasiswaan::dashboard'
        );

        $routes->get(
            'dashboard',
            'Kemahasiswaan::dashboard'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Profile
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'profile',
            'Kemahasiswaan::profile'
        );

        $routes->post(
            'profile/update',
            'Kemahasiswaan::updateProfile'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Statistik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'statistik',
            'Kemahasiswaan::statistik'
        );

        $routes->get(
            'log-aktivitas',
            'Kemahasiswaan::logAktivitas'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Data Tiket Kemahasiswaan
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'data-tiket',
            'Kemahasiswaan::dataTiket'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Detail Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'detail/(:num)',
            'Kemahasiswaan::detail/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Proses
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'proses/(:num)',
            'Kemahasiswaan::proses/$1'
        );

        $routes->post(
            'updateProses/(:num)',
            'Kemahasiswaan::updateProses/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Upload
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'upload/(:num)',
            'Kemahasiswaan::upload/$1'
        );

        $routes->post(
            'simpanUpload/(:num)',
            'Kemahasiswaan::simpanUpload/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Lihat File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'lihat/(:segment)',
            'Kemahasiswaan::lihatFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Download File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'download/(:segment)',
            'Kemahasiswaan::downloadFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Kirim
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'kirim/(:num)',
            'Kemahasiswaan::kirim/$1'
        );

        $routes->get(
            'kirim-pemohon/(:num)',
            'Kemahasiswaan::kirimKePemohon/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Riwayat
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'riwayat',
            'Kemahasiswaan::riwayat'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Hapus Dokumen
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'hapus-dokumen/(:num)',
            'Kemahasiswaan::hapusDokumen/$1'
        );
    }
);


/*
|-------------------------------------------------------------------------- 
| PERPUSTAKAAN
|-------------------------------------------------------------------------- 
|
| Role:
| - SUPER_ADMIN
| - ADMIN_ULT
| - PETUGAS_PERPUSTAKAAN
|
*/

$routes->group(
    'perpustakaan',
    [
        'filter' => [
            'auth',
            'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_PERPUSTAKAAN',
        ],
    ],
    static function ($routes) {

        /*
        |-------------------------------------------------------------------------- 
        | Dashboard
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            '',
            'Perpustakaan::dashboard'
        );

        $routes->get(
            'dashboard',
            'Perpustakaan::dashboard'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Profile
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'profile',
            'Perpustakaan::profile'
        );

        $routes->post(
            'profile/update',
            'Perpustakaan::updateProfile'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Statistik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'statistik',
            'Perpustakaan::statistik'
        );

        $routes->get(
            'log-aktivitas',
            'Perpustakaan::logAktivitas'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Data Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'data-tiket',
            'Perpustakaan::dataTiket'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Detail
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'detail/(:num)',
            'Perpustakaan::detail/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Proses
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'proses/(:num)',
            'Perpustakaan::proses/$1'
        );

        $routes->post(
            'updateProses/(:num)',
            'Perpustakaan::updateProses/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Upload
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'upload/(:num)',
            'Perpustakaan::upload/$1'
        );

        $routes->post(
            'simpanUpload/(:num)',
            'Perpustakaan::simpanUpload/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Lihat File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'lihat/(:segment)',
            'Perpustakaan::lihatFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Download File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'download/(:segment)',
            'Perpustakaan::downloadFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Kirim
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'kirim/(:num)',
            'Perpustakaan::kirim/$1'
        );

        $routes->get(
            'kirim-pemohon/(:num)',
            'Perpustakaan::kirimKePemohon/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Riwayat
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'riwayat',
            'Perpustakaan::riwayat'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Hapus Dokumen
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'hapus-dokumen/(:num)',
            'Perpustakaan::hapusDokumen/$1'
        );
    }
);


/*
|-------------------------------------------------------------------------- 
| JURUSAN
|-------------------------------------------------------------------------- 
|
| Role:
| - SUPER_ADMIN
| - ADMIN_ULT
| - PETUGAS_JURUSAN
|
*/

$routes->group(
    'jurusan',
    [
        'filter' => [
            'auth',
            'role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_JURUSAN',
        ],
    ],
    static function ($routes) {

        /*
        |-------------------------------------------------------------------------- 
        | Dashboard
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            '',
            'Jurusan::dashboard'
        );

        $routes->get(
            'dashboard',
            'Jurusan::dashboard'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Profile
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'profile',
            'Jurusan::profile'
        );

        $routes->post(
            'profile/update',
            'Jurusan::updateProfile'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Statistik
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'statistik',
            'Jurusan::statistik'
        );

        $routes->get(
            'log-aktivitas',
            'Jurusan::logAktivitas'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Data Tiket
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'data-tiket',
            'Jurusan::dataTiket'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Detail
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'detail/(:num)',
            'Jurusan::detail/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Proses
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'proses/(:num)',
            'Jurusan::proses/$1'
        );

        $routes->post(
            'updateProses/(:num)',
            'Jurusan::updateProses/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Upload
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'upload/(:num)',
            'Jurusan::upload/$1'
        );

        $routes->post(
            'simpanUpload/(:num)',
            'Jurusan::simpanUpload/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Lihat File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'lihat/(:segment)',
            'Jurusan::lihatFile/$1'
        );


        /*
        |-------------------------------------------------------------------------- 
        | Download File
        |-------------------------------------------------------------------------- 
        */

        $routes->get(
            'download/(:segment)',
            'Jurusan::downloadFile/$1'
        );
    }
);