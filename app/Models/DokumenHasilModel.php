<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenHasilModel extends Model
{
    protected $table = 'dokumen_hasil';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'penanganan_id',
        'nama_file'
    ];
}