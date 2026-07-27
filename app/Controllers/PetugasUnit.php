<?php

namespace App\Controllers;

use App\Models\PenangananModel;


class PetugasUnit extends BaseController
{

    protected $penanganan;


    public function __construct()
    {
        $this->penanganan = new PenangananModel();
    }



    public function index()
    {

        $data = [
            'title' => 'Tiket Masuk Unit',
            'tiket' => $this->penanganan->getTiketUnit()
        ];


        return view(
            'petugas_unit/index',
            $data
        );

    }




    public function proses($id)
    {

        $data = [
            'title' => 'Proses Tiket',
            'tiket' => $this->penanganan->find($id)
        ];


        return view(
            'petugas_unit/proses',
            $data
        );

    }





    public function update($id)
    {

        $file = $this->request->getFile('file_hasil');


        $namaFile = null;


        if($file && $file->isValid())
        {

            $namaFile = $file->getName();


            $file->move(
                'uploads/hasil',
                $namaFile
            );

        }



        $this->penanganan->update(
            $id,
            [
                'status' => $this->request->getPost('status'),
                'catatan' => $this->request->getPost('catatan'),
                'file_hasil' => $namaFile
            ]
        );



        return redirect()
            ->to('/petugas-unit');

    }

}