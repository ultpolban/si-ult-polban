<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriLayananModel;

class KategoriLayananController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriLayananModel();
    }

    public function index()
    {
        // For the dropdown in Modal Tambah/Edit
        $unitModel = new \App\Models\UnitLayananModel();
        
        $data = [
            'title'    => 'Master Kategori Layanan',
            'kategori' => $this->kategoriModel->getKategoriWithUnit(),
            'units'    => $unitModel->getAllForView()
        ];
        
        return view('admin/kategori_layanan', $data);
    }

    public function store()
    {
        $this->kategoriModel->save([
            'service_unit_id' => $this->request->getPost('unit_layanan_id'),
            'code'            => $this->request->getPost('kode'),
            'name'            => $this->request->getPost('nama'),
            'icon'            => $this->request->getPost('icon'),
            'color'           => $this->request->getPost('color'),
            'is_active'       => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/kategori-layanan')->with('success', 'Kategori Layanan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->kategoriModel->update($id, [
            'service_unit_id' => $this->request->getPost('unit_layanan_id'),
            'code'            => $this->request->getPost('kode'),
            'name'            => $this->request->getPost('nama'),
            'icon'            => $this->request->getPost('icon'),
            'color'           => $this->request->getPost('color'),
            'is_active'       => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/kategori-layanan')->with('success', 'Kategori Layanan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/kategori-layanan')->with('success', 'Kategori Layanan berhasil dihapus.');
    }
}
