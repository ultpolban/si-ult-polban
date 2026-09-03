<?php

namespace App\Models;

class MasterClassModel extends BaseModel
{
    protected $table = 'master_classes';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'study_program_id',
        'code',
        'name',
        'level',
        'parallel_class',
        'entry_year',
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

        'study_program_id' => 'required|integer',

        'code' => 'required|max_length[30]',

        'name' => 'required|max_length[100]',

        'level' => 'required|integer',

        'parallel_class' => 'required|max_length[5]',

        'entry_year' => 'required',

        'description' => 'permit_empty',

        'sort_order' => 'required|integer',

        'is_active' => 'required|in_list[0,1]',

    ];

    protected $skipValidation = false;

    /**
     * ==========================================
     * Join Study Program
     * ==========================================
     */
    public function getWithStudyProgram()
    {
        return $this->select("
                master_classes.*,
                master_study_programs.name AS study_program_name,
                master_study_programs.code AS study_program_code
            ")
            ->join(
                'master_study_programs',
                'master_study_programs.id = master_classes.study_program_id'
            );
    }

    /**
     * ==========================================
     * Active
     * ==========================================
     */
    public function getActive()
    {
        return $this->where('master_classes.is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    /**
     * ==========================================
     * Dropdown
     * ==========================================
     */
    public function dropdown()
    {
        return $this->select('id,name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * ==========================================
     * Search
     * ==========================================
     */
    public function search(string $keyword)
    {
        return $this
            ->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->orLike('parallel_class', $keyword)
            ->groupEnd();
    }
}
