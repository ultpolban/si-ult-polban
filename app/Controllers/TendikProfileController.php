<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class TendikProfileController extends BaseController
{
    protected UserModel $userModel;

    protected UserProfileModel $profileModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel   = new UserModel();
        $this->profileModel = new UserProfileModel();
    }

    /**
     * =====================================================
     * PROFILE TENDIK
     * =====================================================
     */
    public function index()
    {
        // =====================================================
        // CEK LOGIN
        // =====================================================

        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        // =====================================================
        // AMBIL USER
        // =====================================================

        $user = $this->userModel->find($userId);

        if (! $user) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        // =====================================================
        // PASTIKAN HANYA TENDIK
        // =====================================================

        if (session()->get('applicant_type_code') !== 'TENDIK') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Halaman ini hanya untuk Tendik.');
        }

        // =====================================================
        // AMBIL PROFILE DARI DATABASE
        // =====================================================

        $profile = $this->profileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        // =====================================================
        // JIKA PROFILE BELUM ADA
        // =====================================================

        if (! $profile) {

            $profile = [
                'id'                  => null,
                'user_id'             => $userId,

                'applicant_type_id'   => null,
                'study_program_id'    => null,
                'class_id'            => null,

                'nim'                 => null,
                'nidn'                => null,
                'nik'                 => null,

                'student_name'        => null,
                'institution_name'    => null,
                'position'            => 'Tenaga Kependidikan',

                'name'                => $user['full_name'] ?? '',
                'gender'              => $user['gender'] ?? null,
                'email'               => $user['email'] ?? '',
                'phone'               => $user['phone_number'] ?? '',
                'address'             => null,
                'photo'               => $user['profile_photo'] ?? null,

                'full_name'           => $user['full_name'] ?? '',
                'identity_number'     => $user['identity_number'] ?? null,

                'applicant_type_code' => 'TENDIK',
                'applicant_type'      => 'Tenaga Kependidikan',

                'study_program_name'  => null,
                'department_name'     => null,
                'class_name'         => null,
            ];
        }

        // =====================================================
        // BENTUK DATA UNTUK VIEW
        // =====================================================

        $dataProfile = [

            // =================================================
            // DATA PRIBADI
            // =================================================

            'nama' => $profile['name']
                ?? $profile['full_name']
                ?? $user['full_name']
                ?? '',

            // NIP dari users.identity_number
            'nip' => $profile['identity_number']
                ?? $user['identity_number']
                ?? '',

            // NIK dari user_profiles.nik
            'nik' => $profile['nik'] ?? '',

            'email' => $profile['email']
                ?? $user['email']
                ?? '',

            'no_hp' => $profile['phone']
                ?? $user['phone_number']
                ?? '',

            'jenis_kelamin' => $profile['gender']
                ?? $user['gender']
                ?? '',

            'alamat' => $profile['address'] ?? '',

            'foto' => $profile['photo']
                ?? $user['profile_photo']
                ?? null,

            // =================================================
            // DATA KEPEGAWAIAN
            // =================================================

            // institution_name dipakai sebagai unit kerja
            'unit_kerja' => $profile['institution_name'] ?? '',

            // Tidak tersedia di struktur user_profiles
            'bagian' => '',

            // position = jabatan
            'jabatan' => $profile['position']
                ?? 'Tenaga Kependidikan',

            // Status mengikuti users.is_active
            'status' => ((int) ($user['is_active'] ?? 0) === 1)
                ? 'Aktif'
                : 'Tidak Aktif',

            // =================================================
            // ID DATABASE
            // =================================================

            'user_id' => $userId,

            'profile_id' => $profile['id'] ?? null,
        ];

        return view('tendik/profile/index', [
            'title'   => 'Profil Tendik',
            'profile' => $dataProfile,
        ]);
    }

    /**
     * =====================================================
     * FORM EDIT PROFILE TENDIK
     * =====================================================
     */
    public function edit()
    {
        // =====================================================
        // CEK LOGIN
        // =====================================================

        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        // =====================================================
        // PASTIKAN TENDIK
        // =====================================================

        if (session()->get('applicant_type_code') !== 'TENDIK') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Akses hanya untuk Tendik.');
        }

        // =====================================================
        // AMBIL USER
        // =====================================================

        $user = $this->userModel->find($userId);

        if (! $user) {
            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        // =====================================================
        // AMBIL PROFILE
        // =====================================================

        $profile = $this->profileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        // =====================================================
        // PROFILE DEFAULT
        // =====================================================

        if (! $profile) {

            $profile = [
                'id'                => null,
                'user_id'           => $userId,

                'name'              => $user['full_name'] ?? '',

                'nik'               => '',
                'email'             => $user['email'] ?? '',
                'phone'             => $user['phone_number'] ?? '',
                'gender'            => $user['gender'] ?? '',
                'address'           => '',
                'photo'             => null,

                'institution_name'  => '',
                'position'          => 'Tenaga Kependidikan',

                // NIP dari users
                'identity_number'  => $user['identity_number'] ?? '',
            ];
        }

        // =====================================================
        // DATA UNTUK FORM
        // =====================================================

        $dataProfile = [

            // DATA PRIBADI
            'nama' => $profile['name']
                ?? $profile['full_name']
                ?? $user['full_name']
                ?? '',

            'nip' => $profile['identity_number']
                ?? $user['identity_number']
                ?? '',

            'nik' => $profile['nik'] ?? '',

            'email' => $profile['email']
                ?? $user['email']
                ?? '',

            'no_hp' => $profile['phone']
                ?? $user['phone_number']
                ?? '',

            'jenis_kelamin' => $profile['gender']
                ?? $user['gender']
                ?? '',

            'alamat' => $profile['address'] ?? '',

            'foto' => $profile['photo']
                ?? $user['profile_photo']
                ?? null,

            // KEPEGAWAIAN
            'unit_kerja' => $profile['institution_name'] ?? '',

            'bagian' => '',

            'jabatan' => $profile['position']
                ?? 'Tenaga Kependidikan',

            'status' => ((int) ($user['is_active'] ?? 0) === 1)
                ? 'Aktif'
                : 'Tidak Aktif',

            // ID
            'user_id' => $userId,

            'profile_id' => $profile['id'] ?? null,
        ];

        return view('tendik/profile/edit', [
            'title'   => 'Edit Profil Tendik',
            'profile' => $dataProfile,
        ]);
    }

    /**
     * =====================================================
     * UPDATE PROFILE TENDIK
     * =====================================================
     */
    public function update()
    {
        // =====================================================
        // CEK LOGIN
        // =====================================================

        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        // =====================================================
        // PASTIKAN TENDIK
        // =====================================================

        if (session()->get('applicant_type_code') !== 'TENDIK') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Akses hanya untuk Tendik.');
        }

        // =====================================================
        // AMBIL USER
        // =====================================================

        $user = $this->userModel->find($userId);

        if (! $user) {
            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        // =====================================================
        // AMBIL PROFILE
        // =====================================================

        $profile = $this->profileModel
            ->where('user_id', $userId)
            ->first();

        // =====================================================
        // NAMA
        // =====================================================

        $fullName = trim(
            (string) $this->request->getPost('nama')
        );

        if ($fullName === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nama lengkap wajib diisi.'
                );
        }

        // =====================================================
        // UPDATE USERS
        // =====================================================
        //
        // Yang boleh diubah:
        // - full_name
        //
        // Email, NIP, NIK, gender dan status
        // mengikuti data database.
        //

        $this->userModel->update(
            $userId,
            [
                'full_name' => $fullName,
            ]
        );

        // =====================================================
        // FOTO LAMA
        // =====================================================

        $photo = $profile['photo'] ?? null;

        // =====================================================
        // UPLOAD FOTO BARU
        // =====================================================

        $file = $this->request->getFile('foto');

        if (
            $file
            && $file->isValid()
            && ! $file->hasMoved()
        ) {

            // Maksimal 2 MB
            if (
                $file->getSize()
                > 2 * 1024 * 1024
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Ukuran foto maksimal 2 MB.'
                    );
            }

            // Extension
            $allowedExtensions = [
                'jpg',
                'jpeg',
                'png',
                'webp',
            ];

            $extension = strtolower(
                $file->getClientExtension()
            );

            if (
                ! in_array(
                    $extension,
                    $allowedExtensions,
                    true
                )
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                    );
            }

            // Folder upload
            $uploadPath = FCPATH . 'uploads/profile';

            if (! is_dir($uploadPath)) {
                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            // Nama random
            $namaFoto = $file->getRandomName();

            // Pindahkan
            $file->move(
                $uploadPath,
                $namaFoto
            );

            // Hapus foto lama
            if (
                ! empty($photo)
                && is_file(
                    $uploadPath
                    . DIRECTORY_SEPARATOR
                    . $photo
                )
            ) {

                @unlink(
                    $uploadPath
                    . DIRECTORY_SEPARATOR
                    . $photo
                );
            }

            $photo = $namaFoto;
        }

        // =====================================================
        // DATA PROFILE DARI DATABASE
        // =====================================================

        $nikLama = $profile['nik'] ?? '';

        $genderLama = $profile['gender']
            ?? $user['gender']
            ?? '';

        $emailLama = $profile['email']
            ?? $user['email']
            ?? '';

        // =====================================================
        // DATA YANG BOLEH DIUBAH
        // =====================================================

        $phone = trim(
            (string) $this->request->getPost('no_hp')
        );

        $address = trim(
            (string) $this->request->getPost('alamat')
        );

        $unitKerja = trim(
            (string) $this->request->getPost('unit_kerja')
        );

        $jabatan = trim(
            (string) $this->request->getPost('jabatan')
        );

        // =====================================================
        // PROFILE DATA
        // =====================================================

        $profileData = [

            'user_id' => $userId,

            'name' => $fullName,

            // NIK tidak diubah dari form
            'nik' => $nikLama,

            // Email tidak diubah
            'email' => $emailLama,

            // Gender tidak diubah
            'gender' => $genderLama,

            // Yang boleh diedit
            'phone' => $phone,

            'address' => $address,

            // Unit kerja menggunakan institution_name
            'institution_name' => $unitKerja,

            // Jabatan menggunakan position
            'position' => $jabatan
                ?: 'Tenaga Kependidikan',

            'photo' => $photo,
        ];

        // =====================================================
        // SIMPAN PROFILE
        // =====================================================

        if ($profile) {

            $this->profileModel->update(
                $profile['id'],
                $profileData
            );

        } else {

            $this->profileModel->insert(
                $profileData
            );
        }

        // =====================================================
        // UPDATE SESSION SEBAGAI CACHE
        // =====================================================

        $sessionUser = session()->get('user') ?? [];

        $sessionUser['full_name'] = $fullName;

        $sessionUser['email'] = $emailLama;

        $sessionUser['identity_number'] =
            $user['identity_number'] ?? '';

        $sessionUser['phone_number'] =
            $user['phone_number'] ?? '';

        session()->set(
            'user',
            $sessionUser
        );

        // =====================================================
        // REDIRECT
        // =====================================================

        return redirect()
            ->to(base_url('tendik/profile'))
            ->with(
                'success',
                'Profil Tendik berhasil diperbarui.'
            );
    }
}