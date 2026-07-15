<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'is_active'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = false;
}
