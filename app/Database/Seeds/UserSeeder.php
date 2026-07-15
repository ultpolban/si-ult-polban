<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Administrator',
            'email' => 'admin@ultpolban.ac.id',
            'phone' => '081234567890',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role_id' => 1,
            'is_active' => 1,
        ];

        $this->db->table('users')->insert($data);
    }
}
