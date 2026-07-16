<?php

namespace App\Controllers;

class UnitController extends BaseController
{
    public function dashboard()
    {
        return view('unit/dashboard');
    }

    public function tiket()
    {
        return view('unit/tiket');
    }

    public function detail($id)
    {
        return view('unit/detail');
    }

    public function updateStatus($id)
    {
        return view('unit/update_status');
    }

    public function laporan()
    {
        return view('unit/laporan');
    }
}