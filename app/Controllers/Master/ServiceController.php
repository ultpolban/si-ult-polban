<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\ServiceService;
use App\Services\ServiceUnitService;
use App\Services\ServiceCategoryService;
use App\Validation\ServiceValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServiceController extends AdminController
{
    protected ServiceService $serviceService;
    protected ServiceUnitService $serviceUnitService;
    protected ServiceCategoryService $serviceCategoryService;

    public function __construct()
    {
        parent::__construct();

        $this->serviceService         = service('serviceService');
        $this->serviceUnitService     = service('serviceUnitService');
        $this->serviceCategoryService = service('serviceCategoryService');
    }

    /**
     * List Data
     */
    public function index()
    {
        $this->authorize(Permissions::SERVICE_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->serviceService->getList($keyword);

        return view('master/service/index', $this->viewData([
            'title'    => 'Master Layanan',
            'pageTitle' => 'Master Layanan',
            'services' => $result['services'],
            'pager'    => $result['pager'],
            'keyword'  => $keyword,
        ]));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::SERVICE_CREATE);

        return view('master/service/create', $this->viewData([
            'title'             => 'Tambah Layanan',
            'pageTitle'         => 'Tambah Layanan',
            'serviceUnits'      => $this->serviceUnitService->getDropdown(),
            'serviceCategories' => $this->serviceCategoryService->getDropdown(),
        ]));
    }

    /**
     * Simpan
     */
    public function store()
    {
        $this->authorize(Permissions::SERVICE_CREATE);

        if (! $this->validate(ServiceValidator::store())) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceService->create(
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/services'))
            ->with('success', 'Data layanan berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::SERVICE_VIEW);

        $service = $this->serviceService->getById($id);

        if (! $service) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/service/show', $this->viewData([
            'title'   => 'Detail Layanan',
            'pageTitle' => 'Detail Layanan',
            'service' => $service,
        ]));
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::SERVICE_UPDATE);

        $service = $this->serviceService->getById($id);

        if (! $service) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/service/edit', $this->viewData([
            'title'             => 'Edit Layanan',
            'pageTitle'         => 'Edit Layanan',
            'service'           => $service,
            'serviceUnits'      => $this->serviceUnitService->getDropdown(),
            'serviceCategories' => $this->serviceCategoryService->getDropdown(),
        ]));
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::SERVICE_UPDATE);

        if (! $this->validate(ServiceValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceService->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/services'))
            ->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::SERVICE_DELETE);

        $this->serviceService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Data layanan berhasil dihapus.');
    }

    /**
     * Restore
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::SERVICE_RESTORE);

        $this->serviceService->restore($id);

        return redirect()
            ->back()
            ->with('success', 'Data layanan berhasil dikembalikan.');
    }

    /**
     * Ubah Status
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::SERVICE_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->serviceService->changeStatus(
            $id,
            $status
        );

        return redirect()
            ->back()
            ->with('success', 'Status layanan berhasil diperbarui.');
    }
}
