<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UnitLayananModel;

class UnitLayananController extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitLayananModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Unit Layanan',
            'units' => $this->unitModel->getAllForView()
        ];
        
        return view('unit_layanan/index', $data);
    }

    public function store()
    {
        $this->unitModel->save([
            'code'      => $this->request->getPost('kode'),
            'name'      => $this->request->getPost('nama'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('telepon'),
            'is_active' => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/unit-layanan')->with('success', 'Unit Layanan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->unitModel->update($id, [
            'code'      => $this->request->getPost('kode'),
            'name'      => $this->request->getPost('nama'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('telepon'),
            'is_active' => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/unit-layanan')->with('success', 'Unit Layanan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $unit = $this->unitModel->find($id);

        if (!$unit) {
            return redirect()->to('/unit-layanan')->with('error', 'Unit layanan tidak ditemukan.');
        }

        $db = \Config\Database::connect();
        $totalCategory = $db->table('master_service_categories')
            ->where('service_unit_id', $id)
            ->countAllResults();
        $totalService = $db->table('master_services')
            ->where('service_unit_id', $id)
            ->countAllResults();

        if ($totalCategory > 0 || $totalService > 0) {
            return redirect()->to('/unit-layanan')->with(
                'error',
                'Unit layanan tidak dapat dihapus karena masih digunakan oleh '
                    . $totalCategory . ' kategori dan ' . $totalService . ' layanan.'
            );
        }

        $this->unitModel->delete($id);
        return redirect()->to('/unit-layanan')->with('success', 'Unit Layanan berhasil dihapus.');
    }
}
