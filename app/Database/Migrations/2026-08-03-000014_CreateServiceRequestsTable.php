<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceRequestsTable extends Migration
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
            | Nomor Tiket
            |--------------------------------------------------------------------------
            */

            'ticket_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            'user_profile_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'service_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | Data Pengajuan
            |--------------------------------------------------------------------------
            */

            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'draft',
                    'submitted',
                    'verification',
                    'revision',
                    'processing',
                    'completed',
                    'rejected',
                    'cancelled'
                ],
                'default' => 'submitted',
            ],

            /*
            |--------------------------------------------------------------------------
            | Prioritas
            |--------------------------------------------------------------------------
            */

            'priority' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'low',
                    'normal',
                    'high',
                    'urgent'
                ],
                'default' => 'normal',
            ],

            /*
            |--------------------------------------------------------------------------
            | Petugas
            |--------------------------------------------------------------------------
            */

            'assigned_to' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | SLA
            |--------------------------------------------------------------------------
            */

            'submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'processed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'completed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'rejected_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'cancelled_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | Catatan
            |--------------------------------------------------------------------------
            */

            'admin_note' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'rejection_reason' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | Audit
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
        | KEY
        |--------------------------------------------------------------------------
        */

        $this->forge->addKey('id', true);

        $this->forge->addUniqueKey('ticket_number');

        $this->forge->addKey('user_profile_id');
        $this->forge->addKey('service_id');
        $this->forge->addKey('assigned_to');
        $this->forge->addKey('status');
        $this->forge->addKey('priority');

        /*
        |--------------------------------------------------------------------------
        | FOREIGN KEY
        |--------------------------------------------------------------------------
        */

        $this->forge->addForeignKey(
            'user_profile_id',
            'user_profiles',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'service_id',
            'master_services',
            'id',
            'CASCADE',
            'CASCADE'
        );

        /*
        |--------------------------------------------------------------------------
        | assigned_to mengarah ke users
        |--------------------------------------------------------------------------
        */

        $this->forge->addForeignKey(
            'assigned_to',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable('service_requests', true);
    }

    public function down()
    {
        $this->forge->dropTable('service_requests', true);
    }
}
