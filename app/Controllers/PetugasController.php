<?php

namespace App\Controllers;

class PetugasController extends BaseController
{
    public function dashboard()
    {
        return view('petugas/dashboard');
    }

    public function tiket()
    {
        return view('petugas/tiket');
    }

    public function detail($id)
    {
        return view('petugas/detail');
    }

    public function verifikasi($id)
    {
        return view('petugas/verifikasi');
    }

    public function disposisi($id)
    {
        return view('petugas/disposisi');
    }

    public function updateStatus($id)
    {
        return view('petugas/update_status');
    }
}