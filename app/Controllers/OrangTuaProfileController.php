<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OrangTuaProfileController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Profil Saya',

            'user' => [
                'nama'    => 'Budi Santoso',
                'nik'     => '3273010101040001',
                'email'   => 'budisantoso@gmail.com',
                'telepon' => '081234567890',
                'alamat'  => 'Jl. Babakan Radio'
            ]
        ];

        return view('orangtua/profile/index', $data);
    }


public function edit()
{
    $data = [
        'title' => 'Edit Profil',

        'user' => [
            'nama'    => 'Budi Santoso',
            'nik'     => '3273010101040001',
            'email'   => 'budisantoso@gmail.com',
            'telepon' => '081234567890',
            'alamat'  => 'Jl. Babakan Radio'
        ]
    ];

    return view('orangtua/profile/edit', $data);
}


    public function update()
    {
        session()->setFlashdata(
            'success',
            'Profil berhasil diperbarui.'
        );

        return redirect()->to(
            base_url('orangtua/profile')
        );
    }
}