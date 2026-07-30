<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DosenProfileController extends BaseController
{
    // =====================================
    // PROFILE DOSEN
    // =====================================
    public function index()
    {
        $user = session()->get('user') ?? [];

        // Kalau session profile belum ada, buat default
        if (!session()->has('dosen_profile')) {

            $profile = [

                // =========================
                // DATA PRIBADI
                // =========================

                'nama'            => $user['nama'] ?? 'Dr. Andi Saputra',

                'nip'             => $user['nip'] ?? '198812312020011001',

                'nidn'            => $user['nidn'] ?? '0011223344',

                'nik'             => $user['nik'] ?? '',

                'email'           => $user['email'] ?? 'andi@polban.ac.id',

                'no_hp'           => $user['no_hp'] ?? '',

                'jenis_kelamin'   => $user['jenis_kelamin'] ?? 'Laki-laki',

                'alamat'          => $user['alamat'] ?? '',

                'foto'            => $user['foto'] ?? null,

                // =========================
                // AKADEMIK
                // =========================

                'prodi'           => $user['prodi'] ?? 'D3 Teknik Informatika',

                'jurusan'         => $user['jurusan'] ?? 'Teknik Komputer dan Informatika',

                'fakultas'        => $user['fakultas'] ?? 'Sekolah Vokasi',

                'jabatan'         => $user['jabatan'] ?? 'Dosen',

                'status'          => $user['status'] ?? 'Aktif'

            ];

            session()->set('dosen_profile', $profile);

        }

        return view('dosen/profile/index', [

            'title'   => 'Profil Dosen',

            'profile' => session()->get('dosen_profile')

        ]);
    }

    // =====================================
    // FORM EDIT
    // =====================================

    public function edit()
    {
        return view('dosen/profile/edit', [

            'title'   => 'Edit Profil Dosen',

            'profile' => session()->get('dosen_profile')

        ]);
    }

    // =====================================
    // UPDATE PROFILE
    // =====================================

    public function update()
    {
        $profile = [

            'nama'            => $this->request->getPost('nama'),

            'nip'             => $this->request->getPost('nip'),

            'nidn'            => $this->request->getPost('nidn'),

            'nik'             => $this->request->getPost('nik'),

            'email'           => $this->request->getPost('email'),

            'no_hp'           => $this->request->getPost('no_hp'),

            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),

            'alamat'          => $this->request->getPost('alamat'),

            'prodi'           => $this->request->getPost('prodi'),

            'jurusan'         => $this->request->getPost('jurusan'),

            'fakultas'        => $this->request->getPost('fakultas'),

            'jabatan'         => $this->request->getPost('jabatan'),

            'status'          => $this->request->getPost('status'),

            'foto'            => session()->get('dosen_profile')['foto'] ?? null

        ];

        // ==========================
        // Upload Foto
        // ==========================

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (!is_dir(FCPATH . 'uploads/profile')) {

                mkdir(FCPATH . 'uploads/profile', 0777, true);

            }

            $namaFoto = $file->getRandomName();

            $file->move(

                FCPATH . 'uploads/profile',

                $namaFoto

            );

            $profile['foto'] = $namaFoto;

        }

        session()->set('dosen_profile', $profile);

        // Update session user supaya navbar ikut berubah

        $user = session()->get('user') ?? [];

        $user = array_merge($user, $profile);

        session()->set('user', $user);

        return redirect()

            ->to(base_url('dosen/profile'))

            ->with(

                'success',

                'Profil berhasil diperbarui.'

            );
    }
}