<?php

namespace App\Models;

use CodeIgniter\Model;

class StatisticModel extends Model
{
    protected $table = 'service_statistics';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'service_id',
        'total_access'
    ];
}