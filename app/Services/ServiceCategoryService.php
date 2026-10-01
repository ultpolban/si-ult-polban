<?php

namespace App\Services;

use App\Models\MasterServiceCategoryModel;

class ServiceCategoryService
{
    /**
     * Model
     */
    protected MasterServiceCategoryModel $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new MasterServiceCategoryModel();
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model
            ->getWithUnit();

        if ($keyword !== '') {

            $builder->groupStart()
                ->like('master_service_categories.code', $keyword)
                ->orLike('master_service_categories.name', $keyword)
                ->orLike('master_service_units.name', $keyword)
                ->groupEnd();
        }

        $builder
            ->orderBy('master_service_categories.sort_order', 'ASC')
            ->orderBy('master_service_categories.name', 'ASC');

        return [
            'serviceCategories' => $builder->paginate(10),
            'pager'             => $this->model->pager,
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
            ->getWithUnit()
            ->where('master_service_categories.id', $id)
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
     * Ubah Status
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
