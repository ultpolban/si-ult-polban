<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanLayananModel extends Model
{
    protected $table            = 'service_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ticket_number', 'user_profile_id', 'service_id', 'title', 'description', 'priority', 'status', 'assigned_to', 'submitted_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Helper method to get pengajuan with details
    public function getPengajuanWithDetails($id = null)
    {
        $builder = $this
            ->select('service_requests.*, service_requests.ticket_number as tiket, service_requests.title as judul, service_requests.service_id as layanan_id, master_services.name as layanan_nama, user_profiles.name as pemohon_nama, service_requests.status as status_raw')
            ->join('master_services', 'master_services.id = service_requests.service_id', 'left')
            ->join('user_profiles', 'user_profiles.id = service_requests.user_profile_id', 'left')
            ->orderBy('service_requests.id', 'DESC');

        if ($id) {
            return $builder->where('service_requests.id', $id)->first();
        }
        return $builder->findAll();
    }

    /** Ambil detail dan riwayat sebuah tiket untuk halaman pelacakan. */
    public function getTicketTracking(string $ticketNumber): ?array
    {
        $ticket = $this->builder()
            ->select('service_requests.*, master_services.name as layanan_nama, master_service_units.name as unit_nama')
            ->join('master_services', 'master_services.id = service_requests.service_id', 'left')
            ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id', 'left')
            ->where('service_requests.ticket_number', $ticketNumber)
            ->get()
            ->getRowArray();

        if (!$ticket) {
            return null;
        }

        $logs = $this->db->table('service_request_logs')
            ->select('service_request_logs.*, users.full_name as pelaku')
            ->join('users', 'users.id = service_request_logs.user_id', 'left')
            ->where('service_request_logs.service_request_id', $ticket['id'])
            ->orderBy('service_request_logs.created_at', 'ASC')
            ->get()
            ->getResultArray();

        // Riwayat selalu dimulai saat tiket diajukan, walaupun petugas belum
        // membuat log perubahan status.
        $ticket['history'] = [[
            'new_status' => 'submitted',
            'action'     => 'Tiket diajukan',
            'description'=> 'Tiket berhasil dibuat dan menunggu proses.',
            'created_at' => $ticket['submitted_at'] ?? $ticket['created_at'],
            'pelaku'     => null,
        ]];

        foreach ($logs as $log) {
            $ticket['history'][] = $log;
        }

        // Untuk data lama yang belum memiliki log, tampilkan status terakhir
        // berdasarkan timestamp yang tersimpan pada tiket.
        if (empty($logs) && $ticket['status'] !== 'submitted') {
            $statusDates = [
                'verification' => 'verified_at',
                'processing'   => 'processed_at',
                'completed'    => 'completed_at',
                'rejected'     => 'rejected_at',
                'cancelled'    => 'cancelled_at',
            ];
            $dateField = $statusDates[$ticket['status']] ?? null;

            if ($dateField && !empty($ticket[$dateField])) {
                $ticket['history'][] = [
                    'new_status' => $ticket['status'],
                    'action'     => 'Status diperbarui',
                    'description'=> 'Status tiket diperbarui.',
                    'created_at' => $ticket[$dateField],
                    'pelaku'     => null,
                ];
            }
        }

        return $ticket;
    }

    // Ambil semua tiket dengan filter (untuk admin dan laporan)
    public function getAllTicketsWithFilters($keyword = '', $status = '', $priority = '', $perPage = 10, $offset = 0, $unitId = '', $applicantTypeId = '', $startDate = '', $endDate = '')
    {
        $builder = $this->builder()
            ->select('
                service_requests.*, 
                user_profiles.name as pemohon_nama, 
                master_applicant_types.name as pemohon_tipe,
                master_services.name as layanan_nama,
                master_service_units.name as unit_nama
            ')
            ->join('user_profiles', 'user_profiles.id = service_requests.user_profile_id', 'left')
            ->join('master_applicant_types', 'master_applicant_types.id = user_profiles.applicant_type_id', 'left')
            ->join('master_services', 'master_services.id = service_requests.service_id', 'left')
            ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id', 'left')
            ->orderBy('service_requests.created_at', 'DESC');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('service_requests.ticket_number', $keyword)
                ->orLike('service_requests.title', $keyword)
                ->orLike('user_profiles.name', $keyword)
                ->groupEnd();
        }

        if (!empty($status)) {
            $builder->where('service_requests.status', $status);
        }

        if (!empty($priority)) {
            $builder->where('service_requests.priority', $priority);
        }

        if (!empty($unitId)) {
            $builder->where('master_services.service_unit_id', $unitId);
        }

        if (!empty($applicantTypeId)) {
            $builder->where('user_profiles.applicant_type_id', $applicantTypeId);
        }

        if (!empty($startDate)) {
            $builder->where('DATE(service_requests.created_at) >=', $startDate);
        }

        if (!empty($endDate)) {
            $builder->where('DATE(service_requests.created_at) <=', $endDate);
        }

        $total = (clone $builder)->countAllResults(false);

        if ($perPage > 0) {
            $builder->limit($perPage, $offset);
        }
        
        $results = $builder->get()->getResultArray();

        return [
            'data'  => $results,
            'total' => $total
        ];
    }
}
