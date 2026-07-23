<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MahasiswaProfileController extends BaseController
{
    /**
     * Halaman Profil Mahasiswa
     * URL: /mahasiswa/profile
     */
    public function index()
    {
        $data = [

            'title' => 'Profil Mahasiswa',

            'user' => [

                // Data Identitas
                'nama' => 'Alvin',

                'nim' => '221511000',

                'nik' => '3273010101040001',

                'tempat_lahir' => 'Bandung',

                'tanggal_lahir' => '10 Januari 2004',

                'jenis_kelamin' => 'Laki-laki',


                // Data Akademik
                'prodi' => 'D4 Teknik Informatika',

                'fakultas' => 'Teknik Komputer dan Informatika',

                'angkatan' => '2022',

                'status' => 'Aktif',

                'dosen_wali' => 'Dr. Nama Dosen, S.T., M.Kom.',


                // Data Kontak
                'telepon' => '081234567890',

                'email' => 'alvin@polban.ac.id',

                'alamat' => 'Bandung, Jawa Barat'

            ]

        ];


        return view(
            'mahasiswa/profile/index',
            $data
        );
    }


    /**
     * Halaman Edit Profil
     * URL: /mahasiswa/profile/edit
     */
    public function edit()
    {
        $data = [

            'title' => 'Edit Profil Mahasiswa',

            'user' => [

                'nama' => 'Alvin',

                'nim' => '221511000',

                'nik' => '3273010101040001',

                'tempat_lahir' => 'Bandung',

                'tanggal_lahir' => '10 Januari 2004',

                'jenis_kelamin' => 'Laki-laki',

                'prodi' => 'D4 Teknik Informatika',

                'fakultas' => 'Teknik Komputer dan Informatika',

                'angkatan' => '2022',

                'status' => 'Aktif',

                'dosen_wali' => 'Dr. Nama Dosen, S.T., M.Kom.',

                'telepon' => '081234567890',

                'email' => 'alvin@polban.ac.id',

                'alamat' => 'Bandung, Jawa Barat'

            ]

        ];


        return view(
            'mahasiswa/profile/edit',
            $data
        );
    }


    /**
     * Proses Update Profil
     * URL: /mahasiswa/profile/update
     */
    public function update()
    {
        // Untuk sementara belum menyimpan ke database.
        // Nanti akan dihubungkan ke database mahasiswa.

        return redirect()
            ->to('/mahasiswa/profile')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }
}