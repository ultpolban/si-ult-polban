<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceRequestModel extends Model
{
    protected $table = 'service_requests';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'ticket_number',
        'user_profile_id',
        'service_id',
        'title',
        'description',
        'status',
        'priority',
        'assigned_to',
        'submitted_at',
        'verified_at',
        'processed_at',
        'completed_at',
        'rejected_at',
        'cancelled_at',
        'admin_note',
        'rejection_reason',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = false;

    protected $useSoftDeletes = false;
}