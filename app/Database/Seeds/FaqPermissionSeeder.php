<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Menambahkan permission FAQ ke database yang sudah ada (tanpa wipe data).
 *
 * Cara pakai:
 *   php spark db:seed FaqPermissionSeeder
 */
class FaqPermissionSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $permissionBuilder = $this->db->table('permissions');
        $existing = $permissionBuilder->select('code')
            ->get()
            ->getResultArray();

        $existingCodes = array_values(array_filter(
            array_column($existing, 'code'),
            static fn ($code) => str_starts_with((string) $code, 'faq.')
        ));

        $faqPermissions = [
            'faq.view'    => 'Lihat FAQ',
            'faq.create'  => 'Tambah FAQ',
            'faq.update'  => 'Ubah FAQ',
            'faq.delete'  => 'Hapus FAQ',
            'faq.restore' => 'Pulihkan FAQ',
        ];

        $inserted = [];

        $sort = 1;

        foreach ($faqPermissions as $code => $label) {

            if (in_array($code, $existingCodes, true)) {
                continue;
            }

            $permissionBuilder->insert([
                'code'        => $code,
                'name'        => $label,
                'module'      => 'Faq',
                'description' => $label . ' - Faq',
                'sort_order'  => $sort,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);

            $inserted[$code] = $this->db->insertID();
        }

        // Ambil role yang berhak (SUPER_ADMIN & ADMIN_ULT)
        $roles = $this->db->table('roles')
            ->select('id, code')
            ->whereIn('code', ['SUPER_ADMIN', 'ADMIN_ULT'])
            ->get()
            ->getResultArray();

        $grant = [];

        foreach ($roles as $role) {

            foreach ($inserted as $code => $permissionId) {

                $exists = $this->db->table('role_permissions')
                    ->where('role_id', $role['id'])
                    ->where('permission_id', $permissionId)
                    ->countAllResults();

                if ($exists > 0) {
                    continue;
                }

                $grant[] = [
                    'role_id'       => $role['id'],
                    'permission_id' => $permissionId,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
            }
        }

        if (! empty($grant)) {
            $this->db->table('role_permissions')->insertBatch($grant);
        }

        echo 'Seed FAQ permission selesai.' . PHP_EOL;
    }
}