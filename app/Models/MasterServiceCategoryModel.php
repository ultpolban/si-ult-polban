<?php

namespace App\Models;

class MasterServiceCategoryModel extends BaseModel
{
    protected $table = 'master_service_categories';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $allowedFields = [
        'code',
        'name',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $validationRules = [
        'code' => 'required|max_length[50]',

        'name' => 'required|max_length[150]',

        'description' => 'permit_empty',

        'sort_order' => 'permit_empty|integer',

        'is_active' => 'required|in_list[0,1]',
    ];

    /**
     * =========================================================
     * CATEGORY AKTIF
     * =========================================================
     */
    public function getActive()
    {
        return $this
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    /**
     * =========================================================
     * FIND BY CODE
     * =========================================================
     */
    public function findByCode(string $code)
    {
        return $this
            ->where('code', $code)
            ->first();
    }

    /**
     * =========================================================
     * SEARCH
     * =========================================================
     */
    public function search(string $keyword)
    {
        return $this
            ->groupStart()
                ->like('code', $keyword)
                ->orLike('name', $keyword)
                ->orLike('description', $keyword)
            ->groupEnd();
    }
}