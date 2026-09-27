<?php

namespace App\Services;

use App\Models\MasterDepartmentModel;
use RuntimeException;

class DepartmentService extends BaseService
{
    /**
     * Model
     */
    protected MasterDepartmentModel $departmentModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departmentModel = new MasterDepartmentModel();
    }

    /**
     * Daftar data jurusan
     */
    public function getList(?string $keyword = null, int $perPage = 10): array
    {
        if (! empty($keyword)) {
            $departments = $this->departmentModel
                ->search($keyword)
                ->paginate($perPage);
        } else {
            $departments = $this->departmentModel
                ->orderBy('sort_order', 'ASC')
                ->orderBy('name', 'ASC')
                ->paginate($perPage);
        }

        return [
            'departments' => $departments,
            'pager'       => $this->departmentModel->pager,
        ];
    }

    /**
     * Dropdown jurusan aktif
     */
    public function getDropdown(): array
    {
        return $this->departmentModel->dropdown();
    }

    /**
     * Semua jurusan aktif
     */
    public function getActive(): array
    {
        return $this->departmentModel->getActive();
    }

    /**
     * Detail jurusan
     */
    public function getById(int $id): ?array
    {
        return $this->departmentModel->find($id);
    }

    /**
     * Tambah jurusan
     */
    public function create(array $data): int
    {
        $insert = [
            'code'        => strtoupper(trim($data['code'])),
            'name'        => trim($data['name']),
            'short_name'  => trim($data['short_name'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'sort_order'  => (int) $data['sort_order'],
            'is_active'   => (int) $data['is_active'],
        ];

        if (! $this->departmentModel->insert($insert)) {
            throw new RuntimeException('Gagal menambahkan data jurusan.');
        }

        return (int) $this->departmentModel->getInsertID();
    }

    /**
     * Update jurusan
     */
    public function update(int $id, array $data): bool
    {
        $update = [
            'code'        => strtoupper(trim($data['code'])),
            'name'        => trim($data['name']),
            'short_name'  => trim($data['short_name'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'sort_order'  => (int) $data['sort_order'],
            'is_active'   => (int) $data['is_active'],
        ];

        if (! $this->departmentModel->update($id, $update)) {
            throw new RuntimeException('Gagal mengubah data jurusan.');
        }

        return true;
    }

    /**
     * Soft Delete
     */
    public function delete(int $id): bool
    {
        return $this->departmentModel->delete($id);
    }

    /**
     * Restore
     */
    public function restore(int $id): bool
    {
        return $this->departmentModel
            ->withDeleted()
            ->update($id, [
                'deleted_at' => null,
            ]);
    }

    /**
     * Ubah status
     */
    public function changeStatus(int $id, bool $status): bool
    {
        return $this->departmentModel->update($id, [
            'is_active' => $status ? 1 : 0,
        ]);
    }
}
