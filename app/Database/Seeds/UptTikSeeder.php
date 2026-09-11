<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UptTikSeeder extends Seeder
{
    public function run()
    {
        $role = $this->db->table('roles')
            ->where('code', 'PETUGAS_TIK')
            ->get()
            ->getRowArray();

        if (!$role) {
            echo "Role PETUGAS_TIK tidak ditemukan." . PHP_EOL;
            return;
        }

        $email = 'petugas.tik@polban.ac.id';
        $password = 'TIKPolban123!';
        $now = date('Y-m-d H:i:s');
        $user = $this->db->table('users')->where('email', $email)->get()->getRowArray();
        $data = [
            'role_id' => $role['id'],
            'full_name' => 'Petugas UPT TIK',
            'identity_number' => 'TIK001',
            'phone_number' => null,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'profile_photo' => null,
            'is_active' => true,
            'email_verified_at' => $now,
            'updated_at' => $now,
        ];

        if ($user) {
            $this->db->table('users')->where('id', $user['id'])->update($data);
        } else {
            $data['created_at'] = $now;
            $this->db->table('users')->insert($data);
        }

        echo "UPT TIK testing account ready." . PHP_EOL;
        echo "Email    : {$email}" . PHP_EOL;
        echo "Password : {$password}" . PHP_EOL;
    }
}
