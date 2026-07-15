<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'tickets';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'ticket_number',
        'service_id',
        'applicant_id',
        'assigned_unit_id',
        'status',
        'priority',
        'description',
        'submitted_at',
        'verified_at',
        'completed_at'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}