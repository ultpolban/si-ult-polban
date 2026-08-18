<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel = new UserModel();
    }

    /**
     * Halaman Login
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard-mahasiswa');
        }

        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Proses Login
     */
    public function authenticate()
    {
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        if ($email === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email dan Password wajib diisi.');
        }

        $user = $this->userModel
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah.');
        }

        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s')
        ]);

        $role = db_connect()
            ->table('roles')
            ->where('id', $user['role_id'])
            ->get()
            ->getRowArray();

        session()->set([
            'user_id'      => $user['id'],
            'role_id'      => $user['role_id'],
            'full_name'    => $user['full_name'],
            'email'        => $user['email'],
            'role_name'    => $role['name'] ?? '',
            'isLoggedIn'   => true,
            'user'         => $user,
        ]);

        return redirect()->to('/dashboard-mahasiswa');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
