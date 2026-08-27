<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceApplicantTypesTable extends Migration
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
            'service_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'applicant_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
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
        $this->forge->addUniqueKey(['service_id', 'applicant_type_id']);
        $this->forge->addKey('applicant_type_id');

        $this->forge->addForeignKey(
            'service_id',
            'master_services',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'applicant_type_id',
            'master_applicant_types',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('service_applicant_types');
    }

    public function down()
    {
        $this->forge->dropTable('service_applicant_types');
    }
}
