<?php

namespace App\Services;

use App\Models\TicketModel;
use App\Models\ServiceRequestLogModel;

class TicketService extends BaseService
{
    protected TicketModel $ticketModel;
    protected ServiceRequestLogModel $logModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->logModel    = new ServiceRequestLogModel();
    }

    /**
     * ==========================================
     * CRUD DASAR
     * ==========================================
     */

    /**
     * List tiket dengan filter + pagination.
     */
    public function getList(array $filters = [], int $perPage = 10): array
    {
        $builder = $this->ticketModel->getComplete();

        if (!empty($filters['keyword'])) {
            $builder->groupStart()
                ->like('tickets.ticket_number', $filters['keyword'])
                ->orLike('tickets.title', $filters['keyword'])
                ->orLike('user_profiles.name', $filters['keyword'])
                ->groupEnd();
        }

        if (!empty($filters['status'])) {
            $builder->where('tickets.status', $filters['status']);
        }

        if (!empty($filters['priority'])) {
            $builder->where('tickets.priority', $filters['priority']);
        }

        if (!empty($filters['unit_id'])) {
            $builder->where('master_services.service_unit_id', $filters['unit_id']);
        }

        if (!empty($filters['applicant_type_id'])) {
            $builder->where('user_profiles.applicant_type_id', $filters['applicant_type_id']);
        }

        if (!empty($filters['date_from'])) {
            $builder->where('tickets.created_at >=', $filters['date_from'] . ' 00:00:00');
        }

        if (!empty($filters['date_to'])) {
            $builder->where('tickets.created_at <=', $filters['date_to'] . ' 23:59:59');
        }

        return [
            'tickets' => $builder->orderBy('tickets.created_at', 'DESC')->paginate($perPage),
            'pager'   => $this->ticketModel->pager,
        ];
    }

    /**
     * Detail tiket lengkap.
     */
    public function getById(int $id): ?array
    {
        return $this->ticketModel
            ->getComplete()
            ->find($id);
    }

    /**
     * Simpan tiket baru.
     */
    public function create(array $data): int
    {
        $ticketData = [
            'ticket_number'   => $this->ticketModel->generateTicketNumber(),
            'user_profile_id' => $data['user_profile_id'] ?? null,
            'service_id'      => $data['service_id'] ?? null,
            'title'           => $data['title'] ?? '',
            'description'     => $data['description'] ?? null,
            'status'          => $data['status'] ?? 'submitted',
            'priority'        => $data['priority'] ?? 'normal',
            'assigned_to'     => $data['assigned_to'] ?? null,
            'admin_note'      => $data['admin_note'] ?? null,
            'submitted_at'    => date('Y-m-d H:i:s'),
        ];

        return (int) $this->ticketModel->insert($ticketData);
    }

    /**
     * Update tiket.
     */
    public function update(int $id, array $data): bool
    {
        $ticketData = [
            'user_profile_id' => $data['user_profile_id'] ?? null,
            'service_id'      => $data['service_id'] ?? null,
            'title'           => $data['title'] ?? '',
            'description'     => $data['description'] ?? null,
            'priority'        => $data['priority'] ?? 'normal',
            'assigned_to'     => $data['assigned_to'] ?? null,
            'admin_note'      => $data['admin_note'] ?? null,
        ];

        return $this->ticketModel->update($id, $ticketData);
    }

    /**
     * Hapus (soft delete).
     */
    public function delete(int $id): bool
    {
        return $this->ticketModel->delete($id);
    }

    /**
     * Restore.
     */
    public function restore(int $id): bool
    {
        return $this->ticketModel
            ->onlyDeleted()
            ->update($id, ['deleted_at' => null]);
    }

    /**
     * Ubah status tiket + catat log.
     */
    public function changeStatus(int $id, string $status, int $userId, ?string $note = null): bool
    {
        // Petakan status ke kolom timestamp yang sesuai
        $timestampFields = [
            'submitted'    => 'submitted_at',
            'verification' => 'verified_at',
            'processing'   => 'processed_at',
            'completed'    => 'completed_at',
            'rejected'     => 'rejected_at',
            'cancelled'    => 'cancelled_at',
        ];

        $updateData = [
            'status'     => $status,
            'admin_note' => $note,
        ];

        if (isset($timestampFields[$status])) {
            $updateData[$timestampFields[$status]] = date('Y-m-d H:i:s');
        }

        $updated = $this->ticketModel->update($id, $updateData);

        if ($updated) {
            $this->logModel->insert([
                'service_request_id' => $id,
                'user_id'            => $userId,
                'action'             => 'status_change',
                'description'        => 'Status diubah menjadi ' . $status . ($note ? ' - ' . $note : ''),
            ]);
        }

        return $updated;
    }

    /**
     * ==========================================
     * TRACKING
     * ==========================================
     */

    /**
     * Daftar tiket milik user (berdasarkan user profile id).
     */
    public function myTickets(int $userProfileId): array
    {
        return $this->ticketModel
            ->getComplete()
            ->where('tickets.user_profile_id', $userProfileId)
            ->orderBy('tickets.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Cek status tiket publik berdasarkan nomor tiket.
     */
    public function findByTicket(string $ticket): ?array
    {
        return $this->ticketModel
            ->getComplete()
            ->where('tickets.ticket_number', $ticket)
            ->first();
    }

    /**
     * Riwayat (log) sebuah tiket.
     */
    public function history(int $requestId): array
    {
        return $this->logModel->getHistory($requestId);
    }

    /**
     * ==========================================
     * REPORT
     * ==========================================
     */

    /**
     * Laporan tiket dengan filter.
     */
    public function report(array $filters, int $perPage = 15): array
    {
        $builder = $this->ticketModel->getComplete();

        if (!empty($filters['status'])) {
            $builder->where('tickets.status', $filters['status']);
        }

        if (!empty($filters['unit_id'])) {
            $builder->where('master_services.service_unit_id', $filters['unit_id']);
        }

        if (!empty($filters['applicant_type_id'])) {
            $builder->where('user_profiles.applicant_type_id', $filters['applicant_type_id']);
        }

        if (!empty($filters['date_from'])) {
            $builder->where('tickets.created_at >=', $filters['date_from'] . ' 00:00:00');
        }

        if (!empty($filters['date_to'])) {
            $builder->where('tickets.created_at <=', $filters['date_to'] . ' 23:59:59');
        }

        return [
            'tickets' => $builder->orderBy('tickets.created_at', 'DESC')->paginate($perPage),
            'pager'   => $this->ticketModel->pager,
        ];
    }

    /**
     * Export laporan (tanpa pagination).
     */
    public function export(array $filters): array
    {
        $builder = $this->ticketModel->getComplete();

        if (!empty($filters['status'])) {
            $builder->where('tickets.status', $filters['status']);
        }

        if (!empty($filters['unit_id'])) {
            $builder->where('master_services.service_unit_id', $filters['unit_id']);
        }

        if (!empty($filters['applicant_type_id'])) {
            $builder->where('user_profiles.applicant_type_id', $filters['applicant_type_id']);
        }

        if (!empty($filters['date_from'])) {
            $builder->where('tickets.created_at >=', $filters['date_from'] . ' 00:00:00');
        }

        if (!empty($filters['date_to'])) {
            $builder->where('tickets.created_at <=', $filters['date_to'] . ' 23:59:59');
        }

        return $builder
            ->orderBy('tickets.created_at', 'DESC')
            ->findAll();
    }

    /**
     * ==========================================
     * STATISTIC
     * ==========================================
     */

    /**
     * Ringkasan per status.
     */
    public function statsByStatus(): array
    {
        return $this->ticketModel
            ->select('status, COUNT(*) AS total')
            ->groupBy('status')
            ->findAll();
    }

    /**
     * Ringkasan per unit layanan.
     */
    public function statsByUnit(): array
    {
        return $this->ticketModel
            ->select('master_service_units.name AS unit, COUNT(*) AS total')
            ->join('master_services', 'master_services.id = tickets.service_id')
            ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id')
            ->groupBy('master_service_units.id')
            ->orderBy('total', 'DESC')
            ->findAll();
    }

    /**
     * Ringkasan per jenis pemohon.
     */
    public function statsByApplicantType(): array
    {
        return $this->ticketModel
            ->select('COALESCE(master_applicant_types.name, \'Umum\') AS applicant_type, COUNT(*) AS total')
            ->join('user_profiles', 'user_profiles.id = tickets.user_profile_id')
            ->join('master_applicant_types', 'master_applicant_types.id = user_profiles.applicant_type_id', 'left')
            ->groupBy('user_profiles.applicant_type_id')
            ->orderBy('total', 'DESC')
            ->findAll();
    }

    /**
     * Pengajuan per bulan (12 bulan terakhir).
     */
    public function statsByMonth(): array
    {
        return $this->ticketModel
            ->select("DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) AS total")
            ->where('created_at >=', date('Y-m-d', strtotime('-11 months')) . ' 00:00:00')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->findAll();
    }

    /**
     * Total keseluruhan ringkasan.
     */
    public function summary(): array
    {
        $total       = $this->ticketModel->countAllResults();
        $pending     = (clone $this->ticketModel)->where('status', 'submitted')->countAllResults();
        $processing  = (clone $this->ticketModel)->whereIn('status', ['verification', 'processing'])->countAllResults();
        $completed   = (clone $this->ticketModel)->where('status', 'completed')->countAllResults();
        $rejected    = (clone $this->ticketModel)->where('status', 'rejected')->countAllResults();

        return [
            'total'      => $total,
            'pending'    => $pending,
            'processing' => $processing,
            'completed'  => $completed,
            'rejected'   => $rejected,
        ];
    }

    public function getModel(): TicketModel
    {
        return $this->ticketModel;
    }
}