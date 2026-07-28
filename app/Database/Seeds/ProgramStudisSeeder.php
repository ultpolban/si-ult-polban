<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgramStudisSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // try to map jurusan ids by kode
        $jurusans = $this->db->table('jurusans')->get()->getResultArray();
        $map = [];
        foreach ($jurusans as $j) $map[$j['kode']] = $j['id'];

        $data = [
            ['kode' => 'D3AB', 'nama_program' => 'Administrasi Bisnis', 'jurusan_id' => ($map['AN'] ?? null), 'jenjang' => 'D3', 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'D4MB', 'nama_program' => 'Manajemen Bisnis', 'jurusan_id' => ($map['AN'] ?? null), 'jenjang' => 'D4', 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'D3AK', 'nama_program' => 'Akuntansi', 'jurusan_id' => ($map['AK'] ?? null), 'jenjang' => 'D3', 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'D4AKM', 'nama_program' => 'Akuntansi Manajemen', 'jurusan_id' => ($map['AK'] ?? null), 'jenjang' => 'D4', 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'D3TE', 'nama_program' => 'Teknik Elektronika', 'jurusan_id' => ($map['TE'] ?? null), 'jenjang' => 'D3', 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'D3TM', 'nama_program' => 'Teknik Mesin', 'jurusan_id' => ($map['TM'] ?? null), 'jenjang' => 'D3', 'status' => 'Aktif', 'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('program_studis')->insertBatch($data);
    }
}
