<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $allowedFields = [

        'role_id',

        'user_type_id',

        'department_id',

        'study_program_id',

        'work_unit_id',

        'class_id',

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

        'password',

        'is_active',

        'email_verified_at',

        'last_login'

    ];

    protected $validationRules = [

        'full_name' => 'required|min_length[3]',

        'personal_email' => 'required|valid_email',

        'phone' => 'permit_empty'

    ];

    protected $validationMessages = [

        'full_name' => [

            'required' => 'Nama lengkap wajib diisi.'

        ],

        'personal_email' => [

            'required' => 'Email wajib diisi.'

        ]

    ];
}
