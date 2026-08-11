<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\PermissionService;
use App\Services\RolePermissionService;
use App\Services\RoleService;
use CodeIgniter\Exceptions\PageNotFoundException;

class RolePermissionController extends AdminController
{
    /**
     * Service
     */
    protected RoleService $roleService;

    protected PermissionService $permissionService;

    protected RolePermissionService $rolePermissionService;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->roleService           = service('roleService');
        $this->permissionService     = service('permissionService');
        $this->rolePermissionService = service('rolePermissionService');
    }

    /**
     * Halaman Assignment Permission
     */
    public function index(int $roleId)
    {
        $role = $this->roleService->getById($roleId);

        if (! $role) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'management/role-permissions/index',
            $this->viewData([

                'title'      => 'Role Permission',

                'pageTitle'  => 'Role Permission',

                'breadcrumb' => [

                    'Master',

                    'Role',

                    'Permission',

                ],

                'role'       => $role,

                'modules'    => $this->permissionService
                    ->groupByModule(),

                'selected'   => $this->rolePermissionService
                    ->getRolePermissions($roleId),

            ])
        );
    }

    /**
     * Simpan Permission Role
     */
    public function save(int $roleId)
    {
        $role = $this->roleService->getById($roleId);

        if (! $role) {
            throw PageNotFoundException::forPageNotFound();
        }

        $permissions = $this->request->getPost('permissions');

        if (! is_array($permissions)) {
            $permissions = [];
        }

        $this->rolePermissionService->save(
            $roleId,
            $permissions
        );

        $this->logActivity(

            'UPDATE ROLE PERMISSION',

            'Mengubah hak akses Role : ' . $role['name']

        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Hak akses role berhasil diperbarui.'
            );
    }

    /**
     * Semua Permission Aktif
     */
    public function selectAll(int $roleId)
    {
        $role = $this->roleService->getById($roleId);

        if (! $role) {
            throw PageNotFoundException::forPageNotFound();
        }

        $permissions = array_column(

            $this->permissionService
                ->getActive(),

            'id'

        );

        $this->rolePermissionService->save(
            $roleId,
            $permissions
        );

        $this->logActivity(

            'SELECT ALL PERMISSION',

            'Semua permission diberikan kepada role ' . $role['name']

        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Semua permission berhasil dipilih.'
            );
    }

    /**
     * Kosongkan Permission
     */
    public function clear(int $roleId)
    {
        $role = $this->roleService->getById($roleId);

        if (! $role) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->rolePermissionService->save(
            $roleId,
            []
        );

        $this->logActivity(

            'CLEAR ROLE PERMISSION',

            'Menghapus seluruh permission role ' . $role['name']

        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Semua permission berhasil dihapus.'
            );
    }
}
