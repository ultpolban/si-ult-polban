<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\TicketService;
use App\Services\ServiceService;
use App\Services\ServiceUnitService;
use App\Models\UserProfileModel;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServiceRequestController extends AdminController
{
    protected TicketService $ticketService;
    protected ServiceService $serviceService;
    protected ServiceUnitService $serviceUnitService;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService     = new TicketService();
        $this->serviceService    = new ServiceService();
        $this->serviceUnitService = new ServiceUnitService();
        $this->profileModel      = new UserProfileModel();
    }

    /**
     * Daftar pengajuan
     */
    public function index()
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $filters = ['keyword' => $keyword];

        // Pemohon hanya melihat pengajuan miliknya sendiri
        if ($this->isApplicant()) {
            $filters['user_profile_id'] = $this->ownProfileId();
        }

        $result = $this->ticketService->getList($filters);

        return view('service-requests/index', $this->viewData([
            'title'      => 'Pengajuan Layanan',
            'pageTitle'  => 'Pengajuan Layanan',
            'breadcrumb' => ['Pengajuan Layanan'],
            'keyword'    => $keyword,
            'requests'   => $result['tickets'],
            'pager'      => $result['pager'],
        ]));
    }

    /**
     * Apakah user yang sedang login berperan sebagai pemohon?
     */
    protected function isApplicant(): bool
    {
        return strtoupper((string) session()->get('role_code')) === 'PEMOHON';
    }

    /**
     * ID profil pemohon milik user yang sedang login (-1 bila tidak ada).
     */
    protected function ownProfileId(): int
    {
        $userId  = (int) ($this->user['id'] ?? session()->get('user_id'));
        $profile = $this->profileModel->findByUser($userId);

        return $profile ? (int) $profile['id'] : -1;
    }

    /**
     * Tolak akses bila pemohon membuka pengajuan milik orang lain.
     */
    protected function denyIfNotOwner(array $request)
    {
        if ($this->isApplicant() && (int) ($request['user_profile_id'] ?? 0) !== $this->ownProfileId()) {
            return redirect()
                ->to(site_url('service-requests'))
                ->with('error', 'Anda tidak memiliki akses ke pengajuan tersebut.');
        }

        return null;
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

        $data['user_profile_id'] = $profile ? (int) $profile['id'] : (int) ($data['user_profile_id'] ?? 0);

        $requestId = $this->ticketService->create($data);

        $this->logActivity('create_service_request', 'Membuat pengajuan layanan baru #' . $requestId, 'tickets', $requestId);

        // Notifikasi real-time: pengajuan masuk ke petugas ULT / admin
        $created = $this->ticketService->getById($requestId);
        $requestTitle = $created['title'] ?? 'Pengajuan layanan';

        $this->notificationService->notifyToRole(
            ['SUPER_ADMIN', 'ADMIN_ULT', 'PETUGAS_ULT'],
            'Pengajuan Baru',
            'Pengajuan "' . $requestTitle . '" masuk dan menunggu verifikasi.',
            'info',
            $requestId,
            site_url('verifications/show/' . $requestId)
        );

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

        $request = $this->ticketService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        $denied = $this->denyIfNotOwner($request);

        if ($denied !== null) {
            return $denied;
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
        $this->authorize(Permissions::REQUEST_UPDATE);

        $request = $this->ticketService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        $denied = $this->denyIfNotOwner($request);

        if ($denied !== null) {
            return $denied;
        }

        // Pemohon hanya diberi pilihan layanan yang sesuai jenis pemohonnya
        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $profile = $this->isApplicant() ? $this->profileModel->findByUser($userId) : null;

        $applicantTypeId = $profile['applicant_type_id'] ?? null;

        return view('service-requests/edit', $this->viewData([
            'title'     => 'Edit Pengajuan',
            'pageTitle' => 'Edit Pengajuan',
            'request'   => $request,
            'services'  => $applicantTypeId !== null
                ? $this->serviceService->getActiveForApplicantType((int) $applicantTypeId)
                : $this->serviceService->getActive(),
            'serviceUnits' => $this->serviceUnitService->getActive(),
        ]));
    }

    /**
     * Update pengajuan
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::REQUEST_UPDATE);

        $request = $this->ticketService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        $denied = $this->denyIfNotOwner($request);

        if ($denied !== null) {
            return $denied;
        }

        $data = $this->request->getPost();

        // Pemohon hanya boleh mengubah field terbatas —
        // status, penugasan, dan catatan admin tidak dapat disuntikkan.
        if ($this->isApplicant()) {
            $data = array_intersect_key(
                $data,
                array_flip(['service_id', 'priority', 'description'])
            );
        }

        $this->ticketService->update($id, $data);

        $this->logActivity('update_service_request', 'Memperbarui pengajuan #' . $id, 'tickets', $id);

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

        $request = $this->ticketService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        $denied = $this->denyIfNotOwner($request);

        if ($denied !== null) {
            return $denied;
        }

        $this->ticketService->delete($id);

        $this->logActivity('cancel_service_request', 'Membatalkan pengajuan #' . $id, 'tickets', $id);

        return redirect()
            ->to(site_url('service-requests'))
            ->with('success', 'Pengajuan berhasil dihapus.');
    }
}
