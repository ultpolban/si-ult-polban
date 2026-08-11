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

    public function getModel(): NotificationModel
    {
        return $this->model;
    }
}
