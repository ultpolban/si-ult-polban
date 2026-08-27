<?php

namespace App\Services;

use App\Models\ActivityLogModel;

class ActivityLogService
{
    protected ActivityLogModel $model;

    public function __construct()
    {
        $this->model = new ActivityLogModel();
    }

    public function getList(string $keyword = '', int $perPage = 15)
    {
        $builder = $this->model->getComplete();

        if ($keyword !== '') {
            $builder = $builder->search($keyword);
        }

        return [
            'logs'  => $builder->paginate($perPage),
            'pager' => $this->model->pager,
        ];
    }

    public function getById(int $id): ?array
    {
        return $this->model->getComplete()->find($id);
    }

    public function storeLog(array $data): int
    {
        $insert = [
            'user_id'      => $data['user_id'] ?? null,
            'action'       => $data['action'] ?? '',
            'module'       => $data['module'] ?? $data['description'] ?? 'general',
            'reference_id' => $data['reference_id'] ?? null,
            'old_data'     => $data['old_data'] ?? null,
            'new_data'     => $data['new_data'] ?? null,
            'ip_address'   => $data['ip_address'] ?? null,
            'user_agent'   => $data['user_agent'] ?? null,
            'created_at'   => $data['created_at'] ?? date('Y-m-d H:i:s'),
        ];

        if (! $this->model->insert($insert)) {
            return 0;
        }

        return (int) $this->model->getInsertID();
    }

    public function getModel(): ActivityLogModel
    {
        return $this->model;
    }
}
