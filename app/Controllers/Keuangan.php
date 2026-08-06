<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenangananTiketModel;

class Keuangan extends BaseController
{
    protected $penangananTiketModel;

    public function __construct()
    {
        $this->penangananTiketModel = new PenangananTiketModel();
    }


    public function index()
    {
        return $this->dashboard();
    }


    public function dashboard()
    {
        $unitName = 'Keuangan';

        $query = $this->penangananTiketModel
            ->select('
                penanganan_tiket.id,
                penanganan_tiket.status,
                penanganan_tiket.created_at,
                pengajuan_tiket.no_tiket,
                pengajuan_tiket.nama_pemohon,
                pengajuan_tiket.nim,
                pengajuan_tiket.judul,
                layanan.nama_layanan,
                unit_layanan.nama_unit
            ')
            ->join(
                'pengajuan_tiket',
                'pengajuan_tiket.id = penanganan_tiket.tiket_id',
                'left'
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
                'unit_layanan.nama_unit',
                $unitName
            )
            ->orderBy(
                'penanganan_tiket.id',
                'DESC'
            );


        $tiket = $query->findAll();


        $data = [
            'title' => 'Dashboard Keuangan',
            'total' => count($tiket),
            'menunggu' => 0,
            'diproses' => 0,
            'selesai' => 0,
            'tiket' => $tiket
        ];


        foreach ($tiket as $item) {

            if (($item['status'] ?? '') == 'Menunggu') {

                $data['menunggu']++;

            } elseif (($item['status'] ?? '') == 'Diproses') {

                $data['diproses']++;

            } elseif (($item['status'] ?? '') == 'Selesai') {

                $data['selesai']++;

            }

        }


        return view('keuangan/dashboard', $data);
    }

    public function detail($id)
{
    $tiket = $this->penangananTiketModel
        ->select('
            penanganan_tiket.*,
            pengajuan_tiket.no_tiket,
            pengajuan_tiket.nama_pemohon,
            pengajuan_tiket.nim,
            pengajuan_tiket.judul,
            pengajuan_tiket.deskripsi,
            layanan.nama_layanan,
            kategori_layanan.nama_kategori,
            unit_layanan.nama_unit
        ')
        ->join(
            'pengajuan_tiket',
            'pengajuan_tiket.id = penanganan_tiket.tiket_id',
            'left'
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
        ->where('penanganan_tiket.id', $id)
        ->first();


    if (!$tiket) {
        return redirect()->to('/keuangan')
            ->with('error','Data tiket tidak ditemukan');
    }


    return view('keuangan/detail', [
        'title' => 'Detail Tiket Keuangan',
        'tiket' => $tiket
    ]);
}

public function proses($id)
{
    $tiket = $this->penangananTiketModel
        ->select('
            penanganan_tiket.*,
            pengajuan_tiket.no_tiket,
            pengajuan_tiket.judul,
            pengajuan_tiket.deskripsi,
            layanan.nama_layanan,
            kategori_layanan.nama_kategori,
            unit_layanan.nama_unit
        ')
        ->join(
            'pengajuan_tiket',
            'pengajuan_tiket.id = penanganan_tiket.tiket_id',
            'left'
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
        ->where('penanganan_tiket.id', $id)
        ->first();


    if (!$tiket) {
        return redirect()->to('/keuangan')
            ->with('error', 'Data tiket tidak ditemukan');
    }


    return view('keuangan/proses', [
        'title' => 'Proses Tiket Keuangan',
        'tiket' => $tiket
    ]);
}
}