<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PersyaratanLayanan extends Migration
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
            'layanan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'persyaratan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tipe_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'pdf',
            ],
            'ukuran' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => '4096 MB', // following screenshot
            ],
            'wajib' => [
                'type'       => 'ENUM',
                'constraint' => ['Wajib', 'Opsional'],
                'default'    => 'Wajib',
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
        $this->forge->addForeignKey('layanan_id', 'layanans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('persyaratan_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('persyaratan_layanan');
    }
}
