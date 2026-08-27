<?php

namespace App\Controllers\Content;

use App\Controllers\AdminController;
use App\Services\FaqService;
use App\Validation\FaqValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class FaqController extends AdminController
{
    protected FaqService $faqService;

    public function __construct()
    {
        parent::__construct();

        $this->faqService = service('faqService');
    }

    /**
     * List Data
     */
    public function index()
    {
        $this->authorize(Permissions::FAQ_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->faqService->getList($keyword);

        return view('faqs/index', $this->viewData([
            'title'   => 'Manajemen FAQ',
            'pageTitle' => 'Manajemen FAQ',
            'faqs'    => $result['faqs'],
            'pager'   => $result['pager'],
            'keyword' => $keyword,
        ]));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::FAQ_CREATE);

        return view('faqs/create', $this->viewData([
            'title'     => 'Tambah FAQ',
            'pageTitle' => 'Tambah FAQ',
        ]));
    }

    /**
     * Simpan
     */
    public function store()
    {
        $this->authorize(Permissions::FAQ_CREATE);

        if (! $this->validate(FaqValidator::store())) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->faqService->create(
            $this->request->getPost()
        );

        $this->logActivity(
            'create',
            'Menambahkan FAQ baru: ' . $this->request->getPost('question'),
            'faq',
            null
        );

        return redirect()
            ->to(site_url('faqs'))
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::FAQ_VIEW);

        $faq = $this->faqService->getById($id);

        if (! $faq) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('faqs/show', $this->viewData([
            'title'     => 'Detail FAQ',
            'pageTitle' => 'Detail FAQ',
            'faq'       => $faq,
        ]));
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::FAQ_UPDATE);

        $faq = $this->faqService->getById($id);

        if (! $faq) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('faqs/edit', $this->viewData([
            'title'     => 'Edit FAQ',
            'pageTitle' => 'Edit FAQ',
            'faq'       => $faq,
        ]));
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::FAQ_UPDATE);

        if (! $this->validate(FaqValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->faqService->update(
            $id,
            $this->request->getPost()
        );

        $this->logActivity(
            'update',
            'Memperbarui FAQ: ' . $this->request->getPost('question'),
            'faq',
            $id
        );

        return redirect()
            ->to(site_url('faqs'))
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::FAQ_DELETE);

        $faq = $this->faqService->getById($id);

        $this->faqService->delete($id);

        $this->logActivity(
            'delete',
            'Menghapus FAQ: ' . ($faq['question'] ?? ''),
            'faq',
            $id
        );

        return redirect()
            ->back()
            ->with('success', 'FAQ berhasil dihapus.');
    }

    /**
     * Restore
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::FAQ_RESTORE);

        $this->faqService->restore($id);

        $this->logActivity(
            'restore',
            'Memulihkan FAQ (id: ' . $id . ')',
            'faq',
            $id
        );

        return redirect()
            ->back()
            ->with('success', 'FAQ berhasil dikembalikan.');
    }

    /**
     * Ubah Status
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::FAQ_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->faqService->changeStatus(
            $id,
            $status
        );

        $this->logActivity(
            'update',
            'Mengubah status FAQ (id: ' . $id . ')',
            'faq',
            $id
        );

        return redirect()
            ->back()
            ->with('success', 'Status FAQ berhasil diperbarui.');
    }
}