<?php

namespace App\Controllers;

class DosenController extends BaseController
{
    public function dashboard()
    {
        return view('dosen/dashboard', [
            'title' => 'Dashboard Dosen'
        ]);
    }
}