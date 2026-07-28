<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['kode' => 'AN', 'nama_jurusan' => 'Administrasi Niaga', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'AK', 'nama_jurusan' => 'Akuntansi', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'TE', 'nama_jurusan' => 'Teknik Elektro', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'TK', 'nama_jurusan' => 'Teknik Kimia', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'JTK', 'nama_jurusan' => 'Teknik Komputer dan Informatika', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'TRE', 'nama_jurusan' => 'Teknik Konversi Energi', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'TM', 'nama_jurusan' => 'Teknik Mesin', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'TRTU', 'nama_jurusan' => 'Teknik Refrigerasi dan Tata Udara', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'TS', 'nama_jurusan' => 'Teknik Sipil', 'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('jurusans')->insertBatch($data);
    }
}
