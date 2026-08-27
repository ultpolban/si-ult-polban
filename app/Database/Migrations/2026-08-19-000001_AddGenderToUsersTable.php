<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGenderToUsersTable extends Migration
{
    public function up()
    {
        $fields = $this->db->getFieldNames('users');

        if (! in_array('gender', $fields, true)) {
            $this->forge->addColumn('users', [
                'gender' => [
                    'type'       => 'ENUM',
                    'constraint' => ['L', 'P'],
                    'null'       => true,
                    'default'    => null,
                    'after'      => 'phone_number',
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldNames('users');

        if (in_array('gender', $fields, true)) {
            $this->forge->dropColumn('users', 'gender');
        }
    }
}
