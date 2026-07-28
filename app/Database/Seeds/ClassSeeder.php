<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $data = [

            ['class_name' => '1A'],
            ['class_name' => '1B'],
            ['class_name' => '1C'],

            ['class_name' => '2A'],
            ['class_name' => '2B'],
            ['class_name' => '2C'],

            ['class_name' => '3A'],
            ['class_name' => '3B'],
            ['class_name' => '3C'],

            ['class_name' => '4A'],
            ['class_name' => '4B'],
            ['class_name' => '4C'],

        ];

        $this->db->table('classes')->insertBatch($data);
    }
}
