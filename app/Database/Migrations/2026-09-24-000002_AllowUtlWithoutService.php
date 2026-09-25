<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AllowUtlWithoutService extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tickets', [
            'unit_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'service_id',
            ],
        ]);

        $this->forge->addColumn('service_requests', [
            'unit_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'service_id',
            ],
        ]);

        $this->db->query(
            'ALTER TABLE tickets MODIFY service_id INT(11) UNSIGNED NULL'
        );

        $this->db->query(
            'ALTER TABLE service_requests MODIFY service_id INT(11) UNSIGNED NULL'
        );
    }

    public function down()
    {
        $this->db->query(
            'ALTER TABLE tickets MODIFY service_id INT(11) UNSIGNED NOT NULL'
        );

        $this->db->query(
            'ALTER TABLE service_requests MODIFY service_id INT(11) UNSIGNED NOT NULL'
        );

        $this->forge->dropColumn('tickets', 'unit_id');
        $this->forge->dropColumn('service_requests', 'unit_id');
    }
}
