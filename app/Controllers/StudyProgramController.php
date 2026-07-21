<?php

namespace App\Controllers;

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

    public function index()
    {
        $programs = $this->studyProgramModel
            ->select('study_programs.*, departments.department_name')
            ->join('departments', 'departments.id = study_programs.department_id')
            ->orderBy('departments.department_name')
            ->orderBy('study_programs.program_name')
            ->findAll();

        return view('study_programs/index', [
            'title' => 'Management Program Studi',
            'programs' => $programs
        ]);
    }

    public function create()
    {
        return view('study_programs/create', [
            'title' => 'Tambah Program Studi',
            'departments' => $this->departmentModel->findAll()
        ]);
    }

    public function store()
    {
        $this->studyProgramModel->save([

            'department_id' => $this->request->getPost('department_id'),

            'program_code' => $this->request->getPost('program_code'),

            'program_name' => $this->request->getPost('program_name'),

            'education_level' => $this->request->getPost('education_level'),

            'status' => $this->request->getPost('status')

        ]);

        return redirect()->to('/study-programs')
            ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('study_programs/edit', [
            'title' => 'Edit Program Studi',
            'program' => $this->studyProgramModel->find($id),
            'departments' => $this->departmentModel->findAll()
        ]);
    }

    public function update($id)
    {
        $this->studyProgramModel->update($id, [

            'department_id' => $this->request->getPost('department_id'),

            'program_code' => $this->request->getPost('program_code'),

            'program_name' => $this->request->getPost('program_name'),

            'education_level' => $this->request->getPost('education_level'),

            'status' => $this->request->getPost('status')

        ]);

        return redirect()->to('/study-programs')
            ->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->studyProgramModel->delete($id);

        return redirect()->to('/study-programs')
            ->with('success', 'Program Studi berhasil dihapus.');
    }
}
