<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class DosenController extends BaseController
{
    protected UserModel $userModel;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel = new UserModel();
        $this->profileModel = new UserProfileModel();
    }

    public function dashboard()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user adalah DOSEN
        $applicantTypeCode = session()->get('applicant_type_code');
        if ($applicantTypeCode !== 'DOSEN') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Akses hanya untuk dosen.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        $user = $this->userModel->find($userId);

        if (! $user) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        $profile = $this->profileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        if (! $profile) {
            $profile = session()->get('dosen_profile') ?? [];
        }

        $dosen = [
            'id' => $userId,

            'nama' => $profile['name']
                ?? $user['full_name']
                ?? 'Dosen',

            'nip' => $profile['identity_number']
                ?? $user['identity_number']
                ?? '-',

            'nidn' => $profile['nidn']
                ?? '-',

            'prodi' => $profile['study_program_name']
                ?? '-',

            'jurusan' => $profile['department_name']
                ?? '-',

            'fakultas' => '-',

            'jabatan' => 'Dosen',

            'status' => ((int) ($user['is_active'] ?? 0) === 1)
                ? 'Aktif'
                : 'Tidak Aktif',
        ];

        $tickets = session()->get('dosen_tickets') ?? [];

        $total = count($tickets);
        $diproses = 0;
        $revisi = 0;
        $selesai = 0;

        foreach ($tickets as $ticket) {
            $status = strtolower(trim((string) ($ticket['status'] ?? '')));

            if (in_array($status, ['submitted', 'verification', 'verified', 'in progress', 'processing', 'processed', 'diproses'], true)) {
                $diproses++;
            }

            if (in_array($status, ['revision', 'revisi'], true)) {
                $revisi++;
            }

            if (in_array($status, ['completed', 'selesai'], true)) {
                $selesai++;
            }
        }

        $data = [
            'title' => 'Dashboard Dosen',
            'user' => $dosen,
            'dosen' => $dosen,
            'statistik' => [
                'total' => $total,
                'diproses' => $diproses,
                'revisi' => $revisi,
                'selesai' => $selesai,
                'notifikasi' => 0,
            ],
            'tickets' => array_reverse($tickets),
        ];

        return view('dosen/dashboard', $data);
    }
}
