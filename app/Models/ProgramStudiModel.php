<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramStudiModel extends Model
{
    protected $table = 'program_studis';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode',
        'nama_program',
        'jurusan_id',
        'jenjang',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
