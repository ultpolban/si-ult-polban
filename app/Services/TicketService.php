<?php

namespace App\Services;

use App\Models\TicketModel;
use App\Models\ServiceRequestLogModel;
use App\Models\MasterServiceModel;

class TicketService extends BaseService
{
    protected TicketModel $ticketModel;
    protected ServiceRequestLogModel $logModel;
    protected MasterServiceModel $serviceModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->logModel    = new ServiceRequestLogModel();
        $this->serviceModel = new MasterServiceModel();
    }

    /**
     * Resolve judul tiket.
     *
     * Karena kolom form judul dihapus, judul otomatis diisi dari nama layanan
     * agar data tetap bermakna dan kolom database (NOT NULL) tetap valid.
     */
    protected function resolveTitle(array $data): string
    {
        if (!empty($data['title'])) {
            return $data['title'];
        }

        $serviceId = (int) ($data['service_id'] ?? 0);

        if ($serviceId > 0) {
            $service = $this->serviceModel->find($serviceId);
            if ($service) {
                return (string) $service['name'];
            }
        }

        return '';
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

        if (!empty($filters['statuses']) && is_array($filters['statuses'])) {
            $builder->whereIn('tickets.status', $filters['statuses']);
        }

        if (!empty($filters['user_profile_id'])) {
            $builder->where('tickets.user_profile_id', (int) $filters['user_profile_id']);
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
            'title'           => $this->resolveTitle($data),
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
     *
     * Hanya field yang benar-benar dikirim yang diperbarui, sehingga
     * pengeditan parsial (mis. form edit yang tidak menyertakan judul
     * maupun pemilik tiket) tidak lagi menghapus judul atau memutus
     * kepemilikan tiket.
     */
    public function update(int $id, array $data): bool
    {
        $current = $this->ticketModel->find($id);

        if (! $current) {
            return false;
        }

        $payload = [];

        // Kepemilikan tiket tidak boleh berubah kecuali secara eksplisit dikirim
        if (array_key_exists('user_profile_id', $data)) {
            $payload['user_profile_id'] = $data['user_profile_id'] ?: null;
        }

        if (array_key_exists('service_id', $data)) {
            $payload['service_id'] = $data['service_id'] ?: null;
        }

        if (array_key_exists('title', $data) && trim((string) $data['title']) !== '') {
            $payload['title'] = trim((string) $data['title']);
        } elseif (array_key_exists('service_id', $payload)
            && (int) $payload['service_id'] !== (int) $current['service_id']) {
            // Judul mengikuti nama layanan bila layanan diganti
            // dan judul tidak ikut dikirim dari form.
            $payload['title'] = $this->resolveTitle(['service_id' => $payload['service_id']]);
        }

        if (array_key_exists('description', $data)) {
            $payload['description'] = $data['description'];
        }

        if (array_key_exists('priority', $data) && ($data['priority'] ?? '') !== '') {
            $payload['priority'] = $data['priority'];
        }

        if (array_key_exists('assigned_to', $data)) {
            $payload['assigned_to'] = $data['assigned_to'] ?: null;
        }

        if (array_key_exists('admin_note', $data)) {
            $payload['admin_note'] = $data['admin_note'];
        }

        if ($payload === []) {
            return true; // tidak ada field yang berubah
        }

        return $this->ticketModel->update($id, $payload);
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
        $current = $this->ticketModel->find($id);

        if (! $current) {
            return false;
        }

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

        if ($status === 'rejected') {
            $updateData['rejection_reason'] = $note;
        }

        $updated = $this->ticketModel->update($id, $updateData);

        if ($updated) {
            $this->logModel->insert([
                'service_request_id' => $id,
                'user_id'            => $userId,
                'old_status'         => $current['status'] ?? null,
                'new_status'         => $status,
                'action'             => 'STATUS_CHANGE',
                'description'        => 'Status diubah menjadi ' . $status . ($note ? ' - ' . $note : ''),
                'ip_address'         => service('request')->getIPAddress(),
                'user_agent'         => service('request')->getUserAgent()->getAgentString(),
                'created_at'         => date('Y-m-d H:i:s'),
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
    public function myTickets(int $userProfileId, ?int $limit = null): array
    {
        $builder = $this->ticketModel
            ->getComplete()
            ->where('tickets.user_profile_id', $userProfileId)
            ->orderBy('tickets.created_at', 'DESC');

        if ($limit !== null && $limit > 0) {
            $builder->limit($limit);
        }

        return $builder->findAll();
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
     * Tiket terbaru (untuk dashboard / feed).
     */
    public function latest(int $limit = 5): array
    {
        $limit = max(1, min($limit, 25));

        return $this->ticketModel
            ->getComplete()
            ->orderBy('tickets.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Ringkasan statistik tiket milik seorang pemohon.
     */
    public function summaryForProfile(int $userProfileId): array
    {
        $db = db_connect();

        $count = static function (string $scope) use ($db, $userProfileId): int {
            $builder = $db->table('tickets')
                ->where('user_profile_id', $userProfileId);

            switch ($scope) {
                case 'pending':
                    $builder->where('status', 'submitted');
                    break;
                case 'processing':
                    $builder->whereIn('status', ['verification', 'processing']);
                    break;
                case 'completed':
                    $builder->where('status', 'completed');
                    break;
                case 'rejected':
                    $builder->where('status', 'rejected');
                    break;
            }

            return (int) $builder->countAllResults();
        };

        return [
            'total'      => $count('total'),
            'pending'    => $count('pending'),
            'processing' => $count('processing'),
            'completed'  => $count('completed'),
            'rejected'   => $count('rejected'),
        ];
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