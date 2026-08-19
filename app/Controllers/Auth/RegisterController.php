<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\MasterRoleModel;
use App\Models\MasterApplicantTypeModel;
use App\Models\MasterStudyProgramModel;
use App\Models\MasterClassModel;

class RegisterController extends BaseController
{
    protected UserModel $userModel;
    protected UserProfileModel $profileModel;
    protected MasterRoleModel $roleModel;
    protected MasterApplicantTypeModel $applicantTypeModel;
    protected MasterStudyProgramModel $studyProgramModel;
    protected MasterClassModel $classModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel           = new UserModel();
        $this->profileModel        = new UserProfileModel();
        $this->roleModel           = new MasterRoleModel();
        $this->applicantTypeModel  = new MasterApplicantTypeModel();
        $this->studyProgramModel   = new MasterStudyProgramModel();
        $this->classModel          = new MasterClassModel();
    }

    /**
     * Halaman Registrasi
     */
    public function index()
{
    if (session()->get('isLoggedIn')) {

        $userId = (int) session()->get('user_id');

        $dashboardUrl = $this->getDashboardUrl($userId);

        if ($dashboardUrl) {
            return redirect()->to($dashboardUrl);
        }

        session()->destroy();
    }

    return view('auth/register', [
        'title'          => 'Registrasi',
        'applicantTypes' => $this->applicantTypeModel->getActive(),
        'studyPrograms'  => $this->studyProgramModel->getActive(),
        'classes'        => $this->classModel->getActive(),
        'applicantCode'  => 'UMUM',
        'applicantType'  => null,
    ]);
}

    /**
     * Proses Registrasi
     */
    public function store()
    {
        $post = $this->request->getPost();

        $applicantTypeId = (int) ($post['applicant_type_id'] ?? 0);
        $email           = trim($post['email'] ?? '');
        $password        = $post['password'] ?? '';
        $fullName        = trim($post['full_name'] ?? '');

        // Validasi dasar
        if ($applicantTypeId <= 0 || $email === '' || $password === '' || $fullName === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Lengkapi semua field wajib.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Format email tidak valid.');
        }

        if (strlen($password) < 8) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password minimal 8 karakter.');
        }

        $passwordConfirm = $post['password_confirmation'] ?? '';

        if ($password !== $passwordConfirm) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Konfirmasi password tidak cocok.');
        }

        // Cek email sudah terdaftar
        $existing = $this->userModel->where('email', $email)->first();

        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email sudah terdaftar.');
        }

        // Ambil role PEMOHON
        $pemohonRole = $this->roleModel
            ->where('code', 'PEMOHON')
            ->first();

        $roleId = $pemohonRole ? (int) $pemohonRole['id'] : 0;

        if ($roleId <= 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role Pemohon tidak ditemukan. Hubungi administrator.');
        }

        $now = date('Y-m-d H:i:s');

        // Simpan user
        $userId = $this->userModel->insert([
            'role_id'          => $roleId,
            'full_name'        => $fullName,
            'identity_number'  => trim($post['identity_number'] ?? ''),
            'phone_number'     => trim($post['phone_number'] ?? ''),
            'email'            => $email,
            'password'         => password_hash($password, PASSWORD_DEFAULT),
            'profile_photo'    => null,
            'is_active'        => 1,
            'email_verified_at' => $now,
            'created_at'       => $now,
            'updated_at'       => $now,
            'deleted_at'       => null,
        ]);

        if (!$userId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data pengguna.');
        }

        // Ambil data jenis pemohon
$applicantType = $this->applicantTypeModel->find($applicantTypeId);

if (!$applicantType) {
    return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Jenis pemohon tidak valid.');
}

$applicantCode = strtoupper(trim($applicantType['code'] ?? ''));


if ($applicantCode === 'MHS') {

    $nim = trim($post['nim'] ?? '');
    $studyProgramId = (int) ($post['study_program_id'] ?? 0);
    $classId = (int) ($post['class_id'] ?? 0);

    if ($nim === '') {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'NIM wajib diisi.');
    }

    if ($studyProgramId <= 0) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Program studi wajib dipilih.');
    }

    if ($classId <= 0) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Kelas wajib dipilih.');
    }
}

        // Simpan profil pemohon
       $profileId = $this->profileModel->insert([
    'user_id'           => (int) $userId,
    'applicant_type_id' => $applicantTypeId,
    'study_program_id'  => $this->nullableInt($post['study_program_id'] ?? 0),
    'class_id'          => $this->nullableInt($post['class_id'] ?? 0),
    'nim'               => $this->nullable($post['nim'] ?? null, $applicantCode),
    'nik'               => $this->nullable($post['nik'] ?? null, $applicantCode),
    'student_name'      => $this->nullable($post['student_name'] ?? null),
    'institution_name'  => $this->nullable($post['institution_name'] ?? null),
    'position'          => $this->nullable($post['position'] ?? null),
    'name'              => $fullName,
    'email'             => $email,
    'phone'             => trim($post['phone_number'] ?? ''),
    'address'           => trim($post['address'] ?? ''),
    'photo'             => null,
    'created_at'        => $now,
    'updated_at'        => $now,
    'deleted_at'        => null,
]);

if (!$profileId) {

    // Hapus user yang tadi sudah berhasil dibuat
    $this->userModel->delete($userId);

    return redirect()
        ->back()
        ->withInput()
        ->with(
            'error',
            'Data profil gagal disimpan.'
        );
}

        // Auto login
        $user = $this->userModel->find($userId);

        $role = $this->roleModel->find($roleId);

        session()->set([
            'user_id'    => (int) $userId,
            'role_id'    => $roleId,
            'full_name'  => $fullName,
            'email'      => $email,
            'role_name'  => $role['name'] ?? 'Pemohon',
            'isLoggedIn' => true,
            'user'       => $user,
        ]);

        $dashboardUrl = $this->getDashboardUrl((int) $userId);

if (!$dashboardUrl) {

    session()->destroy();

    return redirect()
        ->to('/login')
        ->with(
            'error',
            'Registrasi berhasil, tetapi dashboard untuk jenis pemohon ini belum tersedia.'
        );
}

return redirect()
    ->to($dashboardUrl)
    ->with(
        'success',
        'Registrasi berhasil. Selamat datang, ' . $fullName . '!'
    );
    }

    /**
     * Ambil form dinamis berdasarkan jenis pemohon (AJAX)
     */
public function fields(int $applicantTypeId)
{
    $applicantType = $this->applicantTypeModel->find($applicantTypeId);

    if (!$applicantType) {
        return $this->response->setBody(
            '<p class="text-muted text-center py-3">
                Jenis pemohon tidak ditemukan.
            </p>'
        );
    }

    $code = strtoupper(trim($applicantType['code'] ?? ''));

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
     * Helper: kosongkan jika tidak ada
     */
    protected function nullable($value, $code = ''): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        return $value;
    }

    /**
     * Helper: int nullable
     */
    protected function nullableInt($value): ?int
    {
        $value = (int) $value;

        return $value > 0 ? $value : null;
    }

    /**
 * Tentukan dashboard berdasarkan jenis pemohon
 */
private function getDashboardUrl(int $userId): ?string
{
    $db = \Config\Database::connect();

    $profile = $db->table('user_profiles up')
        ->select('
            up.applicant_type_id,
            mat.code AS applicant_code
        ')
        ->join(
            'master_applicant_types mat',
            'mat.id = up.applicant_type_id',
            'left'
        )
        ->where('up.user_id', $userId)
        ->where('up.deleted_at', null)
        ->get()
        ->getRowArray();

    if (!$profile) {
        return null;
    }

    $code = strtoupper(trim($profile['applicant_code'] ?? ''));

    switch ($code) {

        case 'MHS':
            return '/dashboard-mahasiswa';

        case 'DOSEN':
            return '/dosen/dashboard';

        case 'TENDIK':
            return '/dashboard-tendik';

        case 'WALI':
            return '/dashboard-orangtua';

        case 'MITRA':
            return '/dashboard-mitra';

        case 'UMUM':
            return '/dashboard-umum';

        case 'ALUMNI':
            return '/dashboard-alumni';

        default:
            return null;
    }
}
}
