<?php

namespace App\Controllers;

class ProfileController extends BaseController
{
    private function getUserData(int $userId): array
    {
        $db = \Config\Database::connect();

        $user = $db->table('users')
            ->select('users.id, users.email, users.full_name as name, users.profile_photo, roles.name as role_name, user_profiles.*')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->join('user_profiles', 'user_profiles.user_id = users.id', 'left')
            ->where('users.id', $userId)
            ->get()
            ->getRowArray();

        return $user ?: [];
    }

    private function getLookupData(): array
    {
        $db = \Config\Database::connect();
        return [
            'applicantTypes' => $db->table('master_applicant_types')->get()->getResultArray(),
            'studyPrograms'  => $db->table('master_study_programs')->get()->getResultArray(),
            'classes'        => $db->table('master_classes')->get()->getResultArray(),
        ];
    }

    // ─── Halaman Tampilan Profil (read-only) ───────────────────────────────────

    public function index()
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        return view('profile/index', array_merge([
            'title' => 'Profil Saya',
            'user'  => $this->getUserData($userId),
        ], $this->getLookupData()));
    }

    // ─── Halaman Form Edit Profil ──────────────────────────────────────────────

    public function edit()
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        return view('profile/edit', array_merge([
            'title' => 'Ubah Profil',
            'user'  => $this->getUserData($userId),
        ], $this->getLookupData()));
    }

    // ─── Proses Simpan Profil ──────────────────────────────────────────────────

    public function update()
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        $fullName        = trim((string) $this->request->getPost('full_name'));
        $email           = trim((string) $this->request->getPost('email'));
        $phone           = trim((string) $this->request->getPost('phone'));
        $nim             = trim((string) $this->request->getPost('nim'));
        $nik             = trim((string) $this->request->getPost('nik'));
        $address         = trim((string) $this->request->getPost('address'));
        $studyProgramId  = $this->request->getPost('study_program_id') ? (int) $this->request->getPost('study_program_id') : null;
        $classId         = $this->request->getPost('class_id') ? (int) $this->request->getPost('class_id') : null;
        $applicantTypeId = $this->request->getPost('applicant_type_id') ? (int) $this->request->getPost('applicant_type_id') : null;

        if ($fullName === '' || $email === '') {
            return redirect()->back()->withInput()->with('error', 'Nama dan email wajib diisi.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Handle photo upload
        $photoFile = $this->request->getFile('photo');
        $photoName = null;
        if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
            $photoName = $photoFile->getRandomName();
            $photoFile->move(FCPATH . 'uploads/profiles', $photoName);
        }

        $usersUpdate = [
            'full_name'    => $fullName,
            'email'        => $email,
            'phone_number' => $phone !== '' ? $phone : null,
            'updated_at'   => date('Y-m-d H:i:s'),
        ];
        if ($photoName) {
            $usersUpdate['profile_photo'] = $photoName;
        }

        $db->table('users')
            ->where('id', $userId)
            ->update($usersUpdate);

        $profile = $db->table('user_profiles')->where('user_id', $userId)->get()->getRow();

        $profileData = [
            'name'              => $fullName,
            'email'             => $email,
            'phone'             => $phone,
            'nim'               => $nim,
            'nik'               => $nik,
            'address'           => $address,
            'study_program_id'  => $studyProgramId,
            'class_id'          => $classId,
            'applicant_type_id' => $applicantTypeId,
            'updated_at'        => date('Y-m-d H:i:s'),
        ];
        if ($photoName) {
            $profileData['photo'] = $photoName;
        }

        if ($profile) {
            $db->table('user_profiles')->where('user_id', $userId)->update($profileData);
        } else {
            $profileData['user_id']    = $userId;
            $profileData['created_at'] = date('Y-m-d H:i:s');
            $db->table('user_profiles')->insert($profileData);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui profil.');
        }

        session()->set(['full_name' => $fullName, 'email' => $email]);

        return redirect()->to('/profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
