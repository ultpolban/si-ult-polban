<?php

namespace App\Services;

use App\Models\FaqModel;

class FaqService
{
    /**
     * Model
     */
    protected FaqModel $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new FaqModel();
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model;

        if ($keyword !== '') {

            $builder
                ->groupStart()
                ->like('category', $keyword)
                ->orLike('question', $keyword)
                ->orLike('answer', $keyword)
                ->groupEnd();
        }

        $builder
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC');

        return [
            'faqs'  => $builder->paginate(10),
            'pager' => $this->model->pager,
        ];
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

    /**
     * FAQ Aktif (untuk halaman publik/help).
     */
    public function getActive(): array
    {
        return $this->model->getActive();
    }
}