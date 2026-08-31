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
        'url',
    ];

    protected $validationRules = [
        'user_id'            => 'required|integer',
        'service_request_id' => 'permit_empty|integer',
        'title'              => 'required|max_length[200]',
        'message'            => 'required',
        'type'               => 'required|in_list[info,success,warning,danger]',
        'is_read'            => 'permit_empty|in_list[0,1]',
        'read_at'            => 'permit_empty',
        'url'                => 'permit_empty|max_length[255]',
    ];


    /**
     * Semua notifikasi milik user
     */
    public function getByUser(int $userId): array
    {
        return $this
            ->where('user_id', $userId)
            ->where('deleted_at', null)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }


    /**
     * Jumlah notifikasi belum dibaca
     */
    public function countUnread(int $userId): int
    {
        return $this
            ->where('user_id', $userId)
            ->where('is_read', 0)
            ->where('deleted_at', null)
            ->countAllResults();
    }


    /**
     * Tandai satu notifikasi sebagai dibaca
     */
    public function markAsRead(int $notificationId, int $userId): bool
    {
        return $this
            ->where('id', $notificationId)
            ->where('user_id', $userId)
            ->set([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
            ])
            ->update();
    }


    /**
     * Tandai semua notifikasi user sebagai dibaca
     */
    public function markAllAsRead(int $userId): bool
    {
        return $this
            ->where('user_id', $userId)
            ->where('is_read', 0)
            ->where('deleted_at', null)
            ->set([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
            ])
            ->update();
    }
}