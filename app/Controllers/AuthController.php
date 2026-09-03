<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\MasterApplicantTypeModel;
use App\Models\MasterStudyProgramModel;
use App\Models\MasterClassModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $model = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        // Email tidak ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        // Password salah
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        // Akun tidak aktif
        if ($user['is_active'] == 0) {
            return redirect()->back()->with('error', 'Akun belum aktif');
        }

        // Simpan session
        session()->set([
    'user_id'   => $user['id'],
    'name'      => $user['full_name'],
    'email'     => $user['email'],
    'role_id'   => $user['role_id'],
    'logged_in' => true
]);

        // Redirect sesuai role
        switch ($user['role_id']) {

            // Admin
            case 1:
                return redirect()->to('/admin');

            // Petugas ULT
            case 2:
                return redirect()->to('/petugas');

            // Unit Tujuan
            case 3:
                return redirect()->to('/unit');

            // Pemohon
           // Pemohon
case 6:
    return redirect()->to('/dashboard');

            // Pimpinan
            case 5:
                return redirect()->to('/pimpinan');

            default:
                session()->destroy();
                return redirect()->to('/login')
                    ->with('error', 'Role tidak dikenali.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
{
    $applicantTypeModel = new MasterApplicantTypeModel();
    $studyProgramModel  = new MasterStudyProgramModel();
    $classModel         = new MasterClassModel();

    $data = [
        'applicantTypes' => $applicantTypeModel->getActive(),
        'studyPrograms'  => $studyProgramModel->getActive(),
        'classes'        => $classModel->getActive(),
    ];

    return view('auth/register', $data);
}

    public function fields($id)
{
    $applicantTypeModel = new MasterApplicantTypeModel();
    $studyProgramModel  = new MasterStudyProgramModel();
    $classModel         = new MasterClassModel();

    $applicantType = $applicantTypeModel->find($id);

    if (!$applicantType) {
        return $this->response
            ->setStatusCode(404)
            ->setBody('Jenis pemohon tidak ditemukan.');
    }

    $data = [
        'applicantCode' => $applicantType['code'],
        'applicantType' => $applicantType,
        'studyPrograms' => $studyProgramModel->getActive(),
        'classes'      => $classModel->getActive(),
        'data'         => $this->request->getPost(),
    ];

    return view('auth/_register_fields', $data);
}

public function storeRegister()
{
    $rules = [
        'applicant_type_id'    => 'required|integer',
        'full_name'            => 'required|min_length[3]|max_length[150]',
        'email'                => 'required|valid_email|is_unique[users.email]',
        'phone_number'         => 'required|max_length[20]',
        'password'             => 'required|min_length[8]',
        'password_confirmation'=> 'required|matches[password]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $applicantTypeModel = new MasterApplicantTypeModel();
    $applicantType = $applicantTypeModel->find(
        $this->request->getPost('applicant_type_id')
    );

    if (!$applicantType) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Jenis pemohon tidak ditemukan.');
    }

    $db = \Config\Database::connect();

    $db->transStart();

    $userData = [
        'role_id'         => 6,
        'full_name'       => $this->request->getPost('full_name'),
        'identity_number' => $this->request->getPost('identity_number'),
        'phone_number'    => $this->request->getPost('phone_number'),
        'gender'          => $this->request->getPost('gender'),
        'email'           => $this->request->getPost('email'),
        'password'        => password_hash(
            $this->request->getPost('password'),
            PASSWORD_DEFAULT
        ),
        'is_active'       => 1,
    ];

    $db->table('users')->insert($userData);

    $userId = $db->insertID();

    $profileData = [
        'user_id'           => $userId,
        'applicant_type_id' => $this->request->getPost('applicant_type_id'),
        'study_program_id'  => $this->request->getPost('study_program_id'),
        'class_id'          => $this->request->getPost('class_id'),
        'student_name'      => $this->request->getPost('student_name'),
        'institution_name'  => $this->request->getPost('institution_name'),
        'position'          => $this->request->getPost('position'),
        'nim'               => $this->request->getPost('nim'),
        'nik'               => $this->request->getPost('nik'),
        'name'              => $this->request->getPost('full_name'),
        'gender'            => $this->request->getPost('gender'),
        'email'             => $this->request->getPost('email'),
        'phone'             => $this->request->getPost('phone_number'),
        'address'           => $this->request->getPost('address'),
    ];

    $db->table('user_profiles')->insert($profileData);

    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Registrasi gagal. Silakan coba lagi.');
    }

    return redirect()->to('/login')
        ->with('success', 'Registrasi berhasil, silakan login.');
}
}