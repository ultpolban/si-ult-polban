<?php

namespace App\Models;

class RolePermissionModel extends BaseModel
{
    protected $table = 'role_permissions';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    protected $allowedFields = [

        'role_id',

        'permission_id',

    ];

    protected $validationRules = [

        'role_id' => 'required|integer',

        'permission_id' => 'required|integer',

    ];

    /**
     * Semua permission milik role
     */
    public function getPermissions(int $roleId): array
    {
        return $this

            ->where('role_id', $roleId)

            ->findAll();
    }

    /**
     * Hapus semua permission role
     */
    public function removeRole(int $roleId): bool
    {
        return (bool)$this

            ->where('role_id', $roleId)

            ->delete();
    }
}
