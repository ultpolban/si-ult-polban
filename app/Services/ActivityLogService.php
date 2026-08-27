<?php

namespace App\Services;

/**
 * ActivityLogService
 * 
 * Helper untuk mencatat aktivitas user ke tabel activity_logs
 */
class ActivityLogService
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Catat aktivitas ke tabel activity_logs
     *
     * @param int|null $userId
     * @param string   $action   Contoh: 'login', 'logout', 'create_user'
     * @param string   $module   Contoh: 'auth', 'users', 'roles'
     * @param array    $extra    Data tambahan (old_data, new_data, reference_id)
     */
    public function log(
        ?int $userId,
        string $action,
        string $module,
        array $extra = []
    ): void {
        $request = \Config\Services::request();

        $this->db->table('activity_logs')->insert([
            'user_id'      => $userId,
            'action'       => $action,
            'module'       => $module,
            'reference_id' => $extra['reference_id'] ?? null,
            'old_data'     => isset($extra['old_data']) ? json_encode($extra['old_data']) : null,
            'new_data'     => isset($extra['new_data']) ? json_encode($extra['new_data']) : null,
            'ip_address'   => $request->getIPAddress(),
            'user_agent'   => $request->getUserAgent()->getAgentString(),
            'created_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}
