<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Services\MfaService;
use App\Services\RegistrationRequestService;
use App\Validation\RegisterValidator;

/**
 * Registrasi lanjutan (pending-approval).
 *
 * Alur:
 * 1. /registration-request  : pemohon mengirim payload lengkap -> PENDING.
 * 2. Admin approve          : user + profile dibuat di DB utama (is_active = 0).
 * 3. /register (gate)       : pemohon verifikasi email yang telah disetujui.
 * 4. /register/mfa          : scan QR + simpan recovery codes.
 * 5. /register/mfa/verify   : verifikasi kode -> akun aktif -> login.
 */
class RegisterController extends BaseController
{
    protected UserModel $userModel;

    protected MfaService $mfaService;

    protected RegistrationRequestService $registrationRequestService;

    public function __construct()
    {
        helper(['form', 'url']);

        $this->userModel                  = new UserModel();
        $this->mfaService                 = new MfaService();
        $this->registrationRequestService = new RegistrationRequestService();
    }

    /**
     * Halaman Registrasi (gerbang verifikasi izin)
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        // Lanjutkan setup MFA yang belum selesai (mis. halaman di-refresh).
        $pending = session()->get('mfa_pending');

        if ($pending && ! empty($pending['user_id']) && $this->isPendingActivation((int) $pending['user_id'])) {
            return redirect()->to('/register/mfa');
        }

        session()->remove('mfa_pending');
        session()->remove('registration_approved_email');

        return view('auth/register_gate', [
            'title' => 'Verifikasi Izin Registrasi',
        ]);
    }

    /**
     * Verifikasi email yang sudah disetujui + siapkan MFA.
     * Akun (user + profile) sudah dibuat saat admin approve, jadi di sini
     * hanya menyiapkan secret MFA; aktivasi dilakukan pada verify().
     */
    public function gate()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $email = strtolower(trim((string) $this->request->getPost('email')));

        if ($email === '') {
            return redirect()
                ->to('/register')
                ->with('error', 'Masukkan email yang telah disetujui.');
        }

        if (! $this->hasApprovedRegistrationRequest($email)) {
            session()->remove('registration_approved_email');
            session()->remove('mfa_pending');

            return redirect()
                ->to('/register')
                ->with('error', 'Anda belum mendapatkan izin untuk melakukan registrasi. Silakan mengajukan permintaan izin registrasi terlebih dahulu.');
        }

        $user = $this->userModel->where('email', $email)->first();

        if (! $user) {
            return redirect()
                ->to('/register')
                ->with('error', 'Data akun untuk email tersebut belum tersedia. Hubungi administrator.');
        }

        if ((int) ($user['is_active'] ?? 0) === 1) {
            return redirect()
                ->to('/login')
                ->with('info', 'Akun Anda sudah aktif. Silakan login.');
        }

        // Siapkan secret + recovery codes (mfa_enabled tetap 0 sampai diverifikasi).
        $secret        = $this->mfaService->generateSecret();
        $recoveryCodes = $this->mfaService->generateRecoveryCodes();

        if (! $this->mfaService->beginSetup((int) $user['id'], $secret, $recoveryCodes)) {
            return redirect()
                ->to('/register')
                ->with('error', 'Gagal menyiapkan MFA. Silakan coba lagi.');
        }

        session()->set('registration_approved_email', $email);
        session()->set('mfa_pending', [
            'user_id'   => (int) $user['id'],
            'full_name' => $user['full_name'] ?? '',
            'email'     => $email,
        ]);

        return redirect()->to('/register/mfa');
    }

    /**
     * Kompatibilitas endpoint lama (POST /register) = verifikasi izin.
     */
    public function store()
    {
        return $this->gate();
    }

    /**
     * Halaman Setup MFA (QR + recovery codes)
     */
    public function mfaSetup()
    {
        $pending = session()->get('mfa_pending');

        if (! $pending || empty($pending['user_id'])) {
            return redirect()->to('/register');
        }

        $user = $this->userModel->find($pending['user_id']);

        if (! $user || empty($user['mfa_secret']) || (int) ($user['is_active'] ?? 0) === 1) {
            return redirect()->to('/register');
        }

        $secret = $user['mfa_secret'];

        $uri = $this->mfaService->provisioningUri($secret, (string) $user['email']);

        $recoveryCodes = json_decode($user['mfa_recovery_codes'] ?? '[]', true);
        $recoveryCodes = is_array($recoveryCodes) ? $recoveryCodes : [];

        return view('auth/register_mfa', [
            'title'         => 'Setup MFA',
            'secret'        => $secret,
            'uri'           => $uri,
            'recoveryCodes' => $recoveryCodes,
            'account'       => $pending,
        ]);
    }

    /**
     * Verify MFA Code (aktivasi akun)
     */
    public function verify()
    {
        $pending = session()->get('mfa_pending');

        if (! $pending || empty($pending['user_id'])) {
            return redirect()->to('/register');
        }

        $data = $this->request->getPost();

        if (! $this->validate(RegisterValidator::mfaVerify())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        if (! $this->mfaService->verifyCode((int) $pending['user_id'], (string) $data['mfa_code'])) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Kode MFA tidak valid. Silakan coba lagi.');
        }

        $this->mfaService->activate((int) $pending['user_id']);

        session()->remove('mfa_pending');
        session()->remove('registration_approved_email');

        return redirect()
            ->to('/login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }

    /**
     * Cek apakah email memiliki permintaan izin registrasi berstatus approved.
     */
    protected function hasApprovedRegistrationRequest(string $email): bool
    {
        return $this->registrationRequestService->hasApproved($email);
    }

    /**
     * Apakah user masih menunggu aktivasi (dibuat saat approve, is_active = 0).
     */
    protected function isPendingActivation(int $userId): bool
    {
        $user = $this->userModel->find($userId);

        return $user
            && (int) ($user['is_active'] ?? 0) === 0
            && ! empty($user['mfa_secret']);
    }
}