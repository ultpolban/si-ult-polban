<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $role = strtoupper(
            trim(
                (string) session()->get('role_code')
            )
        );

        switch ($role) {

            case 'SUPER_ADMIN':
            case 'ADMIN_ULT':
            case 'PEMOHON':

                return redirect()->to(
                    base_url('akademik/dashboard')
                );

            case 'PETUGAS_AKADEMIK':

                return redirect()->to(
                    base_url('akademik/dashboard')
                );

            case 'PETUGAS_TIK':

                return redirect()->to(
                    base_url('upt-tik')
                );

            case 'PETUGAS_UMUM':

                return redirect()->to(
                    base_url('administrasi-umum')
                );

            case 'PETUGAS_KEUANGAN':

                return redirect()->to(
                    base_url('keuangan/dashboard')
                );

            case 'PETUGAS_KEMAHASISWAAN':

                return redirect()->to(
                    base_url('kemahasiswaan/dashboard')
                );

            case 'PETUGAS_PERPUSTAKAAN':

                return redirect()->to(
                    base_url('perpustakaan/dashboard')
                );

            case 'PETUGAS_JURUSAN':

                return redirect()->to(
                    base_url('jurusan/dashboard')
                );

            default:

                session()->destroy();

                return redirect()
                    ->to(base_url('login'))
                    ->with(
                        'error',
                        'Role pengguna tidak dikenali.'
                    );
        }
    }
}