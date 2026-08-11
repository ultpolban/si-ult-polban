<?php

namespace App\Models;

class NotificationModel extends BaseModel
{
    protected $table = 'notifications';

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
        'user_id',
        'service_request_id',
        'title',
        'message',
        'type',
        'is_read',
        'read_at',
        'url'
    ];

    protected $validationRules = [
        'user_id'            => 'required|integer',
        'service_request_id' => 'permit_empty|integer',
        'title'              => 'required|max_length[255]',
        'message'            => 'required',
        'type'               => 'required|max_length[50]',
        'is_read'            => 'required|in_list[0,1]',
        'url'                => 'permit_empty|max_length[255]',
    ];

    public function getUserNotifications(int $userId)
    {
        return $this
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function unread(int $userId)
    {
        return $this
            ->where('user_id', $userId)
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function unreadCount(int $userId)
    {
        return $this
            ->where('user_id', $userId)
            ->where('is_read', 0)
            ->countAllResults();
    }

    public function markAsRead(int $id)
    {
        return $this->update($id, [
            'is_read' => 1,
            'read_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getComplete()
    {
        return $this
            ->select("
                notifications.*,
                users.full_name,
                service_requests.ticket_number
            ")
            ->join(
                'users',
                'users.id = notifications.user_id'
            )
            ->join(
                'service_requests',
                'service_requests.id = notifications.service_request_id',
                'left'
            );
    }
}
