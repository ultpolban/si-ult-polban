<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceRequestLogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'service_request_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],

            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | Status sebelum perubahan
            |--------------------------------------------------------------------------
            */

            'old_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | Status setelah perubahan
            |--------------------------------------------------------------------------
            */

            'new_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],


            /*
            |--------------------------------------------------------------------------
            | Jenis Aktivitas
            |--------------------------------------------------------------------------
            */

            'action' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],


            /*
            |--------------------------------------------------------------------------
            | Keterangan
            |--------------------------------------------------------------------------
            */

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | IP & User Agent untuk Audit
            |--------------------------------------------------------------------------
            */

            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],

            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | Timestamp
            |--------------------------------------------------------------------------
            */

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PRIMARY KEY
        |--------------------------------------------------------------------------
        */

        $this->forge->addKey('id', true);


        /*
        |--------------------------------------------------------------------------
        | INDEX
        |--------------------------------------------------------------------------
        */

        $this->forge->addKey('service_request_id');

        $this->forge->addKey('user_id');

        $this->forge->addKey('new_status');


        /*
        |--------------------------------------------------------------------------
        | FOREIGN KEY
        |--------------------------------------------------------------------------
        */


        $this->forge->addForeignKey(
            'service_request_id',
            'service_requests',
            'id',
            'CASCADE',
            'CASCADE'
        );


        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );


        $this->forge->createTable(
            'service_request_logs',
            true
        );
    }


    public function down()
    {
        $this->forge->dropTable(
            'service_request_logs',
            true
        );
    }
}
