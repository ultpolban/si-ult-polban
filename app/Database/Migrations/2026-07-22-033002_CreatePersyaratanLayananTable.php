<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersyaratanLayananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],

            'layanan_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],

            'nama_persyaratan' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],

            'tipe_file' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],

            'wajib' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Ya',
                    'Tidak'
                ],
                'default' => 'Ya'
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);


        $this->forge->addKey('id', true);


        $this->forge->addForeignKey(
            'layanan_id',
            'layanan',
            'id',
            'CASCADE',
            'CASCADE'
        );


        $this->forge->createTable('persyaratan_layanan');
    }


    public function down()
    {
        $this->forge->dropTable('persyaratan_layanan');
    }
}