<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'master_classes';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $protectFields = true;

    protected $allowedFields = [
        'study_program_id',
        'code',
        'name',
        'level',
        'parallel_class',
        'entry_year',
        'description',
        'sort_order',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    /*
    |--------------------------------------------------------------------------
    | Base Query
    |--------------------------------------------------------------------------
    */

    protected function baseQuery()
    {
        return $this->select('
                master_classes.*,
                master_classes.name as class_name,
                master_study_programs.name as program_name,
                master_study_programs.degree as education_level, master_classes.is_active as status
            ')
            ->join(
                'master_study_programs',
                'master_study_programs.id = master_classes.study_program_id',
                'left'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Semua Kelas
    |--------------------------------------------------------------------------
    */

    public function getClasses()
    {
        return $this->getmaster_classes();
    }

    public function getmaster_classes()
    {
        return $this->baseQuery()
            ->orderBy('master_study_programs.name', 'ASC')
            ->orderBy('master_classes.name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | Detail
    |--------------------------------------------------------------------------
    */

    public function getClassById($id)
    {
        return $this->baseQuery()

            ->where('master_classes.id', $id)

            ->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    public function search($keyword = null)
    {
        $builder = $this->baseQuery();

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('master_classes.name', $keyword)
                ->orLike('master_study_programs.name', $keyword)
                ->groupEnd();
        }

        return $builder;
    }

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    public function countActive()
    {
        return $this->where('is_active', 1)->countAllResults();
    }

    public function countInactive()
    {
        return $this->where('is_active', 0)->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | Dropdown Register
    |--------------------------------------------------------------------------
    */

    public function getByStudyProgram($studyProgramId)
    {
        return $this
            ->where('study_program_id', $studyProgramId)
            ->where('is_active', 1)
            ->orderBy('name')
            ->findAll();
    }
}
