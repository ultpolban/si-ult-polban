<?php

namespace App\Services;

use App\Models\MasterApplicantTypeModel;

class ApplicantTypeService
{
    /**
     * Model
     */
    protected MasterApplicantTypeModel $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new MasterApplicantTypeModel();
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
                ->groupEnd();
        }

        $builder->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC');

        return [
            'applicantTypes' => $builder->paginate(10),
            'pager'          => $this->model->pager,
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
     * Internal
     */
    public function getInternal(): array
    {
        return $this->model->getInternal();
    }

    /**
     * External
     */
    public function getExternal(): array
    {
        return $this->model->getExternal();
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
