<?php

namespace App\Models;

use CodeIgniter\Model;

class AkademikActivityLogModel extends Model
{
    protected $table = 'akademik_activity_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

    protected $allowedFields = [
        'ticket_id',
        'ticket_number',
        'activity',
        'status',
        'created_at',
    ];
}