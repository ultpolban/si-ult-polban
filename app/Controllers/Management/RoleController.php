<?php

namespace App\Controllers\Management;

use App\Controllers\AdminController;
use App\Services\RoleService;
use App\Validation\RoleValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class RoleController extends AdminController
{
    protected RoleService $roleService;

    public function __construct()
    {
        parent::__construct();

        $this->roleService = service('roleService');
    }

    /**
     * List Role
     */
    public function index()
    {
        $this->authorize(Permissions::ROLE_VIEW);

        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );

        $result = $this->roleService->getList($keyword);

        return view(
            'management/roles/index',
            $this->viewData([
                'title'     => 'Master Role',
                'pageTitle' => 'Master Role',
                'roles'     => $result['roles'],
                'pager'     => $result['pager'],
                'keyword'   => $keyword,
            ])
        );
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::ROLE_CREATE);

        return view(
            'management/roles/create',
            $this->viewData([
                'title'     => 'Tambah Role',
                'pageTitle' => 'Tambah Role',
            ])
        );
    }

    /**
     * Simpan
     */
    public function store()
    {
        $this->authorize(Permissions::ROLE_CREATE);

        if (! $this->validate(RoleValidator::store())) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->roleService->create(
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('roles'))
            ->with(
                'success',
                'Role berhasil ditambahkan.'
            );
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::ROLE_VIEW);

        $role = $this->roleService->getById($id);

        if (! $role) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'management/roles/show',
            $this->viewData([
                'title'     => 'Detail Role',
                'pageTitle' => 'Detail Role',
                'role'      => $role,
            ])
        );
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::ROLE_UPDATE);

        $role = $this->roleService->getById($id);

        if (! $role) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'management/roles/edit',
            $this->viewData([
                'title'     => 'Edit Role',
                'pageTitle' => 'Edit Role',
                'role'      => $role,
            ])
        );
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::ROLE_UPDATE);

        if (! $this->validate(RoleValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->roleService->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('roles'))
            ->with(
                'success',
                'Role berhasil diperbarui.'
            );
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::ROLE_DELETE);

        $this->roleService->delete($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Role berhasil dihapus.'
            );
    }
}
