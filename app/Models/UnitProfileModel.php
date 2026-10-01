<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitProfileModel extends Model
{
    protected $table = 'units_profiles';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'service_unit_id',
        'is_active',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    protected $useTimestamps = true;
}