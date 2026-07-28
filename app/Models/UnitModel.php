<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table = 'units';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'unit_name',
        'description',
        'created_at',
        'updated_at'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
