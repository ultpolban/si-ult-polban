<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table = 'unit_layanan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_unit',
        'deskripsi',
        'status'
    ];
}