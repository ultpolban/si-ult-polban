<?php

namespace App\Controllers\Dashboard;

use App\Controllers\AdminController;
use App\Services\TicketService;
use App\Models\UserModel;
use App\Models\MasterServiceModel;
use App\Models\UserProfileModel;
use App\Constants\Permissions;

class DashboardController extends AdminController
{
    protected TicketService $ticketService;
    protected UserModel $userModel;
    protected MasterServiceModel $serviceModel;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService = new TicketService();
        $this->userModel     = new UserModel();
        $this->serviceModel  = new MasterServiceModel();
        $this->profileModel  = new UserProfileModel();
    }

    public function index()
    {
        $this->authorize(Permissions::DASHBOARD);

        $roleCode    = strtoupper((string) ($this->user['role_code'] ?? session()->get('role_code') ?? ''));
        $userId      = (int) ($this->user['id'] ?? session()->get('user_id'));
        $isAdminRole = in_array($roleCode, ['SUPER_ADMIN', 'ADMIN_ULT', 'PETUGAS_ULT', 'UNIT_TUJUAN', 'PIMPINAN'], true);

        $summary = $this->ticketService->summary();

        if ($roleCode === 'PEMOHON' && $userId > 0) {
            $profile = $this->profileModel->findByUser($userId);
            $summary = $profile ? $this->ticketService->summaryForProfile((int) $profile['id']) : $summary;
        }

        $data = [
            'title'          => 'Dashboard',
            'totalUsers'     => $isAdminRole ? $this->userModel->countAllResults() : 0,
            'totalServices'  => $this->serviceModel->countAllResults(),
            'totalRequests'  => $summary['total'],
            'pendingRequests' => $summary['pending'],
            'processingRequests' => $summary['processing'],
            'completedRequests'  => $summary['completed'],
            'rejectedRequests'   => $summary['rejected'],
            'latestTickets'  => $this->dashboardTickets($roleCode, $userId),
            'roleCode'       => $roleCode,
        ];

        return view('dashboard/index', $this->viewData($data));
    }

    /**
     * Tiket terbaru sesuai peran pengguna.
     */
    protected function dashboardTickets(string $roleCode, int $userId): array
    {
        $tickets = [];

        if ($roleCode === 'PEMOHON' && $userId > 0) {
            $profile = $this->profileModel->findByUser($userId);

            if ($profile) {
                $tickets = $this->ticketService->myTickets((int) $profile['id']);
            }
        } else {
            $tickets = $this->ticketService->latest(6);
        }

        return array_slice($tickets, 0, 6);
    }
}
