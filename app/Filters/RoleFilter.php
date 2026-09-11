<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        /*
         * =========================================================
         * CEK LOGIN
         * =========================================================
         *
         * Sistem autentikasi menggunakan session:
         * isLoggedIn
         */
        if (!session()->get('isLoggedIn')) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }

        /*
         * =========================================================
         * CEK ROLE
         * =========================================================
         *
         * Contoh:
         *
         * filter => role:SUPER_ADMIN,ADMIN_ULT,PETUGAS_UMUM
         *
         * Role pengguna harus termasuk salah satu
         * dari role yang diperbolehkan.
         */

        // Jika route tidak memberikan daftar role,
        // izinkan karena hanya membutuhkan autentikasi.
        if (empty($arguments)) {
            return;
        }

        /*
         * =========================================================
         * AMBIL ROLE DARI SESSION
         * =========================================================
         */
        $roleCode = strtoupper(
            trim(
                (string) session()->get('role_code')
            )
        );

        /*
         * =========================================================
         * BERSIHKAN ROLE YANG DIPERBOLEHKAN
         * =========================================================
         */
        $allowedRoles = array_map(
            static function ($role) {
                return strtoupper(
                    trim(
                        (string) $role
                    )
                );
            },
            $arguments
        );

        /*
         * =========================================================
         * ROLE TIDAK DIIZINKAN
         * =========================================================
         */
        if (!in_array(
            $roleCode,
            $allowedRoles,
            true
        )) {

            /*
             * Tentukan dashboard berdasarkan role pengguna.
             */
            $dashboard = match ($roleCode) {

                'PETUGAS_AKADEMIK'
                    => '/akademik/dashboard',

                'PETUGAS_TIK'
                    => '/upt-tik/dashboard',

                'PETUGAS_UMUM'
                    => '/administrasi-umum/dashboard',

                'PETUGAS_KEUANGAN'
                    => '/keuangan/dashboard',

                'PETUGAS_KEMAHASISWAAN'
                    => '/kemahasiswaan/dashboard',

                'PETUGAS_PERPUSTAKAAN'
                    => '/perpustakaan/dashboard',

                'PETUGAS_JURUSAN'
                    => '/jurusan/dashboard',

                default
                    => '/dashboard',
            };

            return redirect()
                ->to($dashboard)
                ->with(
                    'error',
                    'Anda tidak memiliki akses ke halaman tersebut.'
                );
        }

        /*
         * =========================================================
         * ROLE DIIZINKAN
         * =========================================================
         *
         * Request dilanjutkan ke controller.
         */
        return;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        /*
         * Tidak ada aksi setelah request.
         */
    }
}