<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTrackingFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tickets', [

            'verified_at DATETIME NULL',

            'assigned_at DATETIME NULL',

            'process_at DATETIME NULL',

            'completed_at DATETIME NULL',

            'closed_at DATETIME NULL'

        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tickets',[
            'verified_at',
            'assigned_at',
            'process_at',
            'completed_at',
            'closed_at'
        ]);
    }
}