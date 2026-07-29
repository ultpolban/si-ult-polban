<?php

namespace App\Controllers;

class TendikController extends BaseController
{
    /**
     * ==========================================
     * DASHBOARD TENDIK
     * ==========================================
     */
    public function dashboard()
    {
        // Ambil data user dari session
        $user = session()->get('user') ?? [];

        // Ambil tiket Tendik dari session
        $tickets = session()->get('tendik_tickets') ?? [];

        // Hitung statistik tiket
        $statistik = [
            'total' => count($tickets),
            'diproses' => 0,
            'revisi' => 0,
            'selesai' => 0,
        ];

        foreach ($tickets as $ticket) {

            $status = strtolower(
                $ticket['status'] ?? ''
            );

            if (
                $status === 'in progress' ||
                $status === 'diproses' ||
                $status === 'processing'
            ) {
                $statistik['diproses']++;
            }

            if (
                $status === 'revision' ||
                $status === 'revisi' ||
                $status === 'perlu revisi'
            ) {
                $statistik['revisi']++;
            }

            if (
                $status === 'completed' ||
                $status === 'selesai'
            ) {
                $statistik['selesai']++;
            }
        }

        // Data yang dikirim ke view
        $data = [
            'title' => 'Dashboard Tendik',

            'user' => $user,

            'tickets' => $tickets,

            'statistik' => $statistik,
        ];

        return view(
            'tendik/dashboard',
            $data
        );
    }

public function profile()
{
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

public function editProfile()
{
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

public function updateProfile()
{
    $user = session()->get('user') ?? [];


    // Ambil data dari form

    $nama = $this->request->getPost('nama');

    $nip = $this->request->getPost('nip');

    $email = $this->request->getPost('email');

    $unitKerja =
        $this->request->getPost('unit_kerja');

    $jabatan =
        $this->request->getPost('jabatan');

    $noHp =
        $this->request->getPost('no_hp');


    // Validasi sederhana

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


    // Update session user

    $user['nama'] =
        $nama;

    $user['nip'] =
        $nip;

    $user['email'] =
        $email;

    $user['unit_kerja'] =
        $unitKerja;

    $user['jabatan'] =
        $jabatan;

    $user['no_hp'] =
        $noHp;


    // Simpan kembali ke session

    session()->set(
        'user',
        $user
    );


    // Kembali ke profil

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