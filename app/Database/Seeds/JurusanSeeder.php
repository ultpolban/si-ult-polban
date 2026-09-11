<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $role = $this->db
            ->table('roles')
            ->where('code', 'PETUGAS_JURUSAN')
            ->get()
            ->getRowArray();

        if (!$role) {
            $this->db->table('roles')->insert([
                'code' => 'PETUGAS_JURUSAN',
                'name' => 'Petugas Jurusan',
                'description' => 'Memverifikasi dan memproses layanan jurusan.',
                'sort_order' => 8,
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $role = $this->db
                ->table('roles')
                ->where('code', 'PETUGAS_JURUSAN')
                ->get()
                ->getRowArray();
        }

        $email = 'petugas.jurusan@polban.ac.id';
        $user = $this->db
            ->table('users')
            ->where('email', $email)
            ->get()
            ->getRowArray();

        if ($user) {
            $this->db->table('users')
                ->where('id', $user['id'])
                ->update([
                    'role_id' => $role['id'],
                    'full_name' => 'Petugas Jurusan',
                    'password' => password_hash('Jurusan123', PASSWORD_DEFAULT),
                    'is_active' => true,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            echo 'Petugas Jurusan sudah tersedia dan diupdate.' . PHP_EOL;
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insert([
            'role_id' => $role['id'],
            'full_name' => 'Petugas Jurusan',
            'identity_number' => 'JUR001',
            'phone_number' => null,
            'email' => $email,
            'password' => password_hash('Jurusan123', PASSWORD_DEFAULT),
            'profile_photo' => null,
            'is_active' => true,
            'mfa_enabled' => false,
            'last_login' => null,
            'remember_token' => null,
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        echo 'Petugas Jurusan berhasil dibuat.' . PHP_EOL;
    }
}
