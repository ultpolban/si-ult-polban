<?php

namespace App\Controllers;

class MahasiswaController extends BaseController
{
    // ==========================================
    // DASHBOARD MAHASISWA
    // ==========================================
    public function dashboard()
    {
        $sessionUser = session()->get('user') ?? [];

        $user = [
            'nama'     => $sessionUser['nama'] ?? 'Mahasiswa',
            'nim'      => $sessionUser['nim'] ?? '-',
            'prodi'    => $sessionUser['prodi'] ?? '-',
            'jurusan'  => $sessionUser['jurusan'] ?? '-',
            'semester' => $sessionUser['semester'] ?? '-',
            'angkatan' => $sessionUser['angkatan'] ?? '-',
            'status'   => $sessionUser['status'] ?? 'Aktif',
        ];

        // ==========================================
        // AMBIL DATA TIKET
        // ==========================================

        $tickets = session()->get('mahasiswa_tickets') ?? [];

        // ==========================================
        // AMBIL DATA DRAFT
        // ==========================================

        $drafts = session()->get('mahasiswa_drafts') ?? [];

        // ==========================================
        // HITUNG STATISTIK
        // ==========================================

        $total = count($tickets);

        $diproses = 0;
        $revisi   = 0;
        $selesai  = 0;

        foreach ($tickets as $ticket) {

            $status = strtolower(
                $ticket['status'] ?? ''
            );

            if (
                in_array(
                    $status,
                    [
                        'in progress',
                        'diproses',
                        'processing',
                        'submitted'
                    ]
                )
            ) {
                $diproses++;
            }

            if (
                in_array(
                    $status,
                    [
                        'revision',
                        'revisi'
                    ]
                )
            ) {
                $revisi++;
            }

            if (
                in_array(
                    $status,
                    [
                        'completed',
                        'selesai'
                    ]
                )
            ) {
                $selesai++;
            }
        }

        // ==========================================
        // STATISTIK
        // ==========================================

        $statistik = [

            'total'      => $total,

            'diproses'   => $diproses,

            'revisi'     => $revisi,

            'selesai'    => $selesai,

            'notifikasi' => 0

        ];

        // ==========================================
        // DATA DASHBOARD
        // ==========================================

        $data = [

            'title' => 'Dashboard Mahasiswa',

            'user' => $user,

            'statistik' => $statistik,

            'tickets' => $tickets,

            'drafts' => $drafts,

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

            ]

        ];

        return view(
            'mahasiswa/dashboard',
            $data
        );
    }
}