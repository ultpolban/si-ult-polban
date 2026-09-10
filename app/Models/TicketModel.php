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


    /**
     * ============================================================
     * QUERY DASAR TIKET
     * ============================================================
     *
     * tickets
     *   -> user_profiles
     *   -> master_services
     *
     * Jadi data yang dikirim ke dashboard sudah lengkap.
     */
    private function ticketQuery()
    {
        return $this->db->table('tickets t')
            ->select('
                t.*,

                up.name AS applicant_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,

                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id AS service_unit_id
            ')
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            );
    }


    /**
     * ============================================================
     * SEMUA TIKET
     * ============================================================
     */
    public function getTickets()
    {
        return $this->ticketQuery()
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();
    }


    /**
     * ============================================================
     * DETAIL TIKET
     * ============================================================
     */
    public function getTicketDetail($id)
    {
        return $this->ticketQuery()
            ->where('t.id', $id)
            ->get()
            ->getRowArray();
    }


    /**
     * ============================================================
     * TIKET BERDASARKAN STATUS
     * ============================================================
     */
    public function getByStatus($status)
    {
        return $this->ticketQuery()
            ->where(
                'LOWER(t.status)',
                strtolower(trim($status))
            )
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();
    }


    /**
     * ============================================================
     * TIKET VERIFIED
     * ============================================================
     */
    public function getVerifiedTickets()
    {
        return $this->ticketQuery()
            ->where('LOWER(t.status)', 'verified')
            ->orderBy('t.verified_at', 'DESC')
            ->get()
            ->getResultArray();
    }


    /**
     * ============================================================
     * TIKET ASSIGNED
     * ============================================================
     */
    public function getAssignedTickets()
    {
        return $this->db->table('tickets t')
            ->select('
                t.*,

                up.name AS applicant_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,

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
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units su',
                'su.id = t.assigned_to',
                'left'
            )
            ->where('LOWER(t.status)', 'assigned')
            ->orderBy('t.updated_at', 'DESC')
            ->get()
            ->getResultArray();
    }


    /**
     * ============================================================
     * TIKET BERDASARKAN UNIT
     * ============================================================
     */
    public function getTicketsByUnit($unitId)
    {
        return $this->db->table('tickets t')
            ->select('
                t.*,

                up.name AS applicant_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,

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
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units su',
                'su.id = t.assigned_to',
                'left'
            )
            ->where('t.assigned_to', $unitId)
            ->whereIn(
                'LOWER(t.status)',
                ['assigned', 'processing', 'in_progress']
            )
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();
    }


    /**
     * ============================================================
     * DETAIL + UNIT
     * ============================================================
     */
    public function getTicketDetailWithUnit($id)
    {
        return $this->db->table('tickets t')
            ->select('
                t.*,

                up.name AS applicant_name,
                up.nim AS nim,
                up.nik AS nik,
                up.email AS applicant_email,
                up.phone AS applicant_phone,

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
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units su',
                'su.id = t.assigned_to',
                'left'
            )
            ->where('t.id', $id)
            ->get()
            ->getRowArray();
    }
}