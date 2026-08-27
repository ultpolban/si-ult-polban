<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $userModel = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan email
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan');
        }

        // Cek apakah akun aktif
        if (isset($user['is_active']) && !$user['is_active']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda tidak aktif');
        }

        // Verifikasi password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah');
        }

        // Update waktu login terakhir
        $userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s')
        ]);

        // Simpan session berdasarkan struktur tabel users
        session()->set([
            'user_id'   => $user['id'],
            'name'      => $user['full_name'],
            'email'     => $user['email'],
            'role_id'   => $user['role_id'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
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
        $userModel = new UserModel();

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

        // Simpan user langsung ke tabel users
        $userModel->insert([
            'full_name'      => $this->request->getPost('name'),
            'email'          => $this->request->getPost('email'),
            'phone_number'   => $this->request->getPost('phone'),
            'password'       => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'is_active'      => 1,
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }
}