<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\DepartmentModel;
use App\Models\StudyProgramModel;
use App\Models\WorkUnitModel;

class DashboardController extends BaseController
{
    protected UserModel $userModel;
    protected RoleModel $roleModel;
    protected DepartmentModel $departmentModel;
    protected StudyProgramModel $studyProgramModel;
    protected WorkUnitModel $workUnitModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->departmentModel = new DepartmentModel();
        $this->studyProgramModel = new StudyProgramModel();
        $this->workUnitModel = new WorkUnitModel();
    }

    public function index()
{
    $userModel = new \App\Models\UserModel();
    $roleModel = new \App\Models\RoleModel();
    $userTypeModel = new \App\Models\UserTypeModel();
    $departmentModel = new \App\Models\DepartmentModel();
    $studyProgramModel = new \App\Models\StudyProgramModel();
    $workUnitModel = new \App\Models\WorkUnitModel();

    $data = [

        'title' => 'Dashboard',

        'totalUsers' => $userModel->countAllResults(),

        'totalRoles' => $roleModel->countAllResults(),

        'totalUserTypes' => $userTypeModel->countAllResults(),

        'totalDepartments' => $departmentModel->countAllResults(),

        'totalStudyPrograms' => $studyProgramModel->countAllResults(),

        'totalWorkUnits' => $workUnitModel->countAllResults(),

        'activeUsers' => $userModel
            ->where('is_active', 1)
            ->countAllResults(),

        'inactiveUsers' => $userModel
            ->where('is_active', 0)
            ->countAllResults(),

        'recentUsers' => $userModel
            ->select('users.*, roles.role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->orderBy('users.id', 'DESC')
            ->limit(5)
            ->find()

    ];

    return view('dashboard/index', $data);
}
}
