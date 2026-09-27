<?php

namespace App\Services;

use CodeIgniter\Model;
use RuntimeException;

abstract class BaseService
{
    public function __construct()
    {
        // Constructor dasar untuk subclass.
    }

    /**
     * Model utama.
     */
    protected $model;

    /**
     * Ambil semua data.
     */
    public function all(array $where = []): array
    {
        if (! empty($where)) {
            return $this->model
                ->where($where)
                ->findAll();
        }

        return $this->model->findAll();
    }

    /**
     * Pagination.
     */
    public function paginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Detail data.
     */
    public function find(int $id): ?array
    {
        return $this->model->find($id);
    }

    /**
     * Simpan data.
     */
    public function store(array $data): int
    {
        $this->beforeStore($data);

        if (! $this->model->insert($data)) {
            throw new RuntimeException('Gagal menyimpan data.');
        }

        $id = (int) $this->model->getInsertID();

        $this->afterStore($id, $data);

        return $id;
    }

    /**
     * Update data.
     */
    public function update(int $id, array $data): bool
    {
        $this->beforeUpdate($id, $data);

        if (! $this->model->update($id, $data)) {
            throw new RuntimeException('Gagal memperbarui data.');
        }

        $this->afterUpdate($id, $data);

        return true;
    }

    /**
     * Hapus data.
     */
    public function delete(int $id): bool
    {
        $this->beforeDelete($id);

        if (! $this->model->delete($id)) {
            throw new RuntimeException('Gagal menghapus data.');
        }

        $this->afterDelete($id);

        return true;
    }

    /**
     * Restore data (Soft Delete).
     */
    public function restore(int $id): bool
    {
        if (! $this->model->useSoftDeletes) {
            throw new RuntimeException('Model tidak menggunakan Soft Delete.');
        }

        return $this->model
            ->withDeleted()
            ->update($id, [
                'deleted_at' => null,
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    protected function beforeStore(array &$data): void {}

    protected function afterStore(int $id, array $data): void {}

    protected function beforeUpdate(int $id, array &$data): void {}

    protected function afterUpdate(int $id, array $data): void {}

    protected function beforeDelete(int $id): void {}

    protected function afterDelete(int $id): void {}
}
