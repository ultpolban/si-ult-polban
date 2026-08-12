<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $protectFields = true;

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
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $skipValidation = false;

    /*
    |--------------------------------------------------------------------------
    | Base Query
    |--------------------------------------------------------------------------
    */

    protected function baseQuery()
    {
        return $this->select('users.*, users.email as personal_email, users.phone_number as phone, users.profile_photo as photo, roles.name as role_name')
            ->join('roles', 'roles.id = users.role_id', 'left');
    }

    /*
    |--------------------------------------------------------------------------
    | Semua User
    |--------------------------------------------------------------------------
    */

    public function getUsers()
    {
        return $this->baseQuery()
            ->orderBy('users.created_at', 'DESC');
    }

    /*
    |--------------------------------------------------------------------------
    | Detail User
    |--------------------------------------------------------------------------
    */

    public function getUserById($id)
    {
        return $this->baseQuery()
            ->select(
                'users.*, users.email as personal_email, users.phone_number as phone, users.profile_photo as photo, user_profiles.nim, user_profiles.nik, user_profiles.study_program_id, user_profiles.class_id, '
                    . 'master_study_programs.name as program_name, master_study_programs.degree as degree, master_study_programs.department_id as department_id, '
                    . 'master_departments.name as department_name, master_classes.name as class_name, NULL as unit_name'
            )
            ->join('user_profiles', 'user_profiles.user_id = users.id', 'left')
            ->join('master_study_programs', 'master_study_programs.id = user_profiles.study_program_id', 'left')
            ->join('master_departments', 'master_departments.id = master_study_programs.department_id', 'left')
            ->join('master_classes', 'master_classes.id = user_profiles.class_id', 'left')
            ->where('users.id', $id)
            ->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function getUserByEmail($email)
    {
        return $this->baseQuery()
            ->select('user_profiles.applicant_type_id')
            ->join('user_profiles', 'user_profiles.user_id = users.id', 'left')
            ->where('users.email', $email)
            ->first();
    }

    /*
    |--------------------------------------------------------------------------
    | User Terbaru
    |--------------------------------------------------------------------------
    */

    public function getLatestUsers($limit = 5)
    {
        return $this->baseQuery()
            ->orderBy('users.created_at', 'DESC')
            ->findAll($limit);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Statistics
    |--------------------------------------------------------------------------
    */

    public function getDashboardStatistics(): array
    {
        return [

            'totalUser'      => $this->countAll(),

            'activeUser'     => $this->countActiveUsers(),

            'inactiveUser'   => $this->countInactiveUsers(),

            'mahasiswa'      => $this->countMahasiswa(),

            'dosen'          => $this->countDosen(),

            'tendik'         => $this->countTendik(),

            'alumni'         => $this->countAlumni(),

            'orangTua'       => $this->countOrangTua(),

            'mitra'          => $this->countMitra(),

            'publik'         => $this->countPublik()

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Search User
    |--------------------------------------------------------------------------
    */

    public function searchUsers(
        ?string $keyword = null,
        ?int $role = null,
        ?int $type = null
    ) {
        $builder = $this->baseQuery()
            ->select('users.email as personal_email, users.phone_number as phone, users.profile_photo as photo, user_profiles.nim, user_profiles.nik, master_applicant_types.name as type_name')
            ->join('user_profiles', 'user_profiles.user_id = users.id', 'left')
            ->join('master_applicant_types', 'master_applicant_types.id = user_profiles.applicant_type_id', 'left');

        if (!empty($keyword)) {

            $builder->groupStart()

                ->like('users.full_name', $keyword)

                ->orLike('users.email', $keyword)

                ->orLike('user_profiles.nim', $keyword)

                ->orLike('user_profiles.nik', $keyword)

                ->groupEnd();
        }

        if (!empty($role)) {

            $builder->where('users.role_id', $role);
        }

        if (!empty($type)) {

            $builder->where('user_profiles.applicant_type_id', $type);
        }

        return $builder->orderBy(
            'users.created_at',
            'DESC'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Count Active User
    |--------------------------------------------------------------------------
    */

    public function countActiveUsers(): int
    {
        return $this
            ->where('is_active', 1)
            ->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | Count Inactive User
    |--------------------------------------------------------------------------
    */

    public function countInactiveUsers(): int
    {
        return $this
            ->where('is_active', 0)
            ->countAllResults();
    }

    public function countMahasiswa(): int
    {
        return $this->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', 1)
            ->countAllResults();
    }

    public function countDosen(): int
    {
        return $this->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', 2)
            ->countAllResults();
    }

    public function countTendik(): int
    {
        return $this->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', 3)
            ->countAllResults();
    }

    public function countAlumni(): int
    {
        return $this->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', 4)
            ->countAllResults();
    }

    public function countOrangTua(): int
    {
        return $this->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', 5)
            ->countAllResults();
    }

    public function countMitra(): int
    {
        return $this->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', 6)
            ->countAllResults();
    }

    public function countPublik(): int
    {
        return $this->join('user_profiles', 'user_profiles.user_id = users.id')
            ->where('user_profiles.applicant_type_id', 7)
            ->countAllResults();
    }

    /*
|--------------------------------------------------------------------------
| Update Last Login
|--------------------------------------------------------------------------
*/

    public function updateLastLogin(int $id): bool
    {
        return $this->update($id, [

            'last_login' => date('Y-m-d H:i:s')

        ]);
    }

    /*
|--------------------------------------------------------------------------
| Activate User
|--------------------------------------------------------------------------
*/

    public function activateUser(int $id): bool
    {
        return $this->update($id, [

            'is_active' => 1

        ]);
    }

    /*
|--------------------------------------------------------------------------
| Deactivate User
|--------------------------------------------------------------------------
*/

    public function deactivateUser(int $id): bool
    {
        return $this->update($id, [

            'is_active' => 0

        ]);
    }

    /*
|--------------------------------------------------------------------------
| Change Password
|--------------------------------------------------------------------------
*/

    public function changePassword(
        int $id,
        string $password
    ): bool {
        return $this->update($id, [

            'password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            )

        ]);
    }
}
