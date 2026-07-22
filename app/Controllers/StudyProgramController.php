<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudyProgramModel;
use App\Models\DepartmentModel;

class StudyProgramController extends BaseController
{
    protected $studyProgramModel;
    protected $departmentModel;

    public function __construct()
    {
        $this->studyProgramModel = new StudyProgramModel();
        $this->departmentModel   = new DepartmentModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data = [
            'title' => 'Master Program Studi',
            'studyPrograms' => $this->studyProgramModel
                ->select('study_programs.*, departments.department_name')
                ->join('departments', 'departments.id = study_programs.department_id')
                ->orderBy('departments.department_name', 'ASC')
                ->orderBy('study_programs.program_name', 'ASC')
                ->findAll()
        ];

        return view('study_programs/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data = [
            'title' => 'Tambah Program Studi',
            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll()
        ];

        return view('study_programs/create', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->studyProgramModel->insert([
            'department_id' => $this->request->getPost('department_id'),
            'program_code' => $this->request->getPost('program_code'),
            'program_name' => $this->request->getPost('program_name'),
            'education_level' => $this->request->getPost('education_level'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to(base_url('study-programs'))
            ->with('success', 'Program studi berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Program Studi',
            'program' => $this->studyProgramModel->find($id),
            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll()
        ];

        return view('study_programs/edit', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $this->studyProgramModel->update($id, [
            'department_id' => $this->request->getPost('department_id'),
            'program_code' => $this->request->getPost('program_code'),
            'program_name' => $this->request->getPost('program_name'),
            'education_level' => $this->request->getPost('education_level'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to(base_url('study-programs'))
            ->with('success', 'Program studi berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->studyProgramModel->delete($id);

        return redirect()->to(base_url('study-programs'))
            ->with('success', 'Program studi berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------
    */

    public function byDepartment($departmentId)
    {
        return $this->response->setJSON(
            $this->studyProgramModel
                ->where('department_id', $departmentId)
                ->where('status', 'Aktif')
                ->orderBy('program_name', 'ASC')
                ->findAll()
        );
    }
}
