<?php

namespace App\Controllers;

class UnitController extends BaseController
{
    public function dashboard()
    {
        return view('unit/dashboard');
    }

    public function detail($id)
    {
        return view('unit/detail');
    }

    public function updateStatus($id)
    {
        return view('unit/update_status');
    }
}