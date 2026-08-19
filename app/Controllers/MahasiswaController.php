<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class MahasiswaController extends BaseController
{
    protected UserModel $userModel;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel    = new UserModel();
        $this->profileModel = new UserProfileModel();
    }

    // ==========================================
    // DASHBOARD MAHASISWA
    // ==========================================
   public function dashboard()
{
    // =====================================================
    // 1. AMBIL DATA USER DARI SESSION
    // =====================================================

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


    // =====================================================
    // 2. AMBIL USER PROFILE ID
    // =====================================================

    $userProfileId = session()->get('user_profile_id');


    // =====================================================
    // FALLBACK:
    // JIKA user_profile_id BELUM ADA DI SESSION
    // =====================================================

    if (empty($userProfileId)) {

        $userId = session()->get('user_id');

        if (!empty($userId)) {

            $userProfileModel = new \App\Models\UserProfileModel();

            $profile = $userProfileModel
                ->where('user_id', $userId)
                ->first();

            if ($profile) {

                $userProfileId = $profile['id'];

            }
        }
    }


    // =====================================================
    // 3. AMBIL TIKET DARI DATABASE
    // =====================================================

    $tickets = [];

    if (!empty($userProfileId)) {

        $db = \Config\Database::connect();

        $tickets = $db->table('service_requests sr')
            ->select('
                sr.id,
                sr.ticket_number,
                sr.user_profile_id,
                sr.service_id,
                sr.title,
                sr.description,
                sr.status,
                sr.priority,
                sr.submitted_at,
                sr.created_at,
                sr.updated_at,
                ms.name AS service_name
            ')
            ->join(
                'master_services ms',
                'ms.id = sr.service_id',
                'left'
            )
            ->where(
                'sr.user_profile_id',
                $userProfileId
            )
            ->where(
                'sr.deleted_at IS NULL',
                null,
                false
            )
            ->orderBy(
                'sr.created_at',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }


    // =====================================================
    // 4. HITUNG STATISTIK
    // =====================================================

    $total = count($tickets);

    $diproses = 0;

    $revisi = 0;

    $selesai = 0;


    foreach ($tickets as $ticket) {

        $status = strtolower(
            trim(
                $ticket['status'] ?? ''
            )
        );


        // ================================================
        // SEDANG DIPROSES
        // ================================================

        if (
            in_array(
                $status,
                [
                    'submitted',
                    'verification',
                    'verified',
                    'in progress',
                    'processing',
                    'processed',
                    'diproses',
                ],
                true
            )
        ) {

            $diproses++;
        }


        // ================================================
        // PERLU REVISI
        // ================================================

        if (
            in_array(
                $status,
                [
                    'revision',
                    'revisi',
                ],
                true
            )
        ) {

            $revisi++;
        }


        // ================================================
        // SELESAI
        // ================================================

        if (
            in_array(
                $status,
                [
                    'completed',
                    'selesai',
                ],
                true
            )
        ) {

            $selesai++;
        }
    }


    // =====================================================
    // 5. STATISTIK DASHBOARD
    // =====================================================

    $statistik = [

        'total' => $total,

        'diproses' => $diproses,

        'revisi' => $revisi,

        'selesai' => $selesai,

        'notifikasi' => 0,

    ];


    // =====================================================
    // 6. RIWAYAT PENGAJUAN
    // =====================================================
    // Hanya tiket yang sudah selesai.
    // Ini sesuai dengan view dashboard kamu sekarang.

    $riwayat = [];


    foreach ($tickets as $ticket) {

        $status = strtolower(
            trim(
                $ticket['status'] ?? ''
            )
        );


        if (
            in_array(
                $status,
                [
                    'completed',
                    'selesai',
                ],
                true
            )
        ) {

            $riwayat[] = [

                'id' => $ticket['id'],

                'nomor' =>
                    $ticket['ticket_number']
                    ?? '-',

                'layanan' =>
                    $ticket['service_name']
                    ?? '-',

                'unit_layanan' =>
                    '-',

                'created_at' =>
                    $ticket['created_at']
                    ?? $ticket['submitted_at']
                    ?? null,

                'status' =>
                    $ticket['status']
                    ?? 'completed',

            ];
        }
    }


    // =====================================================
    // 7. AMBIL DATA DRAFT
    // =====================================================
    // Untuk sementara tetap menggunakan session.
    // Nanti kita sambungkan ke database pada step berikutnya.

    $drafts = session()->get(
        'mahasiswa_drafts'
    ) ?? [];


    // =====================================================
    // 8. DATA DASHBOARD
    // =====================================================

    $data = [

        'title' =>
            'Dashboard Mahasiswa',

        'user' =>
            $user,

        'statistik' =>
            $statistik,

        'tickets' =>
            $tickets,

        'riwayat' =>
            $riwayat,

        'drafts' =>
            $drafts,


        // =================================================
        // JADWAL
        // =================================================

        'jadwal' => [

            [
                'judul' =>
                    'Batas Pengajuan Beasiswa',

                'tanggal' =>
                    '25 Juli 2026',
            ],

            [
                'judul' =>
                    'Pengambilan Surat',

                'tanggal' =>
                    '28 Juli 2026',
            ],

        ],


        // =================================================
        // AKADEMIK
        // =================================================

        'akademik' => [

            'ipk' =>
                '3.71',

            'sks' =>
                98,

            'status' =>
                'Aktif',

            'dosen' =>
                'Dr. Budi Santoso',

        ],

    ];


    // =====================================================
    // 9. TAMPILKAN DASHBOARD
    // =====================================================

    return view(
        'mahasiswa/dashboard',
        $data
    );
}
}