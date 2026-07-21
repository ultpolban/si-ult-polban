<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkUnitModel extends Model
{
    protected $table = 'work_units';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'unit_name',

        'description'

    ];

    protected $useTimestamps = true;
}
