<?php

namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\MasterApplicantTypeModel;

class ApplicantTypesController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MasterApplicantTypeModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Jenis Pemohon',
            'types' => $this->model->orderBy('name', 'ASC')->findAll()
        ];
        
        return view('management/applicant_types/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jenis Pemohon'
        ];
        
        return view('management/applicant_types/create', $data);
    }

    public function store()
    {
        $rules = [
            'code' => 'required|max_length[20]|is_unique[master_applicant_types.code]',
            'name' => 'required|max_length[100]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'is_active' => 1
        ]);

        return redirect()->to('/management/applicant-types')->with('message', 'Jenis pemohon berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Jenis Pemohon',
            'type' => $this->model->find($id)
        ];
        
        return view('management/applicant_types/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'code' => "required|max_length[20]|is_unique[master_applicant_types.code,id,{$id}]",
            'name' => 'required|max_length[100]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/management/applicant-types')->with('message', 'Jenis pemohon berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/management/applicant-types')->with('message', 'Jenis pemohon berhasil dihapus');
    }
}