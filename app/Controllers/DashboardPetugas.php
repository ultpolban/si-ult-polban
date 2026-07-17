<?php

namespace App\Controllers;

class DashboardPetugas extends BaseController
{
    public function index()
    {
        return view('petugas/dashboard');
    }
}