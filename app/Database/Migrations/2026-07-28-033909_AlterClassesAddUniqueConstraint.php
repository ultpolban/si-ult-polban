<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterClassesAddUniqueConstraint extends Migration
{
    public function up()
    {
        $this->db->query("
            ALTER TABLE classes
            ADD CONSTRAINT uq_class_program
            UNIQUE (study_program_id, class_name)
        ");
    }

    public function down()
    {
        $this->db->query("
            ALTER TABLE classes
            DROP INDEX uq_class_program
        ");
    }
}