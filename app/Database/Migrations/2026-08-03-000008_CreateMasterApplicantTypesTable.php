<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterApplicantTypesTable extends Migration
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

            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'is_internal' => [
                'type'    => 'BOOLEAN',
                'default' => true,
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

        $this->forge->addKey('is_internal');
        $this->forge->addKey('is_active');

        $this->forge->createTable('master_applicant_types', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_applicant_types', true);
    }
}
