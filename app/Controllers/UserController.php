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
    protected $userModel;
    protected $roleModel;
    protected $userTypeModel;
    protected $departmentModel;
    protected $studyProgramModel;
    protected $workUnitModel;
    protected $classModel;

    public function __construct()
    {
        $this->userModel         = new UserModel();
        $this->roleModel         = new RoleModel();
        $this->userTypeModel     = new UserTypeModel();
        $this->departmentModel   = new DepartmentModel();
        $this->studyProgramModel = new StudyProgramModel();
        $this->workUnitModel     = new WorkUnitModel();
        $this->classModel        = new ClassModel();
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

        $builder = $this->userModel->getUsers();

        if (!empty($keyword)) {

            $builder->groupStart()
                ->like('users.full_name', $keyword)
                ->orLike('users.personal_email', $keyword)
                ->orLike('users.nim', $keyword)
                ->orLike('users.nip', $keyword)
                ->orLike('users.nidn', $keyword)
                ->groupEnd();
        }

        if (!empty($role)) {
            $builder->where('users.role_id', $role);
        }

        if (!empty($type)) {
            $builder->where('users.user_type_id', $type);
        }

        $perPage = 10;

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

            'totalActive' => $this->userModel
                ->where('is_active', 1)
                ->countAllResults(),

            'totalInactive' => $this->userModel
                ->where('is_active', 0)
                ->countAllResults(),

            'totalMahasiswa' => $this->userModel
                ->where('user_type_id', 1)
                ->countAllResults()

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
        $data = [

            'title' => 'Tambah User',

            'user' => [],

            'roles' => $this->roleModel
                ->orderBy('role_name', 'ASC')
                ->findAll(),

            'userTypes' => $this->userTypeModel
                ->orderBy('type_name', 'ASC')
                ->findAll(),

            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll(),

            'studyPrograms' => [],

            'workUnits' => $this->workUnitModel
                ->orderBy('unit_name', 'ASC')
                ->findAll(),

            'classes' => $this->classModel
                ->orderBy('class_name', 'ASC')
                ->findAll(),

            'validation' => \Config\Services::validation()

        ];

        return view('users/create', $data);
    }

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
        helper(['form']);

        $rules = [

            'role_id' => 'required',

            'full_name' => 'required|min_length[3]|max_length[150]',

            'personal_email' => 'required|valid_email|is_unique[users.personal_email]',

            'password' => 'required|min_length[6]',

        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $photoName = null;

        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            $photoName = $photo->getRandomName();

            $photo->move(ROOTPATH . 'public/uploads/users', $photoName);
        }

        $data = [

            /*
        |--------------------------------------------------------------------------
        | ACCOUNT
        |--------------------------------------------------------------------------
        */

            'role_id'            => $this->request->getPost('role_id'),
            'user_type_id'       => $this->request->getPost('user_type_id'),

            'full_name'          => $this->request->getPost('full_name'),

            'personal_email'     => $this->request->getPost('personal_email'),
            'institution_email'  => $this->request->getPost('institution_email'),

            'password'           => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),

            'is_active'          => $this->request->getPost('is_active'),

            /*
        |--------------------------------------------------------------------------
        | DATA PRIBADI
        |--------------------------------------------------------------------------
        */

            'gender'             => $this->request->getPost('gender'),
            'birth_place'        => $this->request->getPost('birth_place'),
            'birth_date'         => $this->request->getPost('birth_date'),

            'phone'              => $this->request->getPost('phone'),
            'address'            => $this->request->getPost('address'),

            'photo'              => $photoName,

            /*
        |--------------------------------------------------------------------------
        | MAHASISWA
        |--------------------------------------------------------------------------
        */

            'nim'                => $this->request->getPost('nim'),

            'department_id'      => $this->request->getPost('department_id'),

            'study_program_id'   => $this->request->getPost('study_program_id'),

            'class_id'           => $this->request->getPost('class_id'),

            'angkatan'           => $this->request->getPost('angkatan'),

            'semester'           => $this->request->getPost('semester'),

            'student_status'     => $this->request->getPost('student_status'),

            'entry_year'         => $this->request->getPost('entry_year'),

            /*
        |--------------------------------------------------------------------------
        | DOSEN
        |--------------------------------------------------------------------------
        */

            'nip'                => $this->request->getPost('nip'),

            'nidn'               => $this->request->getPost('nidn'),

            'academic_position'  => $this->request->getPost('academic_position'),

            'functional_position' => $this->request->getPost('functional_position'),

            /*
        |--------------------------------------------------------------------------
        | PETUGAS / UNIT TUJUAN / PIMPINAN
        |--------------------------------------------------------------------------
        */

            'work_unit_id'       => $this->request->getPost('work_unit_id'),

            'position'           => $this->request->getPost('position'),

            'employee_status'    => $this->request->getPost('employee_status'),

            /*
        |--------------------------------------------------------------------------
        | ALUMNI
        |--------------------------------------------------------------------------
        */

            'graduation_year'    => $this->request->getPost('graduation_year'),

            'graduation_number'  => $this->request->getPost('graduation_number'),

            /*
        |--------------------------------------------------------------------------
        | ORANG TUA
        |--------------------------------------------------------------------------
        */

            'student_name'       => $this->request->getPost('student_name'),

            'student_nim'        => $this->request->getPost('student_nim'),

            'relationship'       => $this->request->getPost('relationship'),

            /*
        |--------------------------------------------------------------------------
        | MITRA / PUBLIK
        |--------------------------------------------------------------------------
        */

            'institution_name'   => $this->request->getPost('institution_name'),

            'institution_type'   => $this->request->getPost('institution_type'),

            'job_title'          => $this->request->getPost('job_title'),

            'identity_number'    => $this->request->getPost('identity_number'),

        ];

        /*
    |--------------------------------------------------------------------------
    | Hapus data kosong (kecuali nilai 0)
    |--------------------------------------------------------------------------
    */

        $data = array_filter($data, function ($value) {

            return $value !== '' && $value !== null;
        });

        /*
    |--------------------------------------------------------------------------
    | Simpan ke database
    |--------------------------------------------------------------------------
    */

        if ($this->userModel->insert($data)) {

            return redirect()
                ->to(base_url('users'))
                ->with('success', 'Data user berhasil ditambahkan.');
        }

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Data user gagal disimpan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User tidak ditemukan.');
        }

        $studyPrograms = [];

        if (!empty($user['department_id'])) {

            $studyPrograms = $this->studyProgramModel
                ->select('id, department_id, program_code, program_name, education_level')
                ->where('department_id', $user['department_id'])
                ->orderBy('education_level', 'ASC')
                ->orderBy('program_name', 'ASC')
                ->findAll();
        }

        $data = [

            'title' => 'Edit User',

            'user' => $user,

            'roles' => $this->roleModel
                ->orderBy('role_name', 'ASC')
                ->findAll(),

            'userTypes' => $this->userTypeModel
                ->orderBy('type_name', 'ASC')
                ->findAll(),

            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll(),

            'studyPrograms' => $studyPrograms,

            'workUnits' => $this->workUnitModel
                ->orderBy('unit_name', 'ASC')
                ->findAll(),

            'classes' => $this->classModel
                ->orderBy('class_name', 'ASC')
                ->findAll(),

            'validation' => \Config\Services::validation()

        ];

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

        $rules = [

            'role_id' => 'required',

            'full_name' => 'required|min_length[3]',

            'personal_email' => 'required|valid_email'

        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        /*
    ====================================
    FOTO
    ====================================
    */

        $photo = $this->request->getFile('photo');

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            $photoName = $this->userModel->replacePhoto(

                $user['photo'],

                $photo

            );
        } else {

            $photoName = $user['photo'];
        }

        /*
    ====================================
    PASSWORD
    ====================================
    */

        $password = $user['password'];

        if (!empty($this->request->getPost('password'))) {

            $password = password_hash(

                $this->request->getPost('password'),

                PASSWORD_DEFAULT

            );
        }

        $data = $this->request->getPost();

        $data['photo'] = $photoName;

        $data['password'] = $password;

        $this->userModel->update($id, $data);

        return redirect()

            ->to(base_url('users'))

            ->with('success', 'Data user berhasil diperbarui.');
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
    ==========================================
    HAPUS FOTO
    ==========================================
    */

        if (!empty($user['photo'])) {

            $this->userModel->deletePhoto($user['photo']);
        }

        /*
    ==========================================
    SOFT DELETE
    ==========================================
    */

        $this->userModel->delete($id);

        return redirect()
            ->to(base_url('users'))
            ->with('success', 'User berhasil dihapus.');
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

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('users/show', [

            'title' => 'Detail User',

            'user' => $user

        ]);
    }
}
