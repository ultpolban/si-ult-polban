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

        $this->userModel = new UserModel();
        $this->mfaService = new MfaService();
        $this->activityLogService = service('activityLogService');
    }

    /**
     * Halaman Login
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        // Jika kembali ke login, proses MFA sebelumnya dianggap dibatalkan
        session()->remove('login_pending');

        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Proses Login - Step 1
     */
    public function authenticate()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        // Validasi input
        if ($email === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email dan Password wajib diisi.');
        }

        // Cari user berdasarkan email
        $user = $this->userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan.');
        }

        // Cek status akun
        if ((int) ($user['is_active'] ?? 0) !== 1) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun belum aktif.');
        }

        // Cek password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah.');
        }

        // Bersihkan MFA pending sebelumnya
        session()->remove('login_pending');

        /**
         * Jika MFA aktif, lanjut ke halaman MFA
         */
        if ($this->requiresMfa($user)) {

            session()->set('login_pending', [
                'user_id' => (int) $user['id'],
                'full_name' => $user['full_name'] ?? '',
                'email' => $user['email'] ?? '',
            ]);

            return redirect()->to('/login/mfa');
        }

        /**
         * Jika MFA tidak aktif, langsung login
         */
        return $this->completeLogin($user);
    }

    /**
     * Halaman MFA - Step 2
     */
    public function mfa()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Pastikan user masih valid
        if (!$this->validPendingUser((int) $pending['user_id'])) {

            session()->remove('login_pending');

            return redirect()
                ->to('/login')
                ->with('error', 'Sesi verifikasi tidak valid. Silakan login ulang.');
        }

        return view('auth/login_mfa', [
            'title' => 'Verifikasi Dua Langkah',
            'account' => $pending,
        ]);
    }

    /**
     * Verifikasi MFA - Step 3
     */
    public function verifyMfa()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) $pending['user_id'];

        $user = $this->userModel->find($userId);

        if (!$user || !$this->validPendingUser($userId)) {

            session()->remove('login_pending');

            return redirect()
                ->to('/login')
                ->with('error', 'Sesi verifikasi tidak valid. Silakan login ulang.');
        }

        $code = trim((string) $this->request->getPost('mfa_code'));

        if ($code === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kode MFA wajib diisi.');
        }

        $verified = false;
        $isRecovery = false;

        // Cek kode TOTP
        if ($this->mfaService->verifyCode($userId, $code)) {

            $verified = true;

        // Cek recovery code
        } elseif ($this->mfaService->verifyRecoveryCode($userId, $code)) {

            $verified = true;
            $isRecovery = true;
        }

        if (!$verified) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kode MFA tidak valid. Silakan coba lagi.');
        }

        // Recovery code hanya bisa digunakan sekali
        if ($isRecovery) {
            $this->mfaService->consumeRecoveryCode($userId, $code);
        }

        // Hapus session pending MFA
        session()->remove('login_pending');

        // Selesaikan login
        return $this->completeLogin($user);
    }

    /**
     * Selesaikan proses login
     */
    protected function completeLogin(array $user)
    {
        // Update waktu login terakhir
        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s')
        ]);

        // Ambil data role
        $role = db_connect()
            ->table('roles')
            ->where('id', $user['role_id'])
            ->get()
            ->getRowArray();

        // Set session login
        session()->set([
            'user_id' => (int) $user['id'],
            'role_id' => (int) $user['role_id'],
            'role_code' => $role['code'] ?? '',
            'role_name' => $role['name'] ?? '',
            'full_name' => $user['full_name'] ?? '',
            'email' => $user['email'] ?? '',
            'isLoggedIn' => true,
            'user' => $user,
        ]);

        // Bersihkan MFA pending
        session()->remove('login_pending');

        // Catat activity log
        $this->activityLogService->storeLog([
            'action' => 'LOGIN',
            'module' => 'auth',
            'reference_id' => (int) $user['id'],
            'user_id' => (int) $user['id'],
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request
                ->getUserAgent()
                ->getAgentString(),
        ]);

        return redirect()->to('/dashboard');
    }

    /**
     * Cek apakah user menggunakan MFA
     */
    protected function requiresMfa(array $user): bool
    {
        return (int) ($user['mfa_enabled'] ?? 0) === 1
            && !empty($user['mfa_secret']);
    }

    /**
     * Validasi user yang sedang melakukan MFA
     */
    protected function validPendingUser(int $userId): bool
    {
        $user = $this->userModel->find($userId);

        return $user
            && (int) ($user['is_active'] ?? 0) === 1
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

        // Catat logout
        if ($userId > 0) {

            $this->activityLogService->storeLog([
                'action' => 'LOGOUT',
                'module' => 'auth',
                'reference_id' => $userId,
                'user_id' => $userId,
                'ip_address' => $this->request->getIPAddress(),
                'user_agent' => $this->request
                    ->getUserAgent()
                    ->getAgentString(),
            ]);
        }

        // Hapus seluruh session
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with('success', 'Anda berhasil logout.');
    }
}