<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Services\ActivityLogService;
use App\Services\MfaService;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    protected MfaService $mfaService;

    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        helper(['form']);

        $this->userModel          = new UserModel();
        $this->mfaService         = new MfaService();
        $this->activityLogService = service('activityLogService');
    }

    /**
     * =========================================================
     * HALAMAN LOGIN
     * =========================================================
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return $this->redirectByRole(
                (string) session()->get('role_code')
            );
        }

        // Hapus proses MFA yang masih tersimpan
        session()->remove('login_pending');

        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    /**
     * =========================================================
     * PROSES LOGIN
     * STEP 1: EMAIL + PASSWORD
     * =========================================================
     */
    public function authenticate()
    {
        // Buang data session lama tanpa mengirim cookie delete setelah
        // session login baru dibuat pada response yang sama.
        session()->regenerate(true);

        $username = trim(
            (string) $this->request->getPost('email')
        );

        $password = (string) $this->request->getPost('password');

        // -----------------------------------------------------
        // Validasi input
        // -----------------------------------------------------
        if ($username === '' || $password === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Email dan Password wajib diisi.'
                );
        }

        // -----------------------------------------------------
        // Cari user aktif
        // -----------------------------------------------------
        $user = $this->userModel->findByUsernameOrEmail($username);

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Email tidak ditemukan.'
                );
        }

        // -----------------------------------------------------
        // Cek password
        // -----------------------------------------------------
        if (!password_verify($password, $user['password'])) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Password salah.'
                );
        }

        // -----------------------------------------------------
        // Bersihkan pending MFA sebelumnya
        // -----------------------------------------------------
        session()->remove('login_pending');

        // -----------------------------------------------------
        // Jika user menggunakan MFA
        // -----------------------------------------------------
        if ($this->requiresMfa($user)) {

            session()->set('login_pending', [
                'user_id'   => (int) $user['id'],
                'full_name' => $user['full_name'] ?? '',
                'email'     => $user['email'] ?? '',
            ]);

            return redirect()->to('/login/mfa');
        }

        // -----------------------------------------------------
        // Jika tidak menggunakan MFA
        // -----------------------------------------------------
        return $this->completeLogin($user);
    }

    /**
     * =========================================================
     * HALAMAN VERIFIKASI MFA
     * =========================================================
     */
    public function mfa()
    {
        if (session()->get('isLoggedIn')) {
            return $this->redirectByRole(
                (string) session()->get('role_code')
            );
        }

        $pending = session()->get('login_pending');

        // Tidak ada proses login
        if (!$pending || empty($pending['user_id'])) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }

        // Validasi user pending
        if (!$this->validPendingUser(
            (int) $pending['user_id']
        )) {

            session()->remove('login_pending');

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Sesi verifikasi tidak valid. Silakan login ulang.'
                );
        }

        return view('auth/login_mfa', [
            'title'   => 'Verifikasi Dua Langkah',
            'account' => $pending,
        ]);
    }

    /**
     * =========================================================
     * VERIFIKASI MFA
     * =========================================================
     */
    public function verifyMfa()
    {
        if (session()->get('isLoggedIn')) {
            return $this->redirectByRole(
                (string) session()->get('role_code')
            );
        }

        $pending = session()->get('login_pending');

        // -----------------------------------------------------
        // Cek pending login
        // -----------------------------------------------------
        if (!$pending || empty($pending['user_id'])) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }

        // -----------------------------------------------------
        // Ambil user
        // -----------------------------------------------------
        $user = $this->userModel->find(
            (int) $pending['user_id']
        );

        // -----------------------------------------------------
        // Validasi user
        // -----------------------------------------------------
        if (
            !$user ||
            !$this->validPendingUser(
                (int) $pending['user_id']
            )
        ) {

            session()->remove('login_pending');

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Sesi verifikasi tidak valid. Silakan login ulang.'
                );
        }

        // -----------------------------------------------------
        // Ambil kode MFA
        // -----------------------------------------------------
        $code = trim(
            (string) $this->request->getPost('mfa_code')
        );

        if ($code === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Kode MFA wajib diisi.'
                );
        }

        $verified   = false;
        $isRecovery = false;

        // -----------------------------------------------------
        // Cek TOTP
        // -----------------------------------------------------
        if (
            $this->mfaService->verifyCode(
                (int) $user['id'],
                $code
            )
        ) {
            $verified = true;
        }

        // -----------------------------------------------------
        // Jika TOTP gagal, cek recovery code
        // -----------------------------------------------------
        elseif (
            $this->mfaService->verifyRecoveryCode(
                (int) $user['id'],
                $code
            )
        ) {
            $verified   = true;
            $isRecovery = true;
        }

        // -----------------------------------------------------
        // Kode MFA salah
        // -----------------------------------------------------
        if (!$verified) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Kode MFA tidak valid. Silakan coba lagi.'
                );
        }

        // -----------------------------------------------------
        // Recovery code hanya dapat digunakan sekali
        // -----------------------------------------------------
        if ($isRecovery) {
            $this->mfaService->consumeRecoveryCode(
                (int) $user['id'],
                $code
            );
        }

        // -----------------------------------------------------
        // Hapus pending MFA
        // -----------------------------------------------------
        session()->remove('login_pending');

        // -----------------------------------------------------
        // Selesaikan login
        // -----------------------------------------------------
        return $this->completeLogin($user);
    }

    /**
     * =========================================================
     * COMPLETE LOGIN
     * =========================================================
     *
     * Setelah login berhasil:
     * 1. Update last_login
     * 2. Ambil role
     * 3. Simpan session
     * 4. Simpan activity log
     * 5. Redirect berdasarkan role
     */
    protected function completeLogin(array $user)
    {
        // -----------------------------------------------------
        // Update last login
        // -----------------------------------------------------
        $this->userModel->update(
            $user['id'],
            [
                'last_login' => date('Y-m-d H:i:s')
            ]
        );

        // -----------------------------------------------------
        // Ambil role dari tabel roles
        // -----------------------------------------------------
        $role = db_connect()
            ->table('roles')
            ->where('id', $user['role_id'])
            ->get()
            ->getRowArray();

        // -----------------------------------------------------
        // Role code
        // -----------------------------------------------------
        $roleCode = strtoupper(
            trim(
                (string) ($role['code'] ?? '')
            )
        );

        // -----------------------------------------------------
        // Role name
        // -----------------------------------------------------
        $roleName = $role['name'] ?? '';

        // -----------------------------------------------------
        // Simpan session
        // -----------------------------------------------------
        session()->set([
            'user_id'    => (int) $user['id'],
            'role_id'    => (int) $user['role_id'],
            'role_code'  => $roleCode,
            'full_name'  => $user['full_name'] ?? '',
            'email'      => $user['email'] ?? '',
            'role_name'  => $roleName,

            // SESSION LOGIN UTAMA
            'isLoggedIn' => true,

            // Data user
            'user'       => $user,
        ]);

        // -----------------------------------------------------
        // Hapus pending MFA
        // -----------------------------------------------------
        session()->remove('login_pending');

        // -----------------------------------------------------
        // Activity log
        // -----------------------------------------------------
        $this->activityLogService->storeLog([
            'action'       => 'LOGIN',
            'module'       => 'auth',
            'reference_id' => (int) $user['id'],
            'user_id'      => (int) $user['id'],
            'ip_address'   => $this->request->getIPAddress(),
            'user_agent'   => $this->request
                ->getUserAgent()
                ->getAgentString(),
        ]);

        if ($roleCode === 'PETUGAS_TIK') {
            $this->writeUptTikLog('LOGIN', (int) $user['id']);
        }

        if ($roleCode === 'PETUGAS_UMUM') {
            $this->writeAdministrasiUmumLog('LOGIN', (int) $user['id']);
        }

        // -----------------------------------------------------
        // REDIRECT BERDASARKAN ROLE
        // -----------------------------------------------------
        return $this->redirectByRole($roleCode);
    }

    /**
     * =========================================================
     * REDIRECT BERDASARKAN ROLE
     * =========================================================
     */
    protected function redirectByRole(string $roleCode)
    {
        $roleCode = strtoupper(
            trim($roleCode)
        );

        switch ($roleCode) {

            // -------------------------------------------------
            // SUPER ADMIN
            // -------------------------------------------------
            case 'SUPER_ADMIN':

                return redirect()->to('/akademik/dashboard');


            // -------------------------------------------------
            // ADMIN ULT
            // -------------------------------------------------
            case 'ADMIN_ULT':

                return redirect()->to('/akademik/dashboard');


            // -------------------------------------------------
            // PETUGAS AKADEMIK
            // -------------------------------------------------
            case 'PETUGAS_AKADEMIK':

                return redirect()->to('/akademik/dashboard');


            // -------------------------------------------------
            // PETUGAS UPT TIK
            // -------------------------------------------------
            case 'PETUGAS_TIK':

                return redirect()->to('/upt-tik');


            case 'PETUGAS_UMUM':

                return redirect()->to('/administrasi-umum');


            // -------------------------------------------------
            // PETUGAS KEMAHASISWAAN
            // -------------------------------------------------
            case 'PETUGAS_KEMAHASISWAAN':

                return redirect()->to('/kemahasiswaan/dashboard');


            // -------------------------------------------------
            // PETUGAS KEUANGAN
            // -------------------------------------------------
            case 'PETUGAS_KEUANGAN':

                return redirect()->to('/keuangan/dashboard');


            // -------------------------------------------------
            // PETUGAS PERPUSTAKAAN
            // -------------------------------------------------
            case 'PETUGAS_PERPUSTAKAAN':

                return redirect()->to('/perpustakaan/dashboard');


            // -------------------------------------------------
            // PETUGAS JURUSAN
            // -------------------------------------------------
            case 'PETUGAS_JURUSAN':

                return redirect()->to('/jurusan/dashboard');


            // -------------------------------------------------
            // PEMOHON
            // -------------------------------------------------
            case 'PEMOHON':

                return redirect()->to('/akademik/dashboard');


            // -------------------------------------------------
            // ROLE TIDAK DIKENAL
            // -------------------------------------------------
            default:

                session()->destroy();

                return redirect()
                    ->to('/login')
                    ->with(
                        'error',
                        'Role pengguna tidak dikenali.'
                    );
        }
    }

    /**
     * =========================================================
     * CEK APAKAH USER MEMBUTUHKAN MFA
     * =========================================================
     */
    protected function requiresMfa(array $user): bool
    {
        return (
            (int) ($user['mfa_enabled'] ?? 0) === 1
            &&
            !empty($user['mfa_secret'])
        );
    }

    /**
     * =========================================================
     * VALIDASI USER PENDING MFA
     * =========================================================
     */
    protected function validPendingUser(int $userId): bool
    {
        $user = $this->userModel->find($userId);

        return $user
            && (int) $user['is_active'] === 1
            && $this->requiresMfa($user);
    }

    /**
     * =========================================================
     * HALAMAN UNAUTHORIZED
     * =========================================================
     */
    public function unauthorized()
    {
        return view('errors/unauthorized', [
            'title' => 'Akses Ditolak',
        ]);
    }

    /**
     * =========================================================
     * LOGOUT
     * =========================================================
     */
    public function logout()
    {
        $userId = (int) session()->get('user_id');

        // -----------------------------------------------------
        // Activity log logout
        // -----------------------------------------------------
        if ($userId > 0) {

            $this->activityLogService->storeLog([
                'action'       => 'LOGOUT',
                'module'       => 'auth',
                'reference_id' => $userId,
                'user_id'      => $userId,
                'ip_address'   => $this->request->getIPAddress(),
                'user_agent'   => $this->request
                    ->getUserAgent()
                    ->getAgentString(),
            ]);

            if (session()->get('role_code') === 'PETUGAS_TIK') {
                $this->writeUptTikLog('LOGOUT', $userId);
            }

            if (session()->get('role_code') === 'PETUGAS_UMUM') {
                $this->writeAdministrasiUmumLog('LOGOUT', $userId);
            }
        }

        // -----------------------------------------------------
        // Hancurkan session
        // -----------------------------------------------------
        session()->destroy();

        // -----------------------------------------------------
        // Kembali ke login
        // -----------------------------------------------------
        return redirect()
            ->to('/login')
            ->with('success', 'Anda berhasil logout.');
    }

    private function writeUptTikLog(string $action, int $userId): void
    {
        if (!db_connect()->tableExists('upt_tik_activity_logs')) {
            return;
        }

        db_connect()->table('upt_tik_activity_logs')->insert([
            'user_id' => $userId,
            'action' => $action,
            'activity' => $action === 'LOGIN' ? 'Login ke sistem utama' : 'Logout dari sistem utama',
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    private function writeAdministrasiUmumLog(string $action, int $userId): void
    {
        if (!db_connect()->tableExists('administrasi_umum_activity_logs')) {
            return;
        }

        db_connect()->table('administrasi_umum_activity_logs')->insert([
            'user_id' => $userId,
            'action' => $action,
            'activity' => $action === 'LOGIN' ? 'Login ke sistem utama' : 'Logout dari sistem utama',
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}