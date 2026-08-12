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
        'code',
        'name',
        'description',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;

    public function search(?string $keyword = null)
    {
        $builder = $this;

        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('name', $keyword)
                ->orLike('code', $keyword)
                ->orLike('description', $keyword)
                ->groupEnd();
        }

        return $builder->orderBy('name', 'ASC');
    }

    public function countUser(int $roleId): int
    {
        return (new UserModel())
            ->where('role_id', $roleId)
            ->countAllResults();
    }
}
