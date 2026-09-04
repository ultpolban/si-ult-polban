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
        'created_at',
    ];

    /**
     * =========================================================
     * LOG REQUEST
     * =========================================================
     */
    public function getByRequest(int $requestId)
    {
        return $this
            ->select('
                service_request_logs.*,
                users.full_name
            ')
            ->join(
                'users',
                'users.id = service_request_logs.user_id',
                'left'
            )
            ->where(
                'service_request_logs.service_request_id',
                $requestId
            )
            ->orderBy(
                'service_request_logs.id',
                'ASC'
            )
            ->findAll();
    }

    /**
     * =========================================================
     * STORE LOG
     * =========================================================
     */
    public function storeLog(array $data)
    {
        $data['created_at'] ??= date('Y-m-d H:i:s');

        return $this->insert($data);
    }
}