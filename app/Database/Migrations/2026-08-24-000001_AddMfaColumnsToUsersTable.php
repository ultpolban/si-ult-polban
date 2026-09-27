<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMfaColumnsToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'mfa_enabled' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => false,
            ],
            'mfa_secret' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'mfa_recovery_codes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mfa_confirmed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'mfa_enabled',
            'mfa_secret',
            'mfa_recovery_codes',
            'mfa_confirmed_at',
        ]);
    }
}