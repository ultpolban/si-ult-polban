<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResultDocumentColumnsToUptTikTickets extends Migration
{
    public function up()
    {
        $fields = [];

        if (!$this->db->fieldExists('result_note', 'upt_tik_tickets')) {
            $fields['result_note'] = [
                'type' => 'TEXT',
                'null' => true,
            ];
        }

        if (!$this->db->fieldExists('result_file', 'upt_tik_tickets')) {
            $fields['result_file'] = [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ];
        }

        if ($fields !== []) {
            $this->forge->addColumn('upt_tik_tickets', $fields);
        }
    }

    public function down()
    {
        foreach (['result_file', 'result_note'] as $field) {
            if ($this->db->fieldExists($field, 'upt_tik_tickets')) {
                $this->forge->dropColumn('upt_tik_tickets', $field);
            }
        }
    }
}
