<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'category_id',
        'service_code',
        'service_name',
        'description',
        'sla_hours',
        'is_login_required',
        'is_active'
    ];
}