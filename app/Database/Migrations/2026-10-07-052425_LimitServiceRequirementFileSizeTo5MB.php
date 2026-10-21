<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LimitServiceRequirementFileSizeTo5MB extends Migration
{
    public function up()
    {
        $this->db->query("
            UPDATE master_service_requirements
            SET max_file_size = 5120
            WHERE max_file_size > 5120
        ");
    }

    public function down()
    {
        // Tidak mengembalikan nilai file size lama
        // karena nilai sebelumnya bisa berbeda-beda.
    }
}
