<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel study_programs
        $this->db->table('study_programs')->emptyTable();

        // Ambil id jurusan berdasarkan kode
        $departments = [];

        foreach ($this->db->table('departments')->get()->getResult() as $row) {
            $departments[$row->department_code] = $row->id;
        }

        $data = [

            // ===========================
            // Teknik Sipil
            // ===========================
            [
                'department_id' => $departments['TS'],
                'program_code' => 'D3TS',
                'program_name' => 'Teknik Sipil',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['TS'],
                'program_code' => 'D4PJJ',
                'program_name' => 'Perancangan Jalan dan Jembatan',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],

            // ===========================
            // Teknik Mesin
            // ===========================
            [
                'department_id' => $departments['TM'],
                'program_code' => 'D3TM',
                'program_name' => 'Teknik Mesin',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['TM'],
                'program_code' => 'D3TP',
                'program_name' => 'Teknik Pendingin dan Tata Udara',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['TM'],
                'program_code' => 'D4TRM',
                'program_name' => 'Teknik Rekayasa Manufaktur',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],

            // ===========================
            // Teknik Elektro
            // ===========================
            [
                'department_id' => $departments['TE'],
                'program_code' => 'D3TL',
                'program_name' => 'Teknik Listrik',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['TE'],
                'program_code' => 'D3TE',
                'program_name' => 'Teknik Elektronika',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['TE'],
                'program_code' => 'D4TEL',
                'program_name' => 'Teknik Elektronika',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['TE'],
                'program_code' => 'D4TPT',
                'program_name' => 'Teknik Telekomunikasi',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],

            // ===========================
            // Teknik Kimia
            // ===========================
            [
                'department_id' => $departments['TK'],
                'program_code' => 'D3TK',
                'program_name' => 'Teknik Kimia',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['TK'],
                'program_code' => 'D4TKP',
                'program_name' => 'Teknik Kimia Produksi Bersih',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],

            // ===========================
            // Akuntansi
            // ===========================
            [
                'department_id' => $departments['AK'],
                'program_code' => 'D3AK',
                'program_name' => 'Akuntansi',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['AK'],
                'program_code' => 'D4AKM',
                'program_name' => 'Akuntansi Manajemen',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],

            // ===========================
            // Administrasi Niaga
            // ===========================
            [
                'department_id' => $departments['AN'],
                'program_code' => 'D3AB',
                'program_name' => 'Administrasi Bisnis',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['AN'],
                'program_code' => 'D4MB',
                'program_name' => 'Manajemen Bisnis',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],

            // ===========================
            // Teknik Komputer dan Informatika (JTK)
            // ===========================
            [
                'department_id' => $departments['JTK'],
                'program_code' => 'D3TI',
                'program_name' => 'Teknik Informatika',
                'education_level' => 'D3',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['JTK'],
                'program_code' => 'D4TRPL',
                'program_name' => 'Teknik Rekayasa Perangkat Lunak',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],
            [
                'department_id' => $departments['JTK'],
                'program_code' => 'D4AIG',
                'program_name' => 'Teknik Rekayasa Kecerdasan Buatan',
                'education_level' => 'D4',
                'status' => 'Aktif',
            ],

        ];

        $this->db->table('study_programs')->insertBatch($data);

        echo "Study Program Seeder berhasil dijalankan.\n";
    }
}
