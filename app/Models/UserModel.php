<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';

    protected $primaryKey       = 'id';

    protected $returnType       = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields    = true;

    protected $allowedFields = [

        /*
        |--------------------------------------------------------------------------
        | Role
        |--------------------------------------------------------------------------
        */

        'role_id',
        'user_type_id',

        /*
        |--------------------------------------------------------------------------
        | Account
        |--------------------------------------------------------------------------
        */

        'full_name',
        'personal_email',
        'institution_email',
        'password',
        'is_active',

        /*
        |--------------------------------------------------------------------------
        | Personal
        |--------------------------------------------------------------------------
        */

        'gender',
        'birth_place',
        'birth_date',
        'phone',
        'address',
        'photo',

        /*
        |--------------------------------------------------------------------------
        | Mahasiswa
        |--------------------------------------------------------------------------
        */

        'nim',
        'department_id',
        'study_program_id',
        'class_id',
        'angkatan',
        'semester',
        'student_status',
        'entry_year',

        /*
        |--------------------------------------------------------------------------
        | Dosen
        |--------------------------------------------------------------------------
        */

        'nip',
        'nidn',
        'academic_position',
        'functional_position',

        /*
        |--------------------------------------------------------------------------
        | Petugas / Unit / Pimpinan
        |--------------------------------------------------------------------------
        */

        'work_unit_id',
        'position',
        'employee_status',

        /*
        |--------------------------------------------------------------------------
        | Alumni
        |--------------------------------------------------------------------------
        */

        'graduation_year',
        'graduation_number',

        /*
        |--------------------------------------------------------------------------
        | Orang Tua
        |--------------------------------------------------------------------------
        */

        'student_name',
        'student_nim',
        'relationship',

        /*
        |--------------------------------------------------------------------------
        | Mitra / Publik
        |--------------------------------------------------------------------------
        */

        'institution_name',
        'institution_type',
        'job_title',
        'identity_number'

    ];

    protected bool $allowEmptyInserts = false;

    protected bool $updateOnlyChanged = true;

    protected array $casts = [];

    protected array $castHandlers = [];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    public function getUsers()
    {
        return $this->select('users.*,
        roles.role_name,
        user_types.type_name,
        departments.department_name,
        study_programs.program_name,
        study_programs.education_level,
        work_units.unit_name,
        classes.class_name')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->join('user_types', 'user_types.id = users.user_type_id', 'left')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->join('study_programs', 'study_programs.id = users.study_program_id', 'left')
            ->join('work_units', 'work_units.id = users.work_unit_id', 'left')
            ->join('classes', 'classes.id = users.class_id', 'left');
    }

    public function getUserById($id)
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
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->join('user_types', 'user_types.id = users.user_type_id', 'left')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->join('study_programs', 'study_programs.id = users.study_program_id', 'left')
            ->join('work_units', 'work_units.id = users.work_unit_id', 'left')
            ->join('classes', 'classes.id = users.class_id', 'left')
            ->where('users.id', $id)
            ->first();
    }
}
