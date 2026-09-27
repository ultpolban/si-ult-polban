<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSentTrackingColumnsToUnitTickets extends Migration
{
    public function up()
    {
        $tables = [
            'akademik_tickets',
            'keuangan_tickets',
            'kemahasiswaan_tickets',
            'administrasi_umum_tickets',
            'perpustakaan_tickets',
            'upt_tik_tickets',
            'jurusan_tickets',
        ];

        foreach ($tables as $table) {
            $this->ensureColumn($table, 'sent_to_ult', [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
            ]);

            $this->ensureColumn($table, 'sent_to_ult_at', [
                'type' => 'DATETIME',
                'null' => true,
            ]);

            $this->ensureColumn($table, 'sent_to_applicant', [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
            ]);

            $this->ensureColumn($table, 'sent_to_applicant_at', [
                'type' => 'DATETIME',
                'null' => true,
            ]);
        }
    }

    public function down()
    {
        $tables = [
            'akademik_tickets',
            'keuangan_tickets',
            'kemahasiswaan_tickets',
            'administrasi_umum_tickets',
            'perpustakaan_tickets',
            'upt_tik_tickets',
            'jurusan_tickets',
        ];

        foreach ($tables as $table) {
            foreach (['sent_to_ult', 'sent_to_ult_at', 'sent_to_applicant', 'sent_to_applicant_at'] as $column) {
                if ($this->db->fieldExists($column, $table)) {
                    $this->forge->dropColumn($table, $column);
                }
            }
        }
    }

    private function ensureColumn(string $table, string $column, array $definition): void
    {
        if (!$this->db->fieldExists($column, $table)) {
            $this->forge->addColumn($table, [$column => $definition]);
        }
    }
}
