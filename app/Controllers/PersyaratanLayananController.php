<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PersyaratanLayananModel;

class PersyaratanLayananController extends BaseController
{
    protected $persyaratanModel;

    public function __construct()
    {
        $this->persyaratanModel = new PersyaratanLayananModel();
    }

    public function index()
    {
        $layananModel = new \App\Models\LayananModel();
        
        $data = [
            'title'       => 'Master Persyaratan Layanan',
            'persyaratan' => $this->persyaratanModel->getPersyaratanWithLayanan(),
            'layanans'    => array_map(static function (array $row): array {
                $row['nama'] = $row['nama'] ?? $row['name'] ?? '';
                return $row;
            }, $layananModel->findAll())
        ];
        
        return view('admin/persyaratan_layanan', $data);
    }

    public function store()
    {
        $this->persyaratanModel->save([
            'service_id'          => $this->request->getPost('layanan_id'),
            'name'                => $this->request->getPost('persyaratan'),
            'file_type'           => $this->request->getPost('tipe_file') ?? 'pdf',
            'max_file_size'       => $this->request->getPost('ukuran') ?? 2048,
            'is_required'         => $this->request->getPost('wajib') ? 1 : 0,
            'allowed_extensions'  => $this->request->getPost('tipe_file'),
            'is_active'           => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/persyaratan-layanan')->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->persyaratanModel->update($id, [
            'service_id'          => $this->request->getPost('layanan_id'),
            'name'                => $this->request->getPost('persyaratan'),
            'file_type'           => $this->request->getPost('tipe_file') ?? 'pdf',
            'max_file_size'       => $this->request->getPost('ukuran') ?? 2048,
            'is_required'         => $this->request->getPost('wajib') ? 1 : 0,
            'allowed_extensions'  => $this->request->getPost('tipe_file'),
            'is_active'           => $this->request->getPost('status') === 'Aktif' ? 1 : 0,
        ]);
        return redirect()->to('/persyaratan-layanan')->with('success', 'Persyaratan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->persyaratanModel->delete($id);
        return redirect()->to('/persyaratan-layanan')->with('success', 'Persyaratan berhasil dihapus.');
    }
}
