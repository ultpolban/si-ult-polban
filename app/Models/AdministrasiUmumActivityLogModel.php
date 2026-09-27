<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministrasiUmumActivityLogModel extends Model
{
    protected $table = 'administrasi_umum_activity_logs';
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
            ->select('administrasi_umum_activity_logs.*, users.full_name, users.email')
            ->join('users', 'users.id = administrasi_umum_activity_logs.user_id', 'left')
            ->orderBy('administrasi_umum_activity_logs.created_at', 'DESC');
    }
}
