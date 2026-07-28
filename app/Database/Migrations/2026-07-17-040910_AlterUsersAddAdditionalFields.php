<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersAddAdditionalFields extends Migration
{
    public function up()
    {
        $fields = [

            'graduation_year' => [
                'type' => 'YEAR',
                'null' => true,
                'after' => 'study_program_id'
            ],

            'institution_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
                'after' => 'work_unit_id'
            ],

            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'institution_name'
            ],

            'relationship' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'position'
            ]

        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'graduation_year',
            'institution_name',
            'position',
            'relationship'
        ]);
    }
}
