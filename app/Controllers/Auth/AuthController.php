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
            return $this->redirectByApplicantType();
        }

        // Kembali ke halaman login dianggap membatalkan
        // proses MFA yang belum selesai.
        session()->remove('login_pending');

        return view('auth/login', [
            'title' => 'Login',
        ]);
    }

    /**
     * =========================================================
     * PROSES LOGIN
     * Step 1: Validasi email & password
     * =========================================================
     */
    public function authenticate()
    {
        if (session()->get('isLoggedIn')) {
            return $this->redirectByApplicantType();
        }

        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email dan Password wajib diisi.');
        }

        /**
         * Cari user aktif berdasarkan email.
         */
        $user = $this->userModel
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan.');
        }

        /**
         * Verifikasi password.
         */
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah.');
        }

        // Reset pending MFA dari percobaan login sebelumnya.
        session()->remove('login_pending');

        /**
         * =====================================================
         * MFA
         * =====================================================
         */
        if ($this->requiresMfa($user)) {

            session()->set('login_pending', [
                'user_id'   => (int) $user['id'],
                'full_name' => $user['full_name'] ?? '',
                'email'     => $user['email'] ?? '',
            ]);

            return redirect()->to('/login/mfa');
        }

        /**
         * =====================================================
         * TANPA MFA
         * Langsung selesaikan login.
         * =====================================================
         */
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
            return $this->redirectByApplicantType();
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!$this->validPendingUser((int) $pending['user_id'])) {
            session()->remove('login_pending');

            return redirect()->to('/login')
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
            return $this->redirectByApplicantType();
        }

        $pending = session()->get('login_pending');

        if (!$pending || empty($pending['user_id'])) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) $pending['user_id'];

        $user = $this->userModel->find($userId);

        if (!$user || !$this->validPendingUser($userId)) {
            session()->remove('login_pending');

            return redirect()->to('/login')
                ->with(
                    'error',
                    'Sesi verifikasi tidak valid. Silakan login ulang.'
                );
        }

        $code = trim((string) $this->request->getPost('mfa_code'));

        if ($code === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kode MFA wajib diisi.');
        }

        $verified   = false;
        $isRecovery = false;

        /**
         * =====================================================
         * COBA TOTP
         * =====================================================
         */
        if ($this->mfaService->verifyCode($userId, $code)) {

            $verified = true;
        }

        /**
         * =====================================================
         * COBA RECOVERY CODE
         * =====================================================
         */
        elseif ($this->mfaService->verifyRecoveryCode($userId, $code)) {

            $verified   = true;
            $isRecovery = true;
        }

        /**
         * =====================================================
         * MFA GAGAL
         * =====================================================
         */
        if (!$verified) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Kode MFA tidak valid. Silakan coba lagi.'
                );
        }

        /**
         * Recovery code hanya boleh digunakan satu kali.
         */
        if ($isRecovery) {

            $this->mfaService->consumeRecoveryCode(
                $userId,
                $code
            );
        }

        /**
         * MFA selesai.
         */
        session()->remove('login_pending');

        return $this->completeLogin($user);
    }

    /**
     * =========================================================
     * SELESAIKAN LOGIN
     *
     * - update last_login
     * - ambil role
     * - ambil jenis pemohon
     * - isi session
     * - activity log
     * - redirect sesuai jenis pemohon
     * =========================================================
     */
    protected function completeLogin(array $user)
    {
        /**
         * =====================================================
         * UPDATE LAST LOGIN
         * =====================================================
         */
        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s'),
        ]);

        /**
         * =====================================================
         * AMBIL ROLE USER
         * =====================================================
         */
        $role = db_connect()
            ->table('roles')
            ->where('id', $user['role_id'])
            ->get()
            ->getRowArray();

        /**
         * =====================================================
         * AMBIL PROFILE USER
         * =====================================================
         */
        $userProfile = db_connect()
            ->table('user_profiles')
            ->where('user_id', $user['id'])
            ->get()
            ->getRowArray();

        /**
         * =====================================================
         * DEFAULT DATA PEMOHON
         * =====================================================
         */
        $applicantTypeId   = null;
        $applicantTypeCode = '';
        $applicantTypeName = '';

        /**
         * =====================================================
         * AMBIL JENIS PEMOHON
         * dari user_profiles.applicant_type_id
         * =====================================================
         */
        if (
            $userProfile
            && !empty($userProfile['applicant_type_id'])
        ) {

            $applicantTypeId = (int) $userProfile['applicant_type_id'];

            $applicantType = db_connect()
                ->table('master_applicant_types')
                ->where('id', $applicantTypeId)
                ->where('is_active', 1)
                ->get()
                ->getRowArray();

            if ($applicantType) {

                $applicantTypeCode = strtoupper(
                    trim((string) ($applicantType['code'] ?? ''))
                );

                $applicantTypeName = trim(
                    (string) ($applicantType['name'] ?? '')
                );
            }
        }

        /**
         * =====================================================
         * SESSION
         * =====================================================
         */
        session()->set([
            'user_id'            => (int) $user['id'],
            'role_id'            => (int) $user['role_id'],
            'role_code'          => $role['code'] ?? '',
            'role_name'          => $role['name'] ?? '',

            'full_name'          => $user['full_name'] ?? '',
            'email'              => $user['email'] ?? '',

            'applicant_type_id'  => $applicantTypeId,
            'applicant_type_code'=> $applicantTypeCode,
            'applicant_type_name'=> $applicantTypeName,

            'isLoggedIn'         => true,

            'user'               => $user,
            'user_profile'       => $userProfile,
        ]);

        /**
         * Pastikan pending MFA dibersihkan.
         */
        session()->remove('login_pending');

        /**
         * =====================================================
         * ACTIVITY LOG
         * =====================================================
         */
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

        /**
         * =====================================================
         * REDIRECT BERDASARKAN JENIS PEMOHON
         * =====================================================
         */
        return $this->redirectByApplicantType();
    }

    /**
     * =========================================================
     * REDIRECT BERDASARKAN JENIS PEMOHON
     *
     * MHS    -> Dashboard Mahasiswa
     * ALUMNI -> Dashboard Alumni
     * TENDIK -> Dashboard Tendik
     * DOSEN  -> Dashboard Dosen
     * MITRA  -> Dashboard Mitra
     * WALI   -> Dashboard Wali
     * UMUM   -> Dashboard Umum
     * =========================================================
     */
    protected function redirectByApplicantType()
    {
        $applicantCode = strtoupper(
            trim((string) session()->get('applicant_type_code'))
        );

        switch ($applicantCode) {

            /**
             * =================================================
             * MAHASISWA
             * =================================================
             */
            case 'MHS':

                return redirect()->to('/dashboard-mahasiswa');

            /**
             * =================================================
             * ALUMNI
             * =================================================
             */
            case 'ALUMNI':

                return redirect()->to('/alumni/dashboard');

            /**
             * =================================================
             * TENDIK
             * =================================================
             */
            case 'TENDIK':

                return redirect()->to('/dashboard-tendik');

            /**
             * =================================================
             * DOSEN
             * =================================================
             */
            case 'DOSEN':

                return redirect()->to('/dosen/dashboard');

            /**
             * =================================================
             * MITRA
             * =================================================
             */
            case 'MITRA':

                return redirect()->to('/mitra/dashboard');

            /**
             * =================================================
             * WALI
             * =================================================
             */
            case 'WALI':

                return redirect()->to('/wali/dashboard');

            /**
             * =================================================
             * UMUM
             * =================================================
             */
            case 'UMUM':

                return redirect()->to('/umum/dashboard');

            /**
             * =================================================
             * JIKA JENIS PEMOHON TIDAK DITEMUKAN
             * =================================================
             */
            default:

                return redirect()->to('/dashboard-mahasiswa');
        }
    }

    /**
     * =========================================================
     * CEK APAKAH USER WAJIB MFA
     * =========================================================
     */
    protected function requiresMfa(array $user): bool
    {
        return (int) ($user['mfa_enabled'] ?? 0) === 1
            && !empty($user['mfa_secret']);
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
            && (int) ($user['is_active'] ?? 0) === 1
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

        /**
         * Activity log logout.
         */
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

        /**
         * Hancurkan session.
         */
        session()->destroy();

        /**
         * Kembali ke login.
         */
        return redirect()->to('/login');
    }
}