<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OrangTuaProfileController extends BaseController
{
    public function index()
    {
        return view('orangtua/profile/index');
    }

    public function edit()
    {
        return view('orangtua/profile/edit');
    }

    public function update()
    {
        return redirect()->to('orangtua/profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}