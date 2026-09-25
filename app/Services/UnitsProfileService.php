<?php

namespace App\Services;

use App\Models\UnitsProfileModel;

/**
 * Service units_profiles: hanya mengelola description tiap unit.
 */
class UnitsProfileService
{
    protected UnitsProfileModel $model;

    public function __construct()
    {
        $this->model = new UnitsProfileModel();
    }

    public function getList(string $keyword = ''): array
    {
        $builder = $this->model->getWithUnit();
        if ($keyword !== '') {
            $builder->groupStart()
                ->like('units_profiles.description', $keyword)
                ->orLike('master_service_units.name', $keyword)
                ->orLike('master_service_units.code', $keyword)
                ->groupEnd();
        }
        $builder->orderBy('master_service_units.name', 'ASC');
        return ['profiles' => $builder->paginate(10), 'pager' => $this->model->pager];
    }

    public function getById(int $id): ?array
    {
        return $this->model->getWithUnit()->where('units_profiles.id', $id)->first();
    }

    public function getByUnitId(int $unitId): ?array
    {
        return $this->model->where('service_unit_id', $unitId)->first();
    }

    public function getPublished(): array
    {
        return $this->model->getWithUnit()->where('units_profiles.is_active', 1)
            ->orderBy('master_service_units.name', 'ASC')->findAll();
    }

    public function create(array $data): bool
    {
        $filtered = $this->filter($data);
        $result = $this->model->insert($filtered);
        if ($result === false) {
            throw new \Exception('Gagal insert database: ' . json_encode($this->model->errors()));
        }
        return true;
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $this->filter($data));
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    public function restore(int $id): bool
    {
        return $this->model->onlyDeleted()->update($id, ['deleted_at' => null]);
    }

    public function changeStatus(int $id, bool $status): bool
    {
        return $this->model->update($id, ['is_active' => $status]);
    }

    protected function filter(array $data): array
    {
        return array_intersect_key($data, array_flip([
            'service_unit_id', 'description', 'is_active', 'created_by', 'updated_by',
        ]));
    }
}

