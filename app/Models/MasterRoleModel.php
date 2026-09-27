<?php

namespace App\Models;

class MasterRoleModel extends BaseModel
{
    protected $table = 'roles';

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

        'code' => 'required|max_length[30]',

        'name' => 'required|max_length[100]',

        'description' => 'permit_empty',

        'sort_order' => 'required|integer',

        'is_active' => 'required|in_list[0,1]',

    ];

    /**
     * Active Role
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
     * Dropdown
     */
    public function dropdown()
    {
        return $this
            ->select('id,code,name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Search
     */
    public function search(string $keyword = '')
    {
        return $this
            ->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->groupEnd();
    }
}
