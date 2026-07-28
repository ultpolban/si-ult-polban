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

        /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

        'role_id',
        'user_type_id',
        'department_id',
        'study_program_id',
        'work_unit_id',
        'class_id',

        /*
    |--------------------------------------------------------------------------
    | Identitas
    |--------------------------------------------------------------------------
    */

        'nim',
        'nip',
        'nidn',

        'full_name',

        'gender',
        'birth_place',
        'birth_date',

        'phone',

        'institution_email',
        'personal_email',

        'address',

        'photo',

        /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    */

        'password',

        /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

        'is_active',
        'email_verified_at',
        'last_login',

        /*
    |--------------------------------------------------------------------------
    | Mahasiswa
    |--------------------------------------------------------------------------
    */

        'angkatan',
        'semester',
        'student_status',
        'entry_year',

        /*
    |--------------------------------------------------------------------------
    | Dosen
    |--------------------------------------------------------------------------
    */

        'academic_position',
        'functional_position',

        /*
    |--------------------------------------------------------------------------
    | Pegawai
    |--------------------------------------------------------------------------
    */

        'employee_status',

        /*
    |--------------------------------------------------------------------------
    | Alumni
    |--------------------------------------------------------------------------
    */

        'graduation_year',

        /*
    |--------------------------------------------------------------------------
    | Orang Tua / Wali
    |--------------------------------------------------------------------------
    */

        'student_name',
        'student_nim',
        'relationship',

        /*
    |--------------------------------------------------------------------------
    | Mitra
    |--------------------------------------------------------------------------
    */

        'institution_name',
        'institution_type',
        'position',
        'job_title',

        /*
    |--------------------------------------------------------------------------
    | Publik
    |--------------------------------------------------------------------------
    */

        'identity_number'

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
        return $this->select('
            users.*,

            roles.role_name,

            user_types.type_name,

            departments.department_name,

            study_programs.program_name,
            study_programs.education_level,

            work_units.unit_name,

            classes.class_name
        ')

            ->join(
                'roles',
                'roles.id = users.role_id',
                'left'
            )

            ->join(
                'user_types',
                'user_types.id = users.user_type_id',
                'left'
            )

            ->join(
                'departments',
                'departments.id = users.department_id',
                'left'
            )

            ->join(
                'study_programs',
                'study_programs.id = users.study_program_id',
                'left'
            )

            ->join(
                'work_units',
                'work_units.id = users.work_unit_id',
                'left'
            )

            ->join(
                'classes',
                'classes.id = users.class_id',
                'left'
            );
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
            ->where('users.personal_email', $email)
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
        $builder = $this->baseQuery();

        if (!empty($keyword)) {

            $builder->groupStart()

                ->like('users.full_name', $keyword)

                ->orLike('users.personal_email', $keyword)

                ->orLike('users.nim', $keyword)

                ->orLike('users.nip', $keyword)

                ->orLike('users.nidn', $keyword)

                ->groupEnd();
        }

        if (!empty($role)) {

            $builder->where('users.role_id', $role);
        }

        if (!empty($type)) {

            $builder->where('users.user_type_id', $type);
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
        return $this
            ->where('user_type_id', 1)
            ->countAllResults();
    }

    public function countDosen(): int
    {
        return $this->where('user_type_id', 2)
            ->countAllResults();
    }

    public function countTendik(): int
    {
        return $this->where('user_type_id', 3)
            ->countAllResults();
    }

    public function countAlumni(): int
    {
        return $this->where('user_type_id', 4)
            ->countAllResults();
    }

    public function countOrangTua(): int
    {
        return $this->where('user_type_id', 5)
            ->countAllResults();
    }

    public function countMitra(): int
    {
        return $this->where('user_type_id', 6)
            ->countAllResults();
    }

    public function countPublik(): int
    {
        return $this->where('user_type_id', 7)
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
