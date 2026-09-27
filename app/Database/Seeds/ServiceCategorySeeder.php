<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        /*
        ==========================================================
        Ambil ID Unit Layanan
        ==========================================================
        */

        $units = $this->db
            ->table('master_service_units')
            ->get()
            ->getResultArray();

        $unitMap = [];

        foreach ($units as $unit) {
            $unitMap[$unit['code']] = $unit['id'];
        }

        /*
        ==========================================================
        Data Kategori
        ==========================================================
        */

        $data = [

            /*
            ============================
            AKADEMIK
            ============================
            */

            [
                'service_unit_id' => $unitMap['AKD'],
                'code' => 'AKD-SURAT',
                'name' => 'Surat Akademik',
                'description' => 'Layanan surat akademik',
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'code' => 'AKD-STATUS',
                'name' => 'Status Mahasiswa',
                'description' => 'Layanan perubahan status mahasiswa',
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'code' => 'AKD-WISUDA',
                'name' => 'Wisuda',
                'description' => 'Layanan administrasi wisuda',
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ============================
            KEUANGAN
            ============================
            */

            [
                'service_unit_id' => $unitMap['KEU'],
                'code' => 'KEU-UKT',
                'name' => 'UKT',
                'description' => 'Layanan UKT',
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEU'],
                'code' => 'KEU-PEMBAYARAN',
                'name' => 'Administrasi Pembayaran',
                'description' => 'Administrasi pembayaran',
                'sort_order' => 5,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ============================
            KEMAHASISWAAN
            ============================
            */

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'code' => 'KMH-BEASISWA',
                'name' => 'Beasiswa',
                'description' => 'Layanan beasiswa',
                'sort_order' => 6,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'code' => 'KMH-ORMAWA',
                'name' => 'Organisasi Mahasiswa',
                'description' => 'Layanan organisasi mahasiswa',
                'sort_order' => 7,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ============================
            PERPUSTAKAAN
            ============================
            */

            [
                'service_unit_id' => $unitMap['PERPUS'],
                'code' => 'PERPUS-LAYANAN',
                'name' => 'Layanan Perpustakaan',
                'description' => 'Layanan perpustakaan',
                'sort_order' => 8,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ============================
            JURUSAN
            ============================
            */

            [
                'service_unit_id' => $unitMap['JUR'],
                'code' => 'JUR-AKADEMIK',
                'name' => 'Administrasi Jurusan',
                'description' => 'Administrasi jurusan',
                'sort_order' => 9,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'code' => 'JUR-TA',
                'name' => 'Tugas Akhir',
                'description' => 'Layanan administrasi tugas akhir mahasiswa.',
                'sort_order' => 10,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ============================
            UPTIK
            ============================
            */

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'code' => 'UPTIK-AKUN',
                'name' => 'Akun dan Sistem Informasi',
                'description' => 'Layanan akun dan sistem informasi',
                'sort_order' => 10,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ============================
            BAUK
            ============================
            */

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'code' => 'UPTIK-LAYANAN',
                'name' => 'Layanan Teknologi Informasi',
                'description' => 'Layanan umum teknologi informasi kampus.',
                'sort_order' => 12,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['ADM'],
                'code' => 'ADM-UMUM',
                'name' => 'Administrasi Umum',
                'description' => 'Layanan administrasi umum.',
                'sort_order' => 13,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        $this->db->table('master_service_categories')->insertBatch($data);
    }
}
