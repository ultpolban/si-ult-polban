<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterServiceRequirementModel extends Model
{
    protected $table = 'master_service_requirements';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'service_id',
        'name',
        'description',
        'file_type',
        'max_file_size',
        'is_required',
        'allowed_extensions',
        'sort_order',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = false;
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
}