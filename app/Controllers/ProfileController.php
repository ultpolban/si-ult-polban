<?php

namespace App\Controllers;

class ProfileController extends BaseController
{
    public function index()
    {

        $data = [

            'title' => 'Profil Saya',

            'user' => [

                'nama' => 'Alvin',

                'nim' => '221511000',

                'email' => 'alvin@student.polban.ac.id',

                'telepon' => '081234567890',

                'prodi' => 'D3 Teknik Informatika',

                'jurusan' => 'Teknik Komputer dan Informatika',

                'angkatan' => '2022',

                'foto' => 'avatar.png'

            ]

        ];

        return view('profile/index', $data);
    }

    public function edit()
    {

        $data = [

            'title' => 'Edit Profil',

            'user' => [

                'nama' => 'Alvin',

                'nim' => '221511000',

                'email' => 'alvin@student.polban.ac.id',

                'telepon' => '081234567890',

                'prodi' => 'D3 Teknik Informatika',

                'jurusan' => 'Teknik Komputer dan Informatika',

                'angkatan' => '2022',

                'foto' => 'avatar.png'
            ]

        ];

        return view('profile/edit', $data);
    }

    public function update()
    {

        session()->setFlashdata('success', 'Profil berhasil diperbarui.');

        return redirect()->to('/profile');
    }
}
