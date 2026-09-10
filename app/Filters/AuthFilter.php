<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $isLoggedIn = session()->get('isLoggedIn');
        $loggedIn   = session()->get('logged_in');

        // Anggap user sudah login jika salah satu session login bernilai true.
        if (!$isLoggedIn && !$loggedIn) {
            return redirect()->to('/login');
        }

        // Sinkronkan kedua session agar seluruh aplikasi konsisten.
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
