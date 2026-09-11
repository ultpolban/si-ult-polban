<?php

namespace App\Models;

use CodeIgniter\Model;

class UptTikTicketModel extends Model
{
    protected $table = 'upt_tik_tickets';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $allowedFields = [
        'ticket_number',
        'applicant_name',
        'applicant_identifier',
        'service_name',
        'description',
        'status',
        'priority',
        'assigned_to',
        'admin_note',
        'submitted_at',
        'processed_at',
        'completed_at',
    ];
}
