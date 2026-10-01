<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Menambahkan kolom `gender` pada `user_profiles`.
 *
 * Sejumlah halaman profil pemohon (mahasiswa, umum, orang tua, mitra)
 * memilih `user_profiles.gender` sehingga halaman tersebut gagal 500
 * karena kolom tersebut belum ada di basis data.
 */
class AddGenderToUserProfiles extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        if (! $db->tableExists('user_profiles')) {
            return;
        }

        if (in_array('gender', $db->getFieldNames('user_profiles'), true)) {
            return;
        }

        $position = in_array('phone', $db->getFieldNames('user_profiles'), true)
            ? 'AFTER `phone`'
            : '';

        $db->query(
            'ALTER TABLE `user_profiles` ADD COLUMN `gender` VARCHAR(20) NULL ' . $position
        );
    }

    public function down()
    {
        $db = \Config\Database::connect();

        if (! $db->tableExists('user_profiles')) {
            return;
        }

        if (! in_array('gender', $db->getFieldNames('user_profiles'), true)) {
            return;
        }

        $this->forge->dropColumn('user_profiles', 'gender', true);
    }
}