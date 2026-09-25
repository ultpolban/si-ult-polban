<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table            = 'tickets';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'ticket_number',
        'user_profile_id',
        'service_id',
        'unit_id',
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
    ];

    protected $useTimestamps = false;
    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';


    // =========================================================
    // QUERY UTAMA TIKET
    // =========================================================

    private function ticketQuery()
    {
        return $this->db
            ->table('tickets t')
            ->select('
                t.*,

                COALESCE(
                    up.student_name,
                    up.name
                ) AS applicant_name,

                up.name AS name,
                up.student_name AS student_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,
                up.applicant_type_id AS applicant_type_id,

                mat.name AS applicant_type,

                ms.name AS service_name,
                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id AS service_unit_id,

                su.name AS unit_name,
                su.code AS unit_code
            ')
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'master_applicant_types mat',
                'mat.id = up.applicant_type_id',
                'left'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units su',
                'su.id = ms.service_unit_id',
                'left'
            );
    }


    // =========================================================
    // SEMUA TIKET
    // =========================================================

    public function getTickets()
    {
        return $this
            ->select('
                tickets.*,

                COALESCE(
                    user_profiles.student_name,
                    user_profiles.name
                ) AS applicant_name,

                user_profiles.name AS name,
                user_profiles.student_name AS student_name,
                user_profiles.nim AS nim,
                user_profiles.nik AS nik,
                user_profiles.email AS applicant_email,
                user_profiles.phone AS applicant_phone,

                master_services.name AS service_name,
                master_services.name AS service_display_name,
                master_services.code AS service_code,
                master_services.service_unit_id AS service_unit_id,

                master_service_units.name AS unit_name,
                master_service_units.code AS unit_code
            ')
            ->join(
                'user_profiles',
                'user_profiles.id = tickets.user_profile_id',
                'left'
            )
            ->join(
                'master_services',
                'master_services.id = tickets.service_id',
                'left'
            )
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            )
            ->orderBy(
                'tickets.submitted_at',
                'DESC'
            )
            ->findAll();
    }


    // =========================================================
    // DETAIL TIKET
    // =========================================================

    public function getTicketDetail($id)
    {
        return $this->ticketQuery()
            ->where(
                't.id',
                $id
            )
            ->get()
            ->getRowArray();
    }


    // =========================================================
    // BERDASARKAN STATUS
    // =========================================================

    public function getByStatus($status)
    {
        return $this->ticketQuery()
            ->where(
                'LOWER(t.status)',
                strtolower(
                    trim($status)
                )
            )
            ->orderBy(
                't.id',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }


    // =========================================================
    // TIKET VERIFIED
    // =========================================================

    public function getVerifiedTickets()
    {
        return $this->ticketQuery()
            ->where(
                'LOWER(t.status)',
                'verified'
            )
            ->orderBy(
                't.verified_at',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }


    // =========================================================
    // TIKET ASSIGNED
    // =========================================================

    public function getAssignedTickets()
    {
        return $this->db
            ->table('tickets t')
            ->select('
                t.*,

                up.name AS applicant_name,
                up.student_name AS student_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,
                up.applicant_type_id AS applicant_type_id,

                mat.name AS applicant_type,

                ms.name AS service_name,
                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id AS service_unit_id,

                su.name AS unit_name,
                su.code AS unit_code
            ')
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'master_applicant_types mat',
                'mat.id = up.applicant_type_id',
                'left'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units su',
                'su.id = t.assigned_to',
                'left'
            )
            ->where(
                'LOWER(t.status)',
                'assigned'
            )
            ->orderBy(
                't.updated_at',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }


    // =========================================================
    // TIKET BERDASARKAN UNIT
    // =========================================================

    public function getTicketsByUnit($unitId)
    {
        return $this->db
            ->table('tickets t')
            ->select('
                t.*,

                up.name AS applicant_name,
                up.student_name AS student_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,
                up.applicant_type_id AS applicant_type_id,

                mat.name AS applicant_type,

                ms.name AS service_name,
                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id AS service_unit_id,

                su.name AS unit_name,
                su.code AS unit_code
            ')
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'master_applicant_types mat',
                'mat.id = up.applicant_type_id',
                'left'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units su',
                'su.id = t.assigned_to',
                'left'
            )
            ->where(
                't.assigned_to',
                $unitId
            )
            ->whereIn(
                'LOWER(t.status)',
                [
                    'assigned',
                    'processing',
                    'in_progress'
                ]
            )
            ->orderBy(
                't.id',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }


    // =========================================================
    // DETAIL TIKET + UNIT
    // =========================================================

    public function getTicketDetailWithUnit($id)
    {
        return $this->db
            ->table('tickets t')
            ->select('
                t.*,

                up.name AS applicant_name,
                up.student_name AS student_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,
                up.applicant_type_id AS applicant_type_id,

                mat.name AS applicant_type,

                ms.name AS service_name,
                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id AS service_unit_id,

                su.name AS unit_name,
                su.code AS unit_code
            ')
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'master_applicant_types mat',
                'mat.id = up.applicant_type_id',
                'left'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units su',
                'su.id = t.assigned_to',
                'left'
            )
            ->where(
                't.id',
                $id
            )
            ->get()
            ->getRowArray();
    }
}