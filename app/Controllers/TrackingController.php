<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\TicketService;
use App\Models\UserProfileModel;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class TrackingController extends AdminController
{
    protected TicketService $ticketService;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService = new TicketService();
        $this->profileModel  = new UserProfileModel();
    }

    /**
     * Daftar tiket saya (pemohon) / semua tiket (petugas/pimpinan).
     */
    public function index()
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $profile = $this->profileModel->findByUser($userId);

        $myTickets = $profile
            ? $this->ticketService->myTickets((int) $profile['id'])
            : [];

        return view('tracking/index', $this->viewData([
            'title'      => 'Lacak Tiket',
            'pageTitle'  => 'Lacak Tiket',
            'breadcrumb' => ['Tiket', 'Lacak'],
            'myTickets'  => $myTickets,
        ]));
    }

    /**
     * Cek status tiket publik / form lacak.
     */
    public function track()
    {
        return view('tracking/track', $this->viewData([
            'title'      => 'Cek Status Tiket',
            'pageTitle'  => 'Cek Status Tiket',
            'breadcrumb' => ['Tiket', 'Cek Status'],
            'ticket'     => null,
            'history'    => [],
        ]));
    }

    /**
     * Proses pencarian tiket berdasarkan nomor tiket.
     */
    public function search()
    {
        $ticketNumber = trim($this->request->getGet('ticket_number') ?? '');

        $ticket = null;
        $history = [];

        if ($ticketNumber !== '') {
            $ticket = $this->ticketService->findByTicket($ticketNumber);

            if ($ticket) {
                $history = $this->ticketService->history((int) $ticket['id']);
            }
        }

        return view('tracking/track', $this->viewData([
            'title'         => 'Cek Status Tiket',
            'pageTitle'     => 'Cek Status Tiket',
            'breadcrumb'    => ['Tiket', 'Cek Status'],
            'ticketNumber'  => $ticketNumber,
            'ticket'        => $ticket,
            'history'       => $history,
        ]));
    }

    /**
     * Detail tiket beserta riwayatnya.
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $ticket = $this->ticketService->getById($id);

        if (! $ticket) {
            throw PageNotFoundException::forPageNotFound();
        }

        $history = $this->ticketService->history($id);

        return view('tracking/show', $this->viewData([
            'title'      => 'Detail Tiket',
            'pageTitle'  => 'Detail Tiket',
            'breadcrumb' => ['Tiket', 'Detail'],
            'ticket'     => $ticket,
            'history'    => $history,
            'files'      => [],
        ]));
    }
}
