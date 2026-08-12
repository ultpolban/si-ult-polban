<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTypeModel extends Model
{
    protected $table = 'master_applicant_types';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $allowedFields = [

        'name',

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

                ->like('name', $keyword)

                ->orLike('description', $keyword)

                ->groupEnd();
        }

        return $builder

            ->orderBy('name', 'ASC');
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT USER
    |--------------------------------------------------------------------------
    */

    public function countUser(int $typeId): int
    {
        return (new UserModel())
            ->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', $typeId)
            ->countAllResults();
    }
}
