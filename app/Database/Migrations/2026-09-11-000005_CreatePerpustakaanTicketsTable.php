<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerpustakaanTicketsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'ticket_number' => ['type' => 'VARCHAR', 'constraint' => 30],
            'applicant_name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'applicant_identifier' => ['type' => 'VARCHAR', 'constraint' => 50],
            'service_name' => ['type' => 'VARCHAR', 'constraint' => 200],
            'service_category' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'unit_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Perpustakaan'],
            'title' => ['type' => 'VARCHAR', 'constraint' => 200],
            'description' => ['type' => 'TEXT'],
            'status' => ['type' => 'ENUM', 'constraint' => ['submitted', 'processing', 'completed', 'rejected', 'cancelled'], 'default' => 'submitted'],
            'priority' => ['type' => 'ENUM', 'constraint' => ['low', 'normal', 'high', 'urgent'], 'default' => 'normal'],
            'admin_note' => ['type' => 'TEXT', 'null' => true],
            'result_note' => ['type' => 'TEXT', 'null' => true],
            'result_file' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'submitted_at' => ['type' => 'DATETIME', 'null' => true],
            'processed_at' => ['type' => 'DATETIME', 'null' => true],
            'completed_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('ticket_number');
        $this->forge->addKey('status');
        $this->forge->createTable('perpustakaan_tickets', true);
    }

    public function down()
    {
        $this->forge->dropTable('perpustakaan_tickets', true);
    }
}
