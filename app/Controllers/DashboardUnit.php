<?php

namespace App\Controllers;

class DashboardUnit extends BaseController
{
    public function index()
    {
        return view('unit/dashboard');
    }
}