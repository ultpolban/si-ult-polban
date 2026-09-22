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

    protected $allowedFields = [
        'code',
        'name',
        'service_unit_id',
        'description',
        'icon',
        'color',
        'sort_order',
        'is_active'
    ];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $validationRules = [

        'service_unit_id' => 'required|integer',

        'code' => 'required|max_length[20]',

        'name' => 'required|max_length[150]',

        'description' => 'permit_empty',

        'icon' => 'permit_empty|max_length[100]',

        'color' => 'permit_empty|max_length[30]',

        'sort_order' => 'required|integer',

        'is_active' => 'required|in_list[0,1]',

    ];

    public function getWithUnit()
    {
        return $this->select('
                master_service_categories.*,
                master_service_units.name AS service_unit_name
            ')
            ->join(
                'master_service_units',
                'master_service_units.id=master_service_categories.service_unit_id'
            );
    }

    public function getActive()
    {
        return $this->where('master_service_categories.is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Dropdown
     */
    public function dropdown()
    {
        return $this->select('id, code, name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Search
     */
    public function search(string $keyword = '')
    {
        return $this->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->groupEnd()
            ->orderBy('sort_order', 'ASC');
    }
}
