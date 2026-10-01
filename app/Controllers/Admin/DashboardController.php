<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\TicketService;
use App\Models\UserModel;
use App\Models\MasterServiceModel;
use App\Models\MasterServiceUnitModel;
use App\Models\MasterApplicantTypeModel;

/**
 * =====================================================================
 *  Dashboard Admin (SUPER_ADMIN & ADMIN_ULT)
 * =====================================================================
 *
 *  Ringkasan menyeluruh: pengguna, layanan, unit, jenis pemohon,
 *  serta tiket terbaru. Menu & akses.groupby mengikuti role admin.
 */
class DashboardController extends BaseController
{
    protected TicketService $ticketService;

    protected UserModel $userModel;

    protected MasterServiceModel $serviceModel;

    protected MasterServiceUnitModel $unitModel;

    protected MasterApplicantTypeModel $applicantTypeModel;

    public function __construct()
    {
        helper(['role']);

        $this->ticketService       = new TicketService();
        $this->userModel           = new UserModel();
        $this->serviceModel        = new MasterServiceModel();
        $this->unitModel           = new MasterServiceUnitModel();
        $this->applicantTypeModel  = new MasterApplicantTypeModel();
    }

    /**
     * Halaman dashboard admin.
     */
    public function index()
    {
        $summary = $this->ticketService->summary();

        $data = [
            'title'          => 'Dashboard Admin',
            'pageTitle'      => 'Dashboard Admin',
            'breadcrumb'     => ['Beranda', 'Dashboard Admin'],

            'summary'        => $summary,
            'totalUsers'     => (int) $this->userModel->countAllResults(),
            'totalServices'  => (int) $this->serviceModel->countAllResults(),
            'totalUnits'     => (int) $this->unitModel->countAllResults(),
            'totalApplicants'=> (int) $this->applicantTypeModel->countAllResults(),

            'latestTickets'  => $this->ticketService->latest(8),
            'statsByStatus'  => $this->ticketService->statsByStatus(),
            'statsByUnit'    => $this->ticketService->statsByUnit(),
            'statsByType'    => $this->ticketService->statsByApplicantType(),
        ];

        return view('dashboard/admin', $data);
    }
}