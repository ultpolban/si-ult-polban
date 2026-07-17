<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDocumentFieldsToTickets extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tickets', [
            'ktm_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'krs_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tickets', [
            'ktm_file',
            'krs_file',
            'catatan',
        ]);
    }
}