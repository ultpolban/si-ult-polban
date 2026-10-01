<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class OrangtuaController extends BaseController
{
    protected UserModel $userModel;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel    = new UserModel();
        $this->profileModel = new UserProfileModel();
    }

    /**
     * =========================================================
     * DASHBOARD ORANGTUA
     * =========================================================
     *
     * Dashboard Orangtua dibuat dengan tampilan yang sama
     * seperti Dashboard Mahasiswa.
     *
     * TETAPI:
     * - menggunakan profile WALI
     * - menggunakan URL Orangtua
     * - tidak mengubah controller Mahasiswa
     * - data tiket hanya milik akun Orangtua
     */
    public function dashboard()
    {
        // =====================================================
        // 1. CEK LOGIN
        // =====================================================

        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =====================================================
        // 2. AMBIL USER ID
        // =====================================================

        $userId = (int) $session->get('user_id');

        if ($userId <= 0) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Sesi login tidak ditemukan.'
                );
        }


        // =====================================================
        // 3. AMBIL DATA USER
        // =====================================================

        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }


        // =====================================================
        // 4. CEK USER AKTIF
        // =====================================================

        if ((int) ($user['is_active'] ?? 0) !== 1) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun Anda tidak aktif.'
                );
        }


        // =====================================================
        // 5. AMBIL PROFILE
        // =====================================================

        $profile = $this->profileModel
            ->getComplete()
            ->where(
                'user_profiles.user_id',
                $userId
            )
            ->where(
                'user_profiles.deleted_at',
                null
            )
            ->first();


        // =====================================================
        // 6. PROFILE TIDAK DITEMUKAN
        // =====================================================

        if (!$profile) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Data profil Orangtua tidak ditemukan.'
                );
        }


        // =====================================================
        // 7. VALIDASI JENIS PEMOHON
        // =====================================================

        $applicantTypeCode = strtoupper(
            trim(
                (string) (
                    $profile['applicant_type_code']
                    ?? ''
                )
            )
        );

        if ($applicantTypeCode !== 'WALI') {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun ini bukan akun Orangtua/Wali.'
                );
        }


        // =====================================================
        // 8. USER PROFILE ID
        // =====================================================

        $userProfileId = (int) (
            $profile['id']
            ?? 0
        );


        // =====================================================
        // 9. SIMPAN PROFILE ID KE SESSION
        // =====================================================
        //
        // Tidak mengubah alur Mahasiswa.
        // Ini hanya session untuk akun WALI.
        //

        $session->set([
            'user_profile_id' => $userProfileId,
            'orangtua_profile' => $profile,
        ]);


        // =====================================================
        // 10. DATA PRIBADI ORANGTUA
        // =====================================================

        $orangtua = [

            'id' => $userId,

            'nama' =>
                $user['full_name']
                ?? $profile['name']
                ?? 'Orangtua',

            'nik' =>
                $profile['nik']
                ?? $user['identity_number']
                ?? '-',

            'email' =>
                $user['email']
                ?? $profile['email']
                ?? '-',

            'phone' =>
                $profile['phone']
                ?? $user['phone_number']
                ?? '-',

            'alamat' =>
                $profile['address']
                ?? '-',

            'status' =>
                ((int) (
                    $user['is_active']
                    ?? 0
                ) === 1)
                    ? 'Aktif'
                    : 'Tidak Aktif',
        ];


        // =====================================================
        // 11. AMBIL TIKET ORANGTUA
        // =====================================================

        $tickets = [];

        if ($userProfileId > 0) {

            $db = db_connect();

            $tickets = $db
                ->table('service_requests sr')
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
        // 12. HITUNG STATISTIK
        // =====================================================

        $total    = count($tickets);
        $diproses = 0;
        $revisi   = 0;
        $selesai  = 0;


        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim(
                    (string) (
                        $ticket['status']
                        ?? ''
                    )
                )
            );


            // -------------------------------------------------
            // SEDANG DIPROSES
            // -------------------------------------------------

            if (
                in_array(
                    $status,
                    [
                        'submitted',
                        'verification',
                        'verified',
                        'assigned',
                        'processing',
                        'processed',
                        'in_progress',
                        'diproses',
                    ],
                    true
                )
            ) {
                $diproses++;
            }


            // -------------------------------------------------
            // PERLU REVISI
            // -------------------------------------------------

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


            // -------------------------------------------------
            // SELESAI
            // -------------------------------------------------

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
        // 13. RIWAYAT PENGAJUAN
        // =====================================================

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


            // -------------------------------------------------
            // STATUS LABEL
            // -------------------------------------------------

            $statusLabel = 'Diajukan';

            $statusClass = 'status-submitted';


            if (
                in_array(
                    $status,
                    [
                        'processed',
                        'diproses',
                        'processing',
                        'in_progress',
                        'assigned',
                    ],
                    true
                )
            ) {

                $statusLabel = 'Diproses';

                $statusClass = 'status-processing';

            } elseif (
                in_array(
                    $status,
                    [
                        'revision',
                        'revisi',
                    ],
                    true
                )
            ) {

                $statusLabel = 'Perlu Revisi';

                $statusClass = 'status-revision';

            } elseif (
                in_array(
                    $status,
                    [
                        'completed',
                        'selesai',
                    ],
                    true
                )
            ) {

                $statusLabel = 'Selesai';

                $statusClass = 'status-completed';

            } elseif (
                in_array(
                    $status,
                    [
                        'rejected',
                        'ditolak',
                    ],
                    true
                )
            ) {

                $statusLabel = 'Ditolak';

                $statusClass = 'status-rejected';

            } elseif (
                in_array(
                    $status,
                    [
                        'cancelled',
                        'dibatalkan',
                    ],
                    true
                )
            ) {

                $statusLabel = 'Dibatalkan';

                $statusClass = 'status-rejected';
            }


            // -------------------------------------------------
            // DATA RIWAYAT
            // -------------------------------------------------

            $riwayat[] = [

                'id' =>
                    $ticket['id'],

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
                    $statusLabel,

                'status_class' =>
                    $statusClass,
            ];
        }


        // =====================================================
        // 14. DATA UNTUK VIEW
        // =====================================================

        $data = [

            'title' =>
                'Dashboard Orangtua',

            'user' =>
                $orangtua,

            'orangtua' =>
                $orangtua,

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


        // =====================================================
        // 15. TAMPILKAN DASHBOARD ORANGTUA
        // =====================================================

        return view(
            'orangtua/dashboard',
            $data
        );
    }
}