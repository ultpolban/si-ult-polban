<?php

namespace App\Controllers;

use App\Models\WorkUnitModel;

class WorkUnitController extends BaseController
{
    protected $workUnitModel;

    public function __construct()
    {
        $this->workUnitModel = new WorkUnitModel();
    }

    public function index()
    {
        return view('work_units/index', [

            'title' => 'Management Unit Kerja',

            'units' => $this->workUnitModel
                ->orderBy('unit_name', 'ASC')
                ->findAll()

        ]);
    }

    public function create()
    {
        return view('work_units/create', [
            'title' => 'Tambah Unit Kerja'
        ]);
    }

    public function store()
    {
        $this->workUnitModel->save([

            'unit_code' => $this->request->getPost('unit_code'),

            'unit_name' => $this->request->getPost('unit_name'),

            'description' => $this->request->getPost('description'),

            'status' => $this->request->getPost('status')

        ]);

        return redirect()->to('/work-units')
            ->with('success', 'Unit Kerja berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('work_units/edit', [

            'title' => 'Edit Unit Kerja',

            'unit' => $this->workUnitModel->find($id)

        ]);
    }

    public function update($id)
    {
        $this->workUnitModel->update($id, [

            'unit_code' => $this->request->getPost('unit_code'),

            'unit_name' => $this->request->getPost('unit_name'),

            'description' => $this->request->getPost('description'),

            'status' => $this->request->getPost('status')

        ]);

        return redirect()->to('/work-units')
            ->with('success', 'Unit Kerja berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->workUnitModel->delete($id);

        return redirect()
            ->to('/work-units')
            ->with('success', 'Unit kerja berhasil dihapus.');
    }
}
