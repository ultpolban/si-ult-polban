<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Layanan extends Migration
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
            'unit_layanan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'kategori_layanan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sla' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 24,
            ],
            'online' => [
                'type'       => 'ENUM',
                'constraint' => ['Online', 'Offline'],
                'default'    => 'Online',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Nonaktif'],
                'default'    => 'Aktif',
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
        $this->forge->addForeignKey('unit_layanan_id', 'unit_layanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kategori_layanan_id', 'kategori_layanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('layanans');
    }

    public function down()
    {
        $this->forge->dropTable('layanans');
    }
}
