<?php

namespace App\Models;

class FaqModel extends BaseModel
{
    protected $table = 'faqs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'category',
        'question',
        'answer',
        'sort_order',
        'is_active'
    ];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'category' => 'permit_empty|max_length[255]',
        'question' => 'required|max_length[255]',
        'answer'   => 'required',
        'sort_order' => 'required|integer',
        'is_active'  => 'required|in_list[0,1]',
    ];

    /**
     * Ambil FAQ aktif.
     */
    public function getActive()
    {
        return $this->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}