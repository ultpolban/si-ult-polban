<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
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


            /*
            |--------------------------------------------------------------------------
            | Penerima Notifikasi
            |--------------------------------------------------------------------------
            */

            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | Referensi Pengajuan (opsional)
            |--------------------------------------------------------------------------
            */

            'service_request_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | Judul
            |--------------------------------------------------------------------------
            */

            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],


            /*
            |--------------------------------------------------------------------------
            | Isi pesan
            |--------------------------------------------------------------------------
            */

            'message' => [
                'type' => 'TEXT',
            ],


            /*
            |--------------------------------------------------------------------------
            | Tipe Notifikasi
            |--------------------------------------------------------------------------
            */

            'type' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'info',
                    'success',
                    'warning',
                    'danger'
                ],
                'default' => 'info',
            ],


            /*
            |--------------------------------------------------------------------------
            | Status baca
            |--------------------------------------------------------------------------
            */

            'is_read' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],


            'read_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],


            /*
            |--------------------------------------------------------------------------
            | URL tujuan
            |--------------------------------------------------------------------------
            */

            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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

        $this->forge->addKey('user_id');

        $this->forge->addKey('service_request_id');

        $this->forge->addKey('is_read');

        $this->forge->addKey('created_at');


        /*
        |--------------------------------------------------------------------------
        | FOREIGN KEY
        |--------------------------------------------------------------------------
        */


        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );


        $this->forge->addForeignKey(
            'service_request_id',
            'service_requests',
            'id',
            'CASCADE',
            'CASCADE'
        );


        $this->forge->createTable(
            'notifications',
            true
        );
    }


    public function down()
    {
        $this->forge->dropTable(
            'notifications',
            true
        );
    }
}
