<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PengajuanLayananModel;
// use App\Models\LayananModel; // Assuming we will need this later

class PengajuanLayananController extends BaseController
{
    protected $pengajuanModel;

    public function __construct()
    {
        $this->pengajuanModel = new PengajuanLayananModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Pengajuan Layanan',
            'pengajuan' => $this->pengajuanModel->getPengajuanWithDetails()
        ];
        return view('pengajuan/index', $data);
    }

    public function create()
    {
        // For the dropdown we might need Layanan data
        // $layananModel = new \App\Models\LayananModel();
        // $layanans = $layananModel->findAll();
        // Since we don't have layanans yet, let's use a dummy array for the view for now
        $layanans = [
            ['id' => 1, 'name' => 'Pembuatan Surat Keterangan'],
            ['id' => 2, 'name' => 'Pengajuan Cuti Akademik'],
            ['id' => 3, 'name' => 'Legalisir Ijazah']
        ];

        $data = [
            'title'    => 'Buat Pengajuan',
            'layanans' => $layanans
        ];
        return view('pengajuan/create', $data);
    }

    public function store()
    {
        // Validate
        $rules = [
            'layanan_id' => 'required|integer',
            'judul'      => 'required|max_length[255]',
            'prioritas'  => 'required|in_list[Normal,Penting,Mendesak]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Generate tiket
        $tiket = 'TKT-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 4));

        $data = [
            'tiket'      => $tiket,
            'user_id'    => session()->get('id') ?? 1, // Fallback to 1 for dev if not logged in
            'layanan_id' => $this->request->getPost('layanan_id'),
            'judul'      => $this->request->getPost('judul'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'prioritas'  => $this->request->getPost('prioritas'),
            'status'     => 'Pending',
        ];

        $this->pengajuanModel->insert($data);

        return redirect()->to('/pengajuan-layanan')->with('success', 'Pengajuan Layanan berhasil dibuat!');
    }
}
