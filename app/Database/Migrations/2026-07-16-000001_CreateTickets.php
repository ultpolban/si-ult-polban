<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTickets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
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
                'constraint' => 20,
            ],

            'study_program' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Submitted',
                    'Verified',
                    'Assigned',
                    'In Progress',
                    'Completed',
                    'Closed'
                ],
                'default' => 'Submitted'
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'

        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('tickets');
    }

    public function down()
    {
        $this->forge->dropTable('tickets');
    }
}