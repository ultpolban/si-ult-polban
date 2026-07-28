<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'jurusans';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode',
        'nama_jurusan',
        'created_at',
        'updated_at'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
