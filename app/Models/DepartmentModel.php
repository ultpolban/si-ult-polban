<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $allowedFields = [

        'department_code',

        'department_name'

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
        $builder = $this;

        if (!empty($keyword)) {

            $builder = $builder

                ->groupStart()

                ->like('department_code', $keyword)

                ->orLike('department_name', $keyword)

                ->groupEnd();
        }

        return $builder

            ->orderBy('department_name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $departmentId): int
    {
        return (new UserModel())

            ->where('department_id', $departmentId)

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
        return $this

            ->where('department_code', $code)

            ->first();
    }
}
