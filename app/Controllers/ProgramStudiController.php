<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgramStudiModel;
use App\Models\JurusanModel;

class ProgramStudiController extends BaseController
{
    protected $model;
    protected $jurusanModel;

    public function __construct()
    {
        $this->model = new ProgramStudiModel();
        $this->jurusanModel = new JurusanModel();
    }

    public function index()
    {
        $builder = $this->model->builder();
        $builder->select('master_study_programs.*, master_departments.name as jurusan_nama');
        $builder->join('master_departments', 'master_departments.id = master_study_programs.department_id', 'left');
        $query = $builder->get();
        $data['programs'] = $query->getResultArray();
        $data['jurusans'] = $this->jurusanModel->findAll();
        return view('dashboard/program_studi', $data);
    }

    public function store()
    {
        $kode = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama_program');
        $jurusan_id = $this->request->getPost('jurusan_id');
        $jenjang = $this->request->getPost('jenjang');
        $status = $this->request->getPost('status') ?? 'Aktif';

        if (!$kode || !$nama) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kode dan Nama wajib diisi']);
        }

        $data = compact('kode', 'nama', 'jurusan_id', 'jenjang', 'status');
        // adjust keys
        $data = [
            'code' => $kode,
            'name' => $nama,
            'department_id' => $jurusan_id,
            'degree' => $jenjang,
            'is_active' => $status === 'Aktif' ? 1 : 0,
        ];

        if ($this->model->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Program Studi ditambahkan']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menambahkan']);
    }

    public function edit($id)
    {
        $p = $this->model->find($id);
        if ($p) return $this->response->setJSON(['status' => 'success', 'data' => $p]);
        return $this->response->setJSON(['status' => 'error', 'message' => 'Tidak ditemukan']);
    }

    public function update($id)
    {
        $kode = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama_program');
        $jurusan_id = $this->request->getPost('jurusan_id');
        $jenjang = $this->request->getPost('jenjang');
        $status = $this->request->getPost('status') ?? 'Aktif';

        if (!$kode || !$nama) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kode dan Nama wajib diisi']);
        }

        $data = [
            'code' => $kode,
            'name' => $nama,
            'department_id' => $jurusan_id,
            'degree' => $jenjang,
            'is_active' => $status === 'Aktif' ? 1 : 0,
        ];

        if ($this->model->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Diperbarui']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal update']);
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) return $this->response->setJSON(['status' => 'success', 'message' => 'Dihapus']);
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal hapus']);
    }
}
