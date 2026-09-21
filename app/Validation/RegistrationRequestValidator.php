<?php

namespace App\Validation;

class RegistrationRequestValidator
{
    /**
     * Validation Store Registrasi penuh (Opsi A: pending-approval).
     * Payload penuh pemohon disimpan ke DB `registrations`;
     * user + MFA baru dibuat SETELAH admin approve.
     * Aturan per applicant_code mengikuti applicant_fields.php.
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
                'rules' => 'required|valid_email|max_length[150]',
            ],

            'phone_number' => [
                'label' => 'Nomor HP',
                'rules' => 'required|max_length[20]',
            ],

            'address' => [
                'label' => 'Alamat',
                'rules' => 'permit_empty|max_length[65535]',
            ],

            // MHS (+ ALUMNI opsional): NIM / prodi / kelas
            'nim' => [
                'label' => 'NIM',
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

            // DOSEN / TENDIK: NIK via identity_number
            'identity_number' => [
                'label' => 'NIK',
                'rules' => 'permit_empty|max_length[30]',
            ],

            // UMUM & lainnya: NIK via nik
            'nik' => [
                'label' => 'NIK',
                'rules' => 'permit_empty|max_length[30]',
            ],

            // WALI
            'student_name' => [
                'label' => 'Nama Mahasiswa',
                'rules' => 'permit_empty|max_length[150]',
            ],

            // MITRA
            'institution_name' => [
                'label' => 'Nama Instansi',
                'rules' => 'permit_empty|max_length[200]',
            ],

            'position' => [
                'label' => 'Jabatan',
                'rules' => 'permit_empty|max_length[150]',
            ],

            'password' => [
                'label'  => 'Password',
                'rules'  => SecurityRules::password(),
                'errors' => SecurityRules::passwordErrors(),
            ],

            'password_confirmation' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
            ],

            // Keperluan opsional (dipertahankan dari skema lama)
            'purpose' => [
                'label' => 'Keperluan',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];
    }

    /**
     * Validation Alasan Penolakan (admin)
     */
    public static function reject(): array
    {
        return [

            'rejection_reason' => [
                'label' => 'Alasan Penolakan',
                'rules' => 'required|max_length[1000]',
            ],
        ];
    }
}
