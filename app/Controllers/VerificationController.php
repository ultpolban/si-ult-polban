<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\TicketService;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class VerificationController extends AdminController
{
    protected TicketService $ticketService;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService = new TicketService();
    }

    /**
     * Daftar pengajuan untuk diverifikasi
     */
    public function index()
    {
        $this->authorize(Permissions::REQUEST_VERIFY);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->ticketService->getList([
            'keyword'  => $keyword,
            'statuses' => ['submitted', 'revision'],
        ]);

        return view('verifications/index', $this->viewData([
            'title'      => 'Verifikasi Pengajuan',
            'pageTitle'  => 'Verifikasi Pengajuan',
            'breadcrumb' => ['Verifikasi'],
            'keyword'    => $keyword,
            'requests'   => $result['tickets'],
            'pager'      => $result['pager'],
        ]));
    }

    /**
     * Detail pengajuan untuk verifikasi
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::REQUEST_VERIFY);

        $request = $this->ticketService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('verifications/show', $this->viewData([
            'title'      => 'Verifikasi Pengajuan',
            'pageTitle'  => 'Verifikasi Pengajuan',
            'request'    => $request,
            'files'      => [],
        ]));
    }

    /**
     * Verifikasi pengajuan
     */
    public function verify(int $id)
    {
        $this->authorize(Permissions::REQUEST_VERIFY);

        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $request = $this->ticketService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->ticketService->changeStatus($id, 'processing', $userId, 'Pengajuan diverifikasi dan diproses');

        $this->logActivity('verify_ticket', 'Memverifikasi tiket #' . $id, 'tickets', $id);

        // Notifikasi real-time ke pemohon
        if ($request) {
            $this->notificationService->notifyProfileOwner(
                (int) ($request['user_profile_id'] ?? 0),
                'Pengajuan Diverifikasi',
                'Pengajuan ' . ($request['ticket_number'] ?? '#') . $id . ' telah diverifikasi dan sedang diproses.',
                'success',
                $id,
                site_url('tracking/show/' . $id)
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

        $request = $this->ticketService->getById($id);

        if (! $request) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->ticketService->changeStatus($id, 'rejected', $userId, $note ?: 'Pengajuan ditolak');

        $this->logActivity('reject_ticket', 'Menolak tiket #' . $id, 'tickets', $id);

        // Notifikasi real-time ke pemohon
        $this->notificationService->notifyProfileOwner(
            (int) ($request['user_profile_id'] ?? 0),
            'Pengajuan Ditolak',
            'Pengajuan ' . ($request['ticket_number'] ?? '#') . $id . ' ditolak.' . ($note !== '' ? " Alasan: $note" : ''),
            'danger',
            $id,
            site_url('tracking/show/' . $id)
        );

        return redirect()
            ->to(site_url('verifications'))
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
