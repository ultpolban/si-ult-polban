<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\RoleModel;
use Firebase\JWT\JWT;

class AuthService
{
    protected UserModel $userModel;
    protected RoleModel $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    /**
     * Register User
     */
    public function register(array $data)
    {
        // Validasi berdasarkan jenis pemohon
        $validation = $this->validateByUserType($data);

        if ($validation !== null) {
            return $validation;
        }

        // Nama
        if (empty($data['full_name'])) {
            return [
                'success' => false,
                'message' => 'Nama lengkap wajib diisi.'
            ];
        }

        // Gender
        if (empty($data['gender'])) {
            return [
                'success' => false,
                'message' => 'Jenis kelamin wajib dipilih.'
            ];
        }

        // HP
        if (empty($data['phone'])) {
            return [
                'success' => false,
                'message' => 'Nomor HP wajib diisi.'
            ];
        }

        // Email
        if (empty($data['personal_email'])) {
            return [
                'success' => false,
                'message' => 'Email pribadi wajib diisi.'
            ];
        }

        // Password
        if (empty($data['password'])) {
            return [
                'success' => false,
                'message' => 'Password wajib diisi.'
            ];
        }

        if (strlen($data['password']) < 8) {
            return [
                'success' => false,
                'message' => 'Password minimal 8 karakter.'
            ];
        }

        if (
            !isset($data['confirm_password']) ||
            $data['password'] != $data['confirm_password']
        ) {
            return [
                'success' => false,
                'message' => 'Konfirmasi password tidak sama.'
            ];
        }

        // Cek Email
        if ($this->userModel
            ->where('personal_email', $data['personal_email'])
            ->first()
        ) {

            return [
                'success' => false,
                'message' => 'Email sudah terdaftar.'
            ];
        }

        // Role Pemohon
        $role = $this->roleModel
            ->where('role_name', 'Pemohon')
            ->first();

        if (!$role) {
            return [
                'success' => false,
                'message' => 'Role Pemohon tidak ditemukan.'
            ];
        }

        // Simpan User
        $this->userModel->insert([

            'role_id' => $role['id'],

            'user_type_id' => $data['user_type_id'],

            'department_id' => $data['department_id'] ?? null,

            'study_program_id' => $data['study_program_id'] ?? null,

            'work_unit_id' => $data['work_unit_id'] ?? null,

            'nim' => $data['nim'] ?? null,

            'nip' => $data['nip'] ?? null,

            'nidn' => $data['nidn'] ?? null,

            'full_name' => $data['full_name'],

            'gender' => $data['gender'],

            'birth_place' => $data['birth_place'] ?? null,

            'birth_date' => $data['birth_date'] ?? null,

            'phone' => $data['phone'],

            'institution_email' => $data['institution_email'] ?? null,

            'personal_email' => $data['personal_email'],

            'address' => $data['address'] ?? null,

            'password' => password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            ),

            'is_active' => 1,

        ]);

        return [
            'success' => true,
            'message' => 'Registrasi berhasil.'
        ];
    }

    /**
     * Login
     */
    public function login(array $data)
    {
        $user = $this->userModel
            ->where('personal_email', $data['personal_email'])
            ->first();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Email tidak ditemukan.'
            ];
        }

        if (!$user['is_active']) {
            return [
                'success' => false,
                'message' => 'Akun tidak aktif.'
            ];
        }

        if (!password_verify($data['password'], $user['password'])) {
            return [
                'success' => false,
                'message' => 'Password salah.'
            ];
        }

        unset($user['password']);

        $payload = [
            'id'    => $user['id'],
            'email' => $user['personal_email'],
            'iat'   => time(),
            'exp'   => time() + (60 * 60 * 24)
        ];

        $token = JWT::encode(
            $payload,
            env('JWT_SECRET'),
            'HS256'
        );

        return [
            'success' => true,
            'message' => 'Login berhasil.',
            'token' => $token,
            'user' => $user
        ];
    }

    /**
     * Change Password
     */
    public function changePassword($jwtUser, array $data)
    {
        $user = $this->userModel->find($jwtUser->id);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ];
        }

        if (!password_verify($data['old_password'], $user['password'])) {
            return [
                'success' => false,
                'message' => 'Password lama salah.'
            ];
        }

        if ($data['new_password'] != $data['confirm_password']) {
            return [
                'success' => false,
                'message' => 'Konfirmasi password tidak sama.'
            ];
        }

        $this->userModel->update($user['id'], [
            'password' => password_hash(
                $data['new_password'],
                PASSWORD_DEFAULT
            )
        ]);

        return [
            'success' => true,
            'message' => 'Password berhasil diubah.'
        ];
    }

    /**
     * Validasi berdasarkan jenis pemohon
     */
    private function validateByUserType(array $data)
    {
        switch ((int) ($data['user_type_id'] ?? 0)) {

            case 1: // Mahasiswa

                if (empty($data['nim'])) {
                    return [
                        'success' => false,
                        'message' => 'NIM wajib diisi.'
                    ];
                }

                if (empty($data['department_id'])) {
                    return [
                        'success' => false,
                        'message' => 'Jurusan wajib dipilih.'
                    ];
                }

                if (empty($data['study_program_id'])) {
                    return [
                        'success' => false,
                        'message' => 'Program Studi wajib dipilih.'
                    ];
                }

                break;

            case 2: // Dosen

                if (empty($data['nip'])) {
                    return [
                        'success' => false,
                        'message' => 'NIP wajib diisi.'
                    ];
                }

                if (empty($data['work_unit_id'])) {
                    return [
                        'success' => false,
                        'message' => 'Unit Kerja wajib dipilih.'
                    ];
                }

                break;

            case 3: // Tendik

                if (empty($data['nip'])) {
                    return [
                        'success' => false,
                        'message' => 'NIP wajib diisi.'
                    ];
                }

                break;
        }

        return null;
    }
}
