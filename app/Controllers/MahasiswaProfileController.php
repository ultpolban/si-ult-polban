<?php

namespace App\Controllers;

class MahasiswaProfileController extends BaseController
{
    // =====================================================
    // TAMPILKAN PROFILE MAHASISWA
    // =====================================================
    public function index()
    {
        // Ambil data user dari session
        $user = session()->get('user') ?? [];

        // Ambil data profile mahasiswa
        $profile = session()->get('mahasiswa_profile') ?? [];


        // =====================================================
        // JIKA PROFILE BELUM ADA
        // GUNAKAN DATA DEFAULT SEMENTARA
        // =====================================================

        if (empty($profile)) {

            $profile = [

                // ==============================
                // DATA PRIBADI
                // ==============================

                'nama' => $user['nama']
                    ?? 'Muhamad Rafi Putra Zakaria',

                'nim' => $user['nim']
                    ?? '45678',

                'nik' => $user['nik']
                    ?? '',

                'email' => $user['email']
                    ?? 'mochrafiputrazakaria@gmail.com',

                'no_hp' => $user['no_hp']
                    ?? '083123456788',

                'jenis_kelamin' => $user['jenis_kelamin']
                    ?? 'Laki-laki',

                'alamat' => $user['alamat']
                    ?? 'Jl Babakan Radio',

                'foto' => $user['foto']
                    ?? null,


                // ==============================
                // INFORMASI AKADEMIK
                // ==============================

                'prodi' => $user['prodi']
                    ?? 'D3 Teknik Informatika',

                'fakultas' => $user['fakultas']
                    ?? 'Sekolah Vokasi',

                'jurusan' => $user['jurusan']
                    ?? 'Teknik Komputer dan Informatika',

                'semester' => $user['semester']
                    ?? 4,

                'angkatan' => $user['angkatan']
                    ?? 2022,

                'status' => $user['status']
                    ?? 'Aktif'
            ];


            // Simpan data awal ke session
            session()->set(
                'mahasiswa_profile',
                $profile
            );
        }


        // =====================================================
        // DATA YANG DIKIRIM KE VIEW
        // =====================================================

        $data = [

            'title' => 'Profil Mahasiswa',

            'profile' => $profile

        ];


        return view(
            'mahasiswa/profile/index',
            $data
        );
    }


    // =====================================================
    // HALAMAN EDIT PROFILE
    // =====================================================
    public function edit()
    {
        // Ambil profile dari session
        $profile =
            session()->get(
                'mahasiswa_profile'
            )
            ?? [];


        // Jika profile belum ada
        if (empty($profile)) {

            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/profile'
                    )
                )
                ->with(
                    'error',
                    'Data profile belum tersedia.'
                );
        }


        $data = [

            'title' => 'Edit Profil Mahasiswa',

            'profile' => $profile

        ];


        return view(
            'mahasiswa/profile/edit',
            $data
        );
    }


    // =====================================================
    // UPDATE PROFILE
    // =====================================================
    public function update()
    {
        // =====================================================
        // AMBIL PROFILE LAMA
        // =====================================================

        $profile =
            session()->get(
                'mahasiswa_profile'
            )
            ?? [];


        if (empty($profile)) {

            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/profile'
                    )
                )
                ->with(
                    'error',
                    'Data profile tidak ditemukan.'
                );
        }


        // =====================================================
        // AMBIL DATA PRIBADI DARI FORM
        // =====================================================

        $nama =
            trim(
                $this->request->getPost(
                    'nama'
                )
            );





        $email =
            trim(
                $this->request->getPost(
                    'email'
                )
            );


        $noHp =
            trim(
                $this->request->getPost(
                    'no_hp'
                )
            );


        $jenisKelamin =
            trim(
                $this->request->getPost(
                    'jenis_kelamin'
                )
            );


        $alamat =
            trim(
                $this->request->getPost(
                    'alamat'
                )
            );


        // =====================================================
        // AMBIL INFORMASI AKADEMIK DARI FORM
        // =====================================================

        $prodi =
            trim(
                $this->request->getPost(
                    'prodi'
                )
            );



        $jurusan =
            trim(
                $this->request->getPost(
                    'jurusan'
                )
            );


        $semester =
            $this->request->getPost(
                'semester'
            );


        $angkatan =
            $this->request->getPost(
                'angkatan'
            );


        // =====================================================
        // VALIDASI DATA WAJIB
        // =====================================================

        if (
            empty($nama) ||
            empty($email) ||
            empty($noHp) ||
            empty($jenisKelamin) ||
            empty($alamat) ||
            empty($prodi) ||
            empty($jurusan) ||
            empty($semester) ||
            empty($angkatan)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Mohon lengkapi semua data profile dan informasi akademik.'
                );
        }


        // =====================================================
        // VALIDASI EMAIL
        // =====================================================

        if (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Format email tidak valid.'
                );
        }


        // =====================================================
        // VALIDASI SEMESTER
        // =====================================================

        if (
            !is_numeric($semester) ||
            $semester < 1 ||
            $semester > 14
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Semester harus berada antara 1 sampai 14.'
                );
        }


        // =====================================================
        // VALIDASI ANGKATAN
        // =====================================================

        if (
            !is_numeric($angkatan) ||
            $angkatan < 2000 ||
            $angkatan > 2100
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Angkatan tidak valid.'
                );
        }


        // =====================================================
        // UPDATE DATA PRIBADI
        // =====================================================

        $profile['nama'] =
            $nama;

// NIM & NIK tidak diubah

        $profile['email'] =
            $email;

        $profile['no_hp'] =
            $noHp;

        $profile['jenis_kelamin'] =
            $jenisKelamin;

        $profile['alamat'] =
            $alamat;


        // =====================================================
        // UPDATE INFORMASI AKADEMIK
        // =====================================================

        $profile['prodi'] =
            $prodi;

        $profile['jurusan'] =
            $jurusan;

        $profile['semester'] =
            (int) $semester;

        $profile['angkatan'] =
            (int) $angkatan;


        // =====================================================
        // UPLOAD FOTO PROFILE
        // =====================================================

        $foto =
            $this->request->getFile(
                'foto'
            );


        if (
            $foto &&
            $foto->isValid() &&
            !$foto->hasMoved()
        ) {

            // =================================================
            // VALIDASI UKURAN FOTO
            // Maksimal 2 MB
            // =================================================

            if (
                $foto->getSize()
                > 2 * 1024 * 1024
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Ukuran foto maksimal 2 MB.'
                    );
            }


            // =================================================
            // VALIDASI FORMAT FOTO
            // =================================================

            $allowedExtensions = [

                'jpg',
                'jpeg',
                'png',
                'webp'

            ];


            $extension =
                strtolower(
                    $foto->getExtension()
                );


            if (
                !in_array(
                    $extension,
                    $allowedExtensions
                )
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Format foto harus JPG, JPEG, PNG, atau WEBP.'
                    );
            }


            // =================================================
            // FOLDER UPLOAD
            // =================================================

            $uploadPath =
                FCPATH .
                'uploads/profile';


            // Buat folder jika belum ada
            if (
                !is_dir(
                    $uploadPath
                )
            ) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }


            // =================================================
            // HAPUS FOTO LAMA
            // =================================================

            if (
                !empty(
                    $profile['foto']
                    ?? null
                )
            ) {

                $fotoLama =
                    $uploadPath .
                    DIRECTORY_SEPARATOR .
                    $profile['foto'];


                if (
                    file_exists(
                        $fotoLama
                    )
                ) {

                    unlink(
                        $fotoLama
                    );
                }
            }


            // =================================================
            // NAMA FILE FOTO BARU
            // =================================================

            $namaFoto =
                $foto->getRandomName();


            // =================================================
            // PINDAHKAN FOTO
            // =================================================

            $foto->move(
                $uploadPath,
                $namaFoto
            );


            // Simpan nama foto ke profile
            $profile['foto'] =
                $namaFoto;
        }


        // =====================================================
        // SIMPAN PROFILE KE SESSION
        // =====================================================

        session()->set(
            'mahasiswa_profile',
            $profile
        );


        // =====================================================
        // UPDATE SESSION USER
        // Supaya data user lain ikut berubah
        // =====================================================

        $user =
            session()->get(
                'user'
            )
            ?? [];


        // Data pribadi
        $user['nama'] =
            $profile['nama'];

        $user['nim'] =
            $profile['nim'];

        $user['nik'] =
            $profile['nik'];

        $user['email'] =
            $profile['email'];

        $user['no_hp'] =
            $profile['no_hp'];

        $user['jenis_kelamin'] =
            $profile['jenis_kelamin'];

        $user['alamat'] =
            $profile['alamat'];


        // Data akademik
        $user['prodi'] =
            $profile['prodi'];

        $user['fakultas'] =
            $profile['fakultas'];

        $user['jurusan'] =
            $profile['jurusan'];

        $user['semester'] =
            $profile['semester'];

        $user['angkatan'] =
            $profile['angkatan'];


        // Foto
        $user['foto'] =
            $profile['foto']
            ?? null;


        // Simpan kembali session user
        session()->set(
            'user',
            $user
        );


        // =====================================================
        // KEMBALI KE PROFILE
        // =====================================================

        return redirect()
            ->to(
                base_url(
                    'mahasiswa/profile'
                )
            )
            ->with(
                'success',
                'Profil mahasiswa berhasil diperbarui.'
            );
    }
}