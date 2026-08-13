<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'role_id',
        'full_name',
        'identity_number',
        'phone_number',
        'email',
        'password',
        'profile_photo',
        'is_active',
        'last_login',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = false;
}