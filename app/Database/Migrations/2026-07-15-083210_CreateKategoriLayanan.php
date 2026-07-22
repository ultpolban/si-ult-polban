<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriLayanan extends Migration
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

            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Nonaktif'],
                'default'    => 'Aktif',
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',

            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('kategori_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_layanan');
    }
}