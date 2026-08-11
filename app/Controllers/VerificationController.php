<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\ServiceRequestService;
use App\Services\NotificationService;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class VerificationController extends AdminController
{
    protected ServiceRequestService $serviceRequestService;
    protected NotificationService $notificationService;

    public function __construct()
    {
        parent::__construct();

        $this->serviceRequestService = new ServiceRequestService();
        $this->notificationService   = service('notificationService');
    }

    /**
     * Daftar pengajuan untuk diverifikasi
     */
    public function index()
    {
        $this->authorize(Permissions::REQUEST_VERIFY);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->serviceRequestService->getList($keyword);

        return view('verifications/index', $this->viewData([
            'title'      => 'Verifikasi Pengajuan',
            'pageTitle'  => 'Verifikasi Pengajuan',
            'breadcrumb' => ['Verifikasi'],
            'keyword'    => $keyword,
            'requests'   => $result['requests'],
            'pager'      => $result['pager'],
        ]));
    }

    /**
     * Detail pengajuan untuk verifikasi
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::REQUEST_VERIFY);

        $request = $this->serviceRequestService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('verifications/show', $this->viewData([
            'title'      => 'Verifikasi Pengajuan',
            'pageTitle'  => 'Verifikasi Pengajuan',
            'request'    => $request,
        ]));
    }

    /**
     * Verifikasi pengajuan
     */
    public function verify(int $id)
    {
        $this->authorize(Permissions::REQUEST_VERIFY);

        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $this->serviceRequestService->changeStatus($id, 'processing', $userId, 'Pengajuan diverifikasi dan diproses');

        return redirect()
            ->to(site_url('verifications'))
            ->with('success', 'Pengajuan berhasil diverifikasi.');
    }

    /**
     * Tolak pengajuan
     */
    public function reject(int $id)
    {
        $this->authorize(Permissions::REQUEST_REJECT);

        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $note = trim($this->request->getPost('note') ?? '');

        $this->serviceRequestService->changeStatus($id, 'rejected', $userId, $note ?: 'Pengajuan ditolak');

        return redirect()
            ->to(site_url('verifications'))
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
