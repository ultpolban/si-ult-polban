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
            return redirect()->to('/dashboard');
        }

        // Kembali ke halaman login dianggap batal pada proses MFA
        // yang belum selesai.
        session()->remove('login_pending');

        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Proses Login
     * Step 1: Validasi kredensial
     */
    public function authenticate()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
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

        // -------------------------------------------------
        // MFA
        // -------------------------------------------------
        if ($this->requiresMfa($user)) {
            session()->set('login_pending', [
                'user_id'   => (int) $user['id'],
                'full_name' => $user['full_name'] ?? '',
                'email'     => $user['email'] ?? '',
            ]);

            return redirect()->to('/login/mfa');
        }

        // -------------------------------------------------
        // Tanpa MFA → langsung login
        // -------------------------------------------------
        return $this->completeLogin($user);
    }

    /**
     * Halaman Verifikasi Dua Langkah
     * Step 2: Masukkan kode MFA
     */
    public function mfa()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
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
     * Step 3: Validasi kode lalu login
     */
    public function verifyMfa()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = $this->userModel->find((int) $pending['user_id']);

        if (
            !$user ||
            !$this->validPendingUser((int) $pending['user_id'])
        ) {
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

        // Cek kode TOTP
        if (
            $this->mfaService->verifyCode(
                (int) $user['id'],
                $code
            )
        ) {
            $verified = true;
        }

        // Jika TOTP gagal, cek recovery code
        elseif (
            $this->mfaService->verifyRecoveryCode(
                (int) $user['id'],
                $code
            )
        ) {
            $verified   = true;
            $isRecovery = true;
        }

        if (!$verified) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kode MFA tidak valid. Silakan coba lagi.');
        }

        // Recovery code hanya dapat digunakan sekali.
        if ($isRecovery) {
            $this->mfaService->consumeRecoveryCode(
                (int) $user['id'],
                $code
            );
        }

        session()->remove('login_pending');

        return $this->completeLogin($user);
    }

    /**
     * Selesaikan Login
     *
     * - Update last login
     * - Ambil role
     * - Simpan session
     * - Catat activity log
     * - Redirect dashboard
     */
    protected function completeLogin(array $user)
    {
        // Update waktu login terakhir jika field tersedia
        if (
            in_array(
                'last_login',
                $this->userModel->allowedFields ?? []
            )
        ) {
            $this->userModel->update($user['id'], [
                'last_login' => date('Y-m-d H:i:s')
            ]);
        }

        // Ambil informasi role user
        $role = db_connect()
            ->table('roles')
            ->where('id', $user['role_id'])
            ->get()
            ->getRowArray();

        /*
         * Simpan session login.
         *
         * isLoggedIn → digunakan oleh AuthController/MFA
         * logged_in  → digunakan oleh AuthFilter
         */
        session()->set([
            'user_id'    => (int) $user['id'],
            'role_id'    => (int) $user['role_id'],
            'role_code'  => $role['code'] ?? '',
            'full_name'  => $user['full_name'] ?? '',
            'name'       => $user['full_name'] ?? '',
            'email'      => $user['email'] ?? '',
            'role_name'  => $role['name'] ?? '',
            'isLoggedIn' => true,
            'logged_in'  => true,
            'user'       => $user,
        ]);

        // Hapus session MFA sementara
        session()->remove('login_pending');

        // Catat aktivitas login
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

        return redirect()->to('/dashboard');
    }

    /**
     * Apakah user membutuhkan MFA?
     */
    protected function requiresMfa(array $user): bool
    {
        return (
            (int) ($user['mfa_enabled'] ?? 0) === 1 &&
            !empty($user['mfa_secret'])
        );
    }

    /**
     * Validasi user yang sedang melakukan MFA
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

        // Catat aktivitas logout jika user sedang login
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
        }

        // Hapus seluruh session
        session()->remove([
            'user_id',
            'role_id',
            'role_code',
            'full_name',
            'name',
            'email',
            'role_name',
            'isLoggedIn',
            'logged_in',
            'user',
            'login_pending',
        ]);

        session()->destroy();

        return redirect()->to('/login');
    }
}