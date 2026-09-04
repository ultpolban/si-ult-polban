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

    protected $useSoftDeletes = true;

    protected $deletedField = 'deleted_at';


    /**
     * =========================================================
     * REQUEST DETAIL
     * =========================================================
     */
    public function getDetail(int $id)
    {
        return $this
            ->select('
                service_requests.*,

                user_profiles.user_id,
                user_profiles.applicant_type_id,
                user_profiles.study_program_id,
                user_profiles.class_id,
                user_profiles.nim,
                user_profiles.nidn,
                user_profiles.nik,
                user_profiles.name AS profile_name,
                user_profiles.email AS profile_email,
                user_profiles.phone AS profile_phone,
                user_profiles.address AS profile_address,

                users.full_name,
                users.identity_number,
                users.email AS user_email,

                master_services.code AS service_code,
                master_services.name AS service_name,
                master_services.description AS service_description,
                master_services.service_hours,
                master_services.is_online,

                master_service_units.code AS unit_code,
                master_service_units.name AS unit_name,

                master_service_categories.code AS category_code,
                master_service_categories.name AS category_name
            ')

            ->join(
                'user_profiles',
                'user_profiles.id = service_requests.user_profile_id',
                'left'
            )

            ->join(
                'users',
                'users.id = user_profiles.user_id',
                'left'
            )

            ->join(
                'master_services',
                'master_services.id = service_requests.service_id',
                'left'
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

            ->where('service_requests.id', $id)

            ->first();
    }


    /**
     * =========================================================
     * REQUEST USER
     * =========================================================
     */
    public function getByUser(int $userId)
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
                'user_profiles',
                'user_profiles.id = service_requests.user_profile_id'
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

            ->where('user_profiles.user_id', $userId)

            ->orderBy(
                'service_requests.created_at',
                'DESC'
            )

            ->findAll();
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
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }


    /**
     * =========================================================
     * REQUEST BERDASARKAN SERVICE
     * =========================================================
     */
    public function getByService(int $serviceId)
    {
        return $this
            ->where('service_id', $serviceId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }


    /**
     * =========================================================
     * REQUEST BERDASARKAN TICKET
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
     * SEARCH REQUEST
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