<?php

namespace App\Controllers;

class OrangTuaDraftController extends BaseController
{

    public function index()
    {

        $data['draft'] = [

            [
                'id' => 1,
                'unit' => 'Akademik',
                'layanan' => 'Surat Aktif Kuliah',
                'keterangan' => 'Mohon dibuatkan surat aktif kuliah',
                'dokumen' => 'Tidak ada',
                'status' => 'Draft',
                'tanggal' => '07-08-2026 10:30'
            ],

            [
                'id' => 2,
                'unit' => 'Kemahasiswaan',
                'layanan' => 'Beasiswa',
                'keterangan' => 'Pengajuan KIP',
                'dokumen' => 'kip.pdf',
                'status' => 'Draft',
                'tanggal' => '07-08-2026 11:00'
            ]

        ];

        return view('orangtua/draft/index',$data);

    }

    public function edit($id)
    {
        return redirect()->to('/orangtua/ticket/create');
    }

    public function delete($id)
    {
        return redirect()->to('/orangtua/draft')
        ->with('success','Draft berhasil dihapus.');
    }

}