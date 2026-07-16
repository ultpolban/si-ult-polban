<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function petugas()
    {
        return redirect()->to('/petugas');
    }

    public function unit()
    {
        return redirect()->to('/unit');
    }

    public function admin()
    {
        return redirect()->to('/admin');
    }

    public function pimpinan()
    {
        return redirect()->to('/pimpinan');
    }
}