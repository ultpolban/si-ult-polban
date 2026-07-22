<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\UnitKerjaModel;
use App\Models\KategoriModel;

class Layanan extends BaseController
{
    protected $layanan;
    protected $unit;
    protected $kategori;


    public function __construct()
    {
        $this->layanan = new LayananModel();
        $this->unit = new UnitKerjaModel();
        $this->kategori = new KategoriModel();
    }


    // =========================
    // TAMPIL DATA LAYANAN
    // =========================
    public function index()
    {
        $data = [
            'layanan' => $this->layanan
                ->select('layanan.*, 
                           unit_layanan.nama_unit, 
                           kategori_layanan.nama_kategori')
                ->join(
                    'unit_layanan',
                    'unit_layanan.id = layanan.unit_id'
                )
                ->join(
                    'kategori_layanan',
                    'kategori_layanan.id = layanan.kategori_id'
                )
                ->findAll()
        ];

        return view('layanan/index', $data);
    }



    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        $data = [
            'unit' => $this->unit->findAll(),
            'kategori' => $this->kategori->findAll()
        ];

        return view('layanan/create', $data);
    }



    // =========================
    // SIMPAN DATA
    // =========================
    public function store()
    {
        $this->layanan->save([
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'status' => $this->request->getPost('status'),
            'unit_id' => $this->request->getPost('unit_id'),
            'kategori_id' => $this->request->getPost('kategori_id')
        ]);

        return redirect()->to('/layanan');
    }



    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $data = [
            'layanan' => $this->layanan->find($id),
            'unit' => $this->unit->findAll(),
            'kategori' => $this->kategori->findAll()
        ];


        if (!$data['layanan']) {
            return redirect()->to('/layanan')
                ->with('error','Data layanan tidak ditemukan');
        }


        return view('layanan/edit', $data);
    }



    // =========================
    // UPDATE DATA
    // =========================
    public function update($id)
    {
        $this->layanan->update($id, [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'status' => $this->request->getPost('status'),
            'unit_id' => $this->request->getPost('unit_id'),
            'kategori_id' => $this->request->getPost('kategori_id')
        ]);


        return redirect()->to('/layanan');
    }



    // =========================
    // DELETE DATA
    // =========================
    public function delete($id)
    {
        $this->layanan->delete($id);

        return redirect()->to('/layanan');
    }

}