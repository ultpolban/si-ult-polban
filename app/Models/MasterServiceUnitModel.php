<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterServiceUnitModel extends Model
{
    protected $table = 'master_service_units';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'code',
        'name',
        'description',
        'email',
        'phone',
        'location',
        'website',
        'logo',
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