<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\ServiceRequestService;
use App\Services\ServiceService;
use App\Services\ServiceUnitService;
use App\Models\UserProfileModel;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServiceRequestController extends AdminController
{
    protected ServiceRequestService $serviceRequestService;
    protected ServiceService $serviceService;
    protected ServiceUnitService $serviceUnitService;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        parent::__construct();

        $this->serviceRequestService = new ServiceRequestService();
        $this->serviceService        = new ServiceService();
        $this->serviceUnitService    = new ServiceUnitService();
        $this->profileModel          = new UserProfileModel();
    }

    /**
     * Daftar pengajuan
     */
    public function index()
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->serviceRequestService->getList($keyword);

        return view('service-requests/index', $this->viewData([
            'title'      => 'Pengajuan Layanan',
            'pageTitle'  => 'Pengajuan Layanan',
            'breadcrumb' => ['Pengajuan Layanan'],
            'keyword'    => $keyword,
            'requests'   => $result['requests'],
            'pager'      => $result['pager'],
        ]));
    }

    /**
     * Form pengajuan baru
     */
    public function create()
    {
        $this->authorize(Permissions::REQUEST_CREATE);

        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $profile = $this->profileModel->findByUser($userId);

        $applicantTypeId = isset($profile['applicant_type_id'])
            ? (int) $profile['applicant_type_id']
            : null;

        return view('service-requests/create', $this->viewData([
            'title'      => 'Buat Pengajuan',
            'pageTitle'  => 'Buat Pengajuan',
            'breadcrumb' => ['Pengajuan Layanan', 'Buat'],
            'profile'    => $profile,
            'services'   => $this->serviceService->getActiveForApplicantType($applicantTypeId),
            'serviceUnits' => $this->serviceUnitService->getActive(),
            'applicantTypeId' => $applicantTypeId,
        ]));
    }

    /**
     * Simpan pengajuan
     */
    public function store()
    {
        $this->authorize(Permissions::REQUEST_CREATE);

        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $profile = $this->profileModel->findByUser($userId);

        $applicantTypeId = isset($profile['applicant_type_id'])
            ? (int) $profile['applicant_type_id']
            : null;

        // Filter akses berdasarkan jenis pemohon
        $serviceId = (int) $this->request->getPost('service_id');

        if (! $this->serviceService->isAllowedForApplicantType($serviceId, $applicantTypeId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Layanan tidak tersedia untuk jenis pemohon Anda.');
        }

        $data = $this->request->getPost();

        $data['user_profile_id'] = $profile ? (int) $profile['id'] : 0;

        $this->serviceRequestService->create($userId, $data);

        return redirect()
            ->to(site_url('service-requests'))
            ->with('success', 'Pengajuan layanan berhasil dibuat.');
    }

    /**
     * Detail pengajuan
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $request = $this->serviceRequestService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('service-requests/show', $this->viewData([
            'title'     => 'Detail Pengajuan',
            'pageTitle' => 'Detail Pengajuan',
            'request'   => $request,
        ]));
    }

    /**
     * Form edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $request = $this->serviceRequestService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('service-requests/edit', $this->viewData([
            'title'     => 'Edit Pengajuan',
            'pageTitle' => 'Edit Pengajuan',
            'request'   => $request,
            'services'  => $this->serviceService->getActive(),
            'serviceUnits' => $this->serviceUnitService->getActive(),
        ]));
    }

    /**
     * Update pengajuan
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $this->serviceRequestService->update($id, $this->request->getPost());

        return redirect()
            ->to(site_url('service-requests/show/' . $id))
            ->with('success', 'Pengajuan berhasil diperbarui.');
    }

    /**
     * Hapus pengajuan
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::REQUEST_CANCEL);

        $this->serviceRequestService->delete($id);

        return redirect()
            ->to(site_url('service-requests'))
            ->with('success', 'Pengajuan berhasil dihapus.');
    }
}
