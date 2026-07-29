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



    // ==========================
    // MAPPING JUDUL LAYANAN
    // ==========================

    private function mappingLayanan($judul)
    {

        $data = [

            'Permohonan Legalisir Ijazah' => [

                'unit'=>'Akademik',

                'kategori'=>'Legalisasi Dokumen',

                'layanan'=>'Legalisir Ijazah'

            ],



            'Pembuatan Surat Aktif Kuliah' => [

                'unit'=>'Akademik',

                'kategori'=>'Surat Akademik',

                'layanan'=>'Surat Aktif Kuliah'

            ],



            'Pengajuan Beasiswa Mahasiswa' => [

                'unit'=>'Kemahasiswaan',

                'kategori'=>'Beasiswa',

                'layanan'=>'Pengajuan Beasiswa'

            ],



            'Permohonan Informasi Pembayaran UKT' => [

                'unit'=>'Keuangan',

                'kategori'=>'Pembayaran',

                'layanan'=>'Pembayaran UKT'

            ],



            'Pengajuan Cicilan UKT' => [

                'unit'=>'Keuangan',

                'kategori'=>'Pembayaran',

                'layanan'=>'Cicilan UKT'

            ],



            'Permohonan Surat Bebas Pustaka' => [

                'unit'=>'Perpustakaan',

                'kategori'=>'Layanan Perpustakaan',

                'layanan'=>'Bebas Pustaka'

            ],



            'Pengajuan Perpanjangan Peminjaman Buku' => [

                'unit'=>'Perpustakaan',

                'kategori'=>'Layanan Perpustakaan',

                'layanan'=>'Perpanjangan Peminjaman Buku'

            ],



            'Pengaduan Pelayanan ULT' => [

                'unit'=>'Umum',

                'kategori'=>'Pengaduan',

                'layanan'=>'Pengaduan Pelayanan'

            ]

        ];



        return $data[$judul] ?? [

            'unit'=>'Akademik',

            'kategori'=>'Surat Akademik',

            'layanan'=>'Surat Aktif Kuliah'

        ];

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


        kategori_layanan.nama_kategori,


        unit_layanan.nama_unit


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



    ->join(
        'unit_layanan',
        'unit_layanan.id = kategori_layanan.unit_id',
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





    // DEFAULT AGAR TIDAK TAMPIL -

    if(empty($tiket['nama_unit']))
    {
        $tiket['nama_unit'] = 'Akademik';
    }


    if(empty($tiket['nama_kategori']))
    {
        $tiket['nama_kategori'] = 'Surat Akademik';
    }


    if(empty($tiket['nama_layanan']))
    {
        $tiket['nama_layanan'] = 'Surat Aktif Kuliah';
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
        penanganan_tiket.file_hasil,


        pengajuan_tiket.no_tiket,
        pengajuan_tiket.judul,
        pengajuan_tiket.deskripsi,
        pengajuan_tiket.file_pendukung,
        pengajuan_tiket.sumber,


        layanan.nama_layanan,

        kategori_layanan.nama_kategori,

        unit_layanan.nama_unit

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


    ->join(
        'unit_layanan',
        'unit_layanan.id = kategori_layanan.unit_id',
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



    // =========================
    // DEFAULT DATA JIKA KOSONG
    // =========================


    if(empty($tiket['nama_unit']))
    {
        $tiket['nama_unit'] = 'Akademik';
    }


    if(empty($tiket['nama_kategori']))
    {
        $tiket['nama_kategori'] = 'Surat Akademik';
    }


    if(empty($tiket['nama_layanan']))
    {
        $tiket['nama_layanan'] = 'Surat Aktif Kuliah';
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

    $status = $this->request->getPost('status');

    $file = $this->request->getFile('file_hasil');


    // Jika status Selesai, file wajib diupload
    if($status == 'Selesai')
    {

        if(!$file || !$file->isValid())
        {

            return redirect()
            ->back()
            ->with(
                'error',
                'Dokumen hasil wajib diupload jika status Selesai'
            );

        }

    }



    $data = [

        'status' => $status,

        'catatan' => $this->request->getPost('catatan')

    ];



    // Jika ada file upload
    if($file && $file->isValid() && !$file->hasMoved())
    {


        // Validasi ukuran 5 MB
        if($file->getSize() > 5 * 1024 * 1024)
        {

            return redirect()
            ->back()
            ->with(
                'error',
                'Ukuran file maksimal 5 MB'
            );

        }



        // Validasi ekstensi
        $allowed = [
            'pdf',
            'jpg',
            'jpeg',
            'png'
        ];



        $ext = strtolower($file->getExtension());



        if(!in_array($ext,$allowed))
        {

            return redirect()
            ->back()
            ->with(
                'error',
                'File harus PDF, JPG, JPEG, atau PNG'
            );

        }



        $namaFile = $file->getRandomName();



        $file->move(
            'uploads/hasil',
            $namaFile
        );



        $data['file_hasil'] = $namaFile;

    }



    $this->penanganan->update(
        $id,
        $data
    );



    return redirect()

    ->to('/unit-layanan/detail/'.$id)

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


            kategori_layanan.nama_kategori,


            unit_layanan.nama_unit


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



        ->join(
            'unit_layanan',
            'unit_layanan.id = kategori_layanan.unit_id',
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