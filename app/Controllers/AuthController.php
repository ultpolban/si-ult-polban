<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserTypeModel;
use App\Models\DepartmentModel;
use App\Models\StudyProgramModel;
use App\Models\WorkUnitModel;
use App\Models\ClassModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;
    protected RoleModel $roleModel;
    protected UserTypeModel $userTypeModel;
    protected DepartmentModel $departmentModel;
    protected StudyProgramModel $studyProgramModel;
    protected WorkUnitModel $workUnitModel;
    protected ClassModel $classModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->userTypeModel = new UserTypeModel();
        $this->departmentModel = new DepartmentModel();
        $this->studyProgramModel = new StudyProgramModel();
        $this->workUnitModel = new WorkUnitModel();
        $this->classModel = new ClassModel();
    }

    /*
|--------------------------------------------------------------------------
| Register Master Data
|--------------------------------------------------------------------------
*/

    private function getRegisterData(): array
    {
        return [

            'title' => 'Registrasi',

            // Role (tanpa Administrator)
            'roles' => $this->roleModel
                ->where('name !=', 'Administrator')
                ->orderBy('name', 'ASC')
                ->findAll(),

            // Jenis Pemohon
            'userTypes' => $this->userTypeModel
                ->orderBy('name', 'ASC')
                ->findAll(),

            // Jurusan
            'departments' => $this->departmentModel
                ->orderBy('name', 'ASC')
                ->findAll(),

            // Program Studi
            'studyPrograms' => $this->studyProgramModel
                ->select('master_study_programs.*, master_departments.name as department_name')
                ->join(
                    'master_departments',
                    'master_departments.id = master_study_programs.department_id',
                    'left'
                )
                ->orderBy('degree', 'ASC')
                ->orderBy('master_study_programs.name', 'ASC')
                ->findAll(),

            // Unit Kerja
            'workUnits' => $this->workUnitModel
                ->orderBy('name', 'ASC')
                ->findAll(),

            // Kelas
            'classes' => $this->classModel
                ->orderBy('name', 'ASC')
                ->findAll()

        ];
    }


    private function validationRules(): array
    {
        $rules = [

            // ===============================
            // DATA AKUN
            // ===============================

            'full_name' => 'required|min_length[3]|max_length[150]',

            'email' => 'required|valid_email|is_unique[users.email]',

            'password' => 'required|min_length[8]',

            'password_confirmation' => 'required|matches[password]',

            'user_type_id' => 'required',

            // ===============================
            // DATA PRIBADI
            // ===============================

            'phone' => 'required',

            'gender' => 'required',

            'address' => 'required',

            // ===============================
            // FOTO
            // ===============================

            'photo' => [
                'rules' => 'permit_empty|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'Format foto harus JPG atau PNG.',
                    'max_size' => 'Ukuran foto maksimal 2 MB.'
                ]
            ]

        ];

        $userType = (int) $this->request->getPost('user_type_id');

        switch ($userType) {

            /*
            |--------------------------------------------------------------------------
            | Mahasiswa
            |--------------------------------------------------------------------------
            */

            case 1: // Mahasiswa

                $rules['nim'] = 'required';

                $rules['department_id'] = 'required';

                $rules['study_program_id'] = 'required';

                $rules['class_id'] = 'required';

                $rules['angkatan'] = 'required|integer';

                $rules['entry_year'] = 'required|integer';

                $rules['student_status'] = 'required';

                break;

            case 2: // Dosen

                $rules['nip'] = 'required';

                $rules['nidn'] = 'required';

                $rules['department_id'] = 'required';

                $rules['work_unit_id'] = 'required';

                $rules['academic_position'] = 'required';

                $rules['functional_position'] = 'required';

                $rules['employee_status'] = 'required';

                break;

            case 3: // Tendik

                $rules['nip'] = 'required';

                $rules['work_unit_id'] = 'required';

                $rules['employee_status'] = 'required';

                break;

            case 4: // Alumni

                $rules['nim'] = 'required';

                $rules['department_id'] = 'required';

                $rules['study_program_id'] = 'required';

                $rules['graduation_year'] = 'required|integer';

                break;

            case 5: // Orang Tua / Wali

                $rules['relationship'] = 'required';

                $rules['student_name'] = 'required';

                $rules['student_nim'] = 'required';

                break;

            case 6: // Mitra

                $rules['institution_name'] = 'required';

                $rules['institution_type'] = 'required';

                $rules['position'] = 'required';

                $rules['job_title'] = 'required';

                break;

            case 7: // Publik

                $rules['identity_number'] = 'required';

                break;
        }

        return $rules;
    }

    private function validationMessages(): array
    {
        return [

            'full_name' => [
                'required' => 'Nama lengkap wajib diisi.'
            ],

            'email' => [
                'required' => 'Email pribadi wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique' => 'Email sudah terdaftar.'
            ],

            'password' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password minimal 8 karakter.'
            ],

            'password_confirmation' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches' => 'Konfirmasi password tidak sama.'
            ],

            'user_type_id' => [
                'required' => 'Jenis pemohon harus dipilih.'
            ],

            'phone' => [
                'required' => 'Nomor HP wajib diisi.'
            ],

            'gender' => [
                'required' => 'Jenis kelamin harus dipilih.'
            ],

            'address' => [
                'required' => 'Alamat wajib diisi.'
            ],

        ];
    }

    private function uploadPhoto(): ?string
    {
        $photo = $this->request->getFile('photo');

        if (!$photo || !$photo->isValid() || $photo->hasMoved()) {
            return null;
        }

        $photoName = $photo->getRandomName();

        $photo->move(
            ROOTPATH . 'public/uploads/users',
            $photoName
        );

        return $photoName;
    }

    private function buildUserData(string $passwordHash, ?string $photoName): array
    {
        return [

            // Relasi
            'role_id'            => 5,
            'user_type_id'       => $this->request->getPost('user_type_id'),

            // Data akun
            'full_name'          => trim($this->request->getPost('full_name')),
            'email'              => trim($this->request->getPost('email')),
            'institution_email'  => $this->request->getPost('institution_email'),

            // Password
            'password'           => $passwordHash,

            // Data pribadi
            'phone'              => $this->request->getPost('phone'),
            'gender'             => $this->request->getPost('gender'),
            'address'            => $this->request->getPost('address'),

            // Foto
            'photo'              => $photoName,

            // Default
            'is_active'          => 1

        ];
    }

    private function fillUserTypeData(array &$userData): void
    {
        $userType = (int) $this->request->getPost('user_type_id');

        switch ($userType) {

            case 1:

                $userData['nim'] = trim($this->request->getPost('nim'));

                $userData['department_id'] = $this->request->getPost('department_id');

                $userData['study_program_id'] = $this->request->getPost('study_program_id');

                $userData['class_id'] = $this->request->getPost('class_id');

                $userData['angkatan'] = $this->request->getPost('angkatan');

                $userData['entry_year'] = $this->request->getPost('entry_year');

                $userData['student_status'] = $this->request->getPost('student_status');

                break;

            case 2:

                $userData['nip'] = trim($this->request->getPost('nip'));

                $userData['nidn'] = trim($this->request->getPost('nidn'));

                $userData['department_id'] = $this->request->getPost('department_id');

                $userData['work_unit_id'] = $this->request->getPost('work_unit_id');

                $userData['academic_position'] = $this->request->getPost('academic_position');

                $userData['functional_position'] = $this->request->getPost('functional_position');

                $userData['employee_status'] = $this->request->getPost('employee_status');

                break;

            case 3:

                $userData['nip'] = trim($this->request->getPost('nip'));

                $userData['work_unit_id'] = $this->request->getPost('work_unit_id');

                $userData['employee_status'] = $this->request->getPost('employee_status');

                break;

            case 4:

                $userData['nim'] = trim($this->request->getPost('nim'));

                $userData['department_id'] = $this->request->getPost('department_id');

                $userData['study_program_id'] = $this->request->getPost('study_program_id');

                $userData['graduation_year'] = $this->request->getPost('graduation_year');

                break;

            case 5:

                $userData['relationship'] = $this->request->getPost('relationship');

                $userData['student_name'] = $this->request->getPost('student_name');

                $userData['student_nim'] = $this->request->getPost('student_nim');

                break;

            case 6:

                $userData['institution_name'] = $this->request->getPost('institution_name');

                $userData['institution_type'] = $this->request->getPost('institution_type');

                $userData['position'] = $this->request->getPost('position');

                $userData['job_title'] = $this->request->getPost('job_title');

                break;

            case 7:

                $userData['identity_number'] = $this->request->getPost('identity_number');

                break;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATE
    |--------------------------------------------------------------------------
    */

    public function authenticate()
    {
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $user = $this->userModel->getUserByEmail($email);

        if (!$user) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email tidak terdaftar.');
        }

        if (!password_verify($password, $user['password'])) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Password salah.');
        }

        if (!$user['is_active']) {

            return redirect()
                ->back()
                ->with('error', 'Akun belum aktif.');
        }

        $this->userModel->updateLastLogin($user['id']);

        $this->setUserSession($user);

        return redirect()
            ->to('/')
            ->with('success', 'Selamat datang ' . $user['full_name']);
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $data = $this->getRegisterData();

        return view('auth/register', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE REGISTER
    |--------------------------------------------------------------------------
    */

    public function storeRegister()
    {
        // Validasi
        if (!$this->validate(
            $this->validationRules(),
            $this->validationMessages()
        )) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {

            /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

            $photoName = $this->uploadPhoto();

            /*
        |--------------------------------------------------------------------------
        | Hash Password
        |--------------------------------------------------------------------------
        */

            $passwordHash = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );

            /*
        |--------------------------------------------------------------------------
        | Data User
        |--------------------------------------------------------------------------
        */

            $userData = $this->buildUserData(
                $passwordHash,
                $photoName
            );

            /*
        |--------------------------------------------------------------------------
        | Data sesuai Jenis Pemohon
        |--------------------------------------------------------------------------
        */

            $this->fillUserTypeData($userData);

            /*
        |--------------------------------------------------------------------------
        | Simpan User
        |--------------------------------------------------------------------------
        */

            $this->userModel->insert($userData);

            return redirect()
                ->to('/login')
                ->with(
                    'success',
                    'Registrasi berhasil. Silakan login.'
                );
        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    private function setUserSession(array $user): void
    {
        session()->set([

            'user_id'        => $user['id'],
            'full_name'      => $user['full_name'],
            'email'          => $user['email'] ?? '',

            'role_id'        => $user['role_id'],
            'role_name'      => $user['role_name'] ?? '',

            'user_type_id'   => $user['applicant_type_id'] ?? null,

            'photo'          => $user['photo'] ?? null,

            'is_active'      => $user['is_active'],

            'logged_in'      => true,

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Berhasil logout.'
            );
    }
}
