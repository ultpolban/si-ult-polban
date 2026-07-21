<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['type_name' => 'Mahasiswa', 'description' => 'Mahasiswa POLBAN'],
            ['type_name' => 'Dosen', 'description' => 'Dosen POLBAN'],
            ['type_name' => 'Tendik', 'description' => 'Tenaga Kependidikan'],
            ['type_name' => 'Alumni', 'description' => 'Alumni POLBAN'],
            ['type_name' => 'Orang Tua/Wali', 'description' => 'Orang Tua atau Wali Mahasiswa'],
            ['type_name' => 'Mitra', 'description' => 'Mitra Kerja Sama'],
            ['type_name' => 'Publik', 'description' => 'Masyarakat Umum'],
        ];

        $this->db->table('user_types')->insertBatch($data);
    }
}
