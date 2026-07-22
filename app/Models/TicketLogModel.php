<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketLogModel extends Model
{
    protected $table = 'ticket_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'ticket_id',
        'activity',
        'user_name',
        'created_at'
    ];

    protected $useTimestamps = false;
}