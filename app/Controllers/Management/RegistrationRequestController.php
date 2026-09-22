<?php

namespace App\Controllers\Management;

use App\Controllers\AdminController;
use App\Constants\Permissions;
use App\Services\RegistrationRequestService;
use App\Validation\RegistrationRequestValidator;
use CodeIgniter\Exceptions\PageNotFoundException;

class RegistrationRequestController extends AdminController
{
    protected RegistrationRequestService $requestService;

    public function __construct()
    {
        parent::__construct();

        $this->requestService = new RegistrationRequestService();
    }

    /**
     * Daftar Permintaan Izin Registrasi
     */
    public function index()
    {
        $this->authorize(Permissions::REGISTRATION_REQUEST_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');
        $status  = trim($this->request->getGet('status') ?? '');

        $result = $this->requestService->getList($keyword, $status);

        return view('management/registration-requests/index', $this->viewData([
            'title'     => 'Manajemen Permintaan Registrasi',
            'pageTitle' => 'Manajemen Permintaan Registrasi',
            'items'     => $result['items'],
            'pager'     => $result['pager'],
            'keyword'   => $keyword,
            'status'    => $status,
        ]));
    }

    /**
     * Detail Permintaan Izin Registrasi
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::REGISTRATION_REQUEST_VIEW);

        $item = $this->requestService->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('management/registration-requests/show', $this->viewData([
            'title'     => 'Detail Permintaan Registrasi',
            'pageTitle' => 'Detail Permintaan Registrasi',
            'item'      => $item,
        ]));
    }

    /**
     * Setujui Permintaan Izin Registrasi
     */
    public function approve(int $id)
    {
        $this->authorize(Permissions::REGISTRATION_REQUEST_APPROVE);

        if ($this->request->getMethod(true) !== 'POST') {
            return redirect()
                ->back()
                ->with('error', 'Metode tidak diizinkan.');
        }

        $item = $this->requestService->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($item['status'] !== 'pending') {
            return redirect()
                ->back()
                ->with('error', 'Permintaan hanya dapat disetujui jika berstatus pending.');
        }

        $result = $this->requestService->approve(
            $id,
            (int) ($this->user['id'] ?? 0),
            (string) ($this->user['full_name'] ?? '')
        );

        if (! $result['ok']) {
            return redirect()
                ->back()
                ->with('error', $result['error'] !== ''
                    ? $result['error']
                    : 'Gagal menyetujui permintaan. Silakan coba lagi.');
        }

        $this->logActivity(
            'registration_request_approved',
            'Admin menyetujui permintaan registrasi dari ' . $item['email'],
            'registration_request',
            $id
        );

        return redirect()
            ->back()
            ->with('success', 'Permintaan izin registrasi dari ' . $item['email'] . ' berhasil disetujui. Akun pemohon (ID ' . $result['user_id'] . ') telah dibuat dan menunggu aktivasi MFA.');
    }

    /**
     * Tolak Permintaan Izin Registrasi
     */
    public function reject(int $id)
    {
        $this->authorize(Permissions::REGISTRATION_REQUEST_REJECT);

        if ($this->request->getMethod(true) !== 'POST') {
            return redirect()
                ->back()
                ->with('error', 'Metode tidak diizinkan.');
        }

        $item = $this->requestService->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($item['status'] !== 'pending') {
            return redirect()
                ->back()
                ->with('error', 'Permintaan hanya dapat ditolak jika berstatus pending.');
        }

        if (! $this->validate(RegistrationRequestValidator::reject())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $reason = trim((string) $this->request->getPost('rejection_reason'));

        $ok = $this->requestService->reject(
            $id,
            (int) ($this->user['id'] ?? 0),
            $reason,
            (string) ($this->user['full_name'] ?? '')
        );

        if (! $ok) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menolak permintaan. Silakan coba lagi.');
        }

        $this->logActivity(
            'registration_request_rejected',
            'Admin menolak permintaan registrasi dari ' . $item['email'],
            'registration_request',
            $id
        );

        return redirect()
            ->back()
            ->with('success', 'Permintaan izin registrasi dari ' . $item['email'] . ' berhasil ditolak.');
    }
}
