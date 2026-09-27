<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $role = $this->db
            ->table('roles')
            ->where('code', 'SUPER_ADMIN')
            ->get()
            ->getRowArray();

        if (!$role) {
            echo "Role SUPER_ADMIN tidak ditemukan." . PHP_EOL;
            return;
        }

        $email = 'superadmin@polban.ac.id';

        $user = $this->db
            ->table('users')
            ->where('email', $email)
            ->get()
            ->getRowArray();

        if ($user) {
            echo "Super Administrator sudah tersedia." . PHP_EOL;
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insert([

            'role_id' => $role['id'],

            'full_name' => 'Super Administrator',

            'identity_number' => 'ADM001',

            'phone_number' => '081234567890',

            'email' => $email,

            'password' => password_hash('admin123', PASSWORD_DEFAULT),

            'profile_photo' => null,

            'is_active' => true,

            'last_login' => null,

            'remember_token' => null,

            'email_verified_at' => $now,

            'created_at' => $now,

            'updated_at' => $now,

        ]);

        echo "======================================" . PHP_EOL;
        echo " Super Administrator berhasil dibuat " . PHP_EOL;
        echo "======================================" . PHP_EOL;
        echo "Email    : superadmin@polban.ac.id" . PHP_EOL;
        echo "Password : admin123" . PHP_EOL;
        echo "======================================" . PHP_EOL;
    }
}
