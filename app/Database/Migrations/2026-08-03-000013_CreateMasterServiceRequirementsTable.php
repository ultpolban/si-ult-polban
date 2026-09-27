<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterServiceRequirementsTable extends Migration
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

            'service_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'file_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'pdf',
                'comment'    => 'pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
            ],

            'max_file_size' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 2048,
                'comment'    => 'KB',
            ],

            'is_required' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],

            'allowed_extensions' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        $this->forge->addKey('service_id');
        $this->forge->addKey('is_required');
        $this->forge->addKey('is_active');
        $this->forge->addKey('sort_order');

        $this->forge->addForeignKey(
            'service_id',
            'master_services',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('master_service_requirements', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_service_requirements', true);
    }
}
