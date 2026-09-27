<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [

            [
                'code'        => 'TS',
                'name'        => 'Jurusan Teknik Sipil',
                'short_name'  => 'Teknik Sipil',
                'description' => null,
                'sort_order'  => 1,
                'is_active'   => 1,
            ],

            [
                'code'        => 'TM',
                'name'        => 'Jurusan Teknik Mesin',
                'short_name'  => 'Teknik Mesin',
                'description' => null,
                'sort_order'  => 2,
                'is_active'   => 1,
            ],

            [
                'code'        => 'TRTU',
                'name'        => 'Jurusan Teknik Refrigerasi dan Tata Udara',
                'short_name'  => 'TRTU',
                'description' => null,
                'sort_order'  => 3,
                'is_active'   => 1,
            ],

            [
                'code'        => 'TKE',
                'name'        => 'Jurusan Teknik Konversi Energi',
                'short_name'  => 'TKE',
                'description' => null,
                'sort_order'  => 4,
                'is_active'   => 1,
            ],

            [
                'code'        => 'TE',
                'name'        => 'Jurusan Teknik Elektro',
                'short_name'  => 'Teknik Elektro',
                'description' => null,
                'sort_order'  => 5,
                'is_active'   => 1,
            ],

            [
                'code'        => 'TK',
                'name'        => 'Jurusan Teknik Kimia',
                'short_name'  => 'Teknik Kimia',
                'description' => null,
                'sort_order'  => 6,
                'is_active'   => 1,
            ],

            [
                'code'        => 'TKI',
                'name'        => 'Jurusan Teknik Komputer dan Informatika',
                'short_name'  => 'TKI',
                'description' => null,
                'sort_order'  => 7,
                'is_active'   => 1,
            ],

            [
                'code'        => 'AK',
                'name'        => 'Jurusan Akuntansi',
                'short_name'  => 'Akuntansi',
                'description' => null,
                'sort_order'  => 8,
                'is_active'   => 1,
            ],

            [
                'code'        => 'AN',
                'name'        => 'Jurusan Administrasi Niaga',
                'short_name'  => 'Administrasi Niaga',
                'description' => null,
                'sort_order'  => 9,
                'is_active'   => 1,
            ],

            [
                'code'        => 'BI',
                'name'        => 'Jurusan Bahasa Inggris',
                'short_name'  => 'Bahasa Inggris',
                'description' => null,
                'sort_order'  => 10,
                'is_active'   => 1,
            ],

        ];

        foreach ($departments as &$department) {

            $department['created_at'] = date('Y-m-d H:i:s');
            $department['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db
            ->table('master_departments')
            ->insertBatch($departments);
    }
}
