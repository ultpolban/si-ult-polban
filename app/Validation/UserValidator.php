<?php

namespace App\Validation;

class UserValidator
{
    /**
     * Validation Store
     */
    public static function store(): array
    {
        return [

            'role_id' => [

                'label' => 'Role',

                'rules' => 'required|integer',

            ],

            'full_name' => [

                'label' => 'Nama Lengkap',

                'rules' => 'required|max_length[150]',

            ],

            'identity_number' => [

                'label' => 'Nomor Identitas',

                'rules' => 'permit_empty|max_length[30]',

            ],

            'phone_number' => [

                'label' => 'Nomor Telepon',

                'rules' => 'permit_empty|max_length[20]',

            ],

            'gender' => [

                'label' => 'Jenis Kelamin',

                'rules' => 'permit_empty|in_list[L,P]',

            ],

            'email' => [

                'label' => 'Email',

                'rules' => 'required|valid_email|max_length[150]|is_unique[users.email]',

            ],

            'password' => [

                'label' => 'Password',

                'rules' => 'required|min_length[8]',

            ],

            'password_confirmation' => [

                'label' => 'Konfirmasi Password',

                'rules' => 'required|matches[password]',

            ],

            // Field dinamis jenis pemohon

            'applicant_type_id' => [

                'label' => 'Jenis Pemohon',

                'rules' => 'permit_empty|integer',

            ],

            'nim' => [

                'label' => 'NIM',

                'rules' => 'permit_empty|max_length[30]',

            ],

            'nik' => [

                'label' => 'NIK',

                'rules' => 'permit_empty|max_length[30]',

            ],

            'study_program_id' => [

                'label' => 'Program Studi',

                'rules' => 'permit_empty|integer',

            ],

            'class_id' => [

                'label' => 'Kelas',

                'rules' => 'permit_empty|integer',

            ],

            'student_name' => [

                'label' => 'Nama Mahasiswa',

                'rules' => 'permit_empty|max_length[150]',

            ],

            'institution_name' => [

                'label' => 'Nama Instansi',

                'rules' => 'permit_empty|max_length[200]',

            ],

            'position' => [

                'label' => 'Jabatan',

                'rules' => 'permit_empty|max_length[150]',

            ],

            'address' => [

                'label' => 'Alamat',

                'rules' => 'permit_empty',

            ],

            'profile_photo' => [

                'label' => 'Foto Profil',

                'rules' => 'permit_empty|max_length[255]',

            ],

            'is_active' => [

                'label' => 'Status',

                'rules' => 'required|in_list[0,1]',

            ],

        ];
    }

    /**
     * Validation Update
     */
    public static function update(int $id): array
    {
        return [

            'role_id' => [

                'label' => 'Role',

                'rules' => 'required|integer',

            ],

            'full_name' => [

                'label' => 'Nama Lengkap',

                'rules' => 'required|max_length[150]',

            ],

            'identity_number' => [

                'label' => 'Nomor Identitas',

                'rules' => 'permit_empty|max_length[30]',

            ],

            'phone_number' => [

                'label' => 'Nomor Telepon',

                'rules' => 'permit_empty|max_length[20]',

            ],

            'gender' => [

                'label' => 'Jenis Kelamin',

                'rules' => 'permit_empty|in_list[L,P]',

            ],

            'email' => [

                'label' => 'Email',

                'rules' => 'required|valid_email|max_length[150]|is_unique[users.email,id,' . $id . ']',

            ],

            'password' => [

                'label' => 'Password',

                'rules' => 'permit_empty|min_length[8]',

            ],

            'password_confirmation' => [

                'label' => 'Konfirmasi Password',

                'rules' => 'permit_empty|matches[password]',

            ],

            // Field dinamis jenis pemohon

            'applicant_type_id' => [

                'label' => 'Jenis Pemohon',

                'rules' => 'permit_empty|integer',

            ],

            'nim' => [

                'label' => 'NIM',

                'rules' => 'permit_empty|max_length[30]',

            ],

            'nik' => [

                'label' => 'NIK',

                'rules' => 'permit_empty|max_length[30]',

            ],

            'study_program_id' => [

                'label' => 'Program Studi',

                'rules' => 'permit_empty|integer',

            ],

            'class_id' => [

                'label' => 'Kelas',

                'rules' => 'permit_empty|integer',

            ],

            'student_name' => [

                'label' => 'Nama Mahasiswa',

                'rules' => 'permit_empty|max_length[150]',

            ],

            'institution_name' => [

                'label' => 'Nama Instansi',

                'rules' => 'permit_empty|max_length[200]',

            ],

            'position' => [

                'label' => 'Jabatan',

                'rules' => 'permit_empty|max_length[150]',

            ],

            'address' => [

                'label' => 'Alamat',

                'rules' => 'permit_empty',

            ],

            'profile_photo' => [

                'label' => 'Foto Profil',

                'rules' => 'permit_empty|max_length[255]',

            ],

            'is_active' => [

                'label' => 'Status',

                'rules' => 'required|in_list[0,1]',

            ],

        ];
    }
}