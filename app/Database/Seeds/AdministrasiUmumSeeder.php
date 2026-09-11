<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdministrasiUmumSeeder extends Seeder
{
    public function run()
    {
        $role = $this->db->table('roles')->where('code', 'PETUGAS_UMUM')->get()->getRowArray();
        if (!$role) {
            echo "Role PETUGAS_UMUM tidak ditemukan." . PHP_EOL;
            return;
        }

        $email = 'petugas.umum@polban.ac.id';
        $password = 'UmumPolban123!';
        $now = date('Y-m-d H:i:s');
        $data = [
            'role_id' => $role['id'],
            'full_name' => 'Petugas Administrasi Umum',
            'identity_number' => 'UMUM001',
            'phone_number' => null,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'profile_photo' => null,
            'is_active' => true,
            'email_verified_at' => $now,
            'updated_at' => $now,
        ];
        $existing = $this->db->table('users')->where('email', $email)->get()->getRowArray();
        if ($existing) {
            $this->db->table('users')->where('id', $existing['id'])->update($data);
        } else {
            $data['created_at'] = $now;
            $this->db->table('users')->insert($data);
        }

        echo "Administrasi Umum testing account ready." . PHP_EOL;
        echo "Email    : {$email}" . PHP_EOL;
        echo "Password : {$password}" . PHP_EOL;
    }
}
