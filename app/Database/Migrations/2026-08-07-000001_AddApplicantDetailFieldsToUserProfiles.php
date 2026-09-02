<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddApplicantDetailFieldsToUserProfiles extends Migration
{
    public function up()
    {
        $fields = $this->db->getFieldNames('user_profiles');

        if (! in_array('student_name', $fields, true)) {
            $this->forge->addColumn('user_profiles', [
                'student_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                    'null'       => true,
                    'after'      => 'class_id',
                ],
            ]);
        }

        if (! in_array('institution_name', $fields, true)) {
            $this->forge->addColumn('user_profiles', [
                'institution_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 200,
                    'null'       => true,
                    'after'      => 'student_name',
                ],
            ]);
        }

        if (! in_array('position', $fields, true)) {
            $this->forge->addColumn('user_profiles', [
                'position' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                    'null'       => true,
                    'after'      => 'institution_name',
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldNames('user_profiles');

        if (in_array('student_name', $fields, true)) {
            $this->forge->dropColumn('user_profiles', 'student_name');
        }

        if (in_array('institution_name', $fields, true)) {
            $this->forge->dropColumn('user_profiles', 'institution_name');
        }

        if (in_array('position', $fields, true)) {
            $this->forge->dropColumn('user_profiles', 'position');
        }
    }
}