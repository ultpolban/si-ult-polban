<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Revisi units_profiles: hanya service_unit_id + description (+status/audit).
 * Menangani DB yang terlanjur migrate versi lama (banyak kolom) maupun baru.
 */
class SimplifyUnitsProfilesTable extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('units_profiles')) {
            return;
        }

        $fields = $this->db->getFieldNames('units_profiles');

        // Pastikan kolom inti ada
        if (! in_array('description', $fields, true)) {
            $this->forge->addColumn('units_profiles', [
                'description' => ['type' => 'TEXT', 'null' => false],
            ]);
        }
        if (! in_array('is_active', $fields, true)) {
            $this->forge->addColumn('units_profiles', [
                'is_active' => ['type' => 'BOOLEAN', 'default' => true],
            ]);
        }

        // Hapus kolom versi lama bila masih ada
        $drop = [];
        foreach (['slug','tagline','about','vision','mission','history','address','phone','email','website','operating_hours','map_embed','banner','photo','structure_image','facebook','instagram','twitter','youtube','sort_order','is_published'] as $col) {
            if (in_array($col, $this->db->getFieldNames('units_profiles'), true)) {
                $drop[] = $col;
            }
        }
        if ($drop !== []) {
            $this->forge->dropColumn('units_profiles', $drop);
        }
    }

    public function down()
    {
        // Tidak dikembalikan ke versi lama.
    }
}
