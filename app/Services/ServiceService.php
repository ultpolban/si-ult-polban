<?php

namespace App\Services;

use App\Models\MasterServiceModel;

class ServiceService
{
    protected MasterServiceModel $model;

    public function __construct()
    {
        $this->model = new MasterServiceModel();
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model
            ->getComplete();

        if ($keyword !== '') {

            $builder
                ->groupStart()
                ->like('master_services.code', $keyword)
                ->orLike('master_services.name', $keyword)
                ->orLike('master_service_units.name', $keyword)
                ->orLike('master_service_categories.name', $keyword)
                ->groupEnd();
        }

        $builder
            ->orderBy('master_services.sort_order', 'ASC')
            ->orderBy('master_services.name', 'ASC');

        return [

            'services' => $builder->paginate(10),

            'pager' => $this->model->pager,

        ];
    }

    /**
     * Dropdown
     */
    public function getDropdown(): array
    {
        return $this->model->dropdown();
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
            ->getComplete()
            ->where('master_services.id', $id)
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
