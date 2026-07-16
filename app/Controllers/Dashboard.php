<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
   public function index()
{
    return view('petugas/dashboard');
}

    public function layanan()
    {
        return view('dashboard/layanan');
    }

    public function tiket()
    {
        return view('dashboard/tiket');
    }

    public function detail()
    {
        return view('dashboard/detail');
    }

    public function profile()
    {
        return view('dashboard/profile');
    }
}