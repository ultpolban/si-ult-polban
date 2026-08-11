<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Jangan membuat admin dua kali
        $admin = $db->table('users')
            ->where('personal_email', 'admin@ultpolban.ac.id')
            ->get()
            ->getRow();

        if ($admin) {
            echo "Admin sudah ada.";
            return;
        }

        $db->table('users')->insert([

            'role_id' => 1,

            // Karena user_type_id NOT NULL,
            // gunakan Mahasiswa (id = 1) sementara.
            'user_type_id' => 1,

            'full_name' => 'Administrator',

            'personal_email' => 'admin@ultpolban.ac.id',

            'institution_email' => 'admin@ultpolban.ac.id',

            'password' => password_hash('admin123', PASSWORD_DEFAULT),

            'is_active' => 1,

            'created_at' => date('Y-m-d H:i:s'),

            'updated_at' => date('Y-m-d H:i:s'),

        ]);

        echo "Admin berhasil dibuat.";
    }
}