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

class UserController extends BaseController
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
    | MASTER DATA
    |--------------------------------------------------------------------------
    */

    private function getMasterData(): array
    {
        return [

            'roles' => $this->roleModel
                ->orderBy('role_name', 'ASC')
                ->findAll(),

            'userTypes' => $this->userTypeModel
                ->orderBy('type_name', 'ASC')
                ->findAll(),

            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll(),

            'workUnits' => $this->workUnitModel
                ->orderBy('unit_name', 'ASC')
                ->findAll(),

            'classes' => $this->classModel
                ->orderBy('class_name', 'ASC')
                ->findAll()

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD PHOTO
    |--------------------------------------------------------------------------
    */

    private function uploadPhoto(?string $oldPhoto = null): ?string
    {
        $photo = $this->request->getFile('photo');

        if (!$photo || !$photo->isValid() || $photo->hasMoved()) {
            return $oldPhoto;
        }

        $path = FCPATH . 'uploads/users';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if (!empty($oldPhoto)) {

            $old = $path . '/' . $oldPhoto;

            if (file_exists($old)) {
                unlink($old);
            }
        }

        $newName = $photo->getRandomName();

        $photo->move($path, $newName);

        return $newName;
    }

    private function buildUserData(bool $hashPassword = false): array
    {
        $password = $this->request->getPost('password');

        $data = [

            /*
        |--------------------------------------------------------------------------
        | ACCOUNT
        |--------------------------------------------------------------------------
        */

            'role_id' => $this->request->getPost('role_id'),

            'user_type_id' => $this->request->getPost('user_type_id'),

            'full_name' => trim($this->request->getPost('full_name')),

            'personal_email' => trim($this->request->getPost('personal_email')),

            'institution_email' => $this->request->getPost('institution_email'),

            'password' => ($hashPassword && !empty($password))
                ? password_hash($password, PASSWORD_DEFAULT)
                : null,

            'is_active' => $this->request->getPost('is_active'),

            /*
        |--------------------------------------------------------------------------
        | PERSONAL
        |--------------------------------------------------------------------------
        */

            'phone' => $this->request->getPost('phone'),

            'gender' => $this->request->getPost('gender'),

            'birth_place' => $this->request->getPost('birth_place'),

            'birth_date' => $this->request->getPost('birth_date'),

            'address' => $this->request->getPost('address')

        ];

        $userType = (int) $this->request->getPost('user_type_id');

        switch ($userType) {

            /*
        |--------------------------------------------------------------------------
        | Mahasiswa
        |--------------------------------------------------------------------------
        */

            case 1:

                $data['nim'] = $this->request->getPost('nim');

                $data['department_id'] = $this->request->getPost('department_id');

                $data['study_program_id'] = $this->request->getPost('study_program_id');

                $data['class_id'] = $this->request->getPost('class_id');

                $data['angkatan'] = $this->request->getPost('angkatan');

                $data['entry_year'] = $this->request->getPost('entry_year');

                $data['student_status'] = $this->request->getPost('student_status');

                break;

            /*
        |--------------------------------------------------------------------------
        | Dosen
        |--------------------------------------------------------------------------
        */

            case 2:

                $data['nip'] = $this->request->getPost('nip');

                $data['nidn'] = $this->request->getPost('nidn');

                $data['department_id'] = $this->request->getPost('department_id');

                $data['work_unit_id'] = $this->request->getPost('work_unit_id');

                $data['academic_position'] = $this->request->getPost('academic_position');

                $data['functional_position'] = $this->request->getPost('functional_position');

                $data['employee_status'] = $this->request->getPost('employee_status');

                break;

            /*
        |--------------------------------------------------------------------------
        | Tendik
        |--------------------------------------------------------------------------
        */

            case 3:

                $data['nip'] = $this->request->getPost('nip');

                $data['work_unit_id'] = $this->request->getPost('work_unit_id');

                $data['position'] = $this->request->getPost('position');

                $data['employee_status'] = $this->request->getPost('employee_status');

                break;

            /*
        |--------------------------------------------------------------------------
        | Alumni
        |--------------------------------------------------------------------------
        */

            case 4:

                $data['nim'] = $this->request->getPost('nim');

                $data['department_id'] = $this->request->getPost('department_id');

                $data['study_program_id'] = $this->request->getPost('study_program_id');

                $data['graduation_year'] = $this->request->getPost('graduation_year');

                break;

            /*
        |--------------------------------------------------------------------------
        | Orang Tua / Wali
        |--------------------------------------------------------------------------
        */

            case 5:

                $data['student_name'] = $this->request->getPost('student_name');

                $data['student_nim'] = $this->request->getPost('student_nim');

                $data['relationship'] = $this->request->getPost('relationship');

                break;

            /*
        |--------------------------------------------------------------------------
        | Mitra
        |--------------------------------------------------------------------------
        */

            case 6:

                $data['institution_name'] = $this->request->getPost('institution_name');

                $data['institution_type'] = $this->request->getPost('institution_type');

                $data['position'] = $this->request->getPost('position');

                $data['job_title'] = $this->request->getPost('job_title');

                break;

            /*
        |--------------------------------------------------------------------------
        | Publik
        |--------------------------------------------------------------------------
        */

            case 7:

                $data['identity_number'] = $this->request->getPost('identity_number');

                break;
        }

        return array_filter(
            $data,
            static fn($value) => $value !== '' && $value !== null
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

    private function validationRules(?int $id = null): array
    {
        $emailRule = 'required|valid_email';

        if ($id === null) {

            $emailRule .= '|is_unique[users.personal_email]';
        } else {

            $emailRule .= '|is_unique[users.personal_email,id,' . $id . ']';
        }

        $rules = [

            // ===============================
            // DATA AKUN
            // ===============================

            'role_id' => 'required',

            'full_name' => 'required|min_length[3]|max_length[150]',

            'personal_email' => $emailRule,

            'password' => $id === null
                ? 'required|min_length[8]'
                : 'permit_empty|min_length[8]',

            'password_confirmation' => $id === null
                ? 'required|matches[password]'
                : 'permit_empty|matches[password]',

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

            /*
        |--------------------------------------------------------------------------
        | Dosen
        |--------------------------------------------------------------------------
        */

            case 2: // Dosen

                $rules['nip'] = 'required';

                $rules['nidn'] = 'required';

                $rules['department_id'] = 'required';

                $rules['work_unit_id'] = 'required';

                $rules['academic_position'] = 'required';

                $rules['functional_position'] = 'required';

                $rules['employee_status'] = 'required';

                break;

            /*
        |--------------------------------------------------------------------------
        | Tendik
        |--------------------------------------------------------------------------
        */

            case 3: // Tendik

                $rules['nip'] = 'required';

                $rules['work_unit_id'] = 'required';

                $rules['employee_status'] = 'required';

                break;

            /*
        |--------------------------------------------------------------------------
        | Alumni
        |--------------------------------------------------------------------------
        */

            case 4: // Alumni

                $rules['nim'] = 'required';

                $rules['department_id'] = 'required';

                $rules['study_program_id'] = 'required';

                $rules['graduation_year'] = 'required|integer';

                break;

            /*
        |--------------------------------------------------------------------------
        | Orang Tua / Wali
        |--------------------------------------------------------------------------
        */

            case 5: // Orang Tua / Wali

                $rules['relationship'] = 'required';

                $rules['student_name'] = 'required';

                $rules['student_nim'] = 'required';

                break;

            /*
        |--------------------------------------------------------------------------
        | Mitra
        |--------------------------------------------------------------------------
        */

            case 6: // Mitra

                $rules['institution_name'] = 'required';

                $rules['institution_type'] = 'required';

                $rules['position'] = 'required';

                $rules['job_title'] = 'required';

                break;

            /*
        |--------------------------------------------------------------------------
        | Publik
        |--------------------------------------------------------------------------
        */

            case 7: // Publik

                $rules['identity_number'] = 'required';

                break;
        }

        return $rules;
    }

    private function validationMessages(): array
    {
        return [

            // ===============================
            // DATA AKUN
            // ===============================

            'role_id' => [
                'required' => 'Role wajib dipilih.'
            ],

            'user_type_id' => [
                'required' => 'Jenis pemohon wajib dipilih.'
            ],

            'full_name' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama lengkap minimal 3 karakter.',
                'max_length' => 'Nama lengkap maksimal 150 karakter.'
            ],

            'personal_email' => [
                'required'    => 'Email pribadi wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah digunakan.'
            ],

            'password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 8 karakter.'
            ],

            'password_confirmation' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak sama.'
            ],

            // ===============================
            // DATA PRIBADI
            // ===============================

            'phone' => [
                'required' => 'Nomor HP wajib diisi.'
            ],

            'gender' => [
                'required' => 'Jenis kelamin wajib dipilih.'
            ],

            'address' => [
                'required' => 'Alamat wajib diisi.'
            ],

            // ===============================
            // FOTO
            // ===============================

            'photo' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in'  => 'Format foto harus JPG atau PNG.',
                'max_size' => 'Ukuran foto maksimal 2 MB.'
            ],

            // ===============================
            // MAHASISWA
            // ===============================

            'nim' => [
                'required' => 'NIM wajib diisi.'
            ],

            'department_id' => [
                'required' => 'Jurusan wajib dipilih.'
            ],

            'study_program_id' => [
                'required' => 'Program Studi wajib dipilih.'
            ],

            'class_id' => [
                'required' => 'Kelas wajib dipilih.'
            ],

            'angkatan' => [
                'required' => 'Angkatan wajib diisi.',
                'integer'  => 'Angkatan harus berupa angka.'
            ],

            'entry_year' => [
                'required' => 'Tahun masuk wajib diisi.',
                'integer'  => 'Tahun masuk harus berupa angka.'
            ],

            'student_status' => [
                'required' => 'Status mahasiswa wajib dipilih.'
            ],

            // ===============================
            // DOSEN
            // ===============================

            'nip' => [
                'required' => 'NIP wajib diisi.'
            ],

            'nidn' => [
                'required' => 'NIDN wajib diisi.'
            ],

            'work_unit_id' => [
                'required' => 'Unit kerja wajib dipilih.'
            ],

            'academic_position' => [
                'required' => 'Jabatan akademik wajib diisi.'
            ],

            'functional_position' => [
                'required' => 'Jabatan fungsional wajib diisi.'
            ],

            'employee_status' => [
                'required' => 'Status pegawai wajib dipilih.'
            ],

            // ===============================
            // ALUMNI
            // ===============================

            'graduation_year' => [
                'required' => 'Tahun lulus wajib diisi.',
                'integer'  => 'Tahun lulus harus berupa angka.'
            ],

            // ===============================
            // ORANG TUA
            // ===============================

            'relationship' => [
                'required' => 'Hubungan dengan mahasiswa wajib dipilih.'
            ],

            'student_name' => [
                'required' => 'Nama mahasiswa wajib diisi.'
            ],

            'student_nim' => [
                'required' => 'NIM mahasiswa wajib diisi.'
            ],

            // ===============================
            // MITRA
            // ===============================

            'institution_name' => [
                'required' => 'Nama instansi wajib diisi.'
            ],

            'institution_type' => [
                'required' => 'Jenis instansi wajib diisi.'
            ],

            'position' => [
                'required' => 'Jabatan wajib diisi.'
            ],

            'job_title' => [
                'required' => 'Bidang pekerjaan wajib diisi.'
            ],

            // ===============================
            // PUBLIK
            // ===============================

            'identity_number' => [
                'required' => 'Nomor identitas wajib diisi.'
            ]

        ];
    }

    /*
|--------------------------------------------------------------------------
| INDEX
|--------------------------------------------------------------------------
*/

    public function index()
    {
        $keyword = trim($this->request->getGet('keyword'));
        $role    = $this->request->getGet('role');
        $type    = $this->request->getGet('type');

        $perPage = 10;

        $builder = $this->userModel
            ->searchUsers($keyword, $role, $type);

        $data = [

            'title' => 'Management User',

            'users' => $builder->paginate($perPage),

            'pager' => $this->userModel->pager,

            'roles' => $this->roleModel
                ->orderBy('role_name')
                ->findAll(),

            'userTypes' => $this->userTypeModel
                ->orderBy('type_name')
                ->findAll(),

            'keyword' => $keyword,

            'selectedRole' => $role,

            'selectedType' => $type,

            'totalUser' => $this->userModel->countAll(),

            'totalActive' => $this->userModel->countActiveUsers(),

            'totalInactive' => $this->userModel->countInactiveUsers(),

            'totalMahasiswa' => $this->userModel->countMahasiswa()

        ];

        return view('users/index', $data);
    }

    /*
|--------------------------------------------------------------------------
| CREATE
|--------------------------------------------------------------------------
*/

    public function create()
    {
        $data = array_merge([

            'title' => 'Tambah User',

            'user' => [],

            'studyPrograms' => [],

            'validation' => \Config\Services::validation()

        ], $this->getMasterData());

        return view('users/create', $data);
    }

    /*
|--------------------------------------------------------------------------
| GET STUDY PROGRAMS
|--------------------------------------------------------------------------
*/

    public function getStudyPrograms($departmentId)
    {
        $studyPrograms = $this->studyProgramModel

            ->where('department_id', $departmentId)

            ->orderBy('program_name', 'ASC')

            ->findAll();

        return $this->response->setJSON($studyPrograms);
    }

    /*
|--------------------------------------------------------------------------
| STORE
|--------------------------------------------------------------------------
*/

    public function store()
    {
        if (
            !$this->validate(
                $this->validationRules(),
                $this->validationMessages()
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();

        $db->transBegin();

        $photoName = null;

        try {

            /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

            $photoName = $this->uploadPhoto();

            /*
        |--------------------------------------------------------------------------
        | Data User
        |--------------------------------------------------------------------------
        */

            $userData = $this->buildUserData(true);

            $userData['photo'] = $photoName;

            /*
        |--------------------------------------------------------------------------
        | Simpan User
        |--------------------------------------------------------------------------
        */

            $this->userModel->insert($userData);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Gagal menyimpan data user.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('users'))
                ->with('success', 'Data user berhasil ditambahkan.');
        } catch (\Throwable $e) {

            $db->transRollback();

            if (!empty($photoName)) {

                $file = FCPATH . 'uploads/users/' . $photoName;

                if (file_exists($file)) {
                    unlink($file);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /*
|--------------------------------------------------------------------------
| EDIT
|--------------------------------------------------------------------------
*/

    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User tidak ditemukan.');
        }

        $studyPrograms = [];

        if (!empty($user['department_id'])) {

            $studyPrograms = $this->studyProgramModel

                ->where('department_id', $user['department_id'])

                ->orderBy('education_level', 'ASC')

                ->orderBy('program_name', 'ASC')

                ->findAll();
        }

        $data = array_merge([

            'title' => 'Edit User',

            'user' => $user,

            'studyPrograms' => $studyPrograms,

            'validation' => \Config\Services::validation()

        ], $this->getMasterData());

        return view('users/edit', $data);
    }

    /*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return redirect()
                ->to(base_url('users'))
                ->with('error', 'User tidak ditemukan.');
        }

        if (
            !$this->validate(
                $this->validationRules((int) $id),
                $this->validationMessages()
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();

        $db->transBegin();

        try {

            /*
        |--------------------------------------------------------------------------
        | Data User
        |--------------------------------------------------------------------------
        */

            $userData = $this->buildUserData();

            /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

            $userData['photo'] = $this->uploadPhoto($user['photo']);

            /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

            if (!empty($this->request->getPost('password'))) {

                $userData['password'] = password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                );
            }

            /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

            $this->userModel->update($id, $userData);

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Gagal memperbarui data user.');
            }

            $db->transCommit();

            return redirect()
                ->to(base_url('users'))
                ->with('success', 'Data user berhasil diperbarui.');
        } catch (\Throwable $e) {

            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /*
|--------------------------------------------------------------------------
| DELETE
|--------------------------------------------------------------------------
*/

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return redirect()

                ->to(base_url('users'))

                ->with('error', 'User tidak ditemukan.');
        }

        /*
    |--------------------------------------------------------------------------
    | Administrator tidak boleh dihapus
    |--------------------------------------------------------------------------
    */

        $role = $this->roleModel->find($user['role_id']);

        if ($role && $role['role_name'] === 'Administrator') {

            return redirect()

                ->to(base_url('users'))

                ->with('error', 'Akun Administrator tidak dapat dihapus.');
        }

        /*
    |--------------------------------------------------------------------------
    | Tidak boleh menghapus akun sendiri
    |--------------------------------------------------------------------------
    */

        if ($user['id'] == session()->get('user_id')) {

            return redirect()

                ->to(base_url('users'))

                ->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        $db = \Config\Database::connect();

        $db->transBegin();

        try {

            if (!empty($user['photo'])) {

                $photo = FCPATH . 'uploads/users/' . $user['photo'];

                if (file_exists($photo)) {
                    unlink($photo);
                }
            }

            $this->userModel->delete($id);

            if ($db->transStatus() === false) {

                throw new \RuntimeException('Gagal menghapus user.');
            }

            $db->transCommit();

            return redirect()

                ->to(base_url('users'))

                ->with('success', 'User berhasil dihapus.');
        } catch (\Throwable $e) {

            $db->transRollback();

            return redirect()

                ->to(base_url('users'))

                ->with('error', $e->getMessage());
        }
    }

    /*
|--------------------------------------------------------------------------
| SHOW
|--------------------------------------------------------------------------
*/

    public function show($id)
    {
        $user = $this->userModel->getUserById($id);

        if (!$user) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User tidak ditemukan.'
            );
        }

        return view('users/show', [

            'title' => 'Detail User',

            'user' => $user

        ]);
    }

    public function toggle($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return redirect()->to('/users')
                ->with('error', 'User tidak ditemukan.');
        }

        // Administrator tidak boleh dinonaktifkan
        if ($user['role_id'] == 1) {

            return redirect()->to('/users')
                ->with('error', 'Administrator tidak dapat diubah statusnya.');
        }

        $this->userModel->update($id, [

            'is_active' => !$user['is_active']

        ]);

        return redirect()->to('/users')
            ->with('success', 'Status user berhasil diperbarui.');
    }
}
