<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'master_departments';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code',
        'name',
        'short_name',
        'description',
        'sort_order',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
