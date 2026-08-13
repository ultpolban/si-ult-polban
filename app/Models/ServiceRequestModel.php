<?php

namespace App\Models;

class ServiceRequestModel extends BaseModel
{
    protected $table = 'service_requests';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

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
        'rejection_reason'
    ];

    protected $validationRules = [
        'ticket_number'   => 'required|max_length[50]',
        'user_profile_id' => 'required|integer',
        'service_id'      => 'required|integer',
        'title'           => 'permit_empty|max_length[255]',
        'description'     => 'permit_empty',
        'status'          => 'required',
        'priority'        => 'required',
        'assigned_to'     => 'permit_empty|integer'
    ];

    public function getComplete()
    {
        return $this
            ->select("
                service_requests.*,
                user_profiles.name AS applicant_name,
                master_services.name AS service_name,
                users.full_name AS assigned_name
            ")
            ->join(
                'user_profiles',
                'user_profiles.id = service_requests.user_profile_id'
            )
            ->join(
                'master_services',
                'master_services.id = service_requests.service_id'
            )
            ->join(
                'users',
                'users.id = service_requests.assigned_to',
                'left'
            );
    }

    public function search(string $keyword)
    {
        return $this
            ->groupStart()
            ->like('ticket_number', $keyword)
            ->orLike('title', $keyword)
            ->orLike('status', $keyword)
            ->groupEnd();
    }

    public function findByTicket(string $ticket)
    {
        return $this
            ->where('ticket_number', $ticket)
            ->first();
    }
}
