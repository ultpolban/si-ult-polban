<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRegistrationRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | Data Pemohon
            |--------------------------------------------------------------------------
            */

            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],


            /*
            |--------------------------------------------------------------------------
            | Keperluan / Alasan
            |--------------------------------------------------------------------------
            */

            'purpose' => [
                'type' => 'TEXT',
            ],


            /*
            |--------------------------------------------------------------------------
            | Status: pending / approved / rejected
            |--------------------------------------------------------------------------
            */

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'pending',
                    'approved',
                    'rejected',
                ],
                'default' => 'pending',
            ],


            /*
            |--------------------------------------------------------------------------
            | Admin Pemroses
            |--------------------------------------------------------------------------
            */

            'processed_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            'processed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | Alasan Penolakan
            |--------------------------------------------------------------------------
            */

            'rejection_reason' => [
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

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'deleted_at' => [
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

        $this->forge->addKey('email');

        $this->forge->addKey('status');

        $this->forge->addKey('created_at');


        /*
        |--------------------------------------------------------------------------
        | FOREIGN KEY
        |--------------------------------------------------------------------------
        */

        $this->forge->addForeignKey(
            'processed_by',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );


        $this->forge->createTable(
            'registration_requests',
            true
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'registration_requests',
            true
        );
    }
}
