<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BackfillNikDosenTendik extends Migration
{
    /**
     * Sinkronkan NIK Dosen/Tendik ke user_profiles.nik.
     *
     * Sebelumnya NIK/NIP Dosen & Tendik hanya disimpan di users.identity_number.
     * Agar tampil konsisten di profil & detail user, nilai tersebut
     * juga disalin ke user_profiles.nik.
     */
    public function up()
    {
        // ID jenis pemohon Dosen & Tendik
        $applicantTypes = $this->db->table('master_applicant_types')
            ->select('id')
            ->whereIn('code', ['DOSEN', 'TENDIK'])
            ->get()
            ->getResultArray();

        $typeIds = array_column($applicantTypes, 'id');

        if (empty($typeIds)) {
            return;
        }

        $profiles = $this->db->table('user_profiles')
            ->select('user_profiles.id, users.identity_number')
            ->join('users', 'users.id = user_profiles.user_id', 'left')
            ->whereIn('user_profiles.applicant_type_id', $typeIds)
            ->groupStart()
                ->where('user_profiles.nik IS NULL')
                ->orWhere('user_profiles.nik', '')
            ->groupEnd()
            ->get()
            ->getResultArray();

        foreach ($profiles as $profile) {
            if (empty($profile['identity_number'])) {
                continue;
            }

            $this->db->table('user_profiles')
                ->where('id', $profile['id'])
                ->update(['nik' => $profile['identity_number']]);
        }
    }

    public function down()
    {
        // Tidak ada operasi rollback khusus.
        // Nilai nik yang telah disalin menjadi bagian dari data profil pengguna.
    }
}