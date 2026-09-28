<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantTypeModel extends Model
{
    protected $table = 'master_applicant_types';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'code',
        'name',
        'description',
        'is_active',
    ];
}