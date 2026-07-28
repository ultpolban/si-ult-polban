<?php

namespace App\Models;

use CodeIgniter\Model;

class StudyProgramModel extends Model
{
    protected $table = 'study_programs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $allowedFields = [

        'department_id',

        'education_level',

        'program_name'

    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    public function search(?string $keyword = null)
    {
        $builder = $this

            ->select('study_programs.*, departments.department_name')

            ->join(
                'departments',
                'departments.id = study_programs.department_id'
            );

        if (!empty($keyword)) {

            $builder

                ->groupStart()

                ->like('study_programs.program_name', $keyword)

                ->orLike('departments.department_name', $keyword)

                ->orLike('study_programs.education_level', $keyword)

                ->groupEnd();
        }

        return $builder

            ->orderBy('departments.department_name', 'ASC')

            ->orderBy('study_programs.education_level', 'ASC')

            ->orderBy('study_programs.program_name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $studyProgramId): int
    {
        return (new UserModel())

            ->where('study_program_id', $studyProgramId)

            ->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | GET DETAIL
    |--------------------------------------------------------------------------
    */

    public function getWithDepartment($id)
    {
        return $this

            ->select('study_programs.*, departments.department_name')

            ->join(
                'departments',
                'departments.id = study_programs.department_id'
            )

            ->find($id);
    }

    /*
    |--------------------------------------------------------------------------
    | GET BY DEPARTMENT
    |--------------------------------------------------------------------------
    */

    public function getByDepartment($departmentId)
    {
        return $this

            ->where('department_id', $departmentId)

            ->orderBy('education_level', 'ASC')

            ->orderBy('program_name', 'ASC')

            ->findAll();
    }
}
