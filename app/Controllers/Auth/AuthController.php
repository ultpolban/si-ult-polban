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
     * Halaman Login
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard-mahasiswa');
        }

        // Kembali ke halaman login dianggap membatalkan
        // proses MFA yang belum selesai.
        session()->remove('login_pending');

        return view('auth/login', [
            'title' => 'Login',
        ]);
    }

    /**
     * Proses Login (Step 1: validasi kredensial)
     */
    public function authenticate()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard-mahasiswa');
        }

        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email dan Password wajib diisi.');
        }

        $user = $this->userModel
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah.');
        }

        // Reset pending MFA dari percobaan login sebelumnya.
        session()->remove('login_pending');

        // =====================================================
        // MFA: user wajib verifikasi kode terlebih dahulu
        // =====================================================
        if ($this->requiresMfa($user)) {
            session()->set('login_pending', [
                'user_id'   => (int) $user['id'],
                'full_name' => $user['full_name'] ?? '',
                'email'     => $user['email'] ?? '',
            ]);

            return redirect()->to('/login/mfa');
        }

        // =====================================================
        // Tanpa MFA: langsung login
        // =====================================================
        return $this->completeLogin($user);
    }

    /**
     * Halaman Verifikasi Dua Langkah
     * Step 2: masukkan kode MFA
     */
    public function mfa()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard-mahasiswa');
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!$this->validPendingUser((int) $pending['user_id'])) {
            session()->remove('login_pending');

            return redirect()->to('/login')
                ->with('error', 'Sesi verifikasi tidak valid. Silakan login ulang.');
        }

        return view('auth/login_mfa', [
            'title'   => 'Verifikasi Dua Langkah',
            'account' => $pending,
        ]);
    }

    /**
     * Proses Verifikasi MFA
     * Step 3: validasi kode, lalu login
     */
    public function verifyMfa()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard-mahasiswa');
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = $this->userModel->find((int) $pending['user_id']);

        if (!$user || !$this->validPendingUser((int) $pending['user_id'])) {
            session()->remove('login_pending');

            return redirect()->to('/login')
                ->with('error', 'Sesi verifikasi tidak valid. Silakan login ulang.');
        }

        $code = trim((string) $this->request->getPost('mfa_code'));

        if ($code === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kode MFA wajib diisi.');
        }

        $verified   = false;
        $isRecovery = false;

        // Coba verifikasi menggunakan TOTP.
        if ($this->mfaService->verifyCode((int) $user['id'], $code)) {
            $verified = true;
        }

        // Jika TOTP gagal, coba recovery code.
        elseif ($this->mfaService->verifyRecoveryCode((int) $user['id'], $code)) {
            $verified   = true;
            $isRecovery = true;
        }

        if (!$verified) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kode MFA tidak valid. Silakan coba lagi.');
        }

        // Recovery code hanya boleh digunakan satu kali.
        if ($isRecovery) {
            $this->mfaService->consumeRecoveryCode(
                (int) $user['id'],
                $code
            );
        }

        // MFA selesai.
        session()->remove('login_pending');

        return $this->completeLogin($user);
    }

    /**
     * Selesaikan login:
     * - update last_login
     * - isi session
     * - catat activity log
     * - redirect ke dashboard mahasiswa
     */
    protected function completeLogin(array $user)
    {
        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s'),
        ]);

        $role = db_connect()
            ->table('roles')
            ->where('id', $user['role_id'])
            ->get()
            ->getRowArray();

        session()->set([
            'user_id'    => $user['id'],
            'role_id'    => $user['role_id'],
            'role_code'  => $role['code'] ?? '',
            'full_name'  => $user['full_name'],
            'email'      => $user['email'],
            'role_name'  => $role['name'] ?? '',
            'isLoggedIn' => true,
            'user'       => $user,
        ]);

        session()->remove('login_pending');

        // Catat aktivitas login.
        $this->activityLogService->storeLog([
            'action'       => 'LOGIN',
            'module'       => 'auth',
            'reference_id' => (int) $user['id'],
            'user_id'      => (int) $user['id'],
            'ip_address'   => $this->request->getIPAddress(),
            'user_agent'   => $this->request->getUserAgent()->getAgentString(),
        ]);

        // =====================================================
        // SEMENTARA FOKUS MAHASISWA
        // =====================================================
        return redirect()->to('/dashboard-mahasiswa');
    }

    /**
     * Apakah user perlu menjalani MFA saat login?
     */
    protected function requiresMfa(array $user): bool
    {
        return (int) ($user['mfa_enabled'] ?? 0) === 1
            && !empty($user['mfa_secret']);
    }

    /**
     * Validasi user yang sedang dalam proses verifikasi MFA.
     */
    protected function validPendingUser(int $userId): bool
    {
        $user = $this->userModel->find($userId);

        return $user
            && (int) $user['is_active'] === 1
            && $this->requiresMfa($user);
    }

    /**
     * Halaman akses ditolak
     */
    public function unauthorized()
    {
        return view('errors/unauthorized', [
            'title' => 'Akses Ditolak',
        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        $userId = (int) session()->get('user_id');

        if ($userId > 0) {
            $this->activityLogService->storeLog([
                'action'       => 'LOGOUT',
                'module'       => 'auth',
                'reference_id' => $userId,
                'user_id'      => $userId,
                'ip_address'   => $this->request->getIPAddress(),
                'user_agent'   => $this->request->getUserAgent()->getAgentString(),
            ]);
        }

        session()->destroy();

        return redirect()->to('/login');
    }
}