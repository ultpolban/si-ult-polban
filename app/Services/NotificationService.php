<?php

namespace App\Services;

use App\Models\NotificationModel;

class NotificationService
{
    protected NotificationModel $model;

    public function __construct()
    {
        $this->model = new NotificationModel();
    }

    public function getNotifications(int $userId)
    {
        return $this->model->getUserNotifications($userId);
    }

    public function getUnread(array $user = null)
    {
        $userId = $user['id'] ?? session()->get('user_id');

        if (! $userId) {
            return [];
        }

        return $this->model->unread((int) $userId);
    }

    public function getUnreadNotifications()
    {
        return $this->getUnread();
    }

    public function unreadCount(?int $userId = null): int
    {
        $userId = $userId ?? session()->get('user_id');

        if (! $userId) {
            return 0;
        }

        return $this->model->unreadCount((int) $userId);
    }

    public function markAsRead(int $id): bool
    {
        return (bool) $this->model->markAsRead($id);
    }

    public function notify(
        int $userId,
        string $title,
        string $message,
        string $type = 'info',
        ?int $serviceRequestId = null,
        ?string $url = null
    ): bool {
        return (bool) $this->model->insert([
            'user_id'            => $userId,
            'service_request_id' => $serviceRequestId,
            'title'              => $title,
            'message'            => $message,
            'type'               => $type,
            'is_read'            => 0,
            'url'                => $url,
        ]);
    }

    /**
     * Kirim notifikasi ke seluruh user yang memiliki role tertentu.
     *
     * @param string|string[] $roleCode Kode role (mis. 'PETUGAS_ULT') atau array kode role.
     *
     * @return int Jumlah notifikasi yang berhasil dibuat.
     */
    public function notifyToRole(
        $roleCode,
        string $title,
        string $message,
        string $type = 'info',
        ?int $serviceRequestId = null,
        ?string $url = null
    ): int {
        $roles = is_array($roleCode) ? $roleCode : [$roleCode];
        $roles = array_map('strtoupper', $roles);

        $users = db_connect()
            ->table('users')
            ->select('users.id')
            ->join('roles', 'roles.id = users.role_id')
            ->whereIn('roles.code', $roles)
            ->where('users.is_active', 1)
            ->get()
            ->getResultArray();

        $count = 0;

        foreach ($users as $user) {
            if ($this->notify((int) $user['id'], $title, $message, $type, $serviceRequestId, $url)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Kirim notifikasi ke pemilik sebuah user profile (pemohon).
     */
    public function notifyProfileOwner(
        int $userProfileId,
        string $title,
        string $message,
        string $type = 'info',
        ?int $serviceRequestId = null,
        ?string $url = null
    ): bool {
        if ($userProfileId <= 0) {
            return false;
        }

        $profile = (new \App\Models\UserProfileModel())->find($userProfileId);

        if (! $profile || empty($profile['user_id'])) {
            return false;
        }

        return $this->notify((int) $profile['user_id'], $title, $message, $type, $serviceRequestId, $url);
    }

    public function getModel(): NotificationModel
    {
        return $this->model;
    }
}
