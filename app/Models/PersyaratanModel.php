<?php

namespace App\Models;

use CodeIgniter\Model;

class PersyaratanModel extends Model
{

    protected $table = 'persyaratan_layanan';

    protected $primaryKey = 'id';


    protected $allowedFields = [
        'layanan_id',
        'nama_persyaratan',
        'keterangan',
        'status'
    ];


    protected $useTimestamps = true;



    public function getPersyaratan()
    {

        return $this->select(
                'persyaratan_layanan.*,
                layanan.nama_layanan'
            )
            ->join(
                'layanan',
                'layanan.id = persyaratan_layanan.layanan_id'
            )
            ->findAll();

    }


}