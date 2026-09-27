<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ApplicantTypeSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [

            [
                'code' => 'MHS',
                'name' => 'Mahasiswa',
                'description' => 'Mahasiswa aktif POLBAN',
                'is_internal' => 1,
                'sort_order' => 1,
                'is_active' => 1,
            ],

            [
                'code' => 'ALUMNI',
                'name' => 'Alumni',
                'description' => 'Lulusan POLBAN',
                'is_internal' => 1,
                'sort_order' => 2,
                'is_active' => 1,
            ],

            [
                'code' => 'TENDIK',
                'name' => 'Tendik',
                'description' => 'Tenaga Kependidikan',
                'is_internal' => 1,
                'sort_order' => 3,
                'is_active' => 1,
            ],

            [
                'code' => 'DOSEN',
                'name' => 'Dosen',
                'description' => 'Dosen POLBAN',
                'is_internal' => 1,
                'sort_order' => 4,
                'is_active' => 1,
            ],

            [
                'code' => 'MITRA',
                'name' => 'Mitra',
                'description' => 'Mitra Kerja Sama / Instansi',
                'is_internal' => 0,
                'sort_order' => 5,
                'is_active' => 1,
            ],

            [
                'code' => 'WALI',
                'name' => 'Orang Tua / Wali',
                'description' => 'Orang tua atau wali mahasiswa',
                'is_internal' => 0,
                'sort_order' => 6,
                'is_active' => 1,
            ],

            [
                'code' => 'UMUM',
                'name' => 'Masyarakat Umum',
                'description' => 'Pemohon dari masyarakat umum',
                'is_internal' => 0,
                'sort_order' => 7,
                'is_active' => 1,
            ],

        ];

        $builder = $this->db->table('master_applicant_types');

        foreach ($data as $item) {
            $existing = $builder->where('code', $item['code'])->get()->getRowArray();

            $item['updated_at'] = $now;

            if ($existing) {
                // Update data yang sudah ada
                $builder->where('id', $existing['id'])->update($item);
            } else {
                // Insert data baru
                $item['created_at'] = $now;
                $builder->insert($item);
            }
        }
    }
}