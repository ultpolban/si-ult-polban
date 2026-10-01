<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PerpustakaanSeeder extends Seeder
{
    public function run()
    {
        $role = $this->db
            ->table('roles')
            ->where('code', 'PETUGAS_PERPUSTAKAAN')
            ->get()
            ->getRowArray();

        if (!$role) {
            $this->db->table('roles')->insert([
                'code' => 'PETUGAS_PERPUSTAKAAN',
                'name' => 'Petugas Perpustakaan',
                'description' => 'Memverifikasi dan memproses layanan perpustakaan.',
                'sort_order' => 7,
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $role = $this->db
                ->table('roles')
                ->where('code', 'PETUGAS_PERPUSTAKAAN')
                ->get()
                ->getRowArray();
        }

        $email = 'petugas.perpustakaan@polban.ac.id';
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
                    'full_name' => 'Petugas Perpustakaan',
                    'password' => password_hash('Perpustakaan123', PASSWORD_DEFAULT),
                    'is_active' => true,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            echo "Petugas Perpustakaan sudah tersedia dan diupdate." . PHP_EOL;
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insert([
            'role_id' => $role['id'],
            'full_name' => 'Petugas Perpustakaan',
            'identity_number' => 'PERP001',
            'phone_number' => null,
            'email' => $email,
            'password' => password_hash('Perpustakaan123', PASSWORD_DEFAULT),
            'profile_photo' => null,
            'is_active' => true,
            'mfa_enabled' => false,
            'last_login' => null,
            'remember_token' => null,
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        echo "Petugas Perpustakaan berhasil dibuat." . PHP_EOL;
    }
}
