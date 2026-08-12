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
            'units'    => $unitModel->getAllForView(),
            'kategori' => array_map(static function (array $row): array {
                $row['kode'] = $row['kode'] ?? $row['code'] ?? '';
                $row['nama'] = $row['nama'] ?? $row['name'] ?? '';
                return $row;
            }, $kategoriModel->findAll())
        ];
        
        return view('admin/layanan', $data);
    }

    public function store()
    {
        $this->layananModel->save([
            'service_unit_id'     => $this->request->getPost('unit_layanan_id'),
            'service_category_id' => $this->request->getPost('kategori_layanan_id'),
            'code'                => $this->request->getPost('kode'),
            'name'                => $this->request->getPost('nama'),
            'service_hours'       => $this->request->getPost('sla') ?? 24,
            'is_online'           => $this->request->getPost('online') === 'Online' ? 1 : 0,
            'is_active'           => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->layananModel->update($id, [
            'service_unit_id'     => $this->request->getPost('unit_layanan_id'),
            'service_category_id' => $this->request->getPost('kategori_layanan_id'),
            'code'                => $this->request->getPost('kode'),
            'name'                => $this->request->getPost('nama'),
            'service_hours'       => $this->request->getPost('sla') ?? 24,
            'is_online'           => $this->request->getPost('online') === 'Online' ? 1 : 0,
            'is_active'           => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->layananModel->delete($id);
        return redirect()->to('/layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}
