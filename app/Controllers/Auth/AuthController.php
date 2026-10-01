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
        helper(['form', 'role']);

        $this->userModel          = new UserModel();
        $this->mfaService         = new MfaService();
        $this->activityLogService = service('activityLogService');
    }

    /**
     * Halaman Login
     *
     * Mengakses /login selalu diarahkan ke Landing Page (Beranda)
     * terlebih dahulu. Form login tersedia di /login/form.
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(ult_redirect_url()); 
        }

        return redirect()->to('/');
    }

    /**
     * Form Login (dicapai dari tombol "Masuk" di Landing Page)
     */
    public function showLoginForm()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(ult_redirect_url()); 
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
            return redirect()->to(ult_redirect_url()); 
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
            return redirect()->to(ult_redirect_url()); 
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()->to('/login/form')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!$this->validPendingUser((int) $pending['user_id'])) {
            session()->remove('login_pending');

            return redirect()->to('/login/form')
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
            return redirect()->to(ult_redirect_url()); 
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()->to('/login/form')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = $this->userModel->find((int) $pending['user_id']);

        if (
            !$user ||
            !$this->validPendingUser((int) $pending['user_id'])
        ) {
            session()->remove('login_pending');

            return redirect()->to('/login/form')
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

        // Ambil jenis pemohon dari user_profiles (jika ada)
        $applicantCode = '';

        $profile = db_connect()
            ->table('user_profiles')
            ->select('master_applicant_types.code AS applicant_code')
            ->join(
                'master_applicant_types',
                'master_applicant_types.id = user_profiles.applicant_type_id',
                'left'
            )
            ->where('user_profiles.user_id', $user['id'])
            ->get()
            ->getRowArray();

        if ($profile && ! empty($profile['applicant_code'])) {
            $applicantCode = ult_normalize_applicant_code(
                (string) $profile['applicant_code']
            );
        }

        /*
         * Simpan session login.
         *
         * isLoggedIn  -> digunakan oleh AuthController/MFA
         * logged_in   -> digunakan oleh AuthFilter
         */
        session()->set([
            'user_id'             => (int) $user['id'],
            'role_id'             => (int) $user['role_id'],
            'role_code'           => $role['code'] ?? '',
            'role_name'           => $role['name'] ?? '',
            'applicant_type_code' => $applicantCode,
            'full_name'           => $user['full_name'] ?? '',
            'name'                => $user['full_name'] ?? '',
            'email'               => $user['email'] ?? '',
            'isLoggedIn'          => true,
            'logged_in'           => true,
            'user'                => $user,
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

        return $this->redirectByRole((string) ($role['code'] ?? ''));
    }

    /**
     * Redirect pengguna ke dashboard sesuai role & jenis pemohon.
     *
     * Pemetaan:
     *   - SUPER_ADMIN / ADMIN_ULT -> /admin/dashboard
     *   - PETUGAS_ULT            -> /petugas/dashboard
     *   - PIMPINAN               -> /pimpinan/dashboard
     *   - UNIT_TUJUAN            -> /unit/dashboard
     *   - PEMOHON                -> /{jenis-pemohon}/dashboard
     */
    protected function redirectByRole(string $roleCode)
    {
        return redirect()->to(ult_redirect_site_url($roleCode));
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
     * Setup MFA untuk user yang sudah login
     */
    public function mfaSetup()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login/form')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()->to('/login/form');
        }

        $user = $this->userModel->find($userId);

        if (! $user || (int) ($user['is_active'] ?? 0) !== 1) {
            session()->destroy();

            return redirect()
                ->to('/login/form')
                ->with('error', 'Akun tidak valid.');
        }

        // Jika MFA sudah aktif, tidak perlu setup ulang
        if ($this->requiresMfa($user)) {
            return redirect()
                ->to(ult_redirect_url())
                ->with('success', 'MFA pada akun ini sudah aktif.');
        }

        $pending = session()->get('mfa_setup_pending');

        // Generate setup baru jika belum ada proses MFA
        if (! $pending || (int) ($pending['user_id'] ?? 0) !== $userId) {
            $secret        = $this->mfaService->generateSecret();
            $recoveryCodes = $this->mfaService->generateRecoveryCodes();

            if (! $this->mfaService->beginSetup(
                $userId,
                $secret,
                $recoveryCodes
            )) {
                return redirect()
                    ->to(ult_redirect_url())
                    ->with('error', 'Gagal memulai setup MFA.');
            }

            session()->set('mfa_setup_pending', [
                'user_id' => $userId,
            ]);

            $user = $this->userModel->find($userId);
        }

        $secret = $user['mfa_secret'] ?? '';

        if ($secret === '') {
            return redirect()
                ->to(ult_redirect_url())
                ->with('error', 'Secret MFA tidak tersedia.');
        }

        $uri = $this->mfaService->provisioningUri(
            $secret,
            $user['email']
        );

        $recoveryCodes = json_decode(
            $user['mfa_recovery_codes'] ?? '[]',
            true
        );

        $recoveryCodes = is_array($recoveryCodes)
            ? $recoveryCodes
            : [];

        return view('auth/setup_mfa', [
            'title'         => 'Setup MFA',
            'secret'        => $secret,
            'uri'           => $uri,
            'recoveryCodes' => $recoveryCodes,
            'account'       => [
                'full_name' => $user['full_name'] ?? '',
                'email'     => $user['email'] ?? '',
            ],
        ]);
    }

    /**
     * Verifikasi MFA untuk akun yang sudah login
     */
    public function verifyMfaSetup()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login/form')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()->to('/login/form');
        }

        $user = $this->userModel->find($userId);

        if (! $user || (int) ($user['is_active'] ?? 0) !== 1) {
            session()->destroy();

            return redirect()
                ->to('/login/form')
                ->with('error', 'Akun tidak valid.');
        }

        if ($this->requiresMfa($user)) {
            return redirect()
                ->to(ult_redirect_url())
                ->with('success', 'MFA sudah aktif.');
        }

        $code = trim((string) $this->request->getPost('mfa_code'));

        if (! preg_match('/^\d{6}$/', $code)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Kode MFA harus terdiri dari 6 digit.');
        }

        if (! $this->mfaService->verifyCode($userId, $code)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Kode MFA tidak valid. Silakan coba lagi.');
        }

        if (! $this->mfaService->activate($userId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengaktifkan MFA.');
        }

        session()->remove('mfa_setup_pending');

        // Refresh data user di session
        $user = $this->userModel->find($userId);

        session()->set('user', $user);

        return redirect()
            ->to(ult_redirect_url())
            ->with(
                'success',
                'MFA berhasil diaktifkan. Saat login berikutnya Anda akan diminta kode MFA.'
            );
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

        // Setelah keluar, pengguna diarahkan kembali ke Landing Page.
        return redirect()->to('/');
    }
}
