<?php

namespace App\Models;

use CodeIgniter\Model;

class StudyProgramModel extends Model
{
    protected $table = 'study_programs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'department_id',

        'program_code',

        'program_name',

        'education_level',

        'status'

    ];

    protected $useTimestamps = true;
}
