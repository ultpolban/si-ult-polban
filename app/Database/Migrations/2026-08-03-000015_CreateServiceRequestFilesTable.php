<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceRequestFilesTable extends Migration
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

            'service_request_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],

            'requirement_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'original_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'file_extension' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'mime_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'file_size' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'is_verified' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],

            'verified_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'notes' => [
                'type' => 'TEXT',
                'null' => true,
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

        $this->forge->addKey('service_request_id');
        $this->forge->addKey('requirement_id');
        $this->forge->addKey('verified_by');

        $this->forge->addForeignKey(
            'service_request_id',
            'service_requests',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'requirement_id',
            'master_service_requirements',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'verified_by',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable('service_request_files', true);
    }

    public function down()
    {
        $this->forge->dropTable('service_request_files', true);
    }
}
