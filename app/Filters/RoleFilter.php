<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Belum login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Role user yang login
        $roleId = session()->get('role_id');

        // Tidak ada role yang ditentukan
        if (empty($arguments)) {
            return;
        }

        // Cek apakah role diizinkan
        $allowedRoles = array_map('intval', $arguments);

        if (!in_array((int) $roleId, $allowedRoles)) {

            return redirect()
                ->to('/dashboard')
                ->with('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
