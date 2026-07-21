<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        $user = $userModel
            ->where('personal_email', $email)
            ->orWhere('institution_email', $email)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah.');
        }

        if (!$user['is_active']) {
            return redirect()->back()->with('error', 'Akun tidak aktif.');
        }

        session()->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'role_id'   => $user['role_id'],
            'full_name' => $user['full_name'],
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
