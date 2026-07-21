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
    protected $userModel;
    protected $roleModel;
    protected $userTypeModel;
    protected $departmentModel;
    protected $studyProgramModel;
    protected $workUnitModel;
    protected $classModel;
    protected $applicantProfileModel;
    protected $db;

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

    /**
     * =====================================================
     * Halaman Register
     * =====================================================
     */
    public function index()
    {
        return view('auth/register', [

            'title' => 'Registrasi Pemohon',

            'userTypes' => $this->userTypeModel
                ->orderBy('type_name', 'ASC')
                ->findAll(),

            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll(),

            'studyPrograms' => $this->studyProgramModel
                ->orderBy('program_name', 'ASC')
                ->findAll(),

            'workUnits' => $this->workUnitModel
                ->orderBy('unit_name', 'ASC')
                ->findAll(),

            'classes' => $this->classModel
                ->orderBy('class_name', 'ASC')
                ->findAll(),

        ]);
    }

    /**
     * =====================================================
     * Proses Register
     * =====================================================
     */
    public function store()
    {
        $rules = [

            'full_name' => 'required|min_length[3]',

            'user_type_id' => 'required',

            'personal_email' => 'required|valid_email|is_unique[users.personal_email]',

            'phone' => 'required|min_length[10]',

            'gender' => 'required|in_list[L,P]',

            'password' => 'required|min_length[8]',

            'password_confirmation' => 'required|matches[password]',

            'photo' => 'permit_empty|is_image[photo]|max_size[photo,2048]',

        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        /*
        |-------------------------------------------------------
        | Upload Foto
        |-------------------------------------------------------
        */

        $photo = $this->request->getFile('photo');

        $photoName = null;

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
        |-------------------------------------------------------
        | Ambil Role Pemohon
        |-------------------------------------------------------
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
        |-------------------------------------------------------
        | Mulai Database Transaction
        |-------------------------------------------------------
        */

        $this->db->transStart();

        $userData = [

            'role_id' => $role['id'],

            'user_type_id' => $this->request->getPost('user_type_id'),

            'department_id' => $this->request->getPost('department_id') ?: null,

            'study_program_id' => $this->request->getPost('study_program_id') ?: null,

            'work_unit_id' => $this->request->getPost('work_unit_id') ?: null,

            'nim' => $this->request->getPost('nim') ?: null,

            'nip' => $this->request->getPost('nip') ?: null,

            'nidn' => $this->request->getPost('nidn') ?: null,

            'full_name' => $this->request->getPost('full_name'),

            'gender' => $this->request->getPost('gender'),

            'birth_place' => $this->request->getPost('birth_place'),

            'birth_date' => $this->request->getPost('birth_date'),

            'phone' => $this->request->getPost('phone'),

            'institution_email' => $this->request->getPost('institution_email'),

            'personal_email' => $this->request->getPost('personal_email'),

            'address' => $this->request->getPost('address'),

            'photo' => $photoName,

            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),

            'is_active' => 1,

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

        $profileData = [

            'user_id' => $userId,

            'class_id' => $this->request->getPost('class_id') ?: null,

            'relationship' => $this->request->getPost('relationship'),

            'student_name' => $this->request->getPost('student_name'),

            'student_nim' => $this->request->getPost('student_nim'),

            'graduation_year' => $this->request->getPost('graduation_year'),

            'institution_name' => $this->request->getPost('institution_name'),

            'position' => $this->request->getPost('position'),

            'notes' => null,

        ];

        $this->applicantProfileModel->insert($profileData);

        $this->db->transComplete();

        if (!$this->db->transStatus()) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Registrasi gagal disimpan.'
                );
        }

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Registrasi berhasil. Silakan login.'
            );
    }

    /**
     * =====================================================
     * AJAX Program Studi berdasarkan Jurusan
     * =====================================================
     */
    public function getStudyPrograms($departmentId)
    {
        $programs = $this->studyProgramModel
            ->select('id, program_name, education_level')
            ->where('department_id', $departmentId)
            ->orderBy('program_name', 'ASC')
            ->findAll();

        return $this->response->setJSON($programs);
    }

    /**
     * =====================================================
     * AJAX Data Jenis Pemohon
     * =====================================================
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
