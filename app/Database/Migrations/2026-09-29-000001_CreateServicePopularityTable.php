<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * =====================================================================
 *  TABEL service_popularity
 * ---------------------------------------------------------------------
 *  Menyimpan angka pakai (dipakai/diakses) tiap layanan ULT.
 *
 *  Kenapa tabel terpisah?
 *   - Halaman landing harus cepat, sementara tabel `tickets` bisa
 *     tumbuh ribuan baris. Menghitungnya tiap kali buka landing
 *     terlalu berat.
 *   - Jadi angka disimpan/agregat di sini, di-update setiap kali
 *     ada aktivitas, lalu landing hanya ORDER BY + LIMIT.
 *
 *  view_count       = berapa kali halaman detail layanan dibuka
 *  submission_count = berapa kali layanan itu benar-benar diajukan
 * =====================================================================
 */
class CreateServicePopularityTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'service_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'view_count' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],

            'submission_count' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],

            'last_viewed_at' => [
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

        $this->forge->addKey('service_id', true);

        $this->forge->addKey('view_count');

        $this->forge->addKey('submission_count');

        $this->forge->createTable('service_popularity', true);

        // Pastikan semua layanan aktif punya baris (bernilai 0) supaya
        // landing page tidak perlu LEFT JOIN yang bolos.
        $this->db->query(
            'INSERT INTO service_popularity (service_id, view_count, submission_count, created_at)
             SELECT id, 0, 0, NOW() FROM master_services WHERE deleted_at IS NULL'
        );

        // Sinkronkan dengan service_statistics yang sudah ada (arsip).
        $this->db->query(
            'UPDATE service_popularity sp
             INNER JOIN service_statistics ss ON ss.service_id = sp.service_id
             SET sp.submission_count = sp.submission_count + ss.total_submission'
        );
    }

    public function down()
    {
        $this->forge->dropTable('service_popularity', true);
    }
}
