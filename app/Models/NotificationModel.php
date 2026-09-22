<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'service_request_id',
        'title',
        'message',
        'type',
        'is_read',
        'read_at',
        'url',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = false;
}