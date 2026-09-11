<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AkademikSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'petugas.akademik@polban.ac.id';

        if ($this->db->table('users')->where('email', $email)->countAllResults() > 0) {
            echo 'Akun Akademik sudah tersedia.' . PHP_EOL;
            return;
        }

        $role = $this->db
            ->table('roles')
            ->where('code', 'PETUGAS_AKADEMIK')
            ->get()
            ->getRowArray();

        if (!$role) {
            echo 'Role PETUGAS_AKADEMIK tidak ditemukan.' . PHP_EOL;
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insert([
            'role_id' => $role['id'],
            'full_name' => 'Petugas Akademik',
            'identity_number' => 'AKD001',
            'phone_number' => null,
            'email' => $email,
            'password' => password_hash('Akademik123', PASSWORD_DEFAULT),
            'profile_photo' => null,
            'is_active' => true,
            'last_login' => null,
            'remember_token' => null,
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        echo 'Akun Akademik berhasil dibuat.' . PHP_EOL;
    }
}