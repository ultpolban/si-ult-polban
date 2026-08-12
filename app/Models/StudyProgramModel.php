<?php

namespace App\Models;

use CodeIgniter\Model;

class StudyProgramModel extends Model
{
    protected $table = 'master_study_programs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

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

            ->select('master_study_programs.*, master_departments.name as department_name, master_study_programs.degree as education_level, master_study_programs.name as program_name')

            ->join(
                'master_departments',
                'master_departments.id = master_study_programs.department_id'
            );

        if (!empty($keyword)) {

            $builder

                ->groupStart()

                ->like('master_study_programs.name', $keyword)

                ->orLike('master_departments.name', $keyword)

                ->orLike('master_study_programs.degree', $keyword)

                ->groupEnd();
        }

        return $builder

            ->orderBy('master_departments.name', 'ASC')

            ->orderBy('master_study_programs.degree', 'ASC')

            ->orderBy('master_study_programs.name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $studyProgramId): int
    {
        return $this->db->table('user_profiles')

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

            ->select('master_study_programs.*, master_departments.name as department_name, master_study_programs.degree as education_level, master_study_programs.name as program_name')

            ->join(
                'master_departments',
                'master_departments.id = master_study_programs.department_id'
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

            ->orderBy('degree', 'ASC')

            ->orderBy('name', 'ASC')

            ->findAll();
    }
}
