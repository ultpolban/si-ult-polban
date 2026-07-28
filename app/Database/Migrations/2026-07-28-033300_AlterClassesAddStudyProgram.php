<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterClassesAddStudyProgram extends Migration
{
    public function up()
    {
        $this->forge->addColumn('classes', [

            'study_program_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'id',
            ],

            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'updated_at',
            ],

        ]);

        $this->forge->addForeignKey(
            'study_program_id',
            'study_programs',
            'id',
            'CASCADE',
            'SET NULL'
        );
    }

    public function down()
    {
        $this->forge->dropForeignKey('classes', 'classes_study_program_id_foreign');

        $this->forge->dropColumn('classes', [
            'study_program_id',
            'deleted_at'
        ]);
    }
}
