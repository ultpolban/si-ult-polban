<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PimpinanSeeder extends Seeder
{
    public function run()
    {
        $role = $this->db->table('roles')->where('code', 'PIMPINAN')->get()->getRowArray();

        if (!$role) {
            $now = date('Y-m-d H:i:s');
            $this->db->table('roles')->insert([
                'code'        => 'PIMPINAN',
                'name'        => 'Pimpinan',
                'description' => 'Memantau ringkasan dan kinerja layanan.',
                'is_active'   => true,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
            $role = $this->db->table('roles')->where('code', 'PIMPINAN')->get()->getRowArray();
        }

        $email = 'pemimpin@polban.ac.id';
        $user = $this->db->table('users')->where('email', $email)->get()->getRowArray();

        if ($user) {
            return;
        }

        $now = date('Y-m-d H:i:s');
        $this->db->table('users')->insert([
            'role_id'           => $role['id'],
            'full_name'         => 'Pimpinan POLBAN',
            'email'             => $email,
            'password'          => password_hash('pemimpin123', PASSWORD_DEFAULT),
            'is_active'         => true,
            'email_verified_at' => $now,
            'created_at'        => $now,
            'updated_at'        => $now,
        ]);
    }
}
