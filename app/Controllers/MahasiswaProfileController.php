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

            up.name AS nama,
            up.email,

            up.phone AS no_hp,
            up.address AS alamat,
            up.photo AS foto,

            up.study_program_id,
            up.class_id,

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

        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }

        $profile = $this->getProfile($userId);

        if (!$profile) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data profil mahasiswa tidak ditemukan.'
                );
        }

        $data = [
            'title' => 'Profil Mahasiswa',

            'profile' => [

                // DATA PRIBADI
                'nama' =>
                $profile['nama']
                    ?? $profile['student_name']
                    ?? '-',

                'nim' =>
                $profile['nim']
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


                // DATA AKADEMIK
                'prodi' =>
                $profile['prodi']
                    ?? '-',

                'jurusan' =>
                $profile['jurusan']
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

        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }

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


    public function update()
    {
        // =====================================================
        // 1. AMBIL USER LOGIN
        // =====================================================

        $userId = $this->getUserId();

        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =====================================================
        // 2. AMBIL PROFILE LAMA
        // =====================================================

        $profile = $this->getProfile($userId);

        if (!$profile) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data profil mahasiswa tidak ditemukan.'
                );
        }


        // =====================================================
        // 3. AMBIL DATA DARI FORM
        // =====================================================

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


        // =====================================================
        // 4. VALIDASI DATA PRIBADI
        // =====================================================

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


        // =====================================================
        // 5. VALIDASI EMAIL
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
        // 6. DATA UNTUK USER_PROFILES
        // =====================================================

        $updateProfileData = [
            'name' =>
            $nama,

            'email' =>
            $email,

            'phone' =>
            $noHp,

            'address' =>
            $alamat,

            'updated_at' =>
            date('Y-m-d H:i:s')
        ];


        // =====================================================
        // 7. UPLOAD FOTO
        // =====================================================

        $foto = $this->request->getFile('foto');

        $newPhotoName = null;

        if (
            $foto &&
            $foto->isValid() &&
            !$foto->hasMoved()
        ) {

            // -------------------------------------------------
            // VALIDASI UKURAN
            // -------------------------------------------------

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


            // -------------------------------------------------
            // VALIDASI EXTENSION
            // -------------------------------------------------

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


            // -------------------------------------------------
            // FOLDER UPLOAD
            // -------------------------------------------------

            $uploadPath =
                FCPATH .
                'uploads/profile';

            if (!is_dir($uploadPath)) {

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


            // -------------------------------------------------
            // BUAT NAMA FOTO BARU
            // -------------------------------------------------

            $newPhotoName =
                $foto->getRandomName();


            // -------------------------------------------------
            // PINDAHKAN FOTO
            // -------------------------------------------------

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
                        'Foto gagal diupload: ' .
                            $e->getMessage()
                    );
            }


            // -------------------------------------------------
            // MASUKKAN FOTO KE USER_PROFILES
            // -------------------------------------------------

            $updateProfileData['photo'] =
                $newPhotoName;
        }


        // =====================================================
        // 8. CONNECT DATABASE
        // =====================================================

        $db = \Config\Database::connect();


        // =====================================================
        // 9. MODEL
        // =====================================================

        $userModel =
            new UserModel();

        $profileModel =
            new UserProfileModel();


        // =====================================================
        // 10. CEK EMAIL DI TABEL USERS
        // =====================================================
        //
        // Email milik user sendiri tetap boleh digunakan.
        // Yang ditolak hanya email milik user lain.
        //

        $existingUser = $db
            ->table('users')
            ->where(
                'email',
                $email
            )
            ->where(
                'id !=',
                $userId
            )
            ->where(
                'deleted_at',
                null
            )
            ->get()
            ->getRowArray();


        if ($existingUser) {

            // Kalau tadi sudah upload foto baru,
            // hapus karena update database dibatalkan.

            if ($newPhotoName !== null) {

                $newPhotoPath =
                    FCPATH .
                    'uploads/profile' .
                    DIRECTORY_SEPARATOR .
                    $newPhotoName;

                if (
                    is_file($newPhotoPath)
                ) {
                    unlink($newPhotoPath);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Email tersebut sudah digunakan oleh akun lain.'
                );
        }


        // =====================================================
        // 11. MULAI TRANSAKSI
        // =====================================================

        $db->transBegin();


        try {

            // =================================================
            // 12. DATA UNTUK TABEL USERS
            // =================================================

            $userUpdateData = [

                'full_name' =>
                $nama,

                'email' =>
                $email,

                'phone_number' =>
                $noHp,

                'updated_at' =>
                date('Y-m-d H:i:s')
            ];


            // -------------------------------------------------
            // FOTO UNTUK TABEL USERS
            // -------------------------------------------------

            if ($newPhotoName !== null) {

                $userUpdateData['profile_photo'] =
                    $newPhotoName;
            } elseif (
                !empty($profile['foto']
                    ?? null)
            ) {

                $userUpdateData['profile_photo'] =
                    $profile['foto'];
            }


            // =================================================
            // 13. UPDATE TABEL USERS
            // =================================================

            $userModel->skipValidation(true);

            $userUpdated =
                $userModel->update(
                    $userId,
                    $userUpdateData
                );


            if ($userUpdated === false) {

                $errors =
                    $userModel->errors();

                $errorMessage =
                    !empty($errors)
                    ? implode(
                        ', ',
                        $errors
                    )
                    : 'Update tabel users gagal.';

                throw new \RuntimeException(
                    $errorMessage
                );
            }


            // =================================================
            // 14. UPDATE TABEL USER_PROFILES
            // =================================================

            $profileUpdated =
                $profileModel->update(
                    $profile['id'],
                    $updateProfileData
                );


            if ($profileUpdated === false) {

                $errors =
                    $profileModel->errors();

                $errorMessage =
                    !empty($errors)
                    ? implode(
                        ', ',
                        $errors
                    )
                    : 'Update tabel user_profiles gagal.';

                throw new \RuntimeException(
                    $errorMessage
                );
            }


            // =================================================
            // 15. CEK TRANSAKSI
            // =================================================

            if (
                !$db->transStatus()
            ) {

                throw new \RuntimeException(
                    'Transaksi database gagal.'
                );
            }


            // =================================================
            // 16. COMMIT
            // =================================================

            $db->transCommit();
        } catch (\Throwable $e) {

            // =================================================
            // ROLLBACK
            // =================================================

            $db->transRollback();


            // =================================================
            // HAPUS FOTO BARU JIKA GAGAL
            // =================================================

            if ($newPhotoName !== null) {

                $newPhotoPath =
                    FCPATH .
                    'uploads/profile' .
                    DIRECTORY_SEPARATOR .
                    $newPhotoName;

                if (
                    is_file($newPhotoPath)
                ) {
                    unlink($newPhotoPath);
                }
            }


            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal memperbarui profil: ' .
                        $e->getMessage()
                );
        }


        // =====================================================
        // 17. HAPUS FOTO LAMA
        // =====================================================

        if (
            $newPhotoName !== null &&
            !empty($profile['foto']
                ?? null)
        ) {

            $oldPhotoPath =
                FCPATH .
                'uploads/profile' .
                DIRECTORY_SEPARATOR .
                $profile['foto'];

            if (
                is_file($oldPhotoPath)
            ) {
                unlink($oldPhotoPath);
            }
        }


        // =====================================================
        // 18. BERHASIL
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
