<?php

namespace App\Models;

class ServiceRequestLogModel extends BaseModel
{
    protected $table = 'service_request_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    protected $allowedFields = [
        'service_request_id',
        'user_id',
        'old_status',
        'new_status',
        'action',
        'description',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    public function getHistory(int $requestId)
    {
        return $this
            ->select("
                service_request_logs.*,
                users.full_name
            ")
            ->join(
                'users',
                'users.id = service_request_logs.user_id'
            )
            ->where('service_request_id', $requestId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
}
