<?php

namespace App\Models;

class MasterStudyProgramModel extends BaseModel
{
    protected $table = 'master_study_programs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'department_id',
        'code',
        'name',
        'short_name',
        'degree',
        'description',
        'sort_order',
        'is_active'
    ];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $validationRules = [

        'department_id' => 'required|integer',

        'code' => 'required|max_length[20]',

        'name' => 'required|max_length[200]',

        'short_name' => 'permit_empty|max_length[50]',

        'degree' => 'required|max_length[10]',

        'description' => 'permit_empty',

        'sort_order' => 'required|integer',

        'is_active' => 'required|in_list[0,1]',

    ];

    protected $skipValidation = false;

    /**
     * ===================================
     * Join Department
     * ===================================
     */

    public function getWithDepartment()
    {
        return $this->select('
                master_study_programs.*,
                master_departments.name AS department_name,
                master_departments.code AS department_code
            ')
            ->join(
                'master_departments',
                'master_departments.id = master_study_programs.department_id'
            );
    }

    /**
     * ===================================
     * Active
     * ===================================
     */

    public function getActive()
    {
        return $this->where('master_study_programs.is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    /**
     * ===================================
     * Dropdown
     * ===================================
     */

    public function dropdown()
    {
        return $this->select('id,name')
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->findAll();
    }

    /**
     * ===================================
     * Search
     * ===================================
     */

    public function search($keyword)
    {
        return $this
            ->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->orLike('short_name', $keyword)
            ->orLike('degree', $keyword)
            ->groupEnd();
    }
}
