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
    }

    /**
     * Halaman Registrasi
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register', [
            'title'          => 'Registrasi',
            'applicantTypes' => $this->applicantTypeModel->getActive(),
            'studyPrograms'  => $this->studyProgramModel->getActive(),
            'classes'        => $this->classModel->getActive(),
            'applicantCode'  => 'UMUM',
            'applicantType'  => null,
            'data'           => [],
        ]);
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
     */
    public function store()
    {
        $data = $this->request->getPost();

        if (! $this->validate(RegisterValidator::store())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        if ((int) ($data['applicant_type_id'] ?? 0) <= 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Pilih jenis pemohon.');
        }

        if ($this->userModel->where('email', $data['email'])->first()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email sudah registrasi silakan login.');
        }

        $role = $this->roleModel
            ->where('code', 'PEMOHON')
            ->where('is_active', 1)
            ->first();

        $roleId = $role ? (int) $role['id'] : 0;

        if ($roleId <= 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Role Pemohon tidak ditemukan. Hubungi administrator.');
        }

        $secret = $this->mfaService->generateSecret();

        $userId = $this->userModel->insert([
            'role_id'         => $roleId,
            'full_name'       => $data['full_name'],
            'identity_number' => $this->nullable($data['identity_number'] ?? null),
            'phone_number'    => $this->nullable($data['phone_number'] ?? null),
            'gender'          => in_array($data['gender'] ?? '', ['L', 'P'], true) ? $data['gender'] : null,
            'email'           => $data['email'],
            'password'        => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_active'       => 0,
            'mfa_secret'      => $secret,
        ]);

        if (! $userId) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal proses registrasi. Silakan coba lagi.');
        }
// Simpan profile pemohon
        $this->saveProfile((int) $userId, $data);

        // Setup MFA: simpan secret + recovery codes, aktifasi hanya setelah verifikasi
        $recoveryCodes = $this->mfaService->generateRecoveryCodes();

        $this->mfaService->beginSetup((int) $userId, $secret, $recoveryCodes);

        session()->set('mfa_pending', [
            'user_id'   => (int) $userId,
            'full_name' => $data['full_name'],
            'email'     => $data['email'],
        ]);

        return redirect()->to('/register/mfa');
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
            ->to('/login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
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