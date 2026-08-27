<?php

namespace App\Models;

class UserProfileModel extends BaseModel
{
    protected $table = 'user_profiles';

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

        'user_id',

        'applicant_type_id',

        'study_program_id',

        'class_id',

        'nim',

        'nik',

        'student_name',

        'institution_name',

        'position',

        'name',

        'email',

        'phone',

        'address',

        'photo',

    ];

    protected $validationRules = [

        'user_id' => 'required|integer',

        'applicant_type_id' => 'permit_empty|integer',

        'study_program_id' => 'permit_empty|integer',

        'class_id' => 'permit_empty|integer',

        'nim' => 'permit_empty|max_length[30]',

        'nik' => 'permit_empty|max_length[30]',

        'name' => 'required|max_length[150]',

        'email' => 'permit_empty|valid_email|max_length[150]',

        'phone' => 'permit_empty|max_length[20]',

        'address' => 'permit_empty',

        'photo' => 'permit_empty|max_length[255]',

    ];

    /**
     * ======================================
     * Profile lengkap
     * ======================================
     */

    public function getComplete()
    {
        return $this

            ->select('
                user_profiles.*,

                users.full_name,

                users.identity_number,

                roles.name AS role_name,

                master_applicant_types.code AS applicant_type_code,
                master_applicant_types.name AS applicant_type,

                master_departments.name AS department_name,

                master_study_programs.name AS study_program_name,

                master_classes.name AS class_name
            ')

            ->join(
                'users',
                'users.id=user_profiles.user_id'
            )

            ->join(
                'roles',
                'roles.id=users.role_id'
            )

            ->join(
                'master_applicant_types',
                'master_applicant_types.id=user_profiles.applicant_type_id',
                'left'
            )

            ->join(
                'master_study_programs',
                'master_study_programs.id=user_profiles.study_program_id',
                'left'
            )

            ->join(
                'master_departments',
                'master_departments.id=master_study_programs.department_id',
                'left'
            )

            ->join(
                'master_classes',
                'master_classes.id=user_profiles.class_id',
                'left'
            );
    }

    /**
     * ======================================
     * Berdasarkan User
     * ======================================
     */

    public function findByUser(int $userId)
    {
        return $this

            ->where('user_id', $userId)

            ->first();
    }

    /**
     * ======================================
     * Search
     * ======================================
     */

    public function search(string $keyword)
    {
        return $this

            ->groupStart()

            ->like('name', $keyword)

            ->orLike('nim', $keyword)

            ->orLike('nik', $keyword)

            ->orLike('email', $keyword)

            ->groupEnd();
    }
}
