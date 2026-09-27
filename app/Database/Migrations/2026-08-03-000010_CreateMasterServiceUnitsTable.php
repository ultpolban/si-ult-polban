<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterServiceUnitsTable extends Migration
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
                'constraint' => 150,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],

            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],

            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'default.png',
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

        $this->forge->addKey('sort_order');
        $this->forge->addKey('is_active');

        $this->forge->createTable('master_service_units', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_service_units', true);
    }
}
