<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class UmumController extends BaseController
{
    /*
     * Ambil user ID yang sedang login
     */
    private function getUserId()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            $user = session()->get('user');

            if (is_array($user)) {
                $userId = $user['id'] ?? null;
            }
        }

        return $userId;
    }


    /**
     * Dashboard umum
     */
    public function index()
    {
        // =====================================================
        // USER ID
        // =====================================================

        $userId = $this->getUserId();

        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =====================================================
        // USER
        // =====================================================

        $userModel = new UserModel();

        $user = $userModel
            ->where('id', $userId)
            ->where('deleted_at', null)
            ->first();

        if (!$user) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }


        // =====================================================
        // PROFILE
        // =====================================================

        $profileModel = new UserProfileModel();

        $profile = $profileModel
            ->where('user_id', $userId)
            ->where('deleted_at', null)
            ->first();

        if (!$profile) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Profil pengguna tidak ditemukan.'
                );
        }


        // =====================================================
        // DATABASE
        // =====================================================

        $db = \Config\Database::connect();


        // =====================================================
        // PROFILE DATA + APPLICANT TYPE
        // =====================================================

        $profileBuilder = $db
            ->table('user_profiles up');

        $profileBuilder->select('
            up.*,
            mat.code AS applicant_code
        ');

        $profileBuilder->join(
            'master_applicant_types mat',
            'mat.id = up.applicant_type_id',
            'left'
        );

        $profileBuilder
            ->where(
                'up.user_id',
                $userId
            )
            ->where(
                'up.deleted_at',
                null
            );

        $profileData = $profileBuilder
            ->get()
            ->getRowArray();


        // Kalau query profile kedua gagal mendapatkan data,
        // gunakan profile dari UserProfileModel
        if (!$profileData) {
            $profileData = $profile;
        }


        // =====================================================
        // DATA PEMOHON UMUM
        // =====================================================

        $nama =
            $profileData['name']
            ?? $profileData['student_name']
            ?? $user['full_name']
            ?? 'Pengguna';

        $email =
            $profileData['email']
            ?? $user['email']
            ?? '';

        $telepon =
            $profileData['phone']
            ?? $user['phone_number']
            ?? '';

        $foto =
            $profileData['photo']
            ?? $user['profile_photo']
            ?? null;

        $jenisPemohon =
            $profileData['applicant_code']
            ?? 'UMUM';


        // =====================================================
        // SEMUA PENGAJUAN USER
        // =====================================================

        $builder = $db
            ->table('service_requests sr');

        /*
         * Tidak menggunakan service_units
         * karena tabel tersebut tidak tersedia
         * di database.
         */
        $builder->select('
            sr.id,
            sr.ticket_number,
            sr.title,
            sr.description,
            sr.status,
            sr.priority,
            sr.submitted_at,
            sr.created_at,
            ms.name AS service_name
        ');

        // Ambil nama layanan
        $builder->join(
            'master_services ms',
            'ms.id = sr.service_id',
            'left'
        );

        $builder
            ->where(
                'sr.user_profile_id',
                $profileData['id']
            )
            ->where(
                'sr.deleted_at',
                null
            )
            ->where(
                'sr.status !=',
                'draft'
            );

        $builder->orderBy(
            'sr.created_at',
            'DESC'
        );

        $requests = $builder
            ->get()
            ->getResultArray();


        // =====================================================
        // STATISTIK
        // =====================================================

        $total = 0;
        $diproses = 0;
        $revisi = 0;
        $selesai = 0;

        foreach ($requests as $request) {

            $total++;

            $status = strtolower(
                trim(
                    $request['status'] ?? ''
                )
            );


            // -------------------------------------------------
            // DIPROSES
            // -------------------------------------------------

            if (
                in_array(
                    $status,
                    [
                        'submitted',
                        'verified',
                        'processing',
                        'processed',
                        'diproses'
                    ],
                    true
                )
            ) {
                $diproses++;
            }


            // -------------------------------------------------
            // REVISI
            // -------------------------------------------------

            if (
                in_array(
                    $status,
                    [
                        'revision',
                        'revisi'
                    ],
                    true
                )
            ) {
                $revisi++;
            }


            // -------------------------------------------------
            // SELESAI
            // -------------------------------------------------

            if (
                in_array(
                    $status,
                    [
                        'completed',
                        'selesai'
                    ],
                    true
                )
            ) {
                $selesai++;
            }
        }


        // =====================================================
        // RIWAYAT SELESAI
        // =====================================================

        $riwayat = [];

        foreach ($requests as $request) {

            $status = strtolower(
                trim(
                    $request['status'] ?? ''
                )
            );

            if (
                in_array(
                    $status,
                    [
                        'completed',
                        'selesai'
                    ],
                    true
                )
            ) {
                $riwayat[] = $request;
            }
        }


        // =====================================================
        // BATASI RIWAYAT DASHBOARD
        // =====================================================

        $riwayat = array_slice(
            $riwayat,
            0,
            5
        );


        // =====================================================
        // DATA VIEW
        // =====================================================

        $data = [

            'title' =>
                'Dashboard',

            'user' =>
                $user,

            'profile' =>
                $profileData,

            'nama' =>
                $nama,

            'email' =>
                $email,

            'telepon' =>
                $telepon,

            'foto' =>
                $foto,

            'jenisPemohon' =>
                $jenisPemohon,

            'requests' =>
                $requests,

            'riwayat' =>
                $riwayat,

            'total' =>
                $total,

            'diproses' =>
                $diproses,

            'revisi' =>
                $revisi,

            'selesai' =>
                $selesai,
        ];


        // =====================================================
        // VIEW
        // =====================================================

        return view(
            'umum/dashboard',
            $data
        );
    }
}