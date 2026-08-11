<?php

namespace App\Libraries;

use Config\Database;

class PermissionService
{
    public function getRolePermissions(int $roleId): array
    {
        $db = Database::connect();

        $rows = $db->table('role_permissions')
            ->select('permissions.code')
            ->join(
                'permissions',
                'permissions.id = role_permissions.permission_id'
            )
            ->where('role_permissions.role_id', $roleId)
            ->get()
            ->getResultArray();

        return array_column($rows, 'code');
    }
}
