<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserProfileModel;

class AuthController extends BaseController
{
    // =====================================================
    // LOGIN
    // =====================================================

    public function login()
    {
        return view('auth/login');
    }


    // =====================================================
    // PROSES LOGIN
    // =====================================================

    public function authenticate()
    {
        $userModel = new UserModel();

        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        // =================================================
        // CARI USER BERDASARKAN EMAIL
        // =================================================

        $user = $userModel
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();

        if (!$user) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan atau akun tidak aktif.');
        }


        // =================================================
        // CEK PASSWORD
        // =================================================

        if (!password_verify($password, $user['password'])) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Password salah.');
        }


        // =================================================
        // AMBIL PROFILE MAHASISWA
        // =================================================

        $profileModel = new UserProfileModel();

        $profile = $profileModel
            ->where('user_id', $user['id'])
            ->first();


        // =================================================
        // DATA USER UNTUK SESSION
        // =================================================

        $sessionUser = [

            'id' => $user['id'],

            'nama' => $user['full_name'] ?? '',

            'nim' => $profile['nim']
                ?? $user['identity_number']
                ?? '',

            'nik' => $profile['nik']
                ?? $user['identity_number']
                ?? '',

            'email' => $user['email'] ?? '',

            'no_hp' => $user['phone_number'] ?? '',

            'role_id' => $user['role_id'],

            'prodi' => '',

            'jurusan' => '',

            'semester' => '',

            'angkatan' => '',

            'status' => 'Aktif',

            'foto' => $user['profile_photo'] ?? null,
        ];


        // =================================================
        // SIMPAN SESSION
        // =================================================

        session()->set([

            'user_id' => $user['id'],

            'user' => $sessionUser,

            'name' => $user['full_name'],

            'email' => $user['email'],

            'role_id' => $user['role_id'],

            'logged_in' => true,

            'user_profile_id' => $profile['id'] ?? null,

            'mahasiswa_profile' => $profile ?? [],
        ]);


        // =================================================
        // UPDATE LAST LOGIN
        // =================================================

        $userModel->update(
            $user['id'],
            [
                'last_login' => date('Y-m-d H:i:s')
            ]
        );


        // =================================================
        // REDIRECT BERDASARKAN ROLE
        // =================================================

        if ((int) $user['role_id'] === 6) {

            // PEMOHON / MAHASISWA
            return redirect()->to('/dashboard-mahasiswa');
        }


        // Role lain
        return redirect()->to('/dashboard');
    }


    // =====================================================
    // LOGOUT
    // =====================================================

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }


    // =====================================================
    // REGISTER
    // =====================================================

    public function register()
    {
        return view('auth/register');
    }


    // =====================================================
    // PROSES REGISTER
    // =====================================================

    public function storeRegister()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];


        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }


        $userModel = new UserModel();


        $userModel->insert([

            'full_name' => $this->request->getPost('name'),

            'email' => $this->request->getPost('email'),

            'phone_number' => $this->request->getPost('phone'),

            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),

            // PEMOHON
            'role_id' => 6,

            'is_active' => 1,

            'created_at' => date('Y-m-d H:i:s'),

            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Registrasi berhasil, silakan login.'
            );
    }
}