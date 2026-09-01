<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class DosenProfileController extends BaseController
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
     * PROFILE DOSEN
     * =====================================================
     */
    public function index()
    {
        // Pastikan login
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

        // Ambil user
        $user = $this->userModel->find($userId);

        if (! $user) {
            session()->destroy();

            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        // Pastikan hanya DOSEN
        $applicantTypeCode = session()->get('applicant_type_code');

        if ($applicantTypeCode !== 'DOSEN') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Halaman ini hanya untuk dosen.');
        }

        // Ambil profile lengkap dari database
        $profile = $this->profileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        if (! $profile) {

            // Jika belum ada profile, buat profile dasar
            $profile = [
                'user_id'              => $userId,
                'applicant_type_id'    => null,
                'study_program_id'     => null,
                'class_id'             => null,

                'nim'                  => null,
                'nidn'                 => null,
                'nik'                  => null,

                'student_name'         => null,
                'institution_name'     => null,
                'position'             => null,

                'name'                 => $user['full_name'] ?? '',
                'gender'               => null,
                'email'                => $user['email'] ?? '',
                'phone'                => null,
                'address'              => null,
                'photo'                => null,

                'full_name'            => $user['full_name'] ?? '',
                'identity_number'      => $user['identity_number'] ?? null,

                'applicant_type_code'  => 'DOSEN',
                'applicant_type'       => 'Dosen',

                'study_program_name'   => null,
                'department_name'      => null,
                'class_name'           => null,
            ];
        }

        // =====================================================
        // Bentuk data yang dipakai view
        // =====================================================

        $dataProfile = [

            // Identitas
            'nama' => $profile['name']
                ?? $profile['full_name']
                ?? $user['full_name']
                ?? '',

            // NIP berasal dari users.identity_number
            'nip' => $profile['identity_number']
                ?? $user['identity_number']
                ?? '',

            // NIDN sekarang berasal dari user_profiles.nidn
            'nidn' => $profile['nidn'] ?? '',

            'nik' => $profile['nik'] ?? '',

            'email' => $profile['email']
                ?? $user['email']
                ?? '',

            'no_hp' => $profile['phone'] ?? '',

            'jenis_kelamin' => $profile['gender'] ?? '',

            'alamat' => $profile['address'] ?? '',

            'foto' => $profile['photo'] ?? null,

            // Akademik
            'prodi' => $profile['study_program_name'] ?? '',

            'jurusan' => $profile['department_name'] ?? '',

            'fakultas' => '',

            'jabatan' => $profile['position']
                ?? 'Dosen',

            'status' => ((int) ($user['is_active'] ?? 0) === 1)
                ? 'Aktif'
                : 'Tidak Aktif',

            // ID database
            'user_id' => $userId,

            'profile_id' => $profile['id'] ?? null,

            'study_program_id' => $profile['study_program_id'] ?? null,
        ];

        return view('dosen/profile/index', [
            'title'   => 'Profil Dosen',
            'profile' => $dataProfile,
        ]);
    }

    /**
     * =====================================================
     * FORM EDIT PROFILE
     * =====================================================
     */
    public function edit()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        // Pastikan DOSEN
        if (session()->get('applicant_type_code') !== 'DOSEN') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Akses hanya untuk dosen.');
        }

        $user = $this->userModel->find($userId);

        if (! $user) {
            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        $profile = $this->profileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        // Kalau belum ada profile
        if (! $profile) {
            $profile = [
                'id'                 => null,
                'user_id'            => $userId,

                'name'               => $user['full_name'] ?? '',
                'nidn'               => '',
                'nik'                => '',

                'email'              => $user['email'] ?? '',
                'phone'              => '',
                'gender'             => '',
                'address'            => '',
                'photo'              => '',

                'study_program_id'   => null,
                'study_program_name' => '',

                'department_name'    => '',

                'position'          => 'Dosen',

                // NIP dari users
                'identity_number'    => $user['identity_number'] ?? '',
            ];
        }

        // Data yang digunakan oleh form
        $dataProfile = [
            'nama' => $profile['name']
                ?? $profile['full_name']
                ?? $user['full_name']
                ?? '',

            'nip' => $profile['identity_number']
                ?? $user['identity_number']
                ?? '',

            'nidn' => $profile['nidn'] ?? '',

            'nik' => $profile['nik'] ?? '',

            'email' => $profile['email']
                ?? $user['email']
                ?? '',

            'no_hp' => $profile['phone'] ?? '',

            'jenis_kelamin' => $profile['gender'] ?? '',

            'alamat' => $profile['address'] ?? '',

            'foto' => $profile['photo'] ?? null,

            'prodi' => $profile['study_program_name'] ?? '',

            'jurusan' => $profile['department_name'] ?? '',

            'fakultas' => '',

            'jabatan' => $profile['position'] ?? 'Dosen',

            'status' => ((int) ($user['is_active'] ?? 0) === 1)
                ? 'Aktif'
                : 'Tidak Aktif',

            'study_program_id' => $profile['study_program_id'] ?? null,
        ];

        return view('dosen/profile/edit', [
            'title'   => 'Edit Profil Dosen',
            'profile' => $dataProfile,
        ]);
    }

    /**
     * =====================================================
     * UPDATE PROFILE
     * =====================================================
     */
    public function update()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        // Pastikan DOSEN
        if (session()->get('applicant_type_code') !== 'DOSEN') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Akses hanya untuk dosen.');
        }

        $user = $this->userModel->find($userId);

        if (! $user) {
            return redirect()
                ->to('/login')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        // =====================================================
        // Ambil profile
        // =====================================================

        $profile = $this->profileModel
            ->where('user_id', $userId)
            ->first();

        // =====================================================
        // Data user
        // =====================================================

        $fullName = trim((string) $this->request->getPost('nama'));

        $email = trim((string) $this->request->getPost('email'));

        if ($fullName === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Nama lengkap wajib diisi.');
        }

        if ($email === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email wajib diisi.');
        }

        // =====================================================
        // Update USERS
        // =====================================================
        //
        // NIP disimpan di identity_number.
        // NIDN TIDAK disimpan di users.
        //

        $this->userModel->update($userId, [
            'full_name' => $fullName,
            'email'     => $email,
        ]);

        // =====================================================
        // Foto lama
        // =====================================================

        $photo = $profile['photo'] ?? null;

        // =====================================================
        // Upload foto baru
        // =====================================================

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && ! $file->hasMoved()) {

            // Maksimal 2 MB
            if ($file->getSize() > 2 * 1024 * 1024) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Ukuran foto maksimal 2 MB.');
            }

            // Pastikan extension
            $allowedExtensions = [
                'jpg',
                'jpeg',
                'png',
                'webp',
            ];

            $extension = strtolower(
                $file->getClientExtension()
            );

            if (! in_array($extension, $allowedExtensions, true)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Format foto harus JPG, JPEG, PNG, atau WEBP.');
            }

            // Folder
            $uploadPath = FCPATH . 'uploads/profile';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $namaFoto = $file->getRandomName();

            $file->move(
                $uploadPath,
                $namaFoto
            );

            // Hapus foto lama
            if (
                ! empty($photo)
                && is_file($uploadPath . DIRECTORY_SEPARATOR . $photo)
            ) {
                @unlink(
                    $uploadPath . DIRECTORY_SEPARATOR . $photo
                );
            }

            $photo = $namaFoto;
        }

        // =====================================================
        // Data PROFILE
        // =====================================================

        $profileData = [

            'user_id' => $userId,

            'name' => $fullName,

            // NIDN SEKARANG DI SINI
            'nidn' => trim(
                (string) $this->request->getPost('nidn')
            ),

            'nik' => trim(
                (string) $this->request->getPost('nik')
            ),

            'gender' => trim(
                (string) $this->request->getPost('jenis_kelamin')
            ),

            'email' => $email,

            'phone' => trim(
                (string) $this->request->getPost('no_hp')
            ),

            'address' => trim(
                (string) $this->request->getPost('alamat')
            ),

            'position' => trim(
                (string) $this->request->getPost('jabatan')
            ) ?: 'Dosen',

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
        // Update session user
        // =====================================================

        $sessionUser = session()->get('user') ?? [];

        $sessionUser['full_name'] = $fullName;

        $sessionUser['email'] = $email;

        // NIP tetap dari users.identity_number
        $sessionUser['identity_number'] =
            $user['identity_number'] ?? '';

        session()->set(
            'user',
            $sessionUser
        );

        return redirect()
            ->to(base_url('dosen/profile'))
            ->with(
                'success',
                'Profil dosen berhasil diperbarui.'
            );
    }
}