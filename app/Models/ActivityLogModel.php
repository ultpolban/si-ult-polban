<?php

namespace App\Models;

class ActivityLogModel extends BaseModel
{
    protected $table = 'activity_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    protected $allowedFields = [
        'user_id',
        'action',
        'module',
        'reference_id',
        'old_data',
        'new_data',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    protected $validationRules = [
        'user_id' => 'permit_empty|integer',
        'action'  => 'required|max_length[100]',
        'module'  => 'required|max_length[100]',
    ];

    public function getComplete()
    {
        return $this
            ->select("
                activity_logs.*,
                users.full_name,
                roles.name AS role_name,
                roles.code AS role_code,
                master_applicant_types.name AS applicant_type_name,
                master_applicant_types.code AS applicant_type_code
            ")
            ->join(
                'users',
                'users.id = activity_logs.user_id',
                'left'
            )
            ->join(
                'roles',
                'roles.id = users.role_id',
                'left'
            )
            ->join(
                'user_profiles',
                'user_profiles.user_id = users.id',
                'left'
            )
            ->join(
                'master_applicant_types',
                'master_applicant_types.id = user_profiles.applicant_type_id',
                'left'
            )
            ->orderBy('activity_logs.created_at', 'DESC');
    }

    public function getByModule(string $module)
    {
        return $this
            ->where('module', $module)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getByUser(int $userId)
    {
        return $this
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function search(string $keyword)
    {
        return $this
            ->groupStart()
            ->like('action', $keyword)
            ->orLike('module', $keyword)
            ->groupEnd();
    }

    public function write(array $data)
    {
        return $this->insert([
            'user_id'      => $data['user_id'] ?? null,
            'action'       => $data['action'],
            'module'       => $data['module'],
            'reference_id' => $data['reference_id'] ?? null,
            'old_data'     => $data['old_data'] ?? null,
            'new_data'     => $data['new_data'] ?? null,
            'ip_address'   => $data['ip_address'] ?? null,
            'user_agent'   => $data['user_agent'] ?? null,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}
