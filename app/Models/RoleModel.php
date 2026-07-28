<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'roles';

    protected $primaryKey       = 'id';

    protected $returnType       = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields    = true;

    protected $allowedFields = [

        'role_name',

        'description'

    ];

    protected bool $allowEmptyInserts = false;

    protected bool $updateOnlyChanged = true;

    protected array $casts = [];

    protected array $castHandlers = [];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = '';

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

                ->like('role_name', $keyword)

                ->orLike('description', $keyword)

                ->groupEnd();
        }

        return $builder

            ->orderBy('role_name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $roleId): int
    {
        return (new UserModel())

            ->where('role_id', $roleId)

            ->countAllResults();
    }
}
