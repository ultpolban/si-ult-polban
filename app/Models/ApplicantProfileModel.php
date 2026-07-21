<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantProfileModel extends Model
{
    protected $table = 'applicant_profiles';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $allowedFields = [

        'user_id',

        'class_id',

        'relationship',

        'student_name',

        'student_nim',

        'graduation_year',

        'institution_name',

        'position',

        'notes'

    ];
}
