<?php

namespace App\Models;

class MasterServiceUnitModel extends BaseModel
{
    protected $table = 'master_service_units';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'code',
        'name',
        'description',
        'email',
        'phone',
        'location',
        'website',
        'logo',
        'sort_order',
        'is_active'
    ];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $validationRules = [

        'code' => 'required|max_length[20]',

        'name' => 'required|max_length[150]',

        'description' => 'permit_empty',

        'email' => 'permit_empty|valid_email|max_length[150]',

        'phone' => 'permit_empty|max_length[30]',

        'location' => 'permit_empty|max_length[255]',

        'website' => 'permit_empty|max_length[255]',

        'logo' => 'permit_empty|max_length[255]',

        'sort_order' => 'required|integer',

        'is_active' => 'required|in_list[0,1]',

    ];

    public function getActive()
    {
        return $this->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    public function dropdown()
    {
        return $this->select('id,code,name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    public function search(string $keyword = '')
    {
        return $this->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->orLike('email', $keyword)
            ->groupEnd();
    }
}
