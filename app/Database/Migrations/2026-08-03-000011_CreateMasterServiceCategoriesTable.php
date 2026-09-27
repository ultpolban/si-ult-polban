<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterServiceCategoriesTable extends Migration
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

            'service_unit_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
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

        $this->forge->addKey('service_unit_id');
        $this->forge->addKey('sort_order');
        $this->forge->addKey('is_active');

        $this->forge->addForeignKey(
            'service_unit_id',
            'master_service_units',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('master_service_categories', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_service_categories', true);
    }
}
