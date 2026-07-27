<?php

namespace App\Models;

use CodeIgniter\Model;

class PenangananModel extends Model
{
    protected $table = 'penanganan_tiket';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tiket_id',
        'petugas_id',
        'status',
        'catatan',
        'file_hasil'
    ];


    public function getTiketUnit()
    {
        return $this->select('
                penanganan_tiket.*,
                pengajuan_tiket.no_tiket,
                pengajuan_tiket.judul,
                pengajuan_tiket.deskripsi,
                pengajuan_tiket.status as status_tiket,
                layanan.nama_layanan
            ')
            ->join(
                'pengajuan_tiket',
                'pengajuan_tiket.id = penanganan_tiket.tiket_id'
            )
            ->join(
                'layanan',
                'layanan.id = pengajuan_tiket.layanan_id'
            )
            ->findAll();
    }
}