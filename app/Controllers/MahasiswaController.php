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

    // =====================================================
    // DASHBOARD MAHASISWA
    // =====================================================
    public function dashboard()
    {
        // =====================================================
        // 1. CEK LOGIN
        // =====================================================

        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        // =====================================================
        // 2. AMBIL DATA USER
        // =====================================================

        $user = $this->userModel->find($userId);

        if (! $user) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        // Pastikan akun aktif
        if ((int) ($user['is_active'] ?? 0) !== 1) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Akun Anda tidak aktif.');
        }

        // =====================================================
        // 3. AMBIL PROFILE USER
        // =====================================================

        $profile = $this->profileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        if (! $profile) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Profil mahasiswa tidak ditemukan.'
                );
        }

        // =====================================================
        // 4. VALIDASI JENIS PEMOHON
        // =====================================================

        $applicantTypeId = (int) (
            $profile['applicant_type_id'] ?? 0
        );

        $applicantType = null;

        if ($applicantTypeId > 0) {
            $applicantType = db_connect()
                ->table('master_applicant_types')
                ->select('id, code, name')
                ->where('id', $applicantTypeId)
                ->where('is_active', 1)
                ->get()
                ->getRowArray();
        }

        /*
         * Kita izinkan beberapa kemungkinan kode mahasiswa
         * supaya tidak error hanya karena penamaan kode berbeda
         * di database.
         */
        $applicantCode = strtoupper(
            trim((string) ($applicantType['code'] ?? ''))
        );

        $applicantName = strtolower(
            trim((string) ($applicantType['name'] ?? ''))
        );

        $isMahasiswa =
            in_array(
                $applicantCode,
                ['MHS', 'MAHASISWA'],
                true
            )
            ||
            str_contains(
                $applicantName,
                'mahasiswa'
            );

        if (! $isMahasiswa) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun ini bukan pemohon mahasiswa.'
                );
        }

        // =====================================================
        // 5. DATA MAHASISWA
        // =====================================================

        $mahasiswa = [
            'id' => $userId,

            'nama' =>
                $user['full_name']
                ?? $profile['name']
                ?? '-',

            'nim' =>
                $profile['nim']
                ?? '-',

            'prodi' =>
                $profile['study_program_name']
                ?? '-',

            'jurusan' =>
                $profile['department_name']
                ?? '-',

            'status' =>
                ((int) ($user['is_active'] ?? 0) === 1)
                    ? 'Aktif'
                    : 'Tidak Aktif',
        ];

        // =====================================================
        // 6. USER PROFILE ID
        // =====================================================

        $userProfileId = (int) (
            $profile['id'] ?? 0
        );

        // =====================================================
        // 7. AMBIL TIKET MAHASISWA
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
        // 8. HITUNG STATISTIK
        // =====================================================

        $total    = count($tickets);
        $diproses = 0;
        $revisi   = 0;
        $selesai  = 0;

        foreach ($tickets as $ticket) {
            $status = strtolower(
                trim((string) ($ticket['status'] ?? ''))
            );

            // Sedang diproses
            if (in_array(
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
            )) {
                $diproses++;
            }

            // Perlu revisi
            if (in_array(
                $status,
                [
                    'revision',
                    'revisi',
                ],
                true
            )) {
                $revisi++;
            }

            // Selesai
            if (in_array(
                $status,
                [
                    'completed',
                    'selesai',
                ],
                true
            )) {
                $selesai++;
            }
        }

        // =====================================================
        // 9. RIWAYAT PENGAJUAN
        // =====================================================

        $riwayat = [];

        foreach ($tickets as $ticket) {
            $status = strtolower(
                trim((string) ($ticket['status'] ?? ''))
            );

            if (in_array(
                $status,
                [
                    'completed',
                    'selesai',
                ],
                true
            )) {
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
        // 10. DRAFT
        // =====================================================

        /*
         * Untuk sementara draft masih mengambil dari session.
         * Nanti kita pindahkan ke database.
         */
        $drafts = session()->get(
            'mahasiswa_drafts'
        ) ?? [];

        // =====================================================
        // 11. DATA UNTUK VIEW
        // =====================================================

        $data = [
            'title' =>
                'Dashboard Mahasiswa',

            'user' =>
                $mahasiswa,

            'mahasiswa' =>
                $mahasiswa,

            'statistik' => [
                'total' =>
                    $total,

                'diproses' =>
                    $diproses,

                'revisi' =>
                    $revisi,

                'selesai' =>
                    $selesai,

                'notifikasi' =>
                    0,
            ],

            'tickets' =>
                $tickets,

            'riwayat' =>
                $riwayat,

            'drafts' =>
                $drafts,
        ];

        // =====================================================
        // 12. TAMPILKAN DASHBOARD
        // =====================================================

        return view(
            'mahasiswa/dashboard',
            $data
        );
    }
}