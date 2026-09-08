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

        // Notifikasi ke pemohon bahwa pengajuan diverifikasi
        $request = $this->serviceRequestService->getById($id);
        if ($request) {
            $this->notificationService->notifyProfileOwner(
                (int) ($request['user_profile_id'] ?? 0),
                'Pengajuan Diverifikasi',
                'Pengajuan ' . ($request['ticket_number'] ?? '#') . $id . ' telah diverifikasi dan sedang diproses.',
                'success',
                $id,
                site_url('service-requests/show/' . $id)
            );
        }

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

        // Notifikasi ke pemohon bahwa pengajuan ditolak
        $request = $this->serviceRequestService->getById($id);
        if ($request) {
            $this->notificationService->notifyProfileOwner(
                (int) ($request['user_profile_id'] ?? 0),
                'Pengajuan Ditolak',
                'Pengajuan ' . ($request['ticket_number'] ?? '#') . $id . ' ditolak.' . ($note !== '' ? " Alasan: $note" : ''),
                'danger',
                $id,
                site_url('service-requests/show/' . $id)
            );
        }

        return redirect()
            ->to(site_url('verifications'))
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
