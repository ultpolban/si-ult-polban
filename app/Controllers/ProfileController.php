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

    // =========================================================
    // TAMPIL HALAMAN PROFIL
    // =========================================================
    public function index()
    {
        $userId = session()->get('user_id') ?? 1;

        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Profil Petugas',
            'user'  => $user,
        ];

        return view('profile/index', $data);
    }

    // =========================================================
    // TAMPIL FORM EDIT PROFIL
    // =========================================================
    public function edit()
    {
        $userId = session()->get('user_id') ?? 1;

        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('profile')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Profil Petugas',
            'user'  => $user,
        ];

        return view('profile/edit', $data);
    }

    // =========================================================
    // PROSES UPDATE PROFIL
    // =========================================================
    public function update()
    {
        $userId = session()->get('user_id') ?? 1;

        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('profile')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        // ---------------------------------------------------------
        // VALIDASI
        // ---------------------------------------------------------
        $rules = [
            'full_name' => [
                'label'  => 'Nama Lengkap',
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.'
                ]
            ],

            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'valid_email' => '{field} harus menggunakan format email yang valid.'
                ]
            ],

            'phone_number' => [
                'label'  => 'Nomor Telepon',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.'
                ]
            ],

            'profile_photo' => [
                'label'  => 'Foto Profil',
                'rules'  => 'permit_empty|is_image[profile_photo]|max_size[profile_photo,2048]|mime_in[profile_photo,image/png,image/jpg,image/jpeg,image/webp]',
                'errors' => [
                    'is_image' => 'File yang dipilih harus berupa gambar.',
                    'max_size' => 'Ukuran foto maksimal 2 MB.',
                    'mime_in'  => 'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ---------------------------------------------------------
        // DATA YANG AKAN DIUPDATE
        // ---------------------------------------------------------
        $updateData = [
            'full_name'    => $this->request->getPost('full_name'),
            'email'        => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
        ];

        // ---------------------------------------------------------
        // PROSES FOTO PROFIL
        // ---------------------------------------------------------
        $filePhoto = $this->request->getFile('profile_photo');

        if ($filePhoto && $filePhoto->getError() !== UPLOAD_ERR_NO_FILE) {

            // Pastikan file valid
            if (!$filePhoto->isValid()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', $filePhoto->getErrorString());
            }

            // Folder upload
            $uploadPath = FCPATH . 'uploads/profile';

            // Buat folder jika belum ada
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Generate nama file baru
            $newName = $filePhoto->getRandomName();

            // Pindahkan file
            if (!$filePhoto->move($uploadPath, $newName)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Foto profil gagal diupload.');
            }

            // Hapus foto lama
            if (!empty($user['profile_photo'])) {

                $oldPhoto = $uploadPath . DIRECTORY_SEPARATOR . $user['profile_photo'];

                if (is_file($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }

            // Simpan nama file baru
            $updateData['profile_photo'] = $newName;
        }

        // ---------------------------------------------------------
        // UPDATE DATABASE
        // ---------------------------------------------------------
        if (!$this->userModel->update($userId, $updateData)) {

            // Jika database gagal, hapus file baru jika ada
            if (isset($newName) && is_file($uploadPath . DIRECTORY_SEPARATOR . $newName)) {
                unlink($uploadPath . DIRECTORY_SEPARATOR . $newName);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Profil gagal diperbarui.');
        }

        // ---------------------------------------------------------
        // SELESAI
        // ---------------------------------------------------------
        return redirect()
            ->to(base_url('profile'))
            ->with('success', 'Profil berhasil diperbarui!');
    }
}