<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\TicketService;
use App\Services\ServiceService;
use App\Models\UserProfileModel;
use App\Models\UserModel;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class TicketController extends AdminController
{
    protected TicketService $ticketService;
    protected ServiceService $serviceService;
    protected UserProfileModel $profileModel;
    protected UserModel $userModel;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService   = new TicketService();
        $this->serviceService  = new ServiceService();
        $this->profileModel    = new UserProfileModel();
        $this->userModel       = new UserModel();
    }

    /**
     * ==========================================
     * INDEX (Daftar Tiket)
     * ==========================================
     */
    public function index()
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');
        $status  = trim($this->request->getGet('status') ?? '');
        $priority = trim($this->request->getGet('priority') ?? '');

        $result = $this->ticketService->getList([
            'keyword'  => $keyword,
            'status'   => $status,
            'priority' => $priority,
        ]);

        return view('tickets/index', $this->viewData([
            'title'      => 'Manajemen Tiket',
            'pageTitle'  => 'Manajemen Tiket',
            'breadcrumb' => ['Tiket', 'Manajemen'],
            'tickets'    => $result['tickets'],
            'pager'      => $result['pager'],
            'keyword'    => $keyword,
            'status'     => $status,
            'priority'   => $priority,
        ]));
    }

    /**
     * ==========================================
     * CREATE (Form Tambah Tiket)
     * ==========================================
     */
    public function create()
    {
        $this->authorize(Permissions::REQUEST_CREATE);

        $applicants = $this->profileModel
            ->getComplete()
            ->where('roles.code', 'PEMOHON')
            ->orderBy('user_profiles.name', 'ASC')
            ->findAll();

        return view('tickets/create', $this->viewData([
            'title'      => 'Buat Tiket',
            'pageTitle'  => 'Buat Tiket',
            'breadcrumb' => ['Tiket', 'Buat'],
            'services'   => $this->serviceService->getActive(),
            'applicants' => $applicants,
            'assignees'  => $this->userModel->getActive(),
            'ticket'     => [],
        ]));
    }

    /**
     * ==========================================
     * STORE (Simpan Tiket)
     * ==========================================
     */
    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->authorize(Permissions::REQUEST_CREATE);

        $data = $this->request->getPost();

        $this->ticketService->create($data);

        $this->logActivity('create_ticket', 'Membuat tiket baru', 'tickets');

        return redirect()
            ->to(site_url('tickets'))
            ->with('success', 'Tiket berhasil dibuat.');
    }

    /**
     * ==========================================
     * SHOW (Detail Tiket)
     * ==========================================
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::REQUEST_VIEW);

        $ticket = $this->ticketService->getById($id);

        if (! $ticket) {
            throw PageNotFoundException::forPageNotFound();
        }

        $history = $this->ticketService->history($id);

        return view('tickets/show', $this->viewData([
            'title'      => 'Detail Tiket',
            'pageTitle'  => 'Detail Tiket',
            'breadcrumb' => ['Tiket', 'Detail'],
            'ticket'     => $ticket,
            'history'    => $history,
        ]));
    }

    /**
     * ==========================================
     * EDIT (Form Edit Tiket)
     * ==========================================
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::REQUEST_UPDATE);

        $ticket = $this->ticketService->getById($id);

        if (! $ticket) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('tickets/edit', $this->viewData([
            'title'      => 'Edit Tiket',
            'pageTitle'  => 'Edit Tiket',
            'breadcrumb' => ['Tiket', 'Edit'],
            'ticket'     => $ticket,
            'services'   => $this->serviceService->getActive(),
            'applicants' => $this->profileModel->findAll(),
            'assignees'  => $this->userModel->getActive(),
        ]));
    }

    /**
     * ==========================================
     * UPDATE (Update Tiket)
     * ==========================================
     */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->authorize(Permissions::REQUEST_UPDATE);

        $this->ticketService->update($id, $this->request->getPost());

        $this->logActivity('update_ticket', 'Memperbarui tiket #' . $id, 'tickets', $id);

        return redirect()
            ->to(site_url('tickets/show/' . $id))
            ->with('success', 'Tiket berhasil diperbarui.');
    }

    /**
     * ==========================================
     * DELETE (Hapus Tiket)
     * ==========================================
     */
    public function delete(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->authorize(Permissions::REQUEST_CANCEL);

        $this->ticketService->delete($id);

        $this->logActivity('delete_ticket', 'Menghapus tiket #' . $id, 'tickets', $id);

        return redirect()
            ->to(site_url('tickets'))
            ->with('success', 'Tiket berhasil dihapus.');
    }

    /**
     * ==========================================
     * CHANGE STATUS (Ubah Status Tiket)
     * ==========================================
     */
    public function changeStatus(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->authorize(Permissions::REQUEST_UPDATE);

        $status = trim($this->request->getPost('status') ?? '');
        $note   = trim($this->request->getPost('note') ?? '');

        $allowed = ['submitted', 'verification', 'revision', 'processing', 'completed', 'rejected', 'cancelled'];

        if (! in_array($status, $allowed, true)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $this->ticketService->changeStatus(
            $id,
            $status,
            (int) ($this->user['id'] ?? session()->get('user_id')),
            $note
        );

        $this->logActivity('change_ticket_status', 'Ubah status tiket #' . $id . ' menjadi ' . $status, 'tickets', $id);

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui.');
    }
}
