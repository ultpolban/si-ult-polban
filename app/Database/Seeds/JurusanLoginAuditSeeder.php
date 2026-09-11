<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JurusanLoginAuditSeeder extends Seeder
{
    public function run()
    {
        $email = 'petugas.jurusan@polban.ac.id';

        $users = $this->db
            ->table('users')
            ->where('email', $email)
            ->get()
            ->getResultArray();

        echo 'USER_COUNT=' . count($users) . PHP_EOL;

        foreach ($users as $user) {
            $role = $this->db
                ->table('roles')
                ->where('id', (int) ($user['role_id'] ?? 0))
                ->get()
                ->getRowArray();

            $valid = password_verify('Jurusan123', (string) ($user['password'] ?? ''));

            echo json_encode([
                'id' => (int) ($user['id'] ?? 0),
                'email' => $user['email'] ?? null,
                'role_id' => (int) ($user['role_id'] ?? 0),
                'is_active' => (int) ($user['is_active'] ?? 0),
                'full_name' => $user['full_name'] ?? null,
                'role_code' => $role['code'] ?? null,
                'role_name' => $role['name'] ?? null,
                'password_verify' => $valid ? true : false,
            ], JSON_THROW_ON_ERROR) . PHP_EOL;
        }

        $jurusanRole = $this->db
            ->table('roles')
            ->where('code', 'PETUGAS_JURUSAN')
            ->get()
            ->getRowArray();

        $perpusRole = $this->db
            ->table('roles')
            ->where('code', 'PETUGAS_PERPUSTAKAAN')
            ->get()
            ->getRowArray();

        echo 'JURUSAN_ROLE=' . json_encode($jurusanRole ?? null, JSON_THROW_ON_ERROR) . PHP_EOL;
        echo 'PERPUSTAKAAN_ROLE=' . json_encode($perpusRole ?? null, JSON_THROW_ON_ERROR) . PHP_EOL;
    }
}
