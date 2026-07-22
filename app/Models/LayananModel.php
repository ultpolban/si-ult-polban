<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table = 'layanan';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

protected $allowedFields = [

    'nama_layanan',

    'deskripsi',

    'status',

    'unit_id',

    'kategori_id'

];
}