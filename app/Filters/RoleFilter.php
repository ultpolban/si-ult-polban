<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if ($arguments === null) {
            return;
        }

        $roleCode = $session->get('role_code');

        // Fallback: ambil dari database bila role_code belum ada di session
        if (empty($roleCode)) {
            $roleId = (int) $session->get('role_id');

            if ($roleId > 0) {
                $role = db_connect()
                    ->table('roles')
                    ->select('code')
                    ->where('id', $roleId)
                    ->get()
                    ->getRowArray();

                $roleCode = $role['code'] ?? '';
            }
        }

        $allowedRoles = array_map(
            static fn ($item) => strtoupper(trim((string) $item)),
            (array) $arguments
        );

        if (!in_array(strtoupper((string) $roleCode), $allowedRoles, true)) {
            return redirect()->to('/unauthorized');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {}
}
