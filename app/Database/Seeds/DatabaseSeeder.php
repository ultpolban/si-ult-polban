<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(StudyProgramSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WorkUnitSeeder::class);
        $this->call(ClassSeeder::class);
    }
}