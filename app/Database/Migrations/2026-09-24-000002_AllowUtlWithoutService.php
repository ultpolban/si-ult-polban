<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AllowUtlWithoutService extends Migration
{
    /**
     * Tabel service_requests sudah dihapus oleh migration
     * 2026-09-15-000001_UnifyTicketsAndAlignRoles (data lama
     * digabung ke tabel tickets). Karena itu bagian service_requests
     * hanya dijalankan bila tabelnya benar-benar masih ada.
     */
    private function hasLegacyServiceRequests(): bool
    {
        return $this->db->tableExists('service_requests');
    }

    public function up()
    {
        // Idempoten: kolom bisa sudah ada bila migrasi pernah dijalankan
        // sebagian (DDL MySQL tidak bersifat transaksional).
        if (! in_array('unit_id', $this->db->getFieldNames('tickets'), true)) {
            $this->forge->addColumn('tickets', [
                'unit_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'null'       => true,
                    'after'      => 'service_id',
                ],
            ]);
        }

        $this->db->query(
            'ALTER TABLE tickets MODIFY service_id INT(11) UNSIGNED NULL'
        );

        if (! $this->hasLegacyServiceRequests()) {
            return;
        }

        if (! in_array('unit_id', $this->db->getFieldNames('service_requests'), true)) {
            $this->forge->addColumn('service_requests', [
                'unit_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'null'       => true,
                    'after'      => 'service_id',
                ],
            ]);
        }

        $this->db->query(
            'ALTER TABLE service_requests MODIFY service_id INT(11) UNSIGNED NULL'
        );
    }

    public function down()
    {
        $this->db->query(
            'ALTER TABLE tickets MODIFY service_id INT(11) UNSIGNED NOT NULL'
        );

        $this->forge->dropColumn('tickets', 'unit_id');

        if (! $this->hasLegacyServiceRequests()) {
            return;
        }

        $this->db->query(
            'ALTER TABLE service_requests MODIFY service_id INT(11) UNSIGNED NOT NULL'
        );

        $this->forge->dropColumn('service_requests', 'unit_id');
    }
}
