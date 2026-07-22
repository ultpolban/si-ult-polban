<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitKerjaModel;

class UnitKerjaController extends BaseController
{

    protected $unit;


    public function __construct()
    {
        $this->unit = new UnitKerjaModel();
    }



    public function index()
    {

        $data = [
            'unit' => $this->unit->findAll()
        ];


        return view('unit/index', $data);

    }



    public function create()
    {

        return view('unit/create');

    }



    public function store()
    {

        $this->unit->insert([

            'nama_unit' => $this->request->getPost('nama_unit'),

            'deskripsi' => $this->request->getPost('deskripsi'),

            'status' => $this->request->getPost('status')

        ]);


        return redirect()->to('/unit');

    }



    public function delete($id)
    {

        $this->unit->delete($id);


        return redirect()->to('/unit');

    }


}