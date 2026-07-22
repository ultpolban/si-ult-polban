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
    'service_name',
    'applicant_name',
    'applicant_type',
    'nim',
    'email',
    'phone',
    'ticket_title',
    'ticket_description',
    'attachment',
    'status',
    'priority',
    'assigned_unit',
    'verified_by',
    'verification_note',
    'submitted_at',
    'verified_at',
    'completed_at',
    'created_at',
    'updated_at',
];

    protected $useTimestamps = false;
}