<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTypeModel extends Model
{
    protected $table = 'user_types';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'type_name',

        'description'

    ];

    protected $useTimestamps = true;
}
