<?php

namespace App\Models;

use CodeIgniter\Model;

class UptTikActivityLogModel extends Model
{
    protected $table = 'upt_tik_activity_logs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'user_id',
        'ticket_id',
        'action',
        'activity',
        'status',
        'note',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    public function withUsers()
    {
        return $this
            ->select('upt_tik_activity_logs.*, users.full_name, users.email')
            ->join('users', 'users.id = upt_tik_activity_logs.user_id', 'left')
            ->orderBy('upt_tik_activity_logs.created_at', 'DESC');
    }
}
