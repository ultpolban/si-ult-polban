<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramStudiModel extends Model
{
    protected $table = 'master_study_programs';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'department_id',
        'code',
        'name',
        'short_name',
        'degree',
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
