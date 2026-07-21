<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'class_name',
        'status'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}
