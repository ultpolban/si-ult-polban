<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $programs = [

            /*
            |--------------------------------------------------------------------------
            | JURUSAN TEKNIK SIPIL
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 1,
                'code' => 'TKG',
                'name' => 'Teknik Konstruksi Gedung',
                'short_name' => 'TKG',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 1,
                'code' => 'TKS',
                'name' => 'Teknik Konstruksi Sipil',
                'short_name' => 'TKS',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 1,
                'code' => 'TPJJ',
                'name' => 'Teknik Perancangan Jalan dan Jembatan',
                'short_name' => 'TPJJ',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 1,
                'code' => 'TPPG',
                'name' => 'Teknik Perawatan dan Perbaikan Gedung',
                'short_name' => 'TPPG',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 1,
                'code' => 'RI',
                'name' => 'Rekayasa Infrastruktur',
                'short_name' => 'RI',
                'degree' => 'S2',
                'description' => null,
                'sort_order' => 5,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN TEKNIK MESIN
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 2,
                'code' => 'TM',
                'name' => 'Teknik Mesin',
                'short_name' => 'TM',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 6,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 2,
                'code' => 'TA',
                'name' => 'Teknik Aeronautika',
                'short_name' => 'TA',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 7,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 2,
                'code' => 'TPKM',
                'name' => 'Teknik Perancangan dan Konstruksi Mesin',
                'short_name' => 'TPKM',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 8,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 2,
                'code' => 'PM',
                'name' => 'Proses Manufaktur',
                'short_name' => 'PM',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 9,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN TEKNIK REFRIGERASI DAN TATA UDARA
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 3,
                'code' => 'D3-TPTU',
                'name' => 'Teknik Pendingin dan Tata Udara',
                'short_name' => 'TPTU',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 10,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 3,
                'code' => 'D4-TPTU',
                'name' => 'Teknik Pendingin dan Tata Udara',
                'short_name' => 'TPTU',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 11,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN TEKNIK KONVERSI ENERGI
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 4,
                'code' => 'TKE',
                'name' => 'Teknik Konversi Energi',
                'short_name' => 'TKE',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 12,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 4,
                'code' => 'TPTL',
                'name' => 'Teknologi Pembangkit Tenaga Listrik',
                'short_name' => 'TPTL',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 13,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN TEKNIK ELEKTRO
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 5,
                'code' => 'D3-TEL',
                'name' => 'Teknik Elektronika',
                'short_name' => 'Teknik Elektronika',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 15,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 5,
                'code' => 'TL',
                'name' => 'Teknik Listrik',
                'short_name' => 'Teknik Listrik',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 16,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 5,
                'code' => 'D3-TT',
                'name' => 'Teknik Telekomunikasi',
                'short_name' => 'Teknik Telekomunikasi',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 17,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 5,
                'code' => 'D4-TEL',
                'name' => 'Teknik Elektronika',
                'short_name' => 'Teknik Elektronika',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 18,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 5,
                'code' => 'TOI',
                'name' => 'Teknik Otomasi Industri',
                'short_name' => 'TOI',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 19,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 5,
                'code' => 'D4-TT',
                'name' => 'Teknik Telekomunikasi',
                'short_name' => 'Teknik Telekomunikasi',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 20,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN TEKNIK KIMIA
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 6,
                'code' => 'TK',
                'name' => 'Teknik Kimia',
                'short_name' => 'Teknik Kimia',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 21,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 6,
                'code' => 'AK',
                'name' => 'Analis Kimia',
                'short_name' => 'Analis Kimia',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 22,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 6,
                'code' => 'TKK',
                'name' => 'Teknik Kimia Produksi Bersih',
                'short_name' => 'TKPB',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 23,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN TEKNIK KOMPUTER DAN INFORMATIKA
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 7,
                'code' => 'D3-TI',
                'name' => 'Teknik Informatika',
                'short_name' => 'Teknik Informatika',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 24,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 7,
                'code' => 'D4-TI',
                'name' => 'Teknik Informatika',
                'short_name' => 'Teknik Informatika',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 25,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN AKUNTANSI
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 8,
                'code' => 'D3-AK',
                'name' => 'Akuntansi',
                'short_name' => 'Akuntansi',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 26,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 8,
                'code' => 'D3-KP',
                'name' => 'Keuangan dan Perbankan',
                'short_name' => 'Keuangan & Perbankan',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 27,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 8,
                'code' => 'D4-AK',
                'name' => 'Akuntansi',
                'short_name' => 'Akuntansi',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 28,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 8,
                'code' => 'D4-AMP',
                'name' => 'Akuntansi Manajemen Pemerintahan',
                'short_name' => 'AMP',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 29,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 8,
                'code' => 'D4-KS',
                'name' => 'Keuangan Syariah',
                'short_name' => 'Keuangan Syariah',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 30,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN ADMINISTRASI NIAGA
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 9,
                'code' => 'D3-AB',
                'name' => 'Administrasi Bisnis',
                'short_name' => 'Administrasi Bisnis',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 31,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 9,
                'code' => 'D3-UPW',
                'name' => 'Usaha Perjalanan Wisata',
                'short_name' => 'UPW',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 32,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 9,
                'code' => 'D3-MP',
                'name' => 'Manajemen Pemasaran',
                'short_name' => 'Manajemen Pemasaran',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 33,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 9,
                'code' => 'D4-AB',
                'name' => 'Administrasi Bisnis',
                'short_name' => 'Administrasi Bisnis',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 34,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 9,
                'code' => 'D4-DP',
                'name' => 'Destinasi Pariwisata',
                'short_name' => 'Destinasi Pariwisata',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 35,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 9,
                'code' => 'D4-MA',
                'name' => 'Manajemen Aset',
                'short_name' => 'Manajemen Aset',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 36,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 9,
                'code' => 'D4-MP',
                'name' => 'Manajemen Pemasaran',
                'short_name' => 'Manajemen Pemasaran',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 37,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | JURUSAN BAHASA INGGRIS
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 10,
                'code' => 'D3-BI',
                'name' => 'Bahasa Inggris',
                'short_name' => 'Bahasa Inggris',
                'degree' => 'D3',
                'description' => null,
                'sort_order' => 38,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 10,
                'code' => 'D4-BIKBP',
                'name' => 'Bahasa Inggris untuk Komunikasi Bisnis dan Profesional',
                'short_name' => 'BIKBP',
                'degree' => 'D4',
                'description' => null,
                'sort_order' => 39,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            |--------------------------------------------------------------------------
            | PROGRAM MAGISTER TERAPAN
            |--------------------------------------------------------------------------
            */

            [
                'department_id' => 1,
                'code' => 'S2-RI',
                'name' => 'Rekayasa Infrastruktur',
                'short_name' => 'RI',
                'degree' => 'S2',
                'description' => null,
                'sort_order' => 40,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 8,
                'code' => 'S2-KPS',
                'name' => 'Keuangan dan Perbankan Syariah',
                'short_name' => 'KPS',
                'degree' => 'S2',
                'description' => null,
                'sort_order' => 41,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'department_id' => 9,
                'code' => 'S2-PIT',
                'name' => 'Pemasaran, Inovasi dan Teknologi',
                'short_name' => 'PIT',
                'degree' => 'S2',
                'description' => null,
                'sort_order' => 42,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        $this->db->table('master_study_programs')->insertBatch($programs);
    }
}
