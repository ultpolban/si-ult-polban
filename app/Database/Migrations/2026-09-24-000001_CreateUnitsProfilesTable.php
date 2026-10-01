<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Tabel units_profiles: HANYA berisi description lengkap tentang units.
 * Satu unit (master_service_units) = satu baris profil/deskripsi.
 */
class CreateUnitsProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT', 'constraint' => 11,
                'unsigned' => true, 'auto_increment' => true,
            ],
            'service_unit_id' => [
                'type' => 'INT', 'constraint' => 11, 'unsigned' => true,
            ],
            'description' => ['type' => 'TEXT', 'null' => false],
            'is_active' => ['type' => 'BOOLEAN', 'default' => true],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'updated_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('service_unit_id');
        $this->forge->addKey('is_active');
        $this->forge->addForeignKey('service_unit_id', 'master_service_units', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('updated_by', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('units_profiles', true);
    }

    public function down()
    {
        $this->forge->dropTable('units_profiles', true);
    }
}

