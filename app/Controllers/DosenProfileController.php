<?php

namespace App\Controllers;

class DosenProfileController extends BaseController
{
    // =====================================================
    // PROFILE DOSEN
    // =====================================================

    public function index()
    {
        $user = session()->get('user') ?? [];

        $profile = session()->get('dosen_profile');

        if (!$profile) {

            $profile = [

                // ===========================
                // DATA PRIBADI
                // ===========================

                'nama' => $user['nama'] ?? 'Dr. Andi Saputra',

                'nip' => $user['nip'] ?? '198812312020011001',

                'nidn' => $user['nidn'] ?? '0011223344',

                'nik' => $user['nik'] ?? '',

                'email' => $user['email'] ?? 'andi@polban.ac.id',

                'no_hp' => $user['no_hp'] ?? '',

                'jenis_kelamin' => $user['jenis_kelamin'] ?? 'Laki-laki',

                'alamat' => $user['alamat'] ?? '',

                'foto' => $user['foto'] ?? null,

                // ===========================
                // AKADEMIK
                // ===========================

                'prodi' => $user['prodi'] ?? 'D3 Teknik Informatika',

                'jurusan' => $user['jurusan'] ?? 'Teknik Komputer dan Informatika',

                'fakultas' => $user['fakultas'] ?? 'Sekolah Vokasi',

                'jabatan' => $user['jabatan'] ?? 'Dosen Tetap',

                'status' => $user['status'] ?? 'Aktif'

            ];

            session()->set(
                'dosen_profile',
                $profile
            );
        }

        return view(
            'dosen/profile/index',
            [

                'title' => 'Profil Dosen',

                'profile' => $profile

            ]
        );
    }

    // =====================================================
    // EDIT PROFILE
    // =====================================================

    public function edit()
    {
        $profile = session()->get('dosen_profile');

        if (!$profile) {

            return redirect()->to(
                base_url('dosen/profile')
            );

        }

        return view(
            'dosen/profile/edit',
            [

                'title' => 'Edit Profil Dosen',

                'profile' => $profile

            ]
        );
    }        
    // =====================================================
    // UPDATE PROFILE
    // =====================================================

    public function update()
    {
        $profile = session()->get('dosen_profile') ?? [];

        if (empty($profile)) {

            return redirect()
                ->to(base_url('dosen/profile'))
                ->with(
                    'error',
                    'Data profil tidak ditemukan.'
                );
        }

        // =====================================
        // DATA PRIBADI
        // =====================================

        $profile['nama']            = trim($this->request->getPost('nama'));

        $profile['nip']             = trim($this->request->getPost('nip'));

        $profile['nidn']            = trim($this->request->getPost('nidn'));

        $profile['nik']             = trim($this->request->getPost('nik'));

        $profile['email']           = trim($this->request->getPost('email'));

        $profile['no_hp']           = trim($this->request->getPost('no_hp'));

        $profile['jenis_kelamin']   = trim($this->request->getPost('jenis_kelamin'));

        $profile['alamat']          = trim($this->request->getPost('alamat'));


        // =====================================
        // AKADEMIK
        // =====================================

        $profile['prodi']           = trim($this->request->getPost('prodi'));

        $profile['jurusan']         = trim($this->request->getPost('jurusan'));

        $profile['fakultas']        = trim($this->request->getPost('fakultas'));

        $profile['jabatan']         = trim($this->request->getPost('jabatan'));

        $profile['status']          = trim($this->request->getPost('status'));


        // =====================================
        // VALIDASI
        // =====================================

        if (
            empty($profile['nama']) ||
            empty($profile['nip']) ||
            empty($profile['email'])
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nama, NIP dan Email wajib diisi.'
                );
        }


        // =====================================
        // UPLOAD FOTO
        // =====================================

        $foto = $this->request->getFile('foto');

        if (
            $foto &&
            $foto->isValid() &&
            !$foto->hasMoved()
        ) {

            $allowed = [

                'jpg',
                'jpeg',
                'png',
                'webp'

            ];

            $ext = strtolower(
                $foto->getExtension()
            );

            if (!in_array($ext, $allowed)) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Foto harus JPG, JPEG, PNG atau WEBP.'
                    );
            }

            if ($foto->getSize() > 2 * 1024 * 1024) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Ukuran foto maksimal 2 MB.'
                    );
            }

            $folder = FCPATH . 'uploads/profile';

            if (!is_dir($folder)) {

                mkdir(
                    $folder,
                    0777,
                    true
                );
            }

            // hapus foto lama
            if (!empty($profile['foto'])) {

                $old = $folder . '/' . $profile['foto'];

                if (file_exists($old)) {

                    unlink($old);

                }
            }

            $namaFoto = $foto->getRandomName();

            $foto->move(
                $folder,
                $namaFoto
            );

            $profile['foto'] = $namaFoto;
        }


        // =====================================
        // SIMPAN SESSION
        // =====================================

        session()->set(
            'dosen_profile',
            $profile
        );


        // =====================================
        // UPDATE USER SESSION
        // =====================================

        $user = session()->get('user') ?? [];

        $user = array_merge(
            $user,
            $profile
        );

        session()->set(
            'user',
            $user
        );


        return redirect()
            ->to(
                base_url('dosen/profile')
            )
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    }
    