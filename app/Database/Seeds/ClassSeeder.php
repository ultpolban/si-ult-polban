<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use RuntimeException;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $studyPrograms = [];

        foreach (
            $this->db
                ->table('master_study_programs')
                ->get()
                ->getResultArray()
            as $program
        ) {
            $key = $program['degree'] . '-' . $program['code'];

            $studyPrograms[$key] = $program['id'];
        }

        if (empty($studyPrograms)) {
            throw new RuntimeException('Master study program belum tersedia.');
        }

        $classes = [

            // ===========================
            // Teknik Sipil
            // ===========================

            ['study_program' => 'D3-TKG', 'code' => 'D3-TKG-3A', 'name' => 'Teknik Konstruksi Gedung 3A'],
            ['study_program' => 'D3-TKS', 'code' => 'D3-TKS-3A', 'name' => 'Teknik Konstruksi Sipil 3A'],
            ['study_program' => 'D4-TPJJ', 'code' => 'D4-TPJJ-4A', 'name' => 'Teknik Perancangan Jalan dan Jembatan 4A'],
            ['study_program' => 'D4-TPPG', 'code' => 'D4-TPPG-4A', 'name' => 'Teknik Perawatan dan Perbaikan Gedung 4A'],

            // ===========================
            // Teknik Mesin
            // ===========================

            ['study_program' => 'D3-TM', 'code' => 'D3-TM-3A', 'name' => 'Teknik Mesin 3A'],
            ['study_program' => 'D3-TA', 'code' => 'D3-TA-3A', 'name' => 'Teknik Aeronautika 3A'],
            ['study_program' => 'D4-TPKM', 'code' => 'D4-TPKM-4A', 'name' => 'Teknik Perancangan dan Konstruksi Mesin 4A'],
            ['study_program' => 'D4-PM', 'code' => 'D4-PM-4A', 'name' => 'Proses Manufaktur 4A'],

            // ===========================
            // Refrigerasi
            // ===========================

            ['study_program' => 'D3-D3-TPTU', 'code' => 'D3-TPTU-3A', 'name' => 'Teknik Pendingin dan Tata Udara 3A'],
            ['study_program' => 'D4-D4-TPTU', 'code' => 'D4-TPTU-4A', 'name' => 'Teknik Pendingin dan Tata Udara 4A'],

            // ===========================
            // Teknik Konversi Energi
            // ===========================

            ['study_program' => 'D3-TKE', 'code' => 'D3-TKE-3A', 'name' => 'Teknik Konversi Energi 3A'],
            ['study_program' => 'D4-TPTL', 'code' => 'D4-TPTL-4A', 'name' => 'Teknologi Pembangkit Tenaga Listrik 4A'],

            // ===========================
            // Teknik Elektro
            // ===========================

            ['study_program' => 'D3-D3-TEL', 'code' => 'D3-TEL-3A', 'name' => 'Teknik Elektronika 3A'],
            ['study_program' => 'D3-TL', 'code' => 'D3-TL-3A', 'name' => 'Teknik Listrik 3A'],
            ['study_program' => 'D3-D3-TT', 'code' => 'D3-TT-3A', 'name' => 'Teknik Telekomunikasi 3A'],
            ['study_program' => 'D4-D4-TEL', 'code' => 'D4-TEL-4A', 'name' => 'Teknik Elektronika 4A'],
            ['study_program' => 'D4-TOI', 'code' => 'D4-TOI-4A', 'name' => 'Teknik Otomasi Industri 4A'],
            ['study_program' => 'D4-D4-TT', 'code' => 'D4-TT-4A', 'name' => 'Teknik Telekomunikasi 4A'],

            // ===========================
            // Teknik Kimia
            // ===========================

            ['study_program' => 'D3-TK', 'code' => 'D3-TK-3A', 'name' => 'Teknik Kimia 3A'],
            ['study_program' => 'D3-AK', 'code' => 'D3-ANKIM-3A', 'name' => 'Analis Kimia 3A'],
            ['study_program' => 'D4-TKK', 'code' => 'D4-TKK-4A', 'name' => 'Teknik Kimia Produksi Bersih 4A'],

            // ===========================
            // Teknik Komputer & Informatika
            // ===========================

            ['study_program' => 'D3-D3-TI', 'code' => 'D3-TI-3A', 'name' => 'Teknik Informatika 3A'],
            ['study_program' => 'D4-D4-TI', 'code' => 'D4-TI-4A', 'name' => 'Teknik Informatika 4A'],

            // ===========================
            // Akuntansi
            // ===========================

            ['study_program' => 'D3-D3-AK', 'code' => 'D3-AK-3A', 'name' => 'Akuntansi 3A'],
            ['study_program' => 'D4-D4-AK', 'code' => 'D4-AK-4A', 'name' => 'Akuntansi 4A'],

            // ===========================
            // Administrasi Niaga
            // ===========================

            ['study_program' => 'D3-D3-AB', 'code' => 'D3-AB-3A', 'name' => 'Administrasi Bisnis 3A'],
            ['study_program' => 'D4-D4-AB', 'code' => 'D4-AB-4A', 'name' => 'Administrasi Bisnis 4A'],

            // ===========================
            // Bahasa Inggris
            // ===========================

            ['study_program' => 'D3-D3-BI', 'code' => 'D3-BI-3A', 'name' => 'Bahasa Inggris 3A'],
            ['study_program' => 'D4-D4-BIKBP', 'code' => 'D4-BIKBP-4A', 'name' => 'Bahasa Inggris 4A'],
        ];

        $data = [];

        foreach ($classes as $class) {

            if (!isset($studyPrograms[$class['study_program']])) {
                throw new RuntimeException(
                    "Program studi {$class['study_program']} tidak ditemukan."
                );
            }

            $data[] = [
                'study_program_id' => $studyPrograms[$class['study_program']],
                'code'             => $class['code'],
                'name'             => $class['name'],
                'is_active'        => 1,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ];
        }

        $this->db
            ->table('master_classes')
            ->insertBatch($data);

        echo "Inserted " . count($data) . " classes." . PHP_EOL;
    }
}
