<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\UserModel;

class MahasiswaProfileController extends BaseController
{
    // =====================================================
    // AMBIL USER ID YANG SEDANG LOGIN
    // =====================================================
    private function getUserId()
    {
        $userId = session()->get('user_id');

        // Alternatif jika project menggunakan session user
        if (!$userId) {
            $user = session()->get('user');

            if (is_array($user)) {
                $userId = $user['id'] ?? null;
            }
        }

        return $userId;
    }


    // =====================================================
    // AMBIL DATA PROFILE DARI DATABASE
    // =====================================================
    private function getProfile($userId)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('user_profiles up');

        $builder->select('
            up.id,
            up.user_id,
            up.applicant_type_id,

            up.student_name,
            up.institution_name,
            up.position,

            up.nim,
            up.nik,

            up.name AS nama,
            up.email,

            up.phone AS no_hp,
            up.address AS alamat,
            up.photo AS foto,

            up.study_program_id,
            up.class_id,

            mc.name AS nama_kelas,
            mc.code AS kode_kelas,
            mc.level AS semester,
            mc.parallel_class,
            mc.entry_year AS angkatan,

            msp.name AS prodi,
            msp.code AS kode_prodi,
            msp.department_id,

            md.name AS jurusan,
            md.code AS kode_jurusan

        ');

        // =================================================
        // RELASI CLASS
        // =================================================
        $builder->join(
            'master_classes mc',
            'mc.id = up.class_id
             AND mc.deleted_at IS NULL',
            'left'
        );

        // =================================================
        // RELASI PROGRAM STUDI
        // =================================================
        $builder->join(
            'master_study_programs msp',
            'msp.id = up.study_program_id
             AND msp.deleted_at IS NULL',
            'left'
        );

        // =================================================
        // RELASI JURUSAN
        // =================================================
        $builder->join(
            'master_departments md',
            'md.id = msp.department_id
             AND md.deleted_at IS NULL',
            'left'
        );

        // =================================================
        // USER YANG LOGIN
        // =================================================
        $builder->where(
            'up.user_id',
            $userId
        );

        // Jangan ambil profile yang dihapus
        $builder->where(
            'up.deleted_at',
            null
        );

        return $builder
            ->get()
            ->getRowArray();
    }


    // =====================================================
    // HALAMAN PROFIL MAHASISWA
    // =====================================================
    public function index()
    {
        $userId = $this->getUserId();

        // =================================================
        // BELUM LOGIN
        // =================================================
        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =================================================
        // AMBIL PROFILE
        // =================================================
        $profile = $this->getProfile($userId);


        // =================================================
        // PROFILE TIDAK DITEMUKAN
        // =================================================
        if (!$profile) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data profil mahasiswa tidak ditemukan.'
                );
        }


        // =================================================
        // DATA UNTUK VIEW
        // =================================================
        $data = [

            'title' => 'Profil Mahasiswa',

            'profile' => [

                // -----------------------------------------
                // DATA PRIBADI
                // -----------------------------------------
                'nama' =>
                $profile['nama']
                    ?? $profile['student_name']
                    ?? '-',

                'nim' =>
                $profile['nim']
                    ?? '-',

                'nik' =>
                $profile['nik']
                    ?? '-',

                'email' =>
                $profile['email']
                    ?? '-',

                'no_hp' =>
                $profile['no_hp']
                    ?? '-',

                'alamat' =>
                $profile['alamat']
                    ?? '-',

                'foto' =>
                $profile['foto']
                    ?? null,


                // -----------------------------------------
                // DATA AKADEMIK
                // -----------------------------------------
                'prodi' =>
                $profile['prodi']
                    ?? '-',

                'jurusan' =>
                $profile['jurusan']
                    ?? '-',

                'semester' =>
                $profile['semester']
                    ?? '-',

                'angkatan' =>
                $profile['angkatan']
                    ?? '-',

                'nama_kelas' =>
                $profile['nama_kelas']
                    ?? '-',

                'kode_kelas' =>
                $profile['kode_kelas']
                    ?? '-',

                'study_program_id' =>
                $profile['study_program_id']
                    ?? null,

                'class_id' =>
                $profile['class_id']
                    ?? null,


                // -----------------------------------------
                // SEMENTARA
                // -----------------------------------------
                'fakultas' => '-',

                'status' => 'Aktif'
            ]
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
        $userId = $this->getUserId();


        // =================================================
        // BELUM LOGIN
        // =================================================
        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =================================================
        // AMBIL DATA TERBARU DARI DATABASE
        // =================================================
        $profile = $this->getProfile($userId);


        if (!$profile) {
            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/profile'
                    )
                )
                ->with(
                    'error',
                    'Data profil mahasiswa tidak ditemukan.'
                );
        }


        // =================================================
        // DATA UNTUK FORM EDIT
        // =================================================
        $data = [

            'title' => 'Edit Profil Mahasiswa',

            'profile' => [

                'id' =>
                $profile['id']
                    ?? null,

                'user_id' =>
                $profile['user_id']
                    ?? null,

                // DATA PRIBADI
                'nama' =>
                $profile['nama']
                    ?? $profile['student_name']
                    ?? '',

                'nim' =>
                $profile['nim']
                    ?? '',

                'nik' =>
                $profile['nik']
                    ?? '',

                'email' =>
                $profile['email']
                    ?? '',

                'no_hp' =>
                $profile['no_hp']
                    ?? '',

                'alamat' =>
                $profile['alamat']
                    ?? '',

                'foto' =>
                $profile['foto']
                    ?? null,


                // DATA AKADEMIK
                'prodi' =>
                $profile['prodi']
                    ?? '',

                'jurusan' =>
                $profile['jurusan']
                    ?? '',

                'semester' =>
                $profile['semester']
                    ?? '',

                'angkatan' =>
                $profile['angkatan']
                    ?? '',

                'study_program_id' =>
                $profile['study_program_id']
                    ?? null,

                'class_id' =>
                $profile['class_id']
                    ?? null,

                'nama_kelas' =>
                $profile['nama_kelas']
                    ?? '',
            ]
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
        // =================================================
        // AMBIL USER LOGIN
        // =================================================
        $userId = $this->getUserId();


        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =================================================
        // AMBIL PROFILE LAMA
        // =================================================
        $profile = $this->getProfile($userId);


        if (!$profile) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data profil mahasiswa tidak ditemukan.'
                );
        }


        // =================================================
        // AMBIL DATA DARI FORM
        // =================================================

        $nama = trim(
            (string) $this->request->getPost('nama')
        );

        $email = trim(
            (string) $this->request->getPost('email')
        );

        $noHp = trim(
            (string) $this->request->getPost('no_hp')
        );

        $alamat = trim(
            (string) $this->request->getPost('alamat')
        );

        $prodi = trim(
            (string) $this->request->getPost('prodi')
        );

        $jurusan = trim(
            (string) $this->request->getPost('jurusan')
        );

        $semester = $this->request->getPost(
            'semester'
        );

        $angkatan = $this->request->getPost(
            'angkatan'
        );


        // VALIDASI DATA PRIBADI

        if (
            empty($nama) ||
            empty($email) ||
            empty($noHp) ||
            empty($alamat)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nama, email, nomor HP, dan alamat wajib diisi.'
                );
        }

        // VALIDASI EMAIL

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

        // VALIDASI AKADEMIK=

        if (
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
                    'Data program studi, jurusan, semester, dan angkatan wajib diisi.'
                );
        }


        // VALIDASI SEMESTER

        if (
            !is_numeric($semester) ||
            (int) $semester < 1 ||
            (int) $semester > 14
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Semester harus berada antara 1 sampai 14.'
                );
        }

        // VALIDASI ANGKATAN

        if (
            !is_numeric($angkatan) ||
            (int) $angkatan < 2000 ||
            (int) $angkatan > 2100
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Angkatan tidak valid.'
                );
        }

        // CONNECT DATABASE

        $db = \Config\Database::connect();


        // CARI JURUSAN

        $department = $db
            ->table('master_departments')
            ->where(
                'name',
                $jurusan
            )
            ->where(
                'deleted_at',
                null
            )
            ->get()
            ->getRowArray();


        if (!$department) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Jurusan "' .
                        $jurusan .
                        '" tidak ditemukan di database.'
                );
        }

        // CARI PROGRAM STUDI
        // SESUAI DENGAN JURUSAN

        $studyProgram = $db
            ->table('master_study_programs')
            ->where(
                'name',
                $prodi
            )
            ->where(
                'department_id',
                $department['id']
            )
            ->where(
                'deleted_at',
                null
            )
            ->get()
            ->getRowArray();


        if (!$studyProgram) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Program Studi "' .
                        $prodi .
                        '" tidak ditemukan pada jurusan "' .
                        $jurusan .
                        '".'
                );
        }

        // CARI KELAS
        //
        // Berdasarkan:
        // - study_program_id
        // - semester / level
        // - angkatan / entry_year

        $class = $db
            ->table('master_classes')
            ->where(
                'study_program_id',
                $studyProgram['id']
            )
            ->where(
                'level',
                (int) $semester
            )
            ->where(
                'entry_year',
                (int) $angkatan
            )
            ->where(
                'is_active',
                1
            )
            ->where(
                'deleted_at',
                null
            )
            ->orderBy(
                'id',
                'ASC'
            )
            ->get()
            ->getRowArray();


        // KELAS TIDAK DITEMUKAN
        if (!$class) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Kelas untuk Program Studi "' .
                        $prodi .
                        '", Semester ' .
                        $semester .
                        ', Angkatan ' .
                        $angkatan .
                        ' belum tersedia di database.'
                );
        }

        // DATA USER_PROFILE YANG DIUPDATE

        $updateData = [

            'name' =>
            $nama,

            'email' =>
            $email,

            'phone' =>
            $noHp,

            'address' =>
            $alamat,

            'study_program_id' =>
            $studyProgram['id'],

            'class_id' =>
            $class['id'],

            'updated_at' =>
            date('Y-m-d H:i:s')
        ];

        // UPLOAD FOTO

        $foto = $this->request->getFile(
            'foto'
        );


        if (
            $foto &&
            $foto->isValid() &&
            !$foto->hasMoved()
        ) {

            // VALIDASI UKURAN
            // Maksimal 2 MB
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

            // VALIDASI EXTENSION
            $allowedExtensions = [

                'jpg',
                'jpeg',
                'png',
                'webp'

            ];

            $extension = strtolower(
                $foto->getExtension()
            );

            if (
                !in_array(
                    $extension,
                    $allowedExtensions,
                    true
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

            // FOLDER UPLOAD

            $uploadPath =
                FCPATH .
                'uploads/profile';


            if (
                !is_dir(
                    $uploadPath
                )
            ) {

                if (
                    !mkdir(
                        $uploadPath,
                        0777,
                        true
                    )
                ) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->with(
                            'error',
                            'Folder upload foto tidak dapat dibuat.'
                        );
                }
            }
            // HAPUS FOTO LAMA

            if (
                !empty($profile['foto']
                    ?? null)
            ) {

                $oldPhotoPath =
                    $uploadPath .
                    DIRECTORY_SEPARATOR .
                    $profile['foto'];


                if (
                    is_file(
                        $oldPhotoPath
                    )
                ) {

                    unlink(
                        $oldPhotoPath
                    );
                }
            }

            // NAMA FOTO BARU

            $newPhotoName =
                $foto->getRandomName();

            // PINDAHKAN FOTO
            try {

                $foto->move(
                    $uploadPath,
                    $newPhotoName
                );
            } catch (\Throwable $e) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Foto gagal diupload.'
                    );
            }

            // SIMPAN NAMA FOTO KE DATABASE

            $updateData['photo'] = $newPhotoName;

            // SIMPAN NAMA FOTO KE DATABASE

            $updateData['photo'] =
                $newPhotoName;
        }

        // =====================================================
        // UPDATE DATABASE
        // =====================================================

        $userModel = new UserModel();
        $profileModel = new UserProfileModel();

        $db->transStart();

        try {

            // =================================================
            // UPDATE TABEL USERS
            // =================================================

            $userModel->update(
                $userId,
                [
                    'full_name'    => $nama,
                    'email'        => $email,
                    'phone_number' => $noHp,
                    'updated_at'   => date('Y-m-d H:i:s'),

                    // Kalau upload foto baru,
                    // simpan juga ke users.profile_photo
                    'profile_photo' =>
                    $updateData['photo']
                        ?? ($profile['foto'] ?? null),
                ]
            );


            // =================================================
            // UPDATE TABEL USER_PROFILES
            // =================================================

            $profileModel->update(
                $profile['id'],
                $updateData
            );


            // =================================================
            // SELESAIKAN TRANSAKSI
            // =================================================

            $db->transComplete();


            if ($db->transStatus() === false) {

                throw new \RuntimeException(
                    'Gagal memperbarui data profil.'
                );
            }
        } catch (\Throwable $e) {

            // Kalau transaksi gagal, database akan rollback
            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data profil gagal diperbarui.'
                );
        }
    }
}
