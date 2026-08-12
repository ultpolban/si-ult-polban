<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserTypeModel;
use App\Models\UnitLayananModel;
use App\Models\KategoriLayananModel;
use App\Models\LayananModel;
use App\Models\DepartmentModel;
use App\Models\StudyProgramModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $userModel         = new UserModel();
        $roleModel         = new RoleModel();
        $userTypeModel     = new UserTypeModel();   // master_applicant_types
        $unitLayananModel  = new UnitLayananModel(); // master_service_units
        $kategoriModel     = new KategoriLayananModel(); // master_service_categories
        $layananModel      = new LayananModel();     // master_services
        $departmentModel   = new DepartmentModel();  // master_departments
        $studyProgramModel = new StudyProgramModel(); // master_study_programs

        $data = [
            'title'             => 'Dashboard',
            'totalUsers'        => $userModel->countAllResults(),
            'totalRoles'        => $roleModel->countAllResults(),
            'totalUserTypes'    => $userTypeModel->countAllResults(),
            'totalWorkUnits'    => $unitLayananModel->countAllResults(),
            'totalDepartments'  => $departmentModel->countAllResults(),
            'totalStudyPrograms'=> $studyProgramModel->countAllResults(),
            'totalKategori'     => $kategoriModel->countAllResults(),
            'totalLayanan'      => $layananModel->countAllResults(),
            'activeUsers'       => $userModel->where('is_active', 1)->countAllResults(),
            'inactiveUsers'     => $userModel->where('is_active', 0)->countAllResults(),
            'recentUsers'       => $userModel
                ->select('users.*, roles.name as role_name')
                ->join('roles', 'roles.id = users.role_id', 'left')
                ->orderBy('users.id', 'DESC')
                ->limit(5)
                ->find(),
        ];

        return view('dashboard/index', $data);
    }
}
