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
        'rejection_reason',
    ];

    protected $validationRules = [
        'ticket_number' => 'required|max_length[30]',

        'user_profile_id' => 'required|integer',

        'service_id' => 'required|integer',

        'title' => 'required|max_length[200]',

        'description' => 'permit_empty',

        'status' => 'required|max_length[30]',

        'priority' => 'required|in_list[low,normal,high,urgent]',

        'assigned_to' => 'permit_empty|integer',
    ];

    /**
     * =========================================================
     * GENERATE TICKET
     * =========================================================
     */
    public function generateTicketNumber(): string
    {
        $prefix = 'SR';

        $date = date('Ymd');

        $last = $this
            ->withDeleted()
            ->like('ticket_number', $prefix . '-' . $date . '-', 'after')
            ->orderBy('id', 'DESC')
            ->first();

        $sequence = 1;

        if ($last && !empty($last['ticket_number'])) {

            $parts = explode('-', $last['ticket_number']);

            $sequence = ((int) end($parts)) + 1;
        }

        return sprintf(
            '%s-%s-%04d',
            $prefix,
            $date,
            $sequence
        );
    }

    /**
     * =========================================================
     * REQUEST MILIK USER
     * =========================================================
     */
    public function getByUser(int $userProfileId)
    {
        return $this
            ->select('
                service_requests.*,

                master_services.code AS service_code,
                master_services.name AS service_name,

                master_service_units.name AS unit_name,

                master_service_categories.name AS category_name
            ')
            ->join(
                'master_services',
                'master_services.id = service_requests.service_id'
            )
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            )
            ->join(
                'master_service_categories',
                'master_service_categories.id = master_services.service_category_id',
                'left'
            )
            ->where(
                'service_requests.user_profile_id',
                $userProfileId
            )
            ->orderBy(
                'service_requests.id',
                'DESC'
            )
            ->findAll();
    }

    /**
     * =========================================================
     * DETAIL REQUEST
     * =========================================================
     */
    public function getDetail(int $id)
    {
        return $this
            ->select('
                service_requests.*,

                user_profiles.user_id,
                user_profiles.applicant_type_id,
                user_profiles.nim,
                user_profiles.nidn,
                user_profiles.nik,
                user_profiles.name AS profile_name,
                user_profiles.email AS profile_email,
                user_profiles.phone AS profile_phone,
                user_profiles.address AS profile_address,

                users.full_name,
                users.email AS user_email,

                master_services.code AS service_code,
                master_services.name AS service_name,
                master_services.description AS service_description,
                master_services.service_hours,
                master_services.max_file_size,
                master_services.is_online,

                master_service_units.code AS unit_code,
                master_service_units.name AS unit_name,

                master_service_categories.code AS category_code,
                master_service_categories.name AS category_name,

                assigned_user.full_name AS assigned_name
            ')

            ->join(
                'user_profiles',
                'user_profiles.id = service_requests.user_profile_id'
            )

            ->join(
                'users',
                'users.id = user_profiles.user_id'
            )

            ->join(
                'master_services',
                'master_services.id = service_requests.service_id'
            )

            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            )

            ->join(
                'master_service_categories',
                'master_service_categories.id = master_services.service_category_id',
                'left'
            )

            ->join(
                'users assigned_user',
                'assigned_user.id = service_requests.assigned_to',
                'left'
            )

            ->where(
                'service_requests.id',
                $id
            )

            ->first();
    }

    /**
     * =========================================================
     * FIND BY TICKET
     * =========================================================
     */
    public function findByTicket(string $ticketNumber)
    {
        return $this
            ->where('ticket_number', $ticketNumber)
            ->first();
    }

    /**
     * =========================================================
     * REQUEST BERDASARKAN STATUS
     * =========================================================
     */
    public function getByStatus(string $status)
    {
        return $this
            ->where('status', $status)
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    /**
     * =========================================================
     * REQUEST BERDASARKAN PETUGAS
     * =========================================================
     */
    public function getAssignedTo(int $userId)
    {
        return $this
            ->where('assigned_to', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    /**
     * =========================================================
     * SEARCH
     * =========================================================
     */
    public function search(string $keyword)
    {
        return $this
            ->groupStart()

                ->like(
                    'service_requests.ticket_number',
                    $keyword
                )

                ->orLike(
                    'service_requests.title',
                    $keyword
                )

                ->orLike(
                    'service_requests.description',
                    $keyword
                )

            ->groupEnd();
    }
}