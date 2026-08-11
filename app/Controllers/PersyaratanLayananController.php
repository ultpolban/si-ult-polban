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
            'layanans'    => $layananModel->findAll()
        ];
        
        return view('admin/persyaratan_layanan', $data);
    }

    public function store()
    {
        $this->persyaratanModel->save([
            'layanan_id'  => $this->request->getPost('layanan_id'),
            'persyaratan' => $this->request->getPost('persyaratan'),
            'tipe_file'   => $this->request->getPost('tipe_file'),
            'ukuran'      => $this->request->getPost('ukuran'),
            'wajib'       => $this->request->getPost('wajib'),
            'status'      => $this->request->getPost('status') ?? 'Aktif',
        ]);
        return redirect()->to('/persyaratan-layanan')->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->persyaratanModel->update($id, [
            'layanan_id'  => $this->request->getPost('layanan_id'),
            'persyaratan' => $this->request->getPost('persyaratan'),
            'tipe_file'   => $this->request->getPost('tipe_file'),
            'ukuran'      => $this->request->getPost('ukuran'),
            'wajib'       => $this->request->getPost('wajib'),
            'status'      => $this->request->getPost('status'),
        ]);
        return redirect()->to('/persyaratan-layanan')->with('success', 'Persyaratan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->persyaratanModel->delete($id);
        return redirect()->to('/persyaratan-layanan')->with('success', 'Persyaratan berhasil dihapus.');
    }
}
