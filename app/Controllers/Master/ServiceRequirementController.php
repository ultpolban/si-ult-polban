<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\ServiceRequirementService;
use App\Services\ServiceService;
use App\Validation\ServiceRequirementValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServiceRequirementController extends AdminController
{
    protected ServiceRequirementService $serviceRequirementService;
    protected ServiceService $serviceService;

    public function __construct()
    {
        parent::__construct();

        $this->serviceRequirementService = service('serviceRequirementService');
        $this->serviceService            = service('serviceService');
    }

    /**
     * List Data
     */
    public function index()
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->serviceRequirementService->getList($keyword);

        return view('master/service-requirement/index', $this->viewData([
            'title'        => 'Master Persyaratan Layanan',
            'pageTitle'    => 'Master Persyaratan Layanan',
            'requirements' => $result['requirements'],
            'pager'        => $result['pager'],
            'keyword'      => $keyword,
        ]));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_CREATE);

        return view('master/service-requirement/create', $this->viewData([
            'title'     => 'Tambah Persyaratan',
            'pageTitle' => 'Tambah Persyaratan',
            'services'  => $this->serviceService->getDropdown(),
        ]));
    }

    /**
     * Simpan
     */
    public function store()
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_CREATE);

        if (! $this->validate(ServiceRequirementValidator::store())) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceRequirementService->create(
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/service-requirements'))
            ->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_VIEW);

        $requirement = $this->serviceRequirementService->getById($id);

        if (! $requirement) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/service-requirement/show', $this->viewData([
            'title'       => 'Detail Persyaratan',
            'pageTitle'   => 'Detail Persyaratan',
            'requirement' => $requirement,
        ]));
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_UPDATE);

        $requirement = $this->serviceRequirementService->getById($id);

        if (! $requirement) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/service-requirement/edit', $this->viewData([
            'title'       => 'Edit Persyaratan',
            'pageTitle'   => 'Edit Persyaratan',
            'requirement' => $requirement,
            'services'    => $this->serviceService->getDropdown(),
        ]));
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_UPDATE);

        if (! $this->validate(ServiceRequirementValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceRequirementService->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/service-requirements'))
            ->with('success', 'Persyaratan berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_DELETE);

        $this->serviceRequirementService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Persyaratan berhasil dihapus.');
    }

    /**
     * Restore
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::SERVICE_REQUIREMENT_RESTORE);

        $this->serviceRequirementService->restore($id);

        return redirect()
            ->back()
            ->with('success', 'Persyaratan berhasil dikembalikan.');
    }
}
