<?php

namespace App\Services;

use App\Models\RolePermissionModel;

class RolePermissionService
{
    protected RolePermissionModel $model;

    public function __construct()
    {
        $this->model = new RolePermissionModel();
    }

    /**
     * Permission ID milik Role
     */
    public function getRolePermissions(int $roleId): array
    {
        return array_column(

            $this->model->getPermissions($roleId),

            'permission_id'

        );
    }

    /**
     * Simpan Permission
     */
    public function save(
        int $roleId,
        array $permissions
    ): bool {

        $this->model->removeRole($roleId);

        foreach ($permissions as $permission) {

            $this->model->insert([

                'role_id' => $roleId,

                'permission_id' => $permission

            ]);
        }

        return true;
    }
}
