<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\MasterApplicantTypeModel;
use App\Models\MasterStudyProgramModel;
use App\Models\MasterClassModel;

class ProfileController extends AdminController
{
    protected UserModel $userModel;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        parent::__construct();

        $this->userModel    = new UserModel();
        $this->profileModel = new UserProfileModel();
    }

    /**
     * Halaman profil
     */
    public function index()
    {
        $userId = $this->user['id'] ?? session()->get('user_id');

        if (! $userId) {
            return redirect()->to('/login');
        }

        $profile = $this->profileModel->findByUser((int) $userId);

        return view('profile/index', $this->viewData([
            'title'      => 'Profil Saya',
            'pageTitle'  => 'Profil Saya',
            'breadcrumb' => ['Profil'],
            'user'       => $this->user,
            'profile'    => $profile,
            'applicantTypes' => (new MasterApplicantTypeModel())->getActive(),
            'studyPrograms'  => (new MasterStudyProgramModel())->getActive(),
            'classes'        => (new MasterClassModel())->getActive(),
        ]));
    }

    /**
     * Update profil
     */
    public function update()
    {
        $userId = $this->user['id'] ?? session()->get('user_id');

        if (! $userId) {
            return redirect()->to('/login');
        }

        $fullName = trim($this->request->getPost('full_name') ?? '');
        $email    = trim($this->request->getPost('email') ?? '');
        $phone    = trim($this->request->getPost('phone') ?? '');

        if ($fullName === '' || $email === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nama dan email wajib diisi.');
        }

        $this->userModel->update($userId, [
            'full_name' => $fullName,
            'email'     => $email,
        ]);

        $profileData = [
            'user_id' => (int) $userId,
            'name'    => $fullName,
            'email'   => $email,
            'phone'   => $phone,
            'applicant_type_id' => $this->request->getPost('applicant_type_id') ?: null,
            'study_program_id'  => $this->request->getPost('study_program_id') ?: null,
            'class_id'          => $this->request->getPost('class_id') ?: null,
            'nim'               => $this->request->getPost('nim') ?: null,
            'nik'               => $this->request->getPost('nik') ?: null,
            'address'           => $this->request->getPost('address') ?: null,
        ];

        $existing = $this->profileModel->findByUser((int) $userId);

        if ($existing) {
            $this->profileModel->update($existing['id'], $profileData);
        } else {
            $this->profileModel->insert($profileData);
        }

        return redirect()->back()
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
