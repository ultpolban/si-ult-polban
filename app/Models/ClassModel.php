<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $protectFields = true;

    protected $allowedFields = [

        'study_program_id',

        'class_name',

        'status'

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
                classes.*,

                study_programs.program_name,

                study_programs.education_level
            ')

            ->join(
                'study_programs',
                'study_programs.id = classes.study_program_id',
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
        return $this->baseQuery()

            ->orderBy('study_programs.program_name', 'ASC')

            ->orderBy('classes.class_name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | Detail
    |--------------------------------------------------------------------------
    */

    public function getClassById($id)
    {
        return $this->baseQuery()

            ->where('classes.id', $id)

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

                ->like('classes.class_name', $keyword)

                ->orLike('study_programs.program_name', $keyword)

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
        return $this->where('status', 1)

            ->countAllResults();
    }

    public function countInactive()
    {
        return $this->where('status', 0)

            ->countAllResults();
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

            ->where('status', 1)

            ->orderBy('class_name')

            ->findAll();
    }
}
