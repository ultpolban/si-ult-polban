<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketsTable extends Migration
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

            'ticket_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'service_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'applicant_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],

            'ticket_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'ticket_description' => [
                'type' => 'TEXT',
            ],

            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Submitted',
            ],

            'priority' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Normal',
            ],

            'assigned_unit' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'verified_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'submitted_at' => [
                'type' => 'DATETIME',
            ],

            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'completed_at' => [
                'type' => 'DATETIME',
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tickets');
    }

    public function down()
    {
        $this->forge->dropTable('tickets');
    }
}