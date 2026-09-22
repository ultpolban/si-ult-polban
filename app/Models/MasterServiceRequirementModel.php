<?php

namespace App\Models;

class MasterServiceRequirementModel extends BaseModel
{
    protected $table = 'master_service_requirements';

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

        'service_id',

        'name',

        'description',

        'file_type',

        'max_file_size',

        'is_required',

        'allowed_extensions',

        'sort_order',

        'is_active'

    ];

    protected $validationRules = [

        'service_id'          => 'required|integer',

        'name'                => 'required|max_length[200]',

        'description'         => 'permit_empty',

        'file_type'           => 'required|max_length[100]',

        'max_file_size'       => 'required|integer',

        'is_required'         => 'required|in_list[0,1]',

        'allowed_extensions'  => 'permit_empty|max_length[255]',

        'sort_order'          => 'required|integer',

        'is_active'           => 'required|in_list[0,1]',

    ];

    /**
     * Join Service
     */
    public function getWithService()
    {
        return $this
            ->select('
                master_service_requirements.*,
                master_services.name AS service_name,
                master_services.code AS service_code
            ')
            ->join(
                'master_services',
                'master_services.id = master_service_requirements.service_id'
            );
    }

    public function getActive()
    {
        return $this
            ->where('master_service_requirements.is_active', 1)
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
            ->like('name', $keyword)
            ->orLike('file_type', $keyword)
            ->groupEnd();
    }

    public function dropdown($serviceId)
    {
        return $this
            ->where('service_id', $serviceId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }
}
