<?php

namespace App\Controllers\Dashboard;

use App\Controllers\AdminController;
use App\Models\ServiceRequestModel;
use App\Models\UserModel;
use App\Models\MasterServiceModel;

class DashboardController extends AdminController
{
    protected ServiceRequestModel $requestModel;
    protected UserModel $userModel;
    protected MasterServiceModel $serviceModel;

    public function __construct()
    {
        parent::__construct();

        $this->requestModel = new ServiceRequestModel();
        $this->userModel    = new UserModel();
        $this->serviceModel = new MasterServiceModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',

            'totalUsers' => $this->userModel->countAllResults(),

            'totalServices' => $this->serviceModel->countAllResults(),

            'totalRequests' => $this->requestModel->countAllResults(),

            'pendingRequests' => $this->requestModel
                ->where('status', 'submitted')
                ->countAllResults(),
        ];

        return view('dashboard/index', $this->viewData($data));
    }
}
