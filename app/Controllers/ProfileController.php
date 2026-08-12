<?php

namespace App\Controllers;

class ProfileController extends BaseController
{
    public function index()
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        $user = db_connect()->table('users')
            ->select('users.*, roles.name as role_name')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->where('users.id', $userId)
            ->get()
            ->getRowArray();

        return view('profile/index', [
            'title' => 'Profil Saya',
            'user' => $user ?: [],
        ]);
    }

    public function update()
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        $fullName = trim((string) $this->request->getPost('full_name'));
        $email = trim((string) $this->request->getPost('email'));
        $phone = trim((string) $this->request->getPost('phone'));

        if ($fullName === '' || $email === '') {
            return redirect()->back()->withInput()->with('error', 'Nama dan email wajib diisi.');
        }

        db_connect()->table('users')
            ->where('id', $userId)
            ->update([
                'full_name' => $fullName,
                'email' => $email,
                'phone_number' => $phone !== '' ? $phone : null,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        session()->set([
            'full_name' => $fullName,
            'email' => $email,
        ]);

        return redirect()->to('/profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
