<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Membersihkan tabel `registration_requests` versi LAMA di database
 * utama (si_ult_polban). Sejak Opsi A, tabel tersebut hidup di database
 * fisik terpisah `registrations` (lihat 2026-09-18-000001).
 *
 * Tanpa $DBGroup -> berjalan pada grup `default` (DB utama).
 */
class DropLegacyRegistrationRequestsFromDefaultDb extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('registration_requests')) {
            $this->forge->dropTable('registration_requests', true);
        }
    }

    public function down()
    {
        // Skema lama tidak dihidupkan kembali (tanpa kolom payload penuh).
    }
}