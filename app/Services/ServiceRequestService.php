<?php

namespace App\Services;

use App\Models\ServiceRequestModel;
use App\Models\ServiceRequestFileModel;
use App\Models\ServiceRequestLogModel;
use RuntimeException;

class ServiceRequestService extends BaseService
{
    protected ServiceRequestModel $requestModel;
    protected ServiceRequestFileModel $fileModel;
    protected ServiceRequestLogModel $logModel;

    public function __construct()
    {
        $this->requestModel = new ServiceRequestModel();
        $this->fileModel    = new ServiceRequestFileModel();
        $this->logModel     = new ServiceRequestLogModel();
    }

    /**
     * Generate nomor tiket
     */
    public function generateTicketNumber(): string
    {
        return 'ULT-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));
    }

    /**
     * Daftar pengajuan
     */
    public function getList(?string $keyword = null, int $perPage = 10): array
    {
        $builder = $this->requestModel->getComplete();

        if (! empty($keyword)) {
            $builder = $builder->search($keyword);
        }

        return [
            'requests' => $builder->orderBy('created_at', 'DESC')->paginate($perPage),
            'pager'    => $this->requestModel->pager,
        ];
    }

    /**
     * Detail pengajuan
     */
    public function getById(int $id): ?array
    {
        return $this->requestModel->getComplete()->find($id);
    }

    /**
     * Buat pengajuan baru
     */
    public function create(int $userId, array $data): int
    {
        $insert = [
            'ticket_number'  => $this->generateTicketNumber(),
            'user_profile_id' => (int) ($data['user_profile_id'] ?? 0),
            'service_id'     => (int) $data['service_id'],
            'title'          => trim($data['title']),
            'description'    => trim($data['description'] ?? ''),
            'status'         => 'submitted',
            'priority'       => $data['priority'] ?? 'normal',
            'submitted_at'   => date('Y-m-d H:i:s'),
        ];

        $insertId = $this->requestModel->insert($insert);

        if (! $insertId) {
            throw new RuntimeException('Gagal menyimpan pengajuan.');
        }

        $this->log((int) $insertId, $userId, 'CREATE', null, 'submitted', 'Pengajuan layanan dibuat');

        return (int) $insertId;
    }

    /**
     * Update pengajuan
     */
    public function update(int $id, array $data): bool
    {
        return $this->requestModel->update($id, [
            'title'       => trim($data['title']),
            'description' => trim($data['description'] ?? ''),
            'priority'    => $data['priority'] ?? 'normal',
        ]);
    }

    /**
     * Ubah status
     */
    public function changeStatus(int $id, string $newStatus, ?int $userId = null, ?string $note = null): bool
    {
        $request = $this->requestModel->find($id);

        if (! $request) {
            return false;
        }

        $oldStatus = $request['status'];

        if (! $this->requestModel->update($id, ['status' => $newStatus])) {
            return false;
        }

        $this->log($id, $userId, 'STATUS_CHANGE', $oldStatus, $newStatus, $note ?? 'Status berubah');

        return true;
    }

    /**
     * Hapus
     */
    public function delete(int $id): bool
    {
        return $this->requestModel->delete($id);
    }

    /**
     * Simpan log riwayat
     */
    protected function log(int $requestId, ?int $userId, string $action, ?string $oldStatus, ?string $newStatus, string $description): bool
    {
        return (bool) $this->logModel->insert([
            'service_request_id' => $requestId,
            'user_id'            => $userId,
            'old_status'         => $oldStatus,
            'new_status'         => $newStatus,
            'action'             => $action,
            'description'        => $description,
            'ip_address'         => service('request')->getIPAddress(),
            'user_agent'         => service('request')->getUserAgent()->getAgentString(),
            'created_at'         => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Daftar file / dokumen pengajuan.
     */
    public function getFiles(int $requestId): array
    {
        return $this->fileModel->getByRequest($requestId);
    }

    public function getModel(): ServiceRequestModel
    {
        return $this->requestModel;
    }
}
