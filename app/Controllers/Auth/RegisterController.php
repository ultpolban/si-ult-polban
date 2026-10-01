<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\MasterApplicantTypeModel;
use App\Models\MasterClassModel;
use App\Models\MasterRoleModel;
use App\Models\MasterStudyProgramModel;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Services\MfaService;
use App\Services\RegistrationRequestService;
use App\Validation\RegisterValidator;

class RegisterController extends BaseController
{
    protected UserModel $userModel;

    protected UserProfileModel $profileModel;

    protected MasterRoleModel $roleModel;

    protected MasterApplicantTypeModel $applicantTypeModel;

    protected MasterStudyProgramModel $studyProgramModel;

    protected MasterClassModel $classModel;

    protected MfaService $mfaService;

    protected RegistrationRequestService $requestService;

    public function __construct()
    {
        helper(['form', 'url', 'text']);

        $this->userModel          = new UserModel();
        $this->profileModel       = new UserProfileModel();
        $this->roleModel          = new MasterRoleModel();
        $this->applicantTypeModel = new MasterApplicantTypeModel();
        $this->studyProgramModel  = new MasterStudyProgramModel();
        $this->classModel         = new MasterClassModel();
        $this->mfaService         = new MfaService();
        $this->requestService     = new RegistrationRequestService();
    }

    /**
     * Halaman Registrasi = gerbang verifikasi izin.
     *
     * Alur registrasi (pending approval):
     * 1. /registration-request : pemohon mengirim permintaan izin.
     * 2. Admin menyetujui      : user + profile dibuat (is_active = 0).
     * 3. /register (gate)     : pemohon verifikasi email yang disetujui.
     * 4. /register/mfa        : scan QR + simpan recovery codes.
     * 5. /register/mfa/verify : verifikasi kode -> akun aktif -> login.
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
     * Pendaftaran langsung (alternatif tanpa approval admin).
     *
     * DINONAKTIFKAN.
     *
     * Pendaftaran hanya boleh terjadi melalui alur resmi:
     *   /registration-request -> disetujui admin -> /register (gate)
     *   -> /register/mfa -> /register/mfa/verify -> aktif
     *
     * Method ini sengaja tidak lagi menampilkan form pendaftaran
     * dan mengarahkan pemohon ke halaman pengajuan izin. Route-nya
     * juga sudah dilepas dari app/Config/Routes.php.
     *
     * Metabahan ini dibiarkan (tidak dihapus) sebagai penjaga
     * tambahan bila suatu saat route-nya aktif kembali.
     */
    public function daftar()
    {
        return redirect()
            ->to('/registration-request')
            ->with(
                'info',
                'Pendaftaran dilakukan setelah izin registrasi disetujui administrator. '
                . 'Silakan ajukan izin terlebih dahulu.'
            );
    }

    /**
     * Verifikasi email yang sudah disetujui admin + siapkan MFA.
     *
     * Akun (user + profile) sudah dibuat saat admin menyetujui
     * permintaan, jadi di sini hanya menyiapkan secret MFA.
     * Aktivasi dilakukan pada verify().
     */
    public function gate()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $email = strtolower(
            trim((string) $this->request->getPost('email'))
        );

        if ($email === '') {
            return redirect()
                ->to('/register')
                ->with('error', 'Masukkan email yang telah disetujui.');
        }

        if (! $this->requestService->hasApproved($email)) {
            session()->remove('registration_approved_email');
            session()->remove('mfa_pending');

            return redirect()
                ->to('/register')
                ->with(
                    'error',
                    'Anda belum mendapatkan izin untuk melakukan registrasi. '
                    . 'Silakan mengajukan permintaan izin registrasi terlebih dahulu.'
                );
        }

        $user = $this->userModel->where('email', $email)->first();

        if (! $user) {
            return redirect()
                ->to('/register')
                ->with('error', 'Data akun untuk email tersebut belum tersedia. Hubungi administrator.');
        }

        if ((int) ($user['is_active'] ?? 0) === 1) {
            return redirect()
                ->to('/login/form')
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
     * Form dinamis berdasarkan jenis pemohon (AJAX)
     */
    public function fields(int $applicantTypeId)
    {
        $applicantType = $this->applicantTypeModel->find($applicantTypeId);

        if (! $applicantType) {
            return $this->response->setBody(
                '<p class="text-muted text-center py-3">Jenis pemohon tidak ditemukan.</p>'
            );
        }

        $code = strtoupper($applicantType['code'] ?? '');

        $data = [
            'applicantCode' => $code,
            'applicantType' => $applicantType,
            'studyPrograms' => $this->studyProgramModel->getActive(),
            'classes'       => $this->classModel->getActive(),
            'data'          => [],
        ];

        return view('auth/_register_fields', $data);
    }

    /**
     * Proses Registrasi (step 1: create pending account)
     *
     * DITUTUP.
     *
     * Akun tidak boleh dibuat langsung dari form pendaftaran publik.
     * Akun dibuat oleh proses persetujuan admin pada
     * RegistrationRequestService, setelah itu pemohon cukup
     * memverifikasi email lewat /register (gate) lalu menyiapkan MFA.
     *
     * Penjaga ini dipertahankan sebagai lapisan kedua: walaupun
     * route-nya suatu hari ditambahkan kembali, pembuatan akun
     * tanpa izin yang disetujui tetap ditolak.
     */
    public function store()
    {
        return redirect()
            ->to('/registration-request')
            ->with(
                'error',
                'Pendaftaran langsung tidak diizinkan. '
                . 'Silakan ajukan izin registrasi dan tunggu persetujuan administrator.'
            );
    }

    /**
     * Halaman Setup MFA (step 2: QR + recovery codes)
     */
    public function mfaSetup()
    {
        $pending = session()->get('mfa_pending');

        if (! $pending || empty($pending['user_id'])) {
            return redirect()->to('/register');
        }

        $user = $this->userModel->find($pending['user_id']);

        if (! $user || empty($user['mfa_secret'])) {
            return redirect()->to('/register');
        }

        $secret = $user['mfa_secret'];

        $uri = $this->mfaService->provisioningUri($secret, $user['email']);

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
     * Verify MFA Code (step 3: activate account)
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

        if (! $this->mfaService->verifyCode((int) $pending['user_id'], $data['mfa_code'])) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Kode MFA tidak valid. Silakan coba lagi.');
        }

        $this->mfaService->activate((int) $pending['user_id']);

        session()->remove('mfa_pending');

        return redirect()
            ->to('/login/form')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }

    /**
     * Apakah user masih menunggu aktivasi (MFA belum diaktifkan).
     */
    protected function isPendingActivation(int $userId): bool
    {
        $user = $this->userModel->find($userId);

        return $user !== null
            && (int) ($user['is_active'] ?? 0) === 0
            && ! empty($user['mfa_secret']);
    }

    /**
     * Simpan profile pemohon
     */
    protected function saveProfile(int $userId, array $data): void
    {
        $this->profileModel->insert([
            'user_id'           => $userId,
            'applicant_type_id' => (int) ($data['applicant_type_id'] ?? 0),
            'study_program_id'  => $this->nullableInt($data['study_program_id'] ?? 0),
            'class_id'          => $this->nullableInt($data['class_id'] ?? 0),
            'nim'               => $this->nullable($data['nim'] ?? null),
            'nik'               => $this->nullable($data['nik'] ?? null),
            'student_name'      => $this->nullable($data['student_name'] ?? null),
            'institution_name'  => $this->nullable($data['institution_name'] ?? null),
            'position'          => $this->nullable($data['position'] ?? null),
            'name'              => $data['full_name'] ?? '',
            'email'             => $this->nullable($data['email'] ?? null),
            'phone'             => $this->nullable($data['phone_number'] ?? null),
            'address'           => $this->nullable($data['address'] ?? null),
        ]);
    }

    /**
     * Helper: kosong if empty
     */
    protected function nullable($value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    /**
     * Helper: int nullable
     */
    protected function nullableInt($value): ?int
    {
        $value = (int) $value;

        return $value > 0 ? $value : null;
    }
}