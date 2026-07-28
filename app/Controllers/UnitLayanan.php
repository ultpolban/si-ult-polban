<?php

namespace App\Controllers;

use App\Models\PenangananTiketModel;

class UnitLayanan extends BaseController
{

    protected $penanganan;


    public function __construct()
    {
        $this->penanganan = new PenangananTiketModel();
    }



    public function index()
    {

        $data = [

            'title'=>'Dashboard Unit Layanan',

            'tiket'=>$this->penanganan->getTiketUnit()

        ];


        return view(
            'unit_layanan/index',
            $data
        );

    }




    public function detail($id)
    {

        $tiket = $this->penanganan

        ->select('

            penanganan_tiket.id,
            penanganan_tiket.status,
            penanganan_tiket.catatan,
            penanganan_tiket.file_hasil,


            pengajuan_tiket.no_tiket,
            pengajuan_tiket.judul,
            pengajuan_tiket.deskripsi,
            pengajuan_tiket.file_pendukung,
            pengajuan_tiket.sumber,


            layanan.nama_layanan,

            kategori_layanan.nama_kategori

        ')


        ->join(
            'pengajuan_tiket',
            'pengajuan_tiket.id = penanganan_tiket.tiket_id'
        )


        ->join(
            'layanan',
            'layanan.id = pengajuan_tiket.layanan_id',
            'left'
        )


        ->join(
            'kategori_layanan',
            'kategori_layanan.id = layanan.kategori_id',
            'left'
        )


        ->where(
            'penanganan_tiket.id',
            $id
        )


        ->first();



        if(!$tiket)
        {

            return redirect()
            ->to('/unit-layanan')
            ->with(
                'error',
                'Data tiket tidak ditemukan'
            );

        }



        return view(
            'unit_layanan/detail',
            [

                'title'=>'Detail Tiket Unit Layanan',

                'tiket'=>$tiket

            ]
        );

    }







    public function proses($id)
    {


        $tiket = $this->penanganan

        ->select('

            penanganan_tiket.id,
            penanganan_tiket.status,
            penanganan_tiket.catatan,


            pengajuan_tiket.no_tiket,
            pengajuan_tiket.judul,
            pengajuan_tiket.deskripsi,
            pengajuan_tiket.file_pendukung,
            pengajuan_tiket.sumber,


            layanan.nama_layanan,

            kategori_layanan.nama_kategori

        ')


        ->join(
            'pengajuan_tiket',
            'pengajuan_tiket.id = penanganan_tiket.tiket_id'
        )


        ->join(
            'layanan',
            'layanan.id = pengajuan_tiket.layanan_id',
            'left'
        )


        ->join(
            'kategori_layanan',
            'kategori_layanan.id = layanan.kategori_id',
            'left'
        )


        ->where(
            'penanganan_tiket.id',
            $id
        )


        ->first();



        if(!$tiket)
        {

            return redirect()
            ->to('/unit-layanan')
            ->with(
                'error',
                'Data tiket tidak ditemukan'
            );

        }



        return view(
            'unit_layanan/proses',
            [

                'title'=>'Proses Tiket Unit Layanan',

                'tiket'=>$tiket

            ]
        );


    }







    // SIMPAN HASIL PROSES TIKET

    public function updateProses($id)
    {


        $this->penanganan->update(

            $id,

            [

                'status'=>$this->request->getPost('status'),

                'catatan'=>$this->request->getPost('catatan')

            ]

        );



        return redirect()

        ->to(
            '/unit-layanan/detail/'.$id
        )

        ->with(

            'success',

            'Tiket berhasil diproses'

        );


    }









    // HALAMAN UPLOAD HASIL

    public function upload($id)
    {


        $tiket = $this->penanganan

        ->where(
            'id',
            $id
        )

        ->first();



        if(!$tiket)
        {

            return redirect()
            ->to('/unit-layanan');

        }



        return view(

            'unit_layanan/upload',

            [

                'title'=>'Upload Hasil Dokumen',

                'tiket'=>$tiket

            ]

        );


    }









    // SIMPAN FILE HASIL

    public function simpanUpload($id)
    {


        $file = $this->request->getFile('file_hasil');



        if($file && $file->isValid())
        {


            $namaFile = $file->getRandomName();



            $file->move(

                'uploads/hasil',

                $namaFile

            );



            $this->penanganan->update(

                $id,

                [

                    'file_hasil'=>$namaFile,

                    'status'=>'Selesai'

                ]

            );


        }



        return redirect()

        ->to(

            '/unit-layanan/detail/'.$id

        )

        ->with(

            'success',

            'Dokumen berhasil diupload'

        );


    }









    // KIRIM KE PETUGAS ULT

    public function kirim($id)
    {


        $this->penanganan->update(

            $id,

            [

                'status'=>'Menunggu Petugas ULT'

            ]

        );



        return redirect()

        ->to(

            '/unit-layanan/detail/'.$id

        )

        ->with(

            'success',

            'Tiket berhasil dikirim ke Petugas ULT'

        );


    }









    public function riwayat()
    {


        $data = [


            'title'=>'Riwayat Tiket Unit Layanan',


            'tiket'=>$this->penanganan

            ->select('

                penanganan_tiket.*,

                pengajuan_tiket.no_tiket,

                pengajuan_tiket.judul

            ')


            ->join(

                'pengajuan_tiket',

                'pengajuan_tiket.id = penanganan_tiket.tiket_id'

            )


            ->orderBy(

                'penanganan_tiket.id',

                'DESC'

            )


            ->findAll()


        ];



        return view(

            'unit_layanan/riwayat',

            $data

        );


    }









    public function dashboard()
    {


        $data = [


            'title'=>'Dashboard Unit Layanan',



            'menunggu'=>$this->penanganan

            ->where('status','Menunggu')

            ->countAllResults(),



            'diproses'=>$this->penanganan

            ->where('status','Diproses')

            ->countAllResults(),



            'selesai'=>$this->penanganan

            ->where('status','Selesai')

            ->countAllResults(),



            'total'=>$this->penanganan

            ->countAllResults(),



            'tiket'=>$this->penanganan

            ->select('

                penanganan_tiket.id,

                penanganan_tiket.status,

                pengajuan_tiket.no_tiket,

                pengajuan_tiket.judul,

                layanan.nama_layanan,

                kategori_layanan.nama_kategori

            ')


            ->join(

                'pengajuan_tiket',

                'pengajuan_tiket.id = penanganan_tiket.tiket_id'

            )


            ->join(

                'layanan',

                'layanan.id = pengajuan_tiket.layanan_id',

                'left'

            )


            ->join(

                'kategori_layanan',

                'kategori_layanan.id = layanan.kategori_id',

                'left'

            )


            ->orderBy(

                'penanganan_tiket.id',

                'DESC'

            )


            ->findAll()


        ];



        return view(

            'unit_layanan/dashboard',

            $data

        );


    }


}