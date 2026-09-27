<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\ActivityLogService;
use App\Services\NotificationService;
use App\Services\PermissionService;
use CodeIgniter\Security\Exceptions\SecurityException;

abstract class AdminController extends BaseController
{
    /**
     * Service
     */
    protected AuthService $authService;
    protected PermissionService $permissionService;
    protected NotificationService $notificationService;
    protected ActivityLogService $activityLogService;

    /**
     * User Login
     */
    protected ?array $user = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authService         = service('authService');
        $this->permissionService   = service('permissionService');
        $this->notificationService = service('notificationService');
        $this->activityLogService  = service('activityLogService');

        $this->user = $this->authService->user();
    }

    /**
     * Data default untuk semua view admin.
     */
    protected function viewData(array $data = []): array
    {
        return array_merge([
            'user'             => $this->user,
            'notifications'    => $this->notificationService->getUnreadNotifications(),
            'notificationCount' => $this->notificationService->unreadCount(),
            'title'            => '',
            'pageTitle'        => '',
            'breadcrumb'       => [],
        ], $data);
    }

    /**
     * Cek permission.
     */
    protected function authorize(string $permission): void
    {
        if (! $this->permissionService->hasPermission($permission)) {
            throw SecurityException::forDisallowedAction();
        }
    }

    /**
     * Simpan activity log.
     */
    protected function logActivity(
        string $action,
        string $description,
        ?string $module = null,
        ?int $referenceId = null
    ): void {
        $this->activityLogService->storeLog([
            'action'       => $action,
            'description'  => $description,
            'module'       => $module ?? 'general',
            'reference_id' => $referenceId,
            'user_id'      => $this->user['id'] ?? null,
            'ip_address'   => $this->request->getIPAddress(),
            'user_agent'   => $this->request->getUserAgent()->getAgentString(),
        ]);
    }
}
