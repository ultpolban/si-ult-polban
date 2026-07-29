<?php

namespace App\Models;

use CodeIgniter\Model;

class RequirementModel extends Model
{
    protected $table = 'service_requirements';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'service_id',
        'requirement',
        'is_active'
    ];
}