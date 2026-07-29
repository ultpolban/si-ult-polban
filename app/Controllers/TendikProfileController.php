<?php

namespace App\Controllers;

class TendikProfileController extends BaseController
{
    /**
     * ==========================================
     * HALAMAN PROFIL TENDIK
     * ==========================================
     */
    public function index()
    {
        // Ambil data user dari session
        $user = session()->get('user') ?? [];

        $data = [
            'title' => 'Profil Tendik',
            'user'  => $user,
        ];

        return view(
            'tendik/profile/index',
            $data
        );
    }


    /**
     * ==========================================
     * HALAMAN EDIT PROFIL TENDIK
     * ==========================================
     */
    public function edit()
    {
        // Ambil data user dari session
        $user = session()->get('user') ?? [];

        $data = [
            'title' => 'Edit Profil Tendik',
            'user'  => $user,
        ];

        return view(
            'tendik/profile/edit',
            $data
        );
    }


    /**
     * ==========================================
     * UPDATE PROFIL TENDIK
     * ==========================================
     */
    public function update()
    {
        // Ambil data user dari session
        $user = session()->get('user') ?? [];


        // ==========================================
        // AMBIL DATA DARI FORM
        // ==========================================

        $nama = $this->request->getPost('nama');
        $nip  = $this->request->getPost('nip');
        $email = $this->request->getPost('email');
        $no_hp = $this->request->getPost('no_hp');


        // ==========================================
        // VALIDASI
        // ==========================================

        if (
            empty($nama) ||
            empty($nip) ||
            empty($email)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nama, NIP, dan Email wajib diisi.'
                );
        }


        // ==========================================
        // UPDATE DATA SESSION
        // ==========================================

        $user['nama'] = $nama;

        $user['nip'] = $nip;

        $user['email'] = $email;

        $user['no_hp'] = $no_hp;


        // ==========================================
        // SIMPAN KEMBALI KE SESSION
        // ==========================================

        session()->set(
            'user',
            $user
        );


        // ==========================================
        // REDIRECT KE PROFIL
        // ==========================================

        return redirect()
            ->to(
                base_url(
                    'tendik/profile'
                )
            )
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }
}