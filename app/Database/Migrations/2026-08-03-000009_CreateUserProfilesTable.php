<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'applicant_type_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],

            'study_program_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],

            'class_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],

            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],

            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],

            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],

            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],

            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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


        $this->forge->addKey('id', true);


        /*
        |--------------------------------------------------------------------------
        | Relasi ke users
        |--------------------------------------------------------------------------
        */

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );


        /*
        |--------------------------------------------------------------------------
        | Relasi jenis pemohon
        |--------------------------------------------------------------------------
        */

        $this->forge->addForeignKey(
            'applicant_type_id',
            'master_applicant_types',
            'id',
            'SET NULL',
            'CASCADE'
        );


        /*
        |--------------------------------------------------------------------------
        | Relasi program studi
        |--------------------------------------------------------------------------
        */

        $this->forge->addForeignKey(
            'study_program_id',
            'master_study_programs',
            'id',
            'SET NULL',
            'CASCADE'
        );


        /*
        |--------------------------------------------------------------------------
        | Relasi kelas
        |--------------------------------------------------------------------------
        */

        $this->forge->addForeignKey(
            'class_id',
            'master_classes',
            'id',
            'SET NULL',
            'CASCADE'
        );


        $this->forge->createTable('user_profiles');
    }


    public function down()
    {
        $this->forge->dropTable('user_profiles');
    }
}
