<?php

namespace App\Services;

use App\Models\MasterClassModel;

class ClassService
{
    /**
     * Model
     */
    protected MasterClassModel $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new MasterClassModel();
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model->getWithStudyProgram();

        if ($keyword !== '') {

            $builder->groupStart()
                ->like('master_classes.code', $keyword)
                ->orLike('master_classes.name', $keyword)
                ->orLike('master_classes.parallel_class', $keyword)
                ->orLike('master_study_programs.name', $keyword)
                ->groupEnd();
        }

        $builder->orderBy('master_study_programs.sort_order', 'ASC')
            ->orderBy('master_classes.sort_order', 'ASC')
            ->orderBy('master_classes.name', 'ASC');

        return [
            'classes' => $builder->paginate(10),
            'pager'   => $this->model->pager,
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
            ->getWithStudyProgram()
            ->where('master_classes.id', $id)
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
     * Ubah Status
     */
    public function changeStatus(int $id, bool $status): bool
    {
        return $this->model->update($id, [
            'is_active' => $status,
        ]);
    }
}
