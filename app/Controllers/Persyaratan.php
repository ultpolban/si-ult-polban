<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersyaratanModel;
use App\Models\LayananModel;


class Persyaratan extends BaseController
{

    protected $persyaratan;
    protected $layanan;


    public function __construct()
    {
        $this->persyaratan = new PersyaratanModel();
        $this->layanan = new LayananModel();
    }



    // =========================
    // TAMPIL DATA
    // =========================
    public function index()
    {

        $data = [

            'title' => 'Persyaratan Layanan',

            'persyaratan' => $this->persyaratan->getPersyaratan()

        ];


        return view(
            'persyaratan/index',
            $data
        );

    }




    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {

        $data = [

            'title' => 'Tambah Persyaratan',

            'layanan' => $this->layanan->findAll()

        ];


        return view(
            'persyaratan/create',
            $data
        );

    }




    // =========================
    // SIMPAN DATA
    // =========================
    public function store()
    {

        $this->persyaratan->insert([


            'layanan_id' => 
            $this->request->getPost('layanan_id'),


            'nama_persyaratan' =>
            $this->request->getPost('nama_persyaratan'),


            'keterangan' =>
            $this->request->getPost('keterangan'),


            'status' =>
            $this->request->getPost('status')


        ]);


        return redirect()
            ->to('/persyaratan')
            ->with(
                'success',
                'Persyaratan berhasil ditambahkan'
            );

    }




    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {


        $data = [

            'title' => 'Edit Persyaratan',

            'persyaratan' =>
            $this->persyaratan->find($id),


            'layanan' =>
            $this->layanan->findAll()

        ];



        return view(
            'persyaratan/edit',
            $data
        );

    }





    // =========================
    // UPDATE DATA
    // =========================
    public function update($id)
    {


        $this->persyaratan->update(
            $id,
            [


            'layanan_id' =>
            $this->request->getPost('layanan_id'),


            'nama_persyaratan' =>
            $this->request->getPost('nama_persyaratan'),


            'keterangan' =>
            $this->request->getPost('keterangan'),


            'status' =>
            $this->request->getPost('status')


            ]
        );



        return redirect()
            ->to('/persyaratan')
            ->with(
                'success',
                'Persyaratan berhasil diperbarui'
            );

    }




    // =========================
    // HAPUS DATA
    // =========================
    public function delete($id)
    {


        $this->persyaratan->delete($id);



        return redirect()
            ->to('/persyaratan')
            ->with(
                'success',
                'Persyaratan berhasil dihapus'
            );


    }



}