<?php

namespace App\Controllers;

use App\Models\UserProfileModel;

class MahasiswaProfileController extends BaseController
{
// =====================================================
// TAMPILKAN PROFILE MAHASISWA
// =====================================================
public function index()
{
    $user = session()->get('user') ?? [];

    // =====================================================
    // AMBIL ID USER YANG SEDANG LOGIN
    // =====================================================

    $userId = $user['id'] ?? null;

    if (!$userId) {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Session user tidak ditemukan.'
            );
    }


    // =====================================================
    // MODEL PROFILE
    // =====================================================

    $profileModel = new UserProfileModel();


    // =====================================================
    // AMBIL DATA PROFILE + MASTER DATA
    // =====================================================

$profile = $profileModel
    ->select('
        user_profiles.*,

        user_profiles.name AS nama,

        user_profiles.phone AS no_hp,

        user_profiles.photo AS foto,

        master_study_programs.name AS prodi,

        master_departments.name AS jurusan,

        master_classes.name AS kelas
    ')
    ->join(
        'master_study_programs',
        'master_study_programs.id = user_profiles.study_program_id',
        'left'
    )
    ->join(
        'master_departments',
        'master_departments.id = master_study_programs.department_id',
        'left'
    )
    ->join(
        'master_classes',
        'master_classes.id = user_profiles.class_id',
        'left'
    )
    ->where(
        'user_profiles.user_id',
        $userId
    )
    ->where(
        'user_profiles.deleted_at',
        null
    )
    ->first();


    // =====================================================
    // PROFILE TIDAK DITEMUKAN
    // =====================================================

    if (!$profile) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Data profil mahasiswa tidak ditemukan.'
            );
    }


    // =====================================================
    // DATA YANG DIKIRIM KE VIEW
    // =====================================================

    $data = [
        'title'   => 'Profil Mahasiswa',
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