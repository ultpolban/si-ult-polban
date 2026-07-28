<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class UnitController extends BaseController
{
    protected $unitModel;
    protected $db;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
        $this->db = \Config\Database::connect();
    }

    // Menampilkan daftar unit
    public function index()
    {
        $data['units'] = $this->unitModel->findAll();
        return view('dashboard/unit', $data);
    }

    // Tambah unit (AJAX)
    public function store()
    {
        $unit_name = $this->request->getPost('unit_name');
        $description = $this->request->getPost('description');

        if (empty($unit_name)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Nama unit tidak boleh kosong!'
            ]);
        }

        $data = [
            'unit_name' => $unit_name,
            'description' => $description
        ];

        if ($this->unitModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Unit berhasil ditambahkan'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menambahkan unit'
        ]);
    }

    // Edit unit (AJAX)
    public function edit($id)
    {
        $unit = $this->unitModel->find($id);

        if ($unit) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $unit
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Unit tidak ditemukan'
        ]);
    }

    // Update unit (AJAX)
    public function update($id)
    {
        $unit_name = $this->request->getPost('unit_name');
        $description = $this->request->getPost('description');

        if (empty($unit_name)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Nama unit tidak boleh kosong!'
            ]);
        }

        $data = [
            'unit_name' => $unit_name,
            'description' => $description
        ];

        if ($this->unitModel->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Unit berhasil diperbarui'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal memperbarui unit'
        ]);
    }

    // Hapus unit (AJAX)
    public function delete($id)
    {
        if ($this->unitModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Unit berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menghapus unit'
        ]);
    }
}
