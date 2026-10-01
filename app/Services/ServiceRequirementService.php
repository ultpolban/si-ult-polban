<?php

namespace App\Services;

use App\Models\MasterServiceRequirementModel;

class ServiceRequirementService
{
    protected MasterServiceRequirementModel $model;

    public function __construct()
    {
        $this->model = new MasterServiceRequirementModel();
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model->getWithService();

        if ($keyword !== '') {

            $builder
                ->groupStart()
                ->like('master_service_requirements.name', $keyword)
                ->orLike('master_services.name', $keyword)
                ->groupEnd();
        }

        $builder
            ->orderBy('master_service_requirements.sort_order', 'ASC')
            ->orderBy('master_service_requirements.name', 'ASC');

        return [

            'requirements' => $builder->paginate(10),

            'pager' => $this->model->pager,

        ];
    }

    /**
     * Dropdown
     */
    public function getDropdown(int $serviceId): array
    {
        return $this->model->dropdown($serviceId);
    }

    /**
     * Active
     */
    public function getActive(): array
    {
        return $this->model->getActive();
    }

    /**
     * Detail
     */
    public function getById(int $id): ?array
    {
        return $this->model
            ->getWithService()
            ->where('master_service_requirements.id', $id)
            ->first();
    }

    /**
     * Simpan
     */
    public function create(array $data): bool
    {
        return (bool) $this->model->insert($data);
    }

    /**
     * Update
     */
    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    /**
     * Hapus
     */
    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    /**
     * Restore
     */
    public function restore(int $id): bool
    {
        return $this->model
            ->onlyDeleted()
            ->update($id, [
                'deleted_at' => null,
            ]);
    }

    /**
     * Status
     */
    public function changeStatus(
        int $id,
        bool $status
    ): bool {

        return $this->model->update($id, [
            'is_active' => $status,
        ]);
    }
}
