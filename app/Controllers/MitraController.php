<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class MitraController extends BaseController
{
    protected UserModel $userModel;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        helper(['url']);

        $this->userModel   = new UserModel();
        $this->profileModel = new UserProfileModel();
    }


    // =====================================================
    // DASHBOARD MITRA
    // =====================================================

    public function dashboard()
    {
        // =================================================
        // 1. CEK LOGIN
        // =================================================

        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =================================================
        // 2. AMBIL USER
        // =================================================

        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }


        // =================================================
        // 3. CEK USER AKTIF
        // =================================================

        if ((int) ($user['is_active'] ?? 0) !== 1) {

            session()->destroy();

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun Anda tidak aktif.'
                );
        }


        // =================================================
        // 4. AMBIL PROFILE
        // =================================================

        $profile = $this->profileModel
            ->getComplete()
            ->where(
                'user_profiles.user_id',
                $userId
            )
            ->first();


        if (!$profile) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Profil Mitra tidak ditemukan.'
                );
        }


        // =================================================
        // 5. VALIDASI APPLICANT TYPE
        // =================================================

        $applicantTypeId =
            (int) (
                $profile['applicant_type_id']
                ?? 0
            );


        $applicantType = db_connect()
            ->table('master_applicant_types')
            ->where(
                'id',
                $applicantTypeId
            )
            ->where(
                'is_active',
                1
            )
            ->get()
            ->getRowArray();


        $applicantCode = strtoupper(
            trim(
                (string) (
                    $applicantType['code']
                    ?? ''
                )
            )
        );


        if ($applicantCode !== 'MITRA') {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun ini bukan akun Mitra.'
                );
        }


        // =================================================
        // 6. DATA PEMOHON MITRA
        // =================================================

        $mitra = [

            'nama' =>
                $profile['nama']
                ?? $user['full_name']
                ?? '-',

            'email' =>
                $profile['email']
                ?? $user['email']
                ?? '-',

            'instansi' =>
                $profile['institution_name']
                ?? '-',

            'jabatan' =>
                $profile['position']
                ?? '-',

            'foto' =>
                $profile['photo']
                ?? null,
        ];


        // =================================================
        // 7. AMBIL TIKET MITRA
        // =================================================

        $db = db_connect();


        $tickets = $db
            ->table('service_requests sr')
            ->select('
                sr.*,
                ms.name AS service_name,
                msu.name AS unit_name
            ')
            ->join(
                'master_services ms',
                'ms.id = sr.service_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = ms.service_unit_id',
                'left'
            )
            ->where(
                'sr.user_profile_id',
                $profile['id']
            )
            ->where(
                'sr.deleted_at',
                null
            )
            ->orderBy(
                'sr.created_at',
                'DESC'
            )
            ->get()
            ->getResultArray();


        // =================================================
        // 8. STATISTIK
        // =================================================

        $total = 0;
        $diproses = 0;
        $revisi = 0;
        $selesai = 0;


        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim(
                    (string) (
                        $ticket['status']
                        ?? ''
                    )
                )
            );


            // Draft tidak masuk statistik pengajuan
            if ($status === 'draft') {
                continue;
            }


            $total++;


            if (
                in_array(
                    $status,
                    [
                        'submitted',
                        'verified',
                        'processing',
                        'diproses',
                        'pending',
                    ],
                    true
                )
            ) {
                $diproses++;
            }


            if (
                in_array(
                    $status,
                    [
                        'revision',
                        'revisi',
                        'need_revision',
                    ],
                    true
                )
            ) {
                $revisi++;
            }


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


        // =================================================
        // 9. RIWAYAT
        // =================================================

        $riwayat = [];


        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim(
                    (string) (
                        $ticket['status']
                        ?? ''
                    )
                )
            );


            // Hanya yang selesai
            if (
                !in_array(
                    $status,
                    [
                        'completed',
                        'selesai',
                    ],
                    true
                )
            ) {
                continue;
            }


            $riwayat[] = [

                'id' =>
                    $ticket['id']
                    ?? null,

                'nomor' =>
                    $ticket['ticket_number']
                    ?? '-',

                'layanan' =>
                    $ticket['service_name']
                    ?? '-',

                'unit_layanan' =>
                    $ticket['unit_name']
                    ?? '-',

                'created_at' =>
                    $ticket['created_at']
                    ?? null,

                'status' =>
                    $ticket['status']
                    ?? '',

                'status_label' =>
                    'Selesai',

                'status_class' =>
                    'status-completed',
            ];
        }


        // =================================================
        // 10. DATA VIEW
        // =================================================

        $data = [

            'title' =>
                'Dashboard Mitra',

            'user' =>
                $mitra,

            'mitra' =>
                $mitra,

            'statistik' => [

                'total' =>
                    $total,

                'diproses' =>
                    $diproses,

                'revisi' =>
                    $revisi,

                'selesai' =>
                    $selesai,
            ],

            'riwayat' =>
                $riwayat,
        ];


        // =================================================
        // 11. VIEW
        // =================================================

        return view(
            'mitra/dashboard',
            $data
        );
    }
}