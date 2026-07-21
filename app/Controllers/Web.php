<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\StudyProgramModel;
use App\Models\WorkUnitModel;
use App\Models\UserTypeModel;

class Web extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function register()
    {
        $departmentModel = new DepartmentModel();
        $studyProgramModel = new StudyProgramModel();
        $workUnitModel = new WorkUnitModel();
        $userTypeModel = new UserTypeModel();

        $data = [
            'departments'    => $departmentModel->findAll(),
            'studyPrograms'  => $studyProgramModel->findAll(),
            'workUnits'      => $workUnitModel->findAll(),
            'userTypes'      => $userTypeModel->findAll(),
        ];

        return view('auth/register', $data);
    }

    public function users()
    {
        return view('users/index');
    }
}
