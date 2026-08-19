<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    // Aktifkan Otomatisasi Timestamp & Soft Deletes
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true; 

    // Tentukan nama kolom timestamp (opsional jika nama kolom di DB standar)
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // HANYA masukkan kolom yang boleh diinput/diubah manual oleh user/form
    protected $allowedFields    = [
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
    ];
}