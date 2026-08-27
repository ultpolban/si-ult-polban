<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengajuanLayananModel;
use App\Models\LayananModel;
use App\Models\UnitLayananModel;
use App\Models\PersyaratanLayananModel;

class PengajuanLayananController extends BaseController
{
    protected $pengajuanModel;
    protected $layananModel;
    protected $unitLayananModel;
    protected $persyaratanModel;

    public function __construct()
    {
        $this->pengajuanModel   = new PengajuanLayananModel();
        $this->layananModel     = new LayananModel();
        $this->unitLayananModel = new UnitLayananModel();
        $this->persyaratanModel = new PersyaratanLayananModel();
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
        $data = [
            'title'        => 'Buat Pengajuan',
            'unitLayanans' => $this->unitLayananModel->where('is_active', 1)->orderBy('name', 'ASC')->findAll(),
        ];
        return view('pengajuan/create', $data);
    }

    /**
     * AJAX: Ambil daftar layanan berdasarkan unit layanan
     */
    public function getLayananByUnit(int $unitId)
    {
        $layanan = $this->layananModel
            ->where('service_unit_id', $unitId)
            ->where('is_active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->response->setJSON($layanan);
    }

    /**
     * AJAX: Ambil persyaratan berdasarkan layanan yang dipilih
     */
    public function getPersyaratanByLayanan(int $layananId)
    {
        $persyaratan = $this->persyaratanModel
            ->where('service_id', $layananId)
            ->where('is_active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->response->setJSON($persyaratan);
    }

    public function store()
    {
        $rules = [
            'unit_layanan_id' => 'required|integer',
            'layanan_id'      => 'required|integer',
            'judul'           => 'required|max_length[255]',
            'prioritas'       => 'required|in_list[Normal,Penting,Mendesak]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // --- Dapatkan user_profile_id ---
        $userId = (int) (session()->get('user_id') ?? 0);
        $db = \Config\Database::connect();

        // Cari user_profile berdasarkan user_id
        $profile = $db->table('user_profiles')->where('user_id', $userId)->get()->getRowArray();

        if (!$profile) {
            // Belum ada profil → buat otomatis dari data user
            $user = $db->table('users')->where('id', $userId)->get()->getRowArray();
            $db->table('user_profiles')->insert([
                'user_id'    => $userId,
                'name'       => $user['full_name'] ?? 'User',
                'email'      => $user['email'] ?? '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $userProfileId = $db->insertID();
        } else {
            $userProfileId = $profile['id'];
        }

        $tiket = 'TKT-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 4));

        $priorityMap = [
            'Normal'   => 'normal',
            'Penting'  => 'high',
            'Mendesak' => 'urgent'
        ];
        $priority = $priorityMap[$this->request->getPost('prioritas')] ?? 'normal';

        $data = [
            'ticket_number'   => $tiket,
            'user_profile_id' => $userProfileId,
            'service_id'      => $this->request->getPost('layanan_id'),
            'title'           => $this->request->getPost('judul'),
            'description'     => $this->request->getPost('deskripsi'),
            'priority'        => $priority,
            'status'          => 'submitted',
        ];

        $this->pengajuanModel->insert($data);

        return redirect()->to('/pengajuan-layanan')->with('success', 'Pengajuan Layanan berhasil dibuat! Nomor Tiket: ' . $tiket);
    }
}
