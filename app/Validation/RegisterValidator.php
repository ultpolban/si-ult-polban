<?php

namespace App\Validation;

class RegisterValidator
{
    /**
     * Validation Store Registrasi
     */
    public static function store(): array
    {
        return [

            'full_name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|max_length[150]',
            ],

            'applicant_type_id' => [
                'label' => 'Jenis Pemohon',
                'rules' => 'required|integer',
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[150]|is_unique[users.email]',
            ],

            'phone_number' => [
                'label' => 'Nomor Telepon',
                'rules' => 'permit_empty|max_length[20]',
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
            ],

            'password_confirmation' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
            ],
        ];
    }

    /**
     * Validation Verify MFA Code
     */
    public static function mfaVerify(): array
    {
        return [
            'mfa_code' => [
                'label' => 'Kode MFA',
                'rules' => 'required|numeric|exact_length[6]',
            ],
        ];
    }
}