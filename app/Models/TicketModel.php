<?php

namespace App\Models;

class TicketModel extends BaseModel
{
    protected $table = 'tickets';

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
        'ticket_number'   => 'required|max_length[30]',
        'user_profile_id' => 'required|integer',
        'service_id'      => 'required|integer',
        'title'           => 'permit_empty|max_length[200]',
        'description'     => 'permit_empty',
        'status'          => 'required',
        'priority'        => 'required',
        'assigned_to'     => 'permit_empty|integer'
    ];

    protected $validationMessages = [];

    protected $skipValidation = false;

    protected $cleanValidationRules = true;

    /**
     * ======================================
     * Data Tiket Lengkap
     * ======================================
     */
    public function getComplete()
    {
        return $this
            ->select('
                tickets.*,
                user_profiles.name AS applicant_name,
                user_profiles.nim AS applicant_nim,
                user_profiles.nik AS applicant_nik,
                master_applicant_types.name AS applicant_type,
                master_services.name AS service_name,
                master_services.code AS service_code,
                master_service_units.name AS service_unit_name,
                users.full_name AS assigned_name
            ')
            ->join('user_profiles', 'user_profiles.id = tickets.user_profile_id')
            ->join('master_applicant_types', 'master_applicant_types.id = user_profiles.applicant_type_id', 'left')
            ->join('master_services', 'master_services.id = tickets.service_id')
            ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id', 'left')
            ->join('users', 'users.id = tickets.assigned_to', 'left');
    }

    /**
     * ======================================
     * Search
     * ======================================
     */
    public function search(string $keyword)
    {
        return $this
            ->groupStart()
            ->like('tickets.ticket_number', $keyword)
            ->orLike('tickets.title', $keyword)
            ->orLike('user_profiles.name', $keyword)
            ->orLike('master_services.name', $keyword)
            ->groupEnd();
    }

    /**
     * ======================================
     * Cari Berdasarkan Nomor Tiket
     * ======================================
     */
    public function findByTicket(string $ticket)
    {
        return $this
            ->where('tickets.ticket_number', $ticket)
            ->first();
    }

    /**
     * ======================================
     * Generate Nomor Tiket
     * ======================================
     */
    public function generateTicketNumber(): string
    {
        $prefix = 'TKT';

        $year = date('Y');

        $month = date('m');

        // Hitung jumlah tiket bulan ini
        $count = $this
            ->where('created_at >=', $year . '-' . $month . '-01 00:00:00')
            ->where('created_at <=', $year . '-' . $month . '-31 23:59:59')
            ->countAllResults();

        $sequence = str_pad($count + 1, 5, '0', STR_PAD_LEFT);

        return $prefix . '-' . $year . $month . '-' . $sequence;
    }
}