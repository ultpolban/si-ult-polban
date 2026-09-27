<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Backfill seeder untuk memperbaiki data permission yang sudah terlanjur
 * di-seed dengan schema lama (module/sort_order kosong, dan code lama).
 *
 * Cara pakai:
 *   php spark db:seed PermissionBackfillSeeder
 */
class PermissionBackfillSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Mapping module dari prefix code
        |--------------------------------------------------------------------------
        */

        $moduleLabel = [
            'dashboard'          => 'Dashboard',
            'department'         => 'Department',
            'study_program'      => 'Study Program',
            'class'              => 'Class',
            'applicant_type'     => 'Applicant Type',
            'service_unit'       => 'Service Unit',
            'service_category'   => 'Service Category',
            'service'            => 'Service',
            'service_requirement' => 'Service Requirement',
            'user'               => 'User',
            'role'               => 'Role',
            'permission'         => 'Permission',
            'request'            => 'Request',
            'submission'         => 'Request',
            'notification'       => 'Notification',
            'activity_log'       => 'Activity Log',
        ];

        /*
        |--------------------------------------------------------------------------
        | Ambil semua permission existing
        |--------------------------------------------------------------------------
        */

        $existing = $this->db->table('permissions')->get()->getResultArray();

        $updates = [];

        foreach ($existing as $perm) {

            // Ambil prefix module dari code (misal department.view -> department)
            $dotPos = strpos($perm['code'], '.');

            $moduleKey = $dotPos !== false
                ? substr($perm['code'], 0, $dotPos)
                : $perm['code'];

            // Normalisasi kode lama (submission -> request)
            $newCode = $perm['code'];

            if ($moduleKey === 'submission') {

                $action = substr($perm['code'], $dotPos + 1);

                $newCode = 'request.' . $action;
            }

            $module = $moduleLabel[$moduleKey] ?? ucwords(str_replace('_', ' ', $moduleKey));

            $updates[] = [
                'id'         => $perm['id'],
                'code'       => $newCode,
                'module'     => $module,
                'sort_order' => (int) ($perm['sort_order'] ?? 0) ?: 1,
                'is_active'  => 1,
                'updated_at' => $now,
            ];
        }

        if (! empty($updates)) {

            $this->db->table('permissions')->updateBatch($updates, 'id');
        }

        /*
        |--------------------------------------------------------------------------
        | Re-seed role_permissions berdasarkan mapping terbaru
        |--------------------------------------------------------------------------
        */

        // Kosongkan role_permissions
        $this->db->table('role_permissions')->truncate();

        // Ambil role
        $roles = [];

        foreach ($this->db->table('roles')->get()->getResultArray() as $role) {
            $roles[$role['code']] = $role['id'];
        }

        // Ambil permission
        $permissions = [];

        foreach ($this->db->table('permissions')->get()->getResultArray() as $permission) {
            $permissions[$permission['code']] = $permission['id'];
        }

        $rolePermissions = [

            'SUPER_ADMIN' => ['*'],

            'ADMIN_ULT' => [
                'dashboard.view',
                'user.view',
                'applicant_type.view',
                'applicant_type.create',
                'applicant_type.update',
                'department.view',
                'department.create',
                'department.update',
                'study_program.view',
                'study_program.create',
                'study_program.update',
                'class.view',
                'class.create',
                'class.update',
                'service_unit.view',
                'service_unit.create',
                'service_unit.update',
                'service_category.view',
                'service_category.create',
                'service_category.update',
                'service.view',
                'service.create',
                'service.update',
                'service_requirement.view',
                'service_requirement.create',
                'service_requirement.update',
                'request.view',
                'request.verify',
                'request.approve',
                'request.reject',
                'notification.view',
                'activity_log.view',
            ],

            'PETUGAS_AKADEMIK' => [
                'dashboard.view',
                'request.view',
                'request.verify',
                'notification.view',
            ],

            'PETUGAS_KEUANGAN' => [
                'dashboard.view',
                'request.view',
                'request.verify',
                'notification.view',
            ],

            'PETUGAS_UMUM' => [
                'dashboard.view',
                'request.view',
                'request.verify',
                'notification.view',
            ],

            'PEMOHON' => [
                'dashboard.view',
                'request.view',
                'request.create',
                'request.cancel',
                'notification.view',
            ],

        ];

        $insertData = [];

        foreach ($rolePermissions as $roleCode => $permissionCodes) {

            if (! isset($roles[$roleCode])) {
                continue;
            }

            if ($permissionCodes === ['*']) {

                foreach ($permissions as $permissionId) {

                    $insertData[] = [
                        'role_id'       => $roles[$roleCode],
                        'permission_id' => $permissionId,
                        'created_at'    => $now,
                        'updated_at'    => $now,
                    ];
                }

                continue;
            }

            foreach ($permissionCodes as $permissionCode) {

                if (! isset($permissions[$permissionCode])) {
                    continue;
                }

                $insertData[] = [
                    'role_id'       => $roles[$roleCode],
                    'permission_id' => $permissions[$permissionCode],
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
            }
        }

        if (! empty($insertData)) {

            $this->db->table('role_permissions')->insertBatch($insertData);
        }

        echo "Permission backfill selesai." . PHP_EOL;
    }
}
