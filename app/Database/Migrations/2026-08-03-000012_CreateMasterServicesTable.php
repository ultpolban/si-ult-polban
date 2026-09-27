<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterServicesTable extends Migration
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

            'service_unit_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'service_category_id' => [
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
                'constraint' => 200,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'service_hours' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 24,
                'comment'    => 'Estimasi penyelesaian dalam jam',
            ],

            'max_file_size' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 2048,
                'comment'    => 'KB',
            ],

            'is_online' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],

            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],

            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
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
        $this->forge->addKey('service_category_id');
        $this->forge->addKey('is_active');
        $this->forge->addKey('sort_order');

        $this->forge->addForeignKey(
            'service_unit_id',
            'master_service_units',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->forge->addForeignKey(
            'service_category_id',
            'master_service_categories',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->forge->createTable('master_services', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_services', true);
    }
}
