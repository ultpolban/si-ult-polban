<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

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
            'name'      => $user['name'],
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
            case 4:
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
        return view('auth/register');
    }

    public function storeRegister()
    {
        $rules = [
            'name'             => 'required|min_length[3]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'phone'            => 'required',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $userModel->save([
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role_id'   => 4, // Pemohon
            'is_active' => 1
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }
}