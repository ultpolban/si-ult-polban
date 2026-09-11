<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdministrasiUmumTicketsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'ticket_number' => ['type' => 'VARCHAR', 'constraint' => 30],
            'applicant_name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'applicant_identifier' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'service_name' => ['type' => 'VARCHAR', 'constraint' => 200],
            'description' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['submitted', 'processing', 'completed', 'rejected', 'cancelled'], 'default' => 'submitted'],
            'priority' => ['type' => 'ENUM', 'constraint' => ['low', 'normal', 'high', 'urgent'], 'default' => 'normal'],
            'assigned_to' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
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
        $this->forge->addKey('priority');
        $this->forge->createTable('administrasi_umum_tickets', true);
    }

    public function down()
    {
        $this->forge->dropTable('administrasi_umum_tickets', true);
    }
}
