<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\UnitKerjaModel;


class KategoriController extends BaseController
{

    protected $kategori;
    protected $unit;


    public function __construct()
    {

        $this->kategori = new KategoriModel();

        $this->unit = new UnitKerjaModel();

    }



    // ============================
    // TAMPIL DATA
    // ============================

    public function index()
    {


        $data = [

            'kategori' => $this->kategori

                ->select('
                    kategori_layanan.*,
                    unit_layanan.nama_unit
                ')

                ->join(
                    'unit_layanan',
                    'unit_layanan.id = kategori_layanan.unit_id',
                    'left'
                )

                ->findAll()

        ];



        return view(
            'kategori/index',
            $data
        );


    }





    // ============================
    // FORM TAMBAH
    // ============================

    public function create()
    {


        $data = [


            'unit'=>$this->unit->findAll()


        ];



        return view(
            'kategori/create',
            $data
        );


    }





    // ============================
    // SIMPAN
    // ============================

    public function store()
    {


        $unit_id = $this->request->getPost('unit_id');



        // cek unit ada atau tidak

        $cekUnit = $this->unit

            ->where(
                'id',
                $unit_id
            )

            ->first();



        if(!$cekUnit)
        {


            return redirect()
            ->back()
            ->with(
                'error',
                'Unit layanan tidak ditemukan'
            );


        }





        $this->kategori->insert([


            'unit_id'=>$unit_id,


            'nama_kategori'=>$this->request->getPost('nama_kategori'),


            'deskripsi'=>$this->request->getPost('deskripsi'),


            'status'=>$this->request->getPost('status')


        ]);





        return redirect()
        ->to('/kategori')
        ->with(
            'success',
            'Kategori berhasil ditambahkan'
        );


    }






    // ============================
    // FORM EDIT
    // ============================

    public function edit($id)
    {


        $data = [


            'kategori'=>$this->kategori->find($id),


            'unit'=>$this->unit->findAll()


        ];



        return view(
            'kategori/edit',
            $data
        );


    }





    // ============================
    // UPDATE
    // ============================

    public function update($id)
    {


        $this->kategori->update(

            $id,

            [


                'unit_id'=>$this->request->getPost('unit_id'),


                'nama_kategori'=>$this->request->getPost('nama_kategori'),


                'deskripsi'=>$this->request->getPost('deskripsi'),


                'status'=>$this->request->getPost('status')


            ]

        );



        return redirect()
        ->to('/kategori');


    }






    // ============================
    // DELETE
    // ============================

    public function delete($id)
    {


        $this->kategori->delete($id);


        return redirect()
        ->to('/kategori');


    }


}