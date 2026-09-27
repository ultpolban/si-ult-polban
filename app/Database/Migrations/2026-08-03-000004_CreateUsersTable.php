<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
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

            'role_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],

            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'identity_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],

            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'profile_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],

            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'remember_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'email_verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

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

        // Primary Key
        $this->forge->addKey('id', true);

        // Unique Key
        $this->forge->addUniqueKey('email');

        // Index
        $this->forge->addKey('role_id');
        $this->forge->addKey('identity_number');
        $this->forge->addKey('is_active');
        $this->forge->addKey('deleted_at');

        // Foreign Key
        $this->forge->addForeignKey(
            'role_id',
            'roles',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
