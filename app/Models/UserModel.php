<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    // Timestamp
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Soft Delete
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';

    // Kolom yang boleh diisi melalui insert/update
    protected $allowedFields = [
        'username',
        'role_id',
        'full_name',
        'identity_number',
        'phone_number',
        'gender',
        'email',
        'password',
        'profile_photo',
        'is_active',
        'last_login',
        'remember_token',
        'email_verified_at',

        // MFA
        'mfa_enabled',
        'mfa_secret',
        'mfa_recovery_codes',
        'mfa_confirmed_at',
    ];
}