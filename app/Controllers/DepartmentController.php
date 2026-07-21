<?php

namespace App\Controllers;

use App\Models\DepartmentModel;

class DepartmentController extends BaseController
{
    protected $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        return view('departments/index', [

            'title' => 'Management Jurusan',

            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll()

        ]);
    }

    public function create()
    {
        return view('departments/create', [
            'title' => 'Tambah Jurusan'
        ]);
    }

    public function store()
    {
        $this->departmentModel->save([
            'department_code' => $this->request->getPost('department_code'),
            'department_name' => $this->request->getPost('department_name'),
        ]);

        return redirect()->to('/departments')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('departments/edit', [

            'title' => 'Edit Jurusan',

            'department' => $this->departmentModel->find($id)

        ]);
    }

    public function update($id)
    {
        $this->departmentModel->update($id, [
            'department_code' => $this->request->getPost('department_code'),
            'department_name' => $this->request->getPost('department_name'),
        ]);

        return redirect()->to('/departments')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->departmentModel->delete($id);

        return redirect()->to('/departments')
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}
