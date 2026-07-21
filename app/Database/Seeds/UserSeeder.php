<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'role_id' => 1,
            'user_type_id' => 7, // Publik (boleh diganti jika ada tipe Admin khusus)
            'full_name' => 'Administrator',
            'gender' => 'L',
            'phone' => '081234567890',
            'personal_email' => 'admin@polban.ac.id',
            'institution_email' => 'admin@polban.ac.id',
            'password' => password_hash('Admin123!', PASSWORD_DEFAULT),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
