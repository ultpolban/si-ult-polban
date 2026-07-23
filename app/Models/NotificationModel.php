<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'ticket_id',
        'title',
        'message',
        'is_read',
        'created_at'
    ];

    protected $useTimestamps = false;
}