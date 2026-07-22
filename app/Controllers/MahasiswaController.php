<?php

namespace App\Controllers;

class MahasiswaController extends BaseController
{
    // ==========================================
    // DASHBOARD MAHASISWA
    // ==========================================
    public function dashboard()
    {
        $data = [

            'title' => 'Dashboard Mahasiswa',

            'user' => [

                'nama'      => 'Alvin',
                'nim'       => '221511000',
                'prodi'     => 'D3 Teknik Informatika',
                'jurusan'   => 'Teknik Komputer dan Informatika',
                'semester'  => 6,
                'angkatan'  => 2022,
                'status'    => 'Aktif'

            ],

            'statistik' => [

                'total'      => 8,
                'diproses'   => 2,
                'revisi'     => 1,
                'selesai'    => 5,
                'notifikasi' => 6

            ],

            'jadwal' => [

                [
                    'judul'   => 'Batas Pengajuan Beasiswa',
                    'tanggal' => '25 Juli 2026'
                ],

                [
                    'judul'   => 'Pengambilan Surat',
                    'tanggal' => '28 Juli 2026'
                ]

            ],

            'akademik' => [

                'ipk'    => '3.71',
                'sks'    => 98,
                'status' => 'Aktif',
                'dosen'  => 'Dr. Budi Santoso'

            ],

            'tickets' => [

                [
                    'id'       => 1,
                    'nomor'    => 'ULT-001',
                    'layanan'  => 'Surat Aktif Kuliah',
                    'unit'     => 'Akademik',
                    'tanggal'  => '20 Juli 2026',
                    'status'   => 'Completed'
                ],

                [
                    'id'       => 2,
                    'nomor'    => 'ULT-002',
                    'layanan'  => 'Surat Beasiswa',
                    'unit'     => 'Kemahasiswaan',
                    'tanggal'  => '18 Juli 2026',
                    'status'   => 'In Progress'
                ],

                [
                    'id'       => 3,
                    'nomor'    => 'ULT-003',
                    'layanan'  => 'Legalisir Transkrip',
                    'unit'     => 'Akademik',
                    'tanggal'  => '15 Juli 2026',
                    'status'   => 'Submitted'
                ]

            ]

        ];

        return view('mahasiswa/dashboard', $data);
    }
}