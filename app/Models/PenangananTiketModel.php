<?php

namespace App\Models;

use CodeIgniter\Model;

class PenangananTiketModel extends Model
{

    protected $table = 'penanganan_tiket';

    protected $primaryKey = 'id';


    protected $allowedFields = [

        'tiket_id',

        'petugas_id',

        'status',

        'catatan',

        'file_hasil1',

        'file_hasil2',

        'file_hasil3'

    ];



    public function getTiketUnit()
    {

        return $this

        ->select('
            penanganan_tiket.*,
            pengajuan_tiket.no_tiket,
            pengajuan_tiket.judul,
            pengajuan_tiket.deskripsi
        ')


        ->join(
            'pengajuan_tiket',
            'pengajuan_tiket.id = penanganan_tiket.tiket_id'
        )


        ->orderBy(
            'penanganan_tiket.id',
            'DESC'
        )


        ->findAll();

    }

}