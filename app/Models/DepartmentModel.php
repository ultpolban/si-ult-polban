<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'master_departments';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $allowedFields = [
        'code',
        'name',
        'short_name',
        'description',
        'sort_order',
        'is_active'
    ];

    protected bool $allowEmptyInserts = false;

    protected bool $updateOnlyChanged = true;

    protected array $casts = [];

    protected array $castHandlers = [];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    public function search(?string $keyword = null)
    {
        $builder = $this->select('master_departments.*, master_departments.code as department_code');
        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('code', $keyword)
                ->orLike('name', $keyword)
                ->groupEnd();
        }
        return $builder->orderBy('name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $departmentId): int
    {
        return (new UserModel())

            ->join('user_profiles', 'user_profiles.user_id = users.id')

            ->join('master_study_programs', 'master_study_programs.id = user_profiles.study_program_id', 'left')

            ->where('master_study_programs.department_id', $departmentId)

            ->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT STUDY PROGRAM
    |--------------------------------------------------------------------------
    */

    public function countStudyProgram(int $departmentId): int
    {
        return (new StudyProgramModel())

            ->where('department_id', $departmentId)

            ->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | GET BY CODE
    |--------------------------------------------------------------------------
    */

    public function getByCode(string $code): ?array
    {
        return $this->where('code', $code)->first();
    }
}
