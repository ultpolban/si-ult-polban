<?php

namespace App\Models;

class UserModel extends BaseModel
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $allowedFields = [
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
        'mfa_enabled',
        'mfa_secret',
        'mfa_recovery_codes',
        'mfa_confirmed_at'
    ];

    protected $validationRules = [

        'role_id' => 'required|integer',
        'full_name' => 'required|max_length[150]',
        'identity_number' => 'permit_empty|max_length[30]',
        'phone_number' => 'permit_empty|max_length[20]',
        'gender' => 'permit_empty|in_list[L,P]',
        'email' => 'required|valid_email|max_length[150]|is_unique[users.email,id,{id}]',
        'password' => 'permit_empty|min_length[8]',
        'profile_photo' => 'permit_empty|max_length[255]',
        'is_active' => 'required|in_list[0,1]',

    ];

    /**
     * Join Role
     */
    public function getWithRole()
    {
        return $this
            ->select('
                users.*,
                roles.code AS role_code,
                roles.name AS role_name
            ')
            ->join(
                'roles',
                'roles.id = users.role_id'
            );
    }

    /**
     * Join Profile
     */
    public function withProfile()
    {
        return $this
            ->select('
                users.*,
                user_profiles.applicant_type_id,
                user_profiles.study_program_id,
                user_profiles.class_id,
                user_profiles.nim,
                user_profiles.nik,
                user_profiles.name AS profile_name,
                user_profiles.email AS profile_email,
                user_profiles.phone,
                user_profiles.address,
                user_profiles.photo,
                roles.name AS role_name
            ')
            ->join(
                'user_profiles',
                'user_profiles.user_id = users.id',
                'left'
            )
            ->join(
                'roles',
                'roles.id = users.role_id',
                'left'
            );
    }

    /**
     * Login by username or email
     */
    public function findByUsernameOrEmail(string $username)
    {
        return $this
            ->groupStart()
            ->where('email', $username)
            ->orWhere('identity_number', $username)
            ->groupEnd()
            ->first();
    }

    /**
     * User aktif
     */
    public function getActive()
    {
        return $this
            ->where('users.is_active', 1)
            ->orderBy('full_name', 'ASC')
            ->findAll();
    }

    /**
     * Login
     */
    public function findByEmail(string $email)
    {
        return $this
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();
    }

    /**
     * Update login
     */
    public function updateLastLogin(int $id)
    {
        return $this->update($id, [
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Search
     */
    public function search(string $keyword)
    {
        return $this
            ->like('users.full_name', $keyword)
            ->orLike('users.email', $keyword)
            ->orLike('users.identity_number', $keyword)
            ->orLike('users.phone_number', $keyword);
    }
}
