<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],

            'department_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
            ],

            'study_program_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
            ],

            'work_unit_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
            ],

            'identity_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],

            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['L', 'P'],
                'null' => true,
            ],

            'birth_place' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'birth_date' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'angkatan' => [
                'type' => 'YEAR',
                'null' => true,
            ],

            'graduation_year' => [
                'type' => 'YEAR',
                'null' => true,
            ],

            'institution_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],

            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'relationship' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('user_id');

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('department_id', 'departments', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('study_program_id', 'study_programs', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('work_unit_id', 'work_units', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('user_profiles');
    }

    public function down()
    {
        $this->forge->dropTable('user_profiles');
    }
}
