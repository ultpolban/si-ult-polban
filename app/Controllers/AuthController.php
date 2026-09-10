<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ApplicantTypeModel;

class AuthController extends BaseController
{
    protected $applicantTypeModel;
    protected $userModel;

    public function __construct()
    {
        $this->applicantTypeModel = new ApplicantTypeModel();
        $this->userModel = new UserModel();
    }

    /**
     * Halaman Login
     */
    public function login()
    {
        return view('auth/login');
    }

    /**
     * Proses Login
     */
    public function authenticate()
    {
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $user = $this->userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan');
        }

        if (isset($user['is_active']) && !$user['is_active']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda tidak aktif');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah');
        }

        // Update waktu login terakhir jika kolom tersedia
        if (in_array('last_login', $this->userModel->allowedFields ?? [])) {
            $this->userModel->update($user['id'], [
                'last_login' => date('Y-m-d H:i:s')
            ]);
        }

        session()->set([
            'user_id'   => $user['id'],
            'name'      => $user['full_name'],
            'email'     => $user['email'],
            'role_id'   => $user['role_id'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    /**
     * Halaman Register
     */
    public function register()
    {
        $applicantTypes = $this->applicantTypeModel
            ->where('is_active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('auth/register', [
            'title'          => 'Registrasi',
            'applicantTypes' => $applicantTypes,
        ]);
    }

    /**
     * Form dinamis berdasarkan jenis pemohon
     *
     * URL:
     * /register/fields/{id}
     */
    public function fields($id = null)
    {
        if (!$id) {
            return $this->response->setStatusCode(400)
                ->setBody('Jenis pemohon tidak ditemukan.');
        }

        $applicantType = $this->applicantTypeModel->find($id);

        if (!$applicantType) {
            return $this->response->setStatusCode(404)
                ->setBody('Jenis pemohon tidak ditemukan.');
        }

        /*
         * Ambil kode jenis pemohon.
         * Contoh:
         * MHS
         * ALUMNI
         * DOSEN
         * TENDIK
         * WALI
         * MITRA
         * UMUM
         */
        $applicantCode = strtoupper(
            trim((string) ($applicantType['code'] ?? 'UMUM'))
        );

        /*
         * Data default.
         */
        $studyPrograms = [];
        $classes = [];

        /*
         * Ambil data program studi dan kelas
         * hanya jika diperlukan oleh form.
         */
        if (in_array($applicantCode, ['MHS', 'ALUMNI'])) {

            /*
             * Cari model yang tersedia di project.
             * Sesuaikan nama model jika project menggunakan
             * nama model yang berbeda.
             */
            $studyProgramModel = new \App\Models\StudyProgramModel();

            $studyPrograms = $studyProgramModel
                ->orderBy('name', 'ASC')
                ->findAll();
        }

        if ($applicantCode === 'MHS') {

            $classModel = new \App\Models\ClassModel();

            $classes = $classModel
                ->orderBy('name', 'ASC')
                ->findAll();
        }

        return view('components/applicant_fields', [
            'applicantCode' => $applicantCode,
            'applicantType' => $applicantType,
            'studyPrograms' => $studyPrograms,
            'classes'       => $classes,
            'data'          => [],
        ]);
    }

    /**
     * Proses Registrasi
     */
    public function storeRegister()
    {
        $applicantTypeId = $this->request->getPost('applicant_type_id');

        if (!$applicantTypeId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jenis pemohon wajib dipilih.');
        }

        $applicantType = $this->applicantTypeModel->find($applicantTypeId);

        if (!$applicantType) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jenis pemohon tidak valid.');
        }

        $applicantCode = strtoupper(
            trim((string) ($applicantType['code'] ?? 'UMUM'))
        );

        /*
         * Validasi dasar.
         */
        $rules = [
            'full_name'     => 'required|min_length[3]',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'phone_number'  => 'required',
            'password'      => 'required|min_length[8]',
            'password_confirmation' => 'required|matches[password]',
        ];

        /*
         * Validasi berdasarkan jenis pemohon.
         */
        switch ($applicantCode) {

            case 'MHS':
                $rules['nim'] = 'required';
                $rules['study_program_id'] = 'required';
                $rules['class_id'] = 'required';
                break;

            case 'ALUMNI':
                $rules['nim'] = 'required';
                break;

            case 'DOSEN':
            case 'TENDIK':
                $rules['identity_number'] = 'required';
                break;

            case 'WALI':
                $rules['student_name'] = 'required';
                break;

            case 'MITRA':
                $rules['institution_name'] = 'required';
                break;

            default:
                $rules['nik'] = 'required';
                break;
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        /*
         * Role Pemohon = 4
         */
        $roleId = 4;

        /*
         * Data utama user.
         */
        $userData = [
            'role_id'      => $roleId,
            'full_name'    => $this->request->getPost('full_name'),
            'email'        => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'password'     => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'is_active' => 1,
        ];

        /*
         * Tambahkan field jika memang tersedia
         * di UserModel.
         */
        $allowedFields = $this->userModel->allowedFields ?? [];

        $optionalFields = [
            'gender',
            'identity_number',
            'address',
        ];

        foreach ($optionalFields as $field) {
            if (
                in_array($field, $allowedFields) &&
                $this->request->getPost($field) !== null
            ) {
                $userData[$field] = $this->request->getPost($field);
            }
        }

        /*
         * Email verified jika kolom tersedia.
         */
        if (in_array('email_verified_at', $allowedFields)) {
            $userData['email_verified_at'] = date('Y-m-d H:i:s');
        }

        /*
         * Simpan user.
         */
        $this->userModel->insert($userData);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }
}