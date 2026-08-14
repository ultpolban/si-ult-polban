<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
    protected $table = 'user_profiles';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $deletedField = 'deleted_at';

    protected $allowedFields = [
        'user_id',
        'applicant_type_id',
        'study_program_id',
        'class_id',
        'student_name',
        'institution_name',
        'position',
        'nim',
        'nik',
        'name',
        'email',
        'phone',
        'address',
        'photo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}