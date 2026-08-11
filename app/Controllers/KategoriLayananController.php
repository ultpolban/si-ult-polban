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
            'units'    => $unitModel->findAll()
        ];
        
        return view('admin/kategori_layanan', $data);
    }

    public function store()
    {
        $this->kategoriModel->save([
            'unit_layanan_id' => $this->request->getPost('unit_layanan_id'),
            'kode'            => $this->request->getPost('kode'),
            'nama'            => $this->request->getPost('nama'),
            'icon'            => $this->request->getPost('icon'),
            'color'           => $this->request->getPost('color'),
            'status'          => $this->request->getPost('status') ?? 'Aktif',
        ]);
        return redirect()->to('/kategori-layanan')->with('success', 'Kategori Layanan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->kategoriModel->update($id, [
            'unit_layanan_id' => $this->request->getPost('unit_layanan_id'),
            'kode'            => $this->request->getPost('kode'),
            'nama'            => $this->request->getPost('nama'),
            'icon'            => $this->request->getPost('icon'),
            'color'           => $this->request->getPost('color'),
            'status'          => $this->request->getPost('status'),
        ]);
        return redirect()->to('/kategori-layanan')->with('success', 'Kategori Layanan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/kategori-layanan')->with('success', 'Kategori Layanan berhasil dihapus.');
    }
}
