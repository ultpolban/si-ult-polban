<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FinanceSeeder extends Seeder
{
    public function run()
    {
        $role = $this->db
            ->table('roles')
            ->where('code', 'PETUGAS_KEUANGAN')
            ->get()
            ->getRowArray();

        if (!$role) {
            echo "Role PETUGAS_KEUANGAN tidak ditemukan." . PHP_EOL;
            return;
        }

        $email = 'petugas.keuangan@polban.ac.id';
        $user = $this->db
            ->table('users')
            ->where('email', $email)
            ->get()
            ->getRowArray();

        if ($user) {
            echo "Petugas Keuangan sudah tersedia." . PHP_EOL;
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insert([
            'role_id' => $role['id'],
            'full_name' => 'Petugas Keuangan',
            'identity_number' => 'KEU001',
            'phone_number' => null,
            'email' => $email,
            'password' => password_hash('Keuangan123', PASSWORD_DEFAULT),
            'profile_photo' => null,
            'is_active' => true,
            'mfa_enabled' => false,
            'last_login' => null,
            'remember_token' => null,
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        echo "Petugas Keuangan berhasil dibuat." . PHP_EOL;
    }
}