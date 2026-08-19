<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Tampil Halaman Profil
    public function index()
    {
        $userId = session()->get('user_id') ?? 1; 
        $user   = $this->userModel->find($userId);

        $data = [
            'title' => 'Profil Petugas',
            'user'  => $user,
        ];

        return view('profile/index', $data);
    }

    // Tampil Form Edit Profil
    public function edit()
    {
        $userId = session()->get('user_id') ?? 1; 
        $user   = $this->userModel->find($userId);

        $data = [
            'title' => 'Edit Profil Petugas',
            'user'  => $user,
        ];

        return view('profile/edit', $data);
    }

    // Proses Simpan/Update Data
    public function update()
    {
        $userId = session()->get('user_id') ?? 1;

        $rules = [
            'full_name'    => 'required|min_length[3]',
            'email'        => 'required|valid_email',
            'phone_number' => 'required',
            'profile_photo'=> 'is_image[profile_photo]|max_size[profile_photo,2048]|mime_in[profile_photo,image/png,image/jpg,image/jpeg,image/webp]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $this->userModel->find($userId);
        
        $updateData = [
            'full_name'    => $this->request->getPost('full_name'),
            'email'        => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
        ];

        // Process Upload Foto Profil
        $filePhoto = $this->request->getFile('profile_photo');
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            $newName = $filePhoto->getRandomName();
            $filePhoto->move(FCPATH . 'uploads/profile', $newName);
            
            if (!empty($user['profile_photo']) && file_exists(FCPATH . 'uploads/profile/' . $user['profile_photo'])) {
                unlink(FCPATH . 'uploads/profile/' . $user['profile_photo']);
            }

            $updateData['profile_photo'] = $newName;
        }

        $this->userModel->update($userId, $updateData);

        return redirect()->to('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}