<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $isLoggedIn = session()->get('isLoggedIn');
        $loggedIn   = session()->get('logged_in');

        if (!$isLoggedIn && !$loggedIn) {
            return redirect()->to('/login');
        }

        $roleId = session()->get('role_id');

        // Petugas ULT / role yang diizinkan.
        if ((int) $roleId !== 1) {
            return redirect()->to('/unauthorized');
        }

        session()->set([
            'isLoggedIn' => true,
            'logged_in'  => true,
        ]);
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak ada tindakan setelah request.
    }
}
