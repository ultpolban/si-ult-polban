<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterClassesTable extends Migration
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

            'study_program_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'level' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
            ],

            'parallel_class' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
            ],

            'entry_year' => [
                'type'       => 'YEAR',
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

        $this->forge->addKey('study_program_id');
        $this->forge->addKey('entry_year');
        $this->forge->addKey('level');

        $this->forge->addForeignKey(
            'study_program_id',
            'master_study_programs',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('master_classes', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_classes', true);
    }
}
