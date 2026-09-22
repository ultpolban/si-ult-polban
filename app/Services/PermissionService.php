<?php

namespace App\Services;

use App\Models\MasterPermissionModel;
use App\Models\RolePermissionModel;

class PermissionService
{
    protected MasterPermissionModel $model;
    protected RolePermissionModel $rolePermissionModel;

    public function __construct()
    {
        $this->model = new MasterPermissionModel();
        $this->rolePermissionModel = new RolePermissionModel();
    }

    /**
     * Cek apakah user (dari rolenya) punya permission
     */
    public function hasPermission(string $permission): bool
    {
        $roleId = session()->get('role_id');

        if (!$roleId) {
            return false;
        }

        // Super Admin & Admin ULT memiliki seluruh permission
        $role = db_connect()
            ->table('roles')
            ->select('code')
            ->where('id', $roleId)
            ->get()
            ->getRowArray();

        $roleCode = strtoupper((string) ($role['code'] ?? ''));

        if ($roleCode === 'SUPER_ADMIN' || $roleCode === 'ADMIN_ULT') {
            return true;
        }

        // Role biasa: cek permission melalui role_permissions
        return $this->rolePermissionModel
            ->join(
                'permissions',
                'permissions.id = role_permissions.permission_id'
            )
            ->where('role_permissions.role_id', $roleId)
            ->where('permissions.code', $permission)
            ->countAllResults() > 0;
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model;

        if ($keyword !== '') {

            $builder = $builder->search($keyword);
        }

        $builder
            ->orderBy('module', 'ASC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC');

        return [

            'permissions' => $builder->paginate(15),

            'pager' => $this->model->pager,

        ];
    }

    /**
     * Active
     */
    public function getActive(): array
    {
        return $this->model->getActive();
    }

    /**
     * Dropdown
     */
    public function getDropdown(): array
    {
        return $this->model->dropdown();
    }

    /**
     * Detail
     */
    public function getById(int $id): ?array
    {
        return $this->model->find($id);
    }

    /**
     * Create
     */
    public function create(array $data): bool
    {
        return (bool) $this->model->insert($data);
    }

    /**
     * Update
     */
    public function update(
        int $id,
        array $data
    ): bool {

        return $this->model->update($id, $data);
    }

    /**
     * Delete
     */
    public function delete(int $id): bool
    {
        return (bool) $this->model->delete($id);
    }

    /**
     * Restore
     */
    public function restore(int $id): bool
    {
        return (bool) $this->model
            ->onlyDeleted()
            ->update($id, [
                'deleted_at' => null
            ]);
    }

    /**
     * Change Status
     */
    public function changeStatus(
        int $id,
        bool $status
    ): bool {

        return $this->model->update($id, [

            'is_active' => $status

        ]);
    }

    /**
     * Group by Module
     */
    public function groupByModule(): array
    {
        $items = $this->model
            ->orderBy('module')
            ->orderBy('sort_order')
            ->findAll();

        $result = [];

        foreach ($items as $item) {

            $result[$item['module']][] = $item;
        }

        return $result;
    }
}
