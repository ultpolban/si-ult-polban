<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplicantProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],

            'class_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
            ],

            'relationship' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],

            'student_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],

            'student_nim' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],

            'graduation_year' => [
                'type' => 'YEAR',
                'null' => true,
            ],

            'institution_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],

            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],

            'notes' => [
                'type' => 'TEXT',
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

        ]);

        $this->forge->addKey('id', true);

        $this->forge->addKey('user_id');

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'class_id',
            'classes',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->forge->createTable('applicant_profiles');
    }

    public function down()
    {
        $this->forge->dropTable('applicant_profiles');
    }
}
