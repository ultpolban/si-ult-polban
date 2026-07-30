<?php

namespace App\Controllers;

class DosenController extends BaseController
{
    // ==========================================
    // DASHBOARD DOSEN
    // ==========================================
    public function dashboard()
    {
        // ==========================================
        // DATA USER LOGIN
        // ==========================================

        $sessionUser = session()->get('user') ?? [];

        // ==========================================
        // PROFILE DOSEN
        // ==========================================

        $profile = session()->get('dosen_profile');

        if (!$profile) {

            $profile = [

                // ==========================
                // DATA PRIBADI
                // ==========================

                'nama'            => $sessionUser['nama'] ?? 'Dr. Andi Saputra',

                'nip'             => $sessionUser['nip'] ?? '198812312020011001',

                'nidn'            => $sessionUser['nidn'] ?? '0011223344',

                'nik'             => $sessionUser['nik'] ?? '',

                'email'           => $sessionUser['email'] ?? 'andi@polban.ac.id',

                'no_hp'           => $sessionUser['no_hp'] ?? '',

                'jenis_kelamin'   => $sessionUser['jenis_kelamin'] ?? 'Laki-laki',

                'alamat'          => $sessionUser['alamat'] ?? '',

                'foto'            => $sessionUser['foto'] ?? null,

                // ==========================
                // AKADEMIK
                // ==========================

                'prodi'           => $sessionUser['prodi'] ?? 'D3 Teknik Informatika',

                'jurusan'         => $sessionUser['jurusan'] ?? 'Teknik Komputer dan Informatika',

                'fakultas'        => $sessionUser['fakultas'] ?? 'Sekolah Vokasi',

                'jabatan'         => $sessionUser['jabatan'] ?? 'Dosen',

                'status'          => $sessionUser['status'] ?? 'Aktif'

            ];

            session()->set(
                'dosen_profile',
                $profile
            );
        }

        // ==========================================
        // DATA TIKET
        // ==========================================

        $tickets = session()->get('dosen_tickets') ?? [];

        // ==========================================
        // HITUNG STATISTIK
        // ==========================================

        $total = count($tickets);

        $diproses = 0;

        $revisi = 0;

        $selesai = 0;

        foreach ($tickets as $ticket) {

            switch ($ticket['status']) {

                case 'In Progress':
                    $diproses++;
                    break;

                case 'Revision':
                    $revisi++;
                    break;

                case 'Completed':
                    $selesai++;
                    break;
            }
        }

        // ==========================================
        // DATA VIEW
        // ==========================================

        $data = [

            'title' => 'Dashboard Dosen',

            'user' => $profile,

            'statistik' => [

                'total' => $total,

                'diproses' => $diproses,

                'revisi' => $revisi,

                'selesai' => $selesai

            ],

            'tickets' => array_reverse($tickets)

        ];

        return view(
            'dosen/dashboard',
            $data
        );
    }
}