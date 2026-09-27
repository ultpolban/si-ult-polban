<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\ServiceUnitService;
use App\Validation\ServiceUnitValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServiceUnitController extends AdminController
{
    /**
     * Service
     */
    protected ServiceUnitService $serviceUnitService;

    public function __construct()
    {
        parent::__construct();

        $this->serviceUnitService = service('serviceUnitService');
    }

    /**
     * ==========================================
     * INDEX - List Data
     * ==========================================
     */
    public function index()
    {
        $this->authorize(Permissions::SERVICE_UNIT_VIEW);

        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );

        $result = $this->serviceUnitService->getList($keyword);

        return view(
            'master/service-unit/index',
            $this->viewData([
                'title'        => 'Master Unit Layanan',
                'pageTitle'    => 'Master Unit Layanan',
                'serviceUnits' => $result['serviceUnits'],
                'pager'        => $result['pager'],
                'keyword'      => $keyword,
            ])
        );
    }

    /**
     * ==========================================
     * CREATE - Form Tambah
     * ==========================================
     */
    public function create()
    {
        $this->authorize(Permissions::SERVICE_UNIT_CREATE);

        return view(
            'master/service-unit/create',
            $this->viewData([
                'title'     => 'Tambah Unit Layanan',
                'pageTitle' => 'Tambah Unit Layanan',
            ])
        );
    }

    /**
     * ==========================================
     * STORE - Simpan
     * ==========================================
     */
    public function store()
    {
        $this->authorize(Permissions::SERVICE_UNIT_CREATE);

        if (! $this->validate(ServiceUnitValidator::store())) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceUnitService->create(
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/service-units'))
            ->with('success', 'Unit layanan berhasil ditambahkan.');
    }

    /**
     * ==========================================
     * SHOW - Detail
     * ==========================================
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::SERVICE_UNIT_VIEW);

        $serviceUnit = $this->serviceUnitService->getById($id);

        if (! $serviceUnit) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'master/service-unit/show',
            $this->viewData([
                'title'       => 'Detail Unit Layanan',
                'pageTitle'   => 'Detail Unit Layanan',
                'serviceUnit' => $serviceUnit,
            ])
        );
    }

    /**
     * ==========================================
     * EDIT - Form Edit
     * ==========================================
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::SERVICE_UNIT_UPDATE);

        $serviceUnit = $this->serviceUnitService->getById($id);

        if (! $serviceUnit) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'master/service-unit/edit',
            $this->viewData([
                'title'       => 'Edit Unit Layanan',
                'pageTitle'   => 'Edit Unit Layanan',
                'serviceUnit' => $serviceUnit,
            ])
        );
    }

    /**
     * ==========================================
     * UPDATE - Update Data
     * ==========================================
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::SERVICE_UNIT_UPDATE);

        if (! $this->validate(ServiceUnitValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->serviceUnitService->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/service-units'))
            ->with('success', 'Unit layanan berhasil diperbarui.');
    }

    /**
     * ==========================================
     * DELETE - Hapus
     * ==========================================
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::SERVICE_UNIT_DELETE);

        $this->serviceUnitService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Unit layanan berhasil dihapus.');
    }

    /**
     * ==========================================
     * RESTORE - Kembalikan
     * ==========================================
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::SERVICE_UNIT_RESTORE);

        $this->serviceUnitService->restore($id);

        return redirect()
            ->back()
            ->with('success', 'Unit layanan berhasil dikembalikan.');
    }

    /**
     * ==========================================
     * CHANGE STATUS - Ubah Status
     * ==========================================
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::SERVICE_UNIT_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->serviceUnitService->changeStatus(
            $id,
            $status
        );

        return redirect()
            ->back()
            ->with('success', 'Status unit layanan berhasil diperbarui.');
    }
}
