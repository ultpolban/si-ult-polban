<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class TendikController extends BaseController
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
    // DASHBOARD TENDIK
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
        // 3. AMBIL PROFILE TENDIK
        // =====================================================

        $profile = $this->profileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        if (! $profile) {
            return redirect()
                ->to('/login')
                ->with('error', 'Profil Tendik tidak ditemukan.');
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

        $applicantCode = strtoupper(
            trim((string) ($applicantType['code'] ?? ''))
        );

        $applicantName = strtolower(
            trim((string) ($applicantType['name'] ?? ''))
        );

        $isTendik =
            $applicantCode === 'TENDIK'
            ||
            str_contains($applicantName, 'tenaga kependidikan')
            ||
            str_contains($applicantName, 'tendik');

        if (! $isTendik) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun ini bukan pemohon Tendik.'
                );
        }


        // =====================================================
        // 5. DATA PRIBADI TENDIK
        // =====================================================

        $dataPribadi = [

            'id' => $userId,

            'nama' =>
                $user['full_name']
                ?? $profile['name']
                ?? '-',

            'nik' =>
                $profile['nik']
                ?? '-',

            'jabatan' =>
                ! empty($profile['position'])
                    ? $profile['position']
                    : 'Tenaga Kependidikan',

            'email' =>
                $user['email']
                ?? $profile['email']
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
        // 7. AMBIL TIKET TENDIK
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
        // 8. HITUNG STATISTIK
        // =====================================================

        $jumlahPengajuan = count($tickets);

        $sedangDiproses = 0;

        $perluRevisi = 0;

        $selesai = 0;


        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim((string) ($ticket['status'] ?? ''))
            );


            // ---------------------------------------------
            // SEDANG DIPROSES
            // ---------------------------------------------

            if (in_array(
                $status,
                [
                    'submitted',
                    'verification',
                    'verified',
                    'assigned',
                    'in progress',
                    'processing',
                    'processed',
                    'diproses',
                ],
                true
            )) {
                $sedangDiproses++;
            }


            // ---------------------------------------------
            // PERLU REVISI
            // ---------------------------------------------

            if (in_array(
                $status,
                [
                    'revision',
                    'revisi',
                ],
                true
            )) {
                $perluRevisi++;
            }


            // ---------------------------------------------
            // SELESAI
            // ---------------------------------------------

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
        // 9. FORMAT RECENT TICKETS
        // =====================================================

        $recentTickets = [];

        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim((string) ($ticket['status'] ?? ''))
            );


            // Label status
            switch ($status) {

                case 'submitted':
                    $statusLabel = 'Diajukan';
                    $statusClass = 'badge-warning';
                    break;

                case 'verification':
                case 'verified':
                    $statusLabel = 'Diverifikasi';
                    $statusClass = 'badge-info';
                    break;

                case 'assigned':
                    $statusLabel = 'Didisposisi';
                    $statusClass = 'badge-info';
                    break;

                case 'processed':
                case 'diproses':
                case 'processing':
                case 'in progress':
                    $statusLabel = 'Diproses';
                    $statusClass = 'badge-info';
                    break;

                case 'revision':
                case 'revisi':
                    $statusLabel = 'Perlu Revisi';
                    $statusClass = 'badge-warning';
                    break;

                case 'completed':
                case 'selesai':
                    $statusLabel = 'Selesai';
                    $statusClass = 'badge-success';
                    break;

                case 'rejected':
                case 'ditolak':
                    $statusLabel = 'Ditolak';
                    $statusClass = 'badge-danger';
                    break;

                case 'draft':
                    $statusLabel = 'Draft';
                    $statusClass = 'badge-secondary';
                    break;

                default:
                    $statusLabel = ucfirst(
                        $ticket['status'] ?? '-'
                    );

                    $statusClass = 'badge-secondary';
                    break;
            }


            $recentTickets[] = [

                'id' =>
                    $ticket['id'],

                'ticket_number' =>
                    $ticket['ticket_number']
                    ?? '-',

                'service_name' =>
                    $ticket['service_name']
                    ?? '-',

                'unit_name' =>
                    $ticket['unit_name']
                    ?? '-',

                'created_at' =>
                    $ticket['created_at']
                    ?? $ticket['submitted_at']
                    ?? null,

                'status' =>
                    $ticket['status']
                    ?? '-',

                'status_label' =>
                    $statusLabel,

                'status_class' =>
                    $statusClass,
            ];
        }


        // =====================================================
        // 10. BATASI RIWAYAT TERBARU
        // =====================================================

        $recentTickets = array_slice(
            $recentTickets,
            0,
            5
        );


        // =====================================================
        // 11. DATA UNTUK VIEW
        // =====================================================

        $data = [

            'title' =>
                'Dashboard Tendik',

            'dataPribadi' =>
                $dataPribadi,

            'jumlahPengajuan' =>
                $jumlahPengajuan,

            'sedangDiproses' =>
                $sedangDiproses,

            'perluRevisi' =>
                $perluRevisi,

            'selesai' =>
                $selesai,

            'recentTickets' =>
                $recentTickets,
        ];


        // =====================================================
        // 12. TAMPILKAN DASHBOARD
        // =====================================================

        return view(
            'tendik/dashboard',
            $data
        );
    }
}