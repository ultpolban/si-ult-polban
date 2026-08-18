<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterStudyProgramsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'department_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],

            'short_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],

            'degree' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],

            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);

        $this->forge->addUniqueKey('code');

        $this->forge->addKey('department_id');
        $this->forge->addKey('degree');
        $this->forge->addKey('is_active');

        $this->forge->addForeignKey(
            'department_id',
            'master_departments',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('master_study_programs', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_study_programs', true);
    }
}
