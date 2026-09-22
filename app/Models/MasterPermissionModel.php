<?php

namespace App\Models;

class MasterPermissionModel extends BaseModel
{
    protected $table = 'permissions';

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

        'module',

        'description',

        'sort_order',

        'is_active'

    ];

    protected $validationRules = [

        'code' => 'required|max_length[100]',

        'name' => 'required|max_length[150]',

        'module' => 'required|max_length[100]',

        'description' => 'permit_empty',

        'sort_order' => 'required|integer',

        'is_active' => 'required|in_list[0,1]'

    ];

    public function getActive()
    {
        return $this

            ->where('is_active', 1)

            ->orderBy('module', 'ASC')

            ->orderBy('sort_order', 'ASC')

            ->findAll();
    }

    public function dropdown()
    {
        return $this

            ->select('id,name')

            ->where('is_active', 1)

            ->orderBy('module')

            ->orderBy('sort_order')

            ->findAll();
    }

    public function search(string $keyword = '')
    {
        return $this

            ->groupStart()

            ->like('code', $keyword)

            ->orLike('name', $keyword)

            ->orLike('module', $keyword)

            ->groupEnd();
    }
}
