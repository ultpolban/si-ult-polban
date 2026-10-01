<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\ApplicantTypeService;
use App\Validation\ApplicantTypeValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ApplicantTypeController extends AdminController
{
    /**
     * Service
     */
    protected ApplicantTypeService $applicantTypeService;

    public function __construct()
    {
        parent::__construct();

        $this->applicantTypeService = service('applicantTypeService');
    }

    /**
     * List Data
     */
    public function index()
    {
        $this->authorize(Permissions::APPLICANT_TYPE_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->applicantTypeService->getList($keyword);

        return view('master/applicant-type/index', $this->viewData([
            'title'            => 'Master Jenis Pemohon',
            'pageTitle'        => 'Master Jenis Pemohon',
            'applicantTypes'   => $result['applicantTypes'],
            'pager'            => $result['pager'],
            'keyword'          => $keyword,
        ]));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::APPLICANT_TYPE_CREATE);

        return view('master/applicant-type/create', $this->viewData([
            'title'      => 'Tambah Jenis Pemohon',
            'pageTitle'  => 'Tambah Jenis Pemohon',
        ]));
    }

    /**
     * Simpan
     */
    public function store()
    {
        $this->authorize(Permissions::APPLICANT_TYPE_CREATE);

        if (! $this->validate(ApplicantTypeValidator::store())) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->applicantTypeService->create(
            $this->request->getPost()
        );

        $this->logActivity('create_applicant_type', 'Menambahkan jenis pemohon baru', 'applicant_types');

        return redirect()
            ->to(site_url('master/applicant-types'))
            ->with('success', 'Jenis pemohon berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::APPLICANT_TYPE_VIEW);

        $applicantType = $this->applicantTypeService->getById($id);

        if (!$applicantType) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/applicant-type/show', $this->viewData([
            'title'          => 'Detail Jenis Pemohon',
            'pageTitle'      => 'Detail Jenis Pemohon',
            'applicantType'  => $applicantType,
        ]));
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::APPLICANT_TYPE_UPDATE);

        $applicantType = $this->applicantTypeService->getById($id);

        if (!$applicantType) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/applicant-type/edit', $this->viewData([
            'title'          => 'Edit Jenis Pemohon',
            'pageTitle'      => 'Edit Jenis Pemohon',
            'applicantType'  => $applicantType,
        ]));
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::APPLICANT_TYPE_UPDATE);

        if (! $this->validate(ApplicantTypeValidator::update($id))) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->applicantTypeService->update(
            $id,
            $this->request->getPost()
        );

        $this->logActivity('update_applicant_type', 'Memperbarui jenis pemohon #' . $id, 'applicant_types', $id);

        return redirect()
            ->to(site_url('master/applicant-types'))
            ->with('success', 'Jenis pemohon berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::APPLICANT_TYPE_DELETE);

        $this->applicantTypeService->delete($id);

        $this->logActivity('delete_applicant_type', 'Menghapus jenis pemohon #' . $id, 'applicant_types', $id);

        return redirect()
            ->back()
            ->with('success', 'Jenis pemohon berhasil dihapus.');
    }

    /**
     * Restore
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::APPLICANT_TYPE_RESTORE);

        $this->applicantTypeService->restore($id);

        $this->logActivity('restore_applicant_type', 'Mengembalikan jenis pemohon #' . $id, 'applicant_types', $id);

        return redirect()
            ->back()
            ->with('success', 'Jenis pemohon berhasil dikembalikan.');
    }

    /**
     * Ubah Status
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::APPLICANT_TYPE_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->applicantTypeService->changeStatus($id, $status);

        $this->logActivity('change_applicant_type_status', 'Ubah status jenis pemohon #' . $id, 'applicant_types', $id);

        return redirect()
            ->back()
            ->with('success', 'Status berhasil diperbarui.');
    }
}