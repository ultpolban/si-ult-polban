<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LayananModel;

class LayananController extends BaseController
{
    protected $layananModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
    }

    public function index()
    {
        $unitModel = new \App\Models\UnitLayananModel();
        $kategoriModel = new \App\Models\KategoriLayananModel();
        
        $data = [
            'title'    => 'Master Layanan',
            'layanan'  => $this->layananModel->getLayananWithRelations(),
            'units'    => $unitModel->findAll(),
            'kategori' => $kategoriModel->findAll()
        ];
        
        return view('admin/layanan', $data);
    }

    public function store()
    {
        $this->layananModel->save([
            'unit_layanan_id'     => $this->request->getPost('unit_layanan_id'),
            'kategori_layanan_id' => $this->request->getPost('kategori_layanan_id'),
            'kode'                => $this->request->getPost('kode'),
            'nama'                => $this->request->getPost('nama'),
            'sla'                 => $this->request->getPost('sla'),
            'online'              => $this->request->getPost('online') ?? 'Online',
            'status'              => $this->request->getPost('status') ?? 'Aktif',
        ]);
        return redirect()->to('/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->layananModel->update($id, [
            'unit_layanan_id'     => $this->request->getPost('unit_layanan_id'),
            'kategori_layanan_id' => $this->request->getPost('kategori_layanan_id'),
            'kode'                => $this->request->getPost('kode'),
            'nama'                => $this->request->getPost('nama'),
            'sla'                 => $this->request->getPost('sla'),
            'online'              => $this->request->getPost('online'),
            'status'              => $this->request->getPost('status'),
        ]);
        return redirect()->to('/layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->layananModel->delete($id);
        return redirect()->to('/layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}
