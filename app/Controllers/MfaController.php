<?php

namespace App\Controllers;

use App\Models\UserModel;
use PragmaRX\Google2FA\Google2FA;

class MfaController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan QR Code untuk Setup MFA
    |--------------------------------------------------------------------------
    */
    public function setup()
    {
        $userId = session()->get('mfa_setup_user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi setup MFA telah berakhir atau tidak valid.');
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Generate secret baru jika belum ada
        if (empty($user['mfa_secret'])) {
            $google2fa = new Google2FA();
            $secret = $google2fa->generateSecretKey();
            
            $this->userModel->update($userId, [
                'mfa_secret' => $secret
            ]);
            $user['mfa_secret'] = $secret;
        }

        $google2fa = new Google2FA();
        
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'Sistem ULT Polban',
            $user['email'],
            $user['mfa_secret']
        );

        // Generate QR code image URL using external API
        $qrImage = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($qrCodeUrl);

        return view('auth/mfa_setup', [
            'title' => 'Setup MFA',
            'qrImage' => $qrImage,
            'secret' => $user['mfa_secret']
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Validasi Kode saat Setup
    |--------------------------------------------------------------------------
    */
    public function setupVerify()
    {
        $userId = session()->get('mfa_setup_user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi setup MFA tidak valid.');
        }

        $code = $this->request->getPost('code');
        $user = $this->userModel->find($userId);

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($user['mfa_secret'], $code);

        if ($valid) {
            $this->userModel->update($userId, [
                'mfa_enabled' => 1
            ]);
            
            // Selesai setup, bersihkan sesi setup, minta user login ulang atau langsung login
            session()->remove('mfa_setup_user_id');
            
            return redirect()->to('/login')->with('success', 'MFA berhasil diaktifkan! Silakan login kembali dengan kode dari aplikasi Authenticator Anda.');
        }

        return redirect()->back()->with('error', 'Kode verifikasi salah.');
    }

    /*
    |--------------------------------------------------------------------------
    | Form Verifikasi MFA saat Login
    |--------------------------------------------------------------------------
    */
    public function verify()
    {
        $userId = session()->get('mfa_pending_user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi verifikasi MFA tidak valid.');
        }

        return view('auth/mfa_verify', [
            'title' => 'Verifikasi MFA'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Proses Verifikasi MFA saat Login
    |--------------------------------------------------------------------------
    */
    public function verifyProcess()
    {
        $userId = session()->get('mfa_pending_user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Sesi verifikasi MFA tidak valid.');
        }

        $code = $this->request->getPost('code');
        $user = $this->userModel->find($userId);

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($user['mfa_secret'], $code);

        if ($valid) {
            session()->remove('mfa_pending_user_id');
            
            $this->setUserSession($user);

            $this->userModel->updateLastLogin($user['id']);

            // Catat aktivitas login sukses setelah MFA
            (new \App\Services\ActivityLogService())->log(
                $user['id'],
                'login',
                'auth',
                ['new_data' => ['ip' => $this->request->getIPAddress(), 'role' => $user['role_name'] ?? '', 'mfa' => 'verified']]
            );

            $dashboard = ($user['role_code'] ?? '') === 'PIMPINAN'
                ? '/pimpinan/dashboard'
                : '/dashboard';

            return redirect()->to($dashboard)->with('success', 'Selamat datang ' . $user['full_name']);
        }

        return redirect()->back()->with('error', 'Kode verifikasi salah.');
    }

    private function setUserSession(array $user): void
    {
        session()->set([
            'user_id'        => $user['id'],
            'full_name'      => $user['full_name'],
            'email'          => $user['email'] ?? '',
            'role_id'        => $user['role_id'],
            'role_name'      => $user['role_name'] ?? '',
            'role_code'      => $user['role_code'] ?? '',
            'user_type_id'   => $user['applicant_type_id'] ?? null,
            'photo'          => $user['photo'] ?? null,
            'is_active'      => $user['is_active'],
            'logged_in'      => true,
        ]);
    }
}
