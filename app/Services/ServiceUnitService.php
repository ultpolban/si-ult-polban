<?php

namespace App\Services;

use App\Models\MasterServiceUnitModel;

class ServiceUnitService
{
    protected MasterServiceUnitModel $model;

    public function __construct()
    {
        $this->model = new MasterServiceUnitModel();
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model;

        if ($keyword !== '') {

            $builder->groupStart()
                ->like('code', $keyword)
                ->orLike('name', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        $builder->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC');

        return [
            'serviceUnits' => $builder->paginate(10),
            'pager'        => $this->model->pager,
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
        return $this->model->find($id);
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
     * Delete
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
    public function changeStatus(int $id, bool $status): bool
    {
        return $this->model->update($id, [
            'is_active' => $status,
        ]);
    }
}
