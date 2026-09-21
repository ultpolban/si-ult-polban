<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Opsi A - database FISIK terpisah si_ult_registrations.
 * Menambahkan kolom `gender` (L/P) pada payload permintaan registrasi agar
 * data jenis kelamin yang dikirim form pemohon ikut tersimpan sebelum
 * admin melakukan approve (dipakai saat membuat user di DB utama).
 *
 * Jalan via: php spark migrate  (grup diambil dari $DBGroup di bawah).
 */
class AddGenderToRegistrationRequests extends Migration
{
    protected $DBGroup = 'registrations';

    public function up()
    {
        $this->forge->addColumn('registration_requests', [
            'gender' => [
                'type'       => 'VARCHAR',
                'constraint' => 1,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('registration_requests', 'gender');
    }
}
