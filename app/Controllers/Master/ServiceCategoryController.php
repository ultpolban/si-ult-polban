<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\ServiceCategoryService;
use App\Services\ServiceUnitService;
use App\Validation\ServiceCategoryValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServiceCategoryController extends AdminController
{
    protected ServiceCategoryService $serviceCategoryService;
    protected ServiceUnitService $serviceUnitService;

    public function __construct()
    {
        parent::__construct();

        $this->serviceCategoryService = service('serviceCategoryService');
        $this->serviceUnitService     = service('serviceUnitService');
    }

    /**
     * List Data
     */
    public function index()
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->serviceCategoryService->getList($keyword);

        return view('master/service-category/index', $this->viewData([
            'title'             => 'Master Kategori Layanan',
            'pageTitle'         => 'Master Kategori Layanan',
            'serviceCategories' => $result['serviceCategories'],
            'pager'             => $result['pager'],
            'keyword'           => $keyword,
        ]));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_CREATE);

        return view('master/service-category/create', $this->viewData([
            'title'        => 'Tambah Kategori Layanan',
            'pageTitle'    => 'Tambah Kategori Layanan',
            'serviceUnits' => $this->serviceUnitService->getDropdown(),
        ]));
    }

    /**
     * Simpan
     */
    public function store()
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_CREATE);

        if (! $this->validate(ServiceCategoryValidator::store())) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceCategoryService->create(
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/service-categories'))
            ->with('success', 'Kategori layanan berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_VIEW);

        $serviceCategory = $this->serviceCategoryService->getById($id);

        if (! $serviceCategory) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/service-category/show', $this->viewData([
            'title'           => 'Detail Kategori Layanan',
            'pageTitle'       => 'Detail Kategori Layanan',
            'serviceCategory' => $serviceCategory,
        ]));
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_UPDATE);

        $serviceCategory = $this->serviceCategoryService->getById($id);

        if (! $serviceCategory) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/service-category/edit', $this->viewData([
            'title'           => 'Edit Kategori Layanan',
            'pageTitle'       => 'Edit Kategori Layanan',
            'serviceCategory' => $serviceCategory,
            'serviceUnits'    => $this->serviceUnitService->getDropdown(),
        ]));
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_UPDATE);

        if (! $this->validate(ServiceCategoryValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceCategoryService->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/service-categories'))
            ->with('success', 'Kategori layanan berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_DELETE);

        $this->serviceCategoryService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Kategori layanan berhasil dihapus.');
    }

    /**
     * Restore
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_RESTORE);

        $this->serviceCategoryService->restore($id);

        return redirect()
            ->back()
            ->with('success', 'Kategori layanan berhasil dikembalikan.');
    }

    /**
     * Ubah Status
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::SERVICE_CATEGORY_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->serviceCategoryService->changeStatus(
            $id,
            $status
        );

        return redirect()
            ->back()
            ->with('success', 'Status kategori layanan berhasil diperbarui.');
    }
}
