<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitor_logs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'visitor_ip',
        'visited_date'
    ];

    protected $useTimestamps = false;
}