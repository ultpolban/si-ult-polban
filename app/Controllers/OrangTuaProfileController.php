<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\UserModel;

class OrangTuaProfileController extends BaseController
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

                $userId =
                    $user['id']
                    ?? null;

            }
        }

        return $userId;
    }


    // =====================================================
    // AMBIL PROFILE ORANGTUA DARI DATABASE
    // =====================================================

    private function getProfile($userId)
    {
        $db = \Config\Database::connect();

        $builder =
            $db->table('user_profiles up');


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

            COALESCE(
                up.gender,
                u.gender
            ) AS jenis_kelamin,

            up.phone AS no_hp,
            up.address AS alamat,
            up.photo AS foto,

            up.study_program_id,
            up.class_id,

            msp.name AS prodi,
            msp.code AS kode_prodi,
            msp.department_id,

            md.name AS jurusan,
            md.code AS kode_jurusan,

            mc.name AS nama_kelas,
            mc.code AS kode_kelas,

            mat.code AS applicant_type_code,
            mat.name AS applicant_type_name
        ');


        // =================================================
        // USER
        // =================================================

        $builder->join(
            'users u',
            'u.id = up.user_id',
            'left'
        );


        // =================================================
        // APPLICANT TYPE
        // =================================================

        $builder->join(
            'master_applicant_types mat',
            'mat.id = up.applicant_type_id',
            'left'
        );


        // =================================================
        // CLASS
        // =================================================

        $builder->join(
            'master_classes mc',
            'mc.id = up.class_id
             AND mc.deleted_at IS NULL',
            'left'
        );


        // =================================================
        // PROGRAM STUDI
        // =================================================

        $builder->join(
            'master_study_programs msp',
            'msp.id = up.study_program_id
             AND msp.deleted_at IS NULL',
            'left'
        );


        // =================================================
        // JURUSAN
        // =================================================

        $builder->join(
            'master_departments md',
            'md.id = msp.department_id
             AND md.deleted_at IS NULL',
            'left'
        );


        // =================================================
        // FILTER USER
        // =================================================

        $builder->where(
            'up.user_id',
            $userId
        );

        $builder->where(
            'up.deleted_at',
            null
        );


        return $builder
            ->get()
            ->getRowArray();
    }


    // =====================================================
    // HALAMAN PROFILE ORANGTUA
    // =====================================================

    public function index()
    {
        // =================================================
        // 1. USER LOGIN
        // =================================================

        $userId =
            $this->getUserId();


        if (!$userId) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =================================================
        // 2. AMBIL PROFILE
        // =================================================

        $profile =
            $this->getProfile(
                $userId
            );


        if (!$profile) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data profil Orangtua/Wali tidak ditemukan.'
                );
        }


        // =================================================
        // 3. PASTIKAN WALI
        // =================================================

        $applicantTypeCode =
            strtoupper(
                trim(
                    (string) (
                        $profile[
                            'applicant_type_code'
                        ]
                        ?? ''
                    )
                )
            );


        if (
            $applicantTypeCode !== 'WALI'
        ) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun ini bukan akun Orangtua/Wali.'
                );
        }


        // =================================================
        // 4. DATA VIEW
        // =================================================

        $data = [

            'title' =>
                'Profil Orangtua',

            'profile' => [

                // =========================================
                // DATA PRIBADI ORANGTUA
                // =========================================

                'nama' =>
                    $profile['nama']
                    ?? '-',

                'nik' =>
                    $profile['nik']
                    ?? '-',

                'email' =>
                    $profile['email']
                    ?? '-',

                'jenis_kelamin' =>
                    $profile['jenis_kelamin']
                    ?? '-',

                'no_hp' =>
                    $profile['no_hp']
                    ?? '-',

                'alamat' =>
                    $profile['alamat']
                    ?? '-',

                'hubungan' =>
                    $profile['position']
                    ?? '-',

                'foto' =>
                    $profile['foto']
                    ?? null,


                // =========================================
                // DATA MAHASISWA
                // =========================================

                'student_name' =>
                    $profile['student_name']
                    ?? '-',

                'nim' =>
                    $profile['nim']
                    ?? '-',

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

            ]
        ];


        return view(
            'orangtua/profile/index',
            $data
        );
    }


    // =====================================================
    // HALAMAN EDIT PROFILE
    // =====================================================

    public function edit()
    {
        // =================================================
        // 1. USER LOGIN
        // =================================================

        $userId =
            $this->getUserId();


        if (!$userId) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =================================================
        // 2. AMBIL PROFILE
        // =================================================

        $profile =
            $this->getProfile(
                $userId
            );


        if (!$profile) {

            return redirect()
                ->to(
                    base_url(
                        'orangtua/profile'
                    )
                )
                ->with(
                    'error',
                    'Data profil Orangtua/Wali tidak ditemukan.'
                );
        }


        // =================================================
        // 3. PASTIKAN WALI
        // =================================================

        $applicantTypeCode =
            strtoupper(
                trim(
                    (string) (
                        $profile[
                            'applicant_type_code'
                        ]
                        ?? ''
                    )
                )
            );


        if (
            $applicantTypeCode !== 'WALI'
        ) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun ini bukan akun Orangtua/Wali.'
                );
        }


        // =================================================
        // 4. DATA VIEW
        // =================================================

        $data = [

            'title' =>
                'Edit Profil Orangtua',

            'profile' => [

                'id' =>
                    $profile['id']
                    ?? null,

                'user_id' =>
                    $profile['user_id']
                    ?? null,


                // =========================================
                // DATA PRIBADI
                // =========================================

                'nama' =>
                    $profile['nama']
                    ?? '',

                'nik' =>
                    $profile['nik']
                    ?? '',

                'jenis_kelamin' =>
                    $profile['jenis_kelamin']
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

                'hubungan' =>
                    $profile['position']
                    ?? '',

                'foto' =>
                    $profile['foto']
                    ?? null,


                // =========================================
                // DATA MAHASISWA
                // =========================================

                'student_name' =>
                    $profile['student_name']
                    ?? '',

                'nim' =>
                    $profile['nim']
                    ?? '',

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

                'kode_kelas' =>
                    $profile['kode_kelas']
                    ?? '',
            ]
        ];


        return view(
            'orangtua/profile/edit',
            $data
        );
    }


    // =====================================================
    // UPDATE PROFILE
    // =====================================================

    public function update()
    {
        // =================================================
        // 1. USER LOGIN
        // =================================================

        $userId =
            $this->getUserId();


        if (!$userId) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // =================================================
        // 2. AMBIL PROFILE LAMA
        // =================================================

        $profile =
            $this->getProfile(
                $userId
            );


        if (!$profile) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data profil Orangtua/Wali tidak ditemukan.'
                );
        }


        // =================================================
        // 3. VALIDASI WALI
        // =================================================

        $applicantTypeCode =
            strtoupper(
                trim(
                    (string) (
                        $profile[
                            'applicant_type_code'
                        ]
                        ?? ''
                    )
                )
            );


        if (
            $applicantTypeCode !== 'WALI'
        ) {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Akun ini bukan akun Orangtua/Wali.'
                );
        }


        // =================================================
        // 4. AMBIL FORM
        // =================================================

        $nama =
            trim(
                (string)
                $this->request
                    ->getPost('nama')
            );


        $email =
            trim(
                (string)
                $this->request
                    ->getPost('email')
            );


        $noHp =
            trim(
                (string)
                $this->request
                    ->getPost('no_hp')
            );


        $alamat =
            trim(
                (string)
                $this->request
                    ->getPost('alamat')
            );


        // =================================================
        // 5. VALIDASI
        // =================================================

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


        // =================================================
        // 6. VALIDASI EMAIL
        // =================================================

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


        // =================================================
        // 7. MODEL
        // =================================================

        $db =
            \Config\Database::connect();


        $userModel =
            new UserModel();


        $profileModel =
            new UserProfileModel();


        // =================================================
        // 8. CEK EMAIL USER LAIN
        // =================================================

        $existingUser =
            $db->table('users')
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

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Email tersebut sudah digunakan oleh akun lain.'
                );
        }


        // =================================================
        // 9. DATA USER_PROFILES
        // =================================================

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
                date(
                    'Y-m-d H:i:s'
                ),

        ];


        // =================================================
        // 10. UPLOAD FOTO
        // =================================================

        $foto =
            $this->request
                ->getFile('foto');


        $newPhotoName =
            null;


        if (
            $foto &&
            $foto->isValid() &&
            !$foto->hasMoved()
        ) {

            // =============================================
            // UKURAN
            // =============================================

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


            // =============================================
            // EXTENSION
            // =============================================

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


            // =============================================
            // FOLDER
            // =============================================

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


            // =============================================
            // NAMA FILE
            // =============================================

            $newPhotoName =
                $foto->getRandomName();


            // =============================================
            // PINDAHKAN
            // =============================================

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


            $updateProfileData['photo'] =
                $newPhotoName;
        }


        // =================================================
        // 11. TRANSAKSI
        // =================================================

        $db->transBegin();


        try {

            // =============================================
            // UPDATE USERS
            // =============================================

            $userUpdateData = [

                'full_name' =>
                    $nama,

                'email' =>
                    $email,

                'phone_number' =>
                    $noHp,

                'updated_at' =>
                    date(
                        'Y-m-d H:i:s'
                    ),

            ];


            // =============================================
            // FOTO USER
            // =============================================

            if (
                $newPhotoName !== null
            ) {

                $userUpdateData[
                    'profile_photo'
                ] = $newPhotoName;

            } elseif (
                !empty(
                    $profile['foto']
                    ?? null
                )
            ) {

                $userUpdateData[
                    'profile_photo'
                ] =
                    $profile['foto'];
            }


            // =============================================
            // UPDATE USERS
            // =============================================

            $userModel
                ->skipValidation(true);


            $userUpdated =
                $userModel->update(
                    $userId,
                    $userUpdateData
                );


            if (
                $userUpdated === false
            ) {

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


            // =============================================
            // UPDATE USER PROFILES
            // =============================================

            $profileUpdated =
                $profileModel->update(
                    $profile['id'],
                    $updateProfileData
                );


            if (
                $profileUpdated === false
            ) {

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


            // =============================================
            // CEK TRANSAKSI
            // =============================================

            if (
                !$db->transStatus()
            ) {

                throw new \RuntimeException(
                    'Transaksi database gagal.'
                );
            }


            // =============================================
            // COMMIT
            // =============================================

            $db->transCommit();

        } catch (\Throwable $e) {

            // =============================================
            // ROLLBACK
            // =============================================

            $db->transRollback();


            // =============================================
            // HAPUS FOTO BARU
            // =============================================

            if (
                $newPhotoName !== null
            ) {

                $newPhotoPath =
                    FCPATH .
                    'uploads/profile' .
                    DIRECTORY_SEPARATOR .
                    $newPhotoName;


                if (
                    is_file(
                        $newPhotoPath
                    )
                ) {

                    unlink(
                        $newPhotoPath
                    );
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


        // =================================================
        // 12. HAPUS FOTO LAMA
        // =================================================

        if (
            $newPhotoName !== null &&
            !empty(
                $profile['foto']
                ?? null
            )
        ) {

            $oldPhotoPath =
                FCPATH .
                'uploads/profile' .
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


        // =================================================
        // 13. UPDATE SESSION
        // =================================================

        $updatedProfile =
            $profileModel
                ->where(
                    'user_id',
                    $userId
                )
                ->where(
                    'deleted_at',
                    null
                )
                ->first();


        if ($updatedProfile) {

            session()->set(
                'orangtua_profile',
                $updatedProfile
            );
        }


        // =================================================
        // 14. BERHASIL
        // =================================================

        return redirect()
            ->to(
                base_url(
                    'orangtua/profile'
                )
            )
            ->with(
                'success',
                'Profil Orangtua berhasil diperbarui.'
            );
    }
}