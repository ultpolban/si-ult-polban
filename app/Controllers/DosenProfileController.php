<?php

namespace App\Controllers;

class DosenProfileController extends BaseController
{
    /**
     * Menampilkan Profil Dosen
     */
    public function index()
    {
        // Ambil data user dari session
        $user = session()->get('user');

        // Jika session user belum tersedia
        if (empty($user)) {
            $user = [];
        }

        return view('dosen/profile/index', [
            'title' => 'Profil Dosen',
            'user'  => $user
        ]);
    }


    /**
     * Menampilkan halaman Edit Profil Dosen
     */
    public function edit()
    {
        // Ambil data user dari session
        $user = session()->get('user');

        if (empty($user)) {
            $user = [];
        }

        return view('dosen/profile/edit', [
            'title' => 'Edit Profil Dosen',
            'user'  => $user
        ]);
    }


    /**
     * Menyimpan perubahan profil
     *
     * Untuk sekarang masih frontend.
     * Proses penyimpanan database akan dikerjakan
     * setelah backend siap.
     */
    public function update()
    {
        return redirect()
            ->to(base_url('dosen/profile'))
            ->with(
                'success',
                'Perubahan profil akan diproses setelah backend profil diaktifkan.'
            );
    }
}