<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMetadataToAdministrasiUmumTickets extends Migration
{
    public function up()
    {
        $fields = [];
        if (!$this->db->fieldExists('title', 'administrasi_umum_tickets')) {
            $fields['title'] = ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true, 'after' => 'service_name'];
        }
        if (!$this->db->fieldExists('service_category', 'administrasi_umum_tickets')) {
            $fields['service_category'] = ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true, 'after' => 'service_name'];
        }
        if (!$this->db->fieldExists('unit_name', 'administrasi_umum_tickets')) {
            $fields['unit_name'] = ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'service_category'];
        }
        if ($fields !== []) {
            $this->forge->addColumn('administrasi_umum_tickets', $fields);
        }
    }

    public function down()
    {
        foreach (['unit_name', 'service_category', 'title'] as $field) {
            if ($this->db->fieldExists($field, 'administrasi_umum_tickets')) {
                $this->forge->dropColumn('administrasi_umum_tickets', $field);
            }
        }
    }
}
