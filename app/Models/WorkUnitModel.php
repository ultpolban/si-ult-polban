<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkUnitModel extends Model
{
    protected $table = 'master_service_units';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $allowedFields = [
        'code',
        'name',
        'description',
        'email',
        'phone',
        'location',
        'website',
        'logo',
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
        $builder = $this;
        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('code', $keyword)
                ->orLike('name', $keyword)
                ->groupEnd();
        }
        return $builder->select("master_service_units.*, master_service_units.code as unit_code, master_service_units.name as nama, master_service_units.name as unit_name, master_service_units.phone as telepon, CASE WHEN master_service_units.is_active = 1 THEN 'Aktif' ELSE 'Nonaktif' END as status")->orderBy('name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $unitId): int
    {
        // Backend1 no longer stores work_unit_id on users.
        return 0;
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
