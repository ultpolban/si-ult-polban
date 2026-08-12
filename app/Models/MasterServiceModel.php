<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterServiceModel extends Model
{
    protected $table = 'master_services';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'service_unit_id',
        'service_category_id',
        'code',
        'name',
        'description',
        'service_hours',
        'max_file_size',
        'is_online',
        'is_active',
        'sort_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = false;
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
}