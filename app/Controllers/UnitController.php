<?php

namespace App\Controllers;

use App\Models\UnitModel;

class UnitController extends BaseController
{

    protected $unit;


    public function __construct()
    {
        $this->unit = new UnitModel();
    }



    // =========================
    // TAMPIL DATA UNIT
    // =========================
    public function index()
    {
        $data = [
            'unit' => $this->unit->findAll()
        ];

        return view('unit/index', $data);
    }




    // =========================
    // FORM TAMBAH UNIT
    // =========================
    public function create()
    {
        return view('unit/create');
    }





    // =========================
    // SIMPAN DATA UNIT
    // =========================
    public function store()
    {

        $this->unit->insert([
            'nama_unit' => $this->request->getPost('nama_unit'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'status' => $this->request->getPost('status')
        ]);


        return redirect()->to('/unit');
    }





    // =========================
    // FORM EDIT UNIT
    // =========================
    public function edit($id)
    {

        $data = [
            'unit' => $this->unit->find($id)
        ];


        if (!$data['unit']) {

            return redirect()->to('/unit')
                ->with('error','Data unit tidak ditemukan');

        }


        return view('unit/edit', $data);
    }





    // =========================
    // UPDATE DATA UNIT
    // =========================
    public function update($id)
    {

        $this->unit->update($id, [

            'nama_unit' => $this->request->getPost('nama_unit'),

            'deskripsi' => $this->request->getPost('deskripsi'),

            'status' => $this->request->getPost('status')

        ]);


        return redirect()->to('/unit');
    }





    // =========================
    // HAPUS DATA UNIT
    // =========================
    public function delete($id)
    {

        $this->unit->delete($id);


        return redirect()->to('/unit');

    }


}