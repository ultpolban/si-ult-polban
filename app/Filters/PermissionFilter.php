<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * PermissionFilter
 *
 * Pengecekan hak akses berbasis permission pada level route.
 *
 * Pemakaian:
 *   $routes->get('users', 'UserController::index', ['filter' => 'permission:user.view']);
 *
 * Mendukung beberapa permission (semantik OR) dengan pemisah "|":
 *   ['filter' => 'permission:user.view|user.create']
 *
 * SUPER_ADMIN dan ADMIN_ULT otomatis lolos dari semua pemeriksaan.
 */
class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $roleId = (int) $session->get('role_id');

        if ($roleId <= 0) {
            return redirect()->to('/unauthorized');
        }

        // SUPER_ADMIN & ADMIN_ULT memiliki seluruh hak akses
        $role = db_connect()
            ->table('roles')
            ->select('code')
            ->where('id', $roleId)
            ->get()
            ->getRowArray();

        $roleCode = strtoupper((string) ($role['code'] ?? ''));

        if ($roleCode === 'SUPER_ADMIN' || $roleCode === 'ADMIN_ULT') {
            return null;
        }

        if ($arguments === null || $arguments === []) {
            return null;
        }

        $required = [];

        foreach ((array) $arguments as $arg) {
            foreach (explode('|', (string) $arg) as $perm) {
                $perm = trim($perm);

                if ($perm !== '') {
                    $required[] = $perm;
                }
            }
        }

        $granted = db_connect()
            ->table('role_permissions')
            ->join('permissions', 'permissions.id = role_permissions.permission_id')
            ->where('role_permissions.role_id', $roleId)
            ->whereIn('permissions.code', $required)
            ->countAllResults();

        if ($granted === 0) {
            return redirect()->to('/unauthorized');
        }

        return null;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak digunakan
    }
}