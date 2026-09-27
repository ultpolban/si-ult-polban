<?php

namespace App\Models;

class MasterServiceModel extends BaseModel
{
    protected $table = 'master_services';

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
        'service_unit_id',
        'service_category_id',
        'code',
        'name',
        'description',
        'service_hours',
        'max_file_size',
        'is_online',
        'is_active',
        'sort_order'
    ];

    protected $validationRules = [

        'service_unit_id'      => 'required|integer',

        'service_category_id'  => 'required|integer',

        'code'                 => 'required|max_length[30]',

        'name'                 => 'required|max_length[200]',

        'description'          => 'permit_empty',

        'service_hours'        => 'required|integer',

        'max_file_size'        => 'required|integer',

        'is_online'            => 'required|in_list[0,1]',

        'is_active'            => 'required|in_list[0,1]',

        'sort_order'           => 'required|integer',

    ];

    /**
     * Join Category + Unit
     */
    public function getComplete()
    {
        return $this
            ->select('
                master_services.*,
                master_service_units.name AS service_unit_name,
                master_service_categories.name AS category_name
            ')
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id'
            )
            ->join(
                'master_service_categories',
                'master_service_categories.id = master_services.service_category_id'
            );
    }

    public function getActive()
    {
        return $this
            ->where('master_services.is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    public function dropdown()
    {
        return $this
            ->select('id,code,name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    public function search(string $keyword = '')
    {
        return $this
            ->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->groupEnd();
    }
}
