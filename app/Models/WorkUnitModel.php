<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkUnitModel extends Model
{
    protected $table = 'work_units';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $allowedFields = [

        'unit_code',

        'unit_name'

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

                ->like('unit_code', $keyword)

                ->orLike('unit_name', $keyword)

                ->groupEnd();
        }

        return $builder

            ->orderBy('unit_name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $unitId): int
    {
        return (new UserModel())

            ->where('work_unit_id', $unitId)

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

            ->where('unit_code', $code)

            ->first();
    }
}
