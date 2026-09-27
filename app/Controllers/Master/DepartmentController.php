<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\DepartmentService;
use App\Validation\DepartmentValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class DepartmentController extends AdminController
{
    /**
     * Service
     */
    protected DepartmentService $departmentService;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->departmentService = service('departmentService');
    }

    /**
     * Daftar Jurusan
     */
    public function index()
    {
        $this->authorize(Permissions::DEPARTMENT_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->departmentService->getList($keyword);

        return view('master/department/index', $this->viewData([
            'title'       => 'Master Jurusan',
            'pageTitle'   => 'Master Jurusan',
            'breadcrumb'  => [
                'Master Data',
                'Jurusan',
            ],
            'keyword'     => $keyword,
            'departments' => $result['departments'],
            'pager'       => $result['pager'],
        ]));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::DEPARTMENT_CREATE);

        return view('master/department/create', $this->viewData([
            'title'      => 'Tambah Jurusan',
            'pageTitle'  => 'Tambah Jurusan',
            'breadcrumb' => [
                'Master Data',
                'Jurusan',
                'Tambah',
            ],
        ]));
    }

    /**
     * Simpan
     */
    public function store()
    {
        $this->authorize(Permissions::DEPARTMENT_CREATE);

        if (! $this->validate(DepartmentValidator::store())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->departmentService->create($this->request->getPost());

        $this->logActivity(
            'CREATE_DEPARTMENT',
            'Menambahkan data jurusan'
        );

        return redirect()
            ->to(site_url('master/departments'))
            ->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::DEPARTMENT_VIEW);

        $department = $this->departmentService->getById($id);

        if (!$department) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/department/show', $this->viewData([
            'title'      => 'Detail Jurusan',
            'pageTitle'  => 'Detail Jurusan',
            'department' => $department,
        ]));
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::DEPARTMENT_UPDATE);

        $department = $this->departmentService->getById($id);

        if (!$department) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/department/edit', $this->viewData([
            'title'      => 'Edit Jurusan',
            'pageTitle'  => 'Edit Jurusan',
            'department' => $department,
        ]));
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::DEPARTMENT_UPDATE);

        if (! $this->validate(DepartmentValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->departmentService->update(
            $id,
            $this->request->getPost()
        );

        $this->logActivity(
            'UPDATE_DEPARTMENT',
            'Mengubah data jurusan'
        );

        return redirect()
            ->to(site_url('master/departments'))
            ->with('success', 'Data jurusan berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::DEPARTMENT_DELETE);

        $this->departmentService->delete($id);

        $this->logActivity(
            'DELETE_DEPARTMENT',
            'Menghapus data jurusan'
        );

        return redirect()
            ->back()
            ->with('success', 'Data jurusan berhasil dihapus.');
    }

    /**
     * Restore
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::DEPARTMENT_RESTORE);

        $this->departmentService->restore($id);

        $this->logActivity(
            'RESTORE_DEPARTMENT',
            'Mengembalikan data jurusan'
        );

        return redirect()
            ->back()
            ->with('success', 'Data jurusan berhasil dipulihkan.');
    }

    /**
     * Ubah Status
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::DEPARTMENT_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->departmentService->changeStatus($id, $status);

        return redirect()
            ->back()
            ->with('success', 'Status jurusan berhasil diperbarui.');
    }
}
