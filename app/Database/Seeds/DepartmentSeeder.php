<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'department_code' => 'TS',
                'department_name' => 'Teknik Sipil'
            ],

            [
                'department_code' => 'TM',
                'department_name' => 'Teknik Mesin'
            ],

            [
                'department_code' => 'TRTU',
                'department_name' => 'Teknik Refrigerasi dan Tata Udara'
            ],

            [
                'department_code' => 'TKE',
                'department_name' => 'Teknik Konversi Energi'
            ],

            [
                'department_code' => 'TE',
                'department_name' => 'Teknik Elektro'
            ],

            [
                'department_code' => 'TK',
                'department_name' => 'Teknik Kimia'
            ],

            [
                'department_code' => 'AK',
                'department_name' => 'Akuntansi'
            ],

            [
                'department_code' => 'AN',
                'department_name' => 'Administrasi Niaga'
            ],

            [
                'department_code' => 'JTK',
                'department_name' => 'Teknik Komputer dan Informatika'
            ],

        ];

        $this->db->table('departments')->insertBatch($data);
    }
}
