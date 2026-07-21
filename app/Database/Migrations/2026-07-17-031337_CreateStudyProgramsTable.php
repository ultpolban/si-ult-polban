<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudyProgramsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'department_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'program_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'program_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'education_level' => [
                'type'       => 'ENUM',
                'constraint' => ['D3', 'D4', 'S2'],
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Tidak Aktif'],
                'default'    => 'Aktif',
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('department_id');

        $this->forge->addForeignKey(
            'department_id',
            'departments',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('study_programs');
    }

    public function down()
    {
        $this->forge->dropTable('study_programs');
    }
}
