<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\StudyProgramModel;
use App\Models\WorkUnitModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $roleId = session()->get('role_id');

        switch ($roleId) {

            // Administrator
            case 1:

                $userModel = new UserModel();
                $departmentModel = new DepartmentModel();
                $studyProgramModel = new StudyProgramModel();
                $workUnitModel = new WorkUnitModel();

                return view('dashboard/admin', [

                    'totalUsers'       => $userModel->countAll(),
                    'totalDepartments' => $departmentModel->countAll(),
                    'totalPrograms'    => $studyProgramModel->countAll(),
                    'totalUnits'       => $workUnitModel->countAll()

                ]);

                // Petugas ULT
            case 2:
                return view('dashboard/petugas');

                // Unit Tujuan
            case 3:
                return view('dashboard/unit');

                // Pimpinan
            case 4:
                return view('dashboard/pimpinan');

                // Pemohon
            case 5:
                return view('dashboard/pemohon');

            default:
                session()->destroy();

                return redirect()
                    ->to('/login')
                    ->with('error', 'Role tidak dikenali.');
        }
    }
}
