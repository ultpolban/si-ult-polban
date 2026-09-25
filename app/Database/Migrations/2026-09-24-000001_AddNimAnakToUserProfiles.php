<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNimAnakToUserProfiles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user_profiles', [
            'nim_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'after'      => 'nim',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user_profiles', 'nim_anak');
    }
}
