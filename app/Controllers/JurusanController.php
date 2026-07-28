<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;

class JurusanController extends BaseController
{
    protected $jurusanModel;

    public function __construct()
    {
        $this->jurusanModel = new JurusanModel();
    }

    public function index()
    {
        $data['jurusans'] = $this->jurusanModel->findAll();
        return view('dashboard/jurusan', $data);
    }

    public function store()
    {
        $kode = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama_jurusan');

        if (empty($kode) || empty($nama)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Kode dan Nama jurusan tidak boleh kosong!'
            ]);
        }

        $data = [
            'kode' => $kode,
            'nama_jurusan' => $nama
        ];

        if ($this->jurusanModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Jurusan berhasil ditambahkan'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menambahkan jurusan'
        ]);
    }

    public function edit($id)
    {
        $jurusan = $this->jurusanModel->find($id);

        if ($jurusan) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $jurusan
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Jurusan tidak ditemukan'
        ]);
    }

    public function update($id)
    {
        $kode = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama_jurusan');

        if (empty($kode) || empty($nama)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Kode dan Nama jurusan tidak boleh kosong!'
            ]);
        }

        $data = [
            'kode' => $kode,
            'nama_jurusan' => $nama
        ];

        if ($this->jurusanModel->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Jurusan berhasil diperbarui'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal memperbarui jurusan'
        ]);
    }

    public function delete($id)
    {
        if ($this->jurusanModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Jurusan berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menghapus jurusan'
        ]);
    }
}
