<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserTypeModel;
use App\Models\DepartmentModel;
use App\Models\StudyProgramModel;
use App\Models\WorkUnitModel;
use App\Models\ClassModel;
use App\Models\ApplicantProfileModel;

class RegisterController extends BaseController
{
    protected $db;

    protected $userModel;
    protected $roleModel;
    protected $userTypeModel;
    protected $departmentModel;
    protected $studyProgramModel;
    protected $workUnitModel;
    protected $classModel;
    protected $applicantProfileModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->userTypeModel = new UserTypeModel();
        $this->departmentModel = new DepartmentModel();
        $this->studyProgramModel = new StudyProgramModel();
        $this->workUnitModel = new WorkUnitModel();
        $this->classModel = new ClassModel();
        $this->applicantProfileModel = new ApplicantProfileModel();
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Register
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('auth/register', [

            'title' => 'Registrasi Pemohon',

            'userTypes' => $this->userTypeModel
                ->orderBy('type_name')
                ->findAll(),

            'departments' => $this->departmentModel
                ->orderBy('department_name')
                ->findAll(),

            'studyPrograms' => $this->studyProgramModel
                ->orderBy('education_level')
                ->orderBy('program_name')
                ->findAll(),

            'workUnits' => $this->workUnitModel
                ->orderBy('unit_name')
                ->findAll(),

            'classes' => $this->classModel
                ->orderBy('class_name')
                ->findAll()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Registrasi
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        /*
|--------------------------------------------------------------------------
| Validasi Dasar
|--------------------------------------------------------------------------
*/

        $rules = [

            'full_name'              => 'required|min_length[3]',
            'user_type_id'           => 'required',

            'personal_email'         => 'required|valid_email|is_unique[users.personal_email]',

            'phone'                  => 'required|min_length[10]',

            'gender'                 => 'required|in_list[L,P]',

            'password'               => 'required|min_length[8]',
            'password_confirmation'  => 'required|matches[password]',

            'photo'                  => 'permit_empty|is_image[photo]|max_size[photo,2048]',

        ];

        /*
|--------------------------------------------------------------------------
| Validasi berdasarkan Jenis Pemohon
|--------------------------------------------------------------------------
*/

        $userType = $this->userTypeModel
            ->find($this->request->getPost('user_type_id'));

        $type = strtolower($userType['type_name'] ?? '');

        switch ($type) {

            case 'mahasiswa':

                $rules['nim'] = 'required';
                $rules['department_id'] = 'required';
                $rules['study_program_id'] = 'required';
                $rules['class_id'] = 'required';

                break;

            case 'dosen':

                $rules['nip'] = 'required';
                $rules['department_id'] = 'required';

                break;

            case 'tendik':

                $rules['nip'] = 'required';
                $rules['work_unit_id'] = 'required';

                break;

            case 'alumni':

                $rules['nim'] = 'required';
                $rules['graduation_year'] = 'required';

                break;

            case 'orang tua/wali':

                $rules['student_name'] = 'required';
                $rules['student_nim'] = 'required';

                break;

            case 'mitra':

                $rules['institution_name'] = 'required';

                break;

            case 'publik':

                $rules['identity_number'] = 'required';

                break;
        }

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        /*
|--------------------------------------------------------------------------
| Upload Foto
|--------------------------------------------------------------------------
*/

        $photoName = null;

        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            if (!is_dir(ROOTPATH . 'public/uploads/users')) {

                mkdir(ROOTPATH . 'public/uploads/users', 0777, true);
            }

            $photoName = $photo->getRandomName();

            $photo->move(
                ROOTPATH . 'public/uploads/users',
                $photoName
            );
        }

        /*
|--------------------------------------------------------------------------
| Ambil Role Pemohon
|--------------------------------------------------------------------------
*/

        $role = $this->roleModel
            ->where('role_name', 'Pemohon')
            ->first();

        if (!$role) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Role Pemohon belum tersedia.'
                );
        }

        /*
|--------------------------------------------------------------------------
| Mulai Transaction
|--------------------------------------------------------------------------
*/

        $this->db->transBegin();

        /*
|--------------------------------------------------------------------------
| Simpan ke tabel users
|--------------------------------------------------------------------------
*/

        $userData = [

            // Role
            'role_id' => $role['id'],
            'user_type_id' => $this->request->getPost('user_type_id'),

            // Akun
            'full_name' => $this->request->getPost('full_name'),
            'personal_email' => $this->request->getPost('personal_email'),
            'institution_email' => $this->request->getPost('institution_email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'is_active' => 1,

            // Data Pribadi
            'gender' => $this->request->getPost('gender'),
            'birth_place' => $this->request->getPost('birth_place'),
            'birth_date' => $this->request->getPost('birth_date'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'photo' => $photoName,

            // Mahasiswa
            'nim' => $this->request->getPost('nim'),
            'department_id' => $this->request->getPost('department_id') ?: null,
            'study_program_id' => $this->request->getPost('study_program_id') ?: null,
            'class_id' => $this->request->getPost('class_id') ?: null,
            'angkatan' => $this->request->getPost('angkatan'),
            'semester' => $this->request->getPost('semester'),
            'student_status' => $this->request->getPost('student_status'),
            'entry_year' => $this->request->getPost('entry_year'),

            // Dosen
            'nip' => $this->request->getPost('nip'),
            'nidn' => $this->request->getPost('nidn'),
            'academic_position' => $this->request->getPost('academic_position'),
            'functional_position' => $this->request->getPost('functional_position'),

            // Pegawai
            'work_unit_id' => $this->request->getPost('work_unit_id') ?: null,
            'employee_status' => $this->request->getPost('employee_status'),
            'position' => $this->request->getPost('position'),

            // Alumni
            'graduation_year' => $this->request->getPost('graduation_year'),
            'graduation_number' => $this->request->getPost('graduation_number'),

            // Orang Tua
            'student_name' => $this->request->getPost('student_name'),
            'student_nim' => $this->request->getPost('student_nim'),
            'relationship' => $this->request->getPost('relationship'),

            // Mitra
            'institution_name' => $this->request->getPost('institution_name'),
            'institution_type' => $this->request->getPost('institution_type'),
            'job_title' => $this->request->getPost('job_title'),

            // Publik
            'identity_number' => $this->request->getPost('identity_number')

        ];

        $userId = $this->userModel->insert($userData, true);

        if (!$userId) {

            $this->db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->userModel->errors()
                );
        }

        /*
|--------------------------------------------------------------------------
| Simpan applicant_profiles
|--------------------------------------------------------------------------
*/

        $profileData = [

            'user_id' => $userId,

            'class_id' => $this->request->getPost('class_id'),

            'relationship' => $this->request->getPost('relationship'),

            'student_name' => $this->request->getPost('student_name'),

            'student_nim' => $this->request->getPost('student_nim'),

            'graduation_year' => $this->request->getPost('graduation_year'),

            'institution_name' => $this->request->getPost('institution_name'),

            'position' => $this->request->getPost('position'),

            'notes' => null

        ];

        $this->applicantProfileModel->insert($profileData);

        /*
|--------------------------------------------------------------------------
| Commit
|--------------------------------------------------------------------------
*/

        $this->db->transCommit();

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Registrasi berhasil. Silakan login.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX Program Studi berdasarkan Jurusan
    |--------------------------------------------------------------------------
    */
    public function getStudyPrograms($departmentId)
    {
        $programs = $this->studyProgramModel
            ->select('id, program_name, education_level')
            ->where('department_id', $departmentId)
            ->where('status', 'Aktif')
            ->orderBy('education_level', 'ASC')
            ->orderBy('program_name', 'ASC')
            ->findAll();

        return $this->response->setJSON($programs);
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX Jenis Pemohon
    |--------------------------------------------------------------------------
    */
    public function getUserType($id)
    {
        $userType = $this->userTypeModel->find($id);

        if (!$userType) {

            return $this->response->setJSON([
                'status' => false,
                'message' => 'Jenis pemohon tidak ditemukan.'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => $userType
        ]);
    }
}
