<?php

namespace App\Controllers\Management;

use App\Controllers\AdminController;
use App\Services\PermissionService;
use App\Validation\PermissionValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class PermissionController extends AdminController
{
    protected PermissionService $permissionService;

    public function __construct()
    {
        parent::__construct();

        $this->permissionService = service('permissionService');
    }

    public function index()
    {
        $this->authorize(Permissions::PERMISSION_VIEW);

        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );

        $result = $this->permissionService
            ->getList($keyword);

        return view(
            'management/permissions/index',
            $this->viewData([

                'title' => 'Manajemen Permission',

                'pageTitle' => 'Manajemen Permission',

                'permissions' => $result['permissions'],

                'pager' => $result['pager'],

                'keyword' => $keyword

            ])
        );
    }

    public function create()
    {
        $this->authorize(Permissions::PERMISSION_UPDATE);

        return view(
            'management/permissions/create',
            $this->viewData([

                'title' => 'Tambah Permission',

                'pageTitle' => 'Tambah Permission'

            ])
        );
    }

    public function store()
    {
        $this->authorize(Permissions::PERMISSION_UPDATE);

        if (! $this->validate(
            PermissionValidator::store()
        )) {

            return redirect()
                ->back()
                ->withInput();
        }

        $this->permissionService
            ->create(
                $this->request->getPost()
            );

        return redirect()
            ->to(site_url('permissions'))
            ->with(
                'success',
                'Permission berhasil ditambahkan.'
            );
    }

    public function show(int $id)
    {
        $this->authorize(Permissions::PERMISSION_VIEW);

        $permission = $this->permissionService
            ->getById($id);

        if (! $permission) {

            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'management/permissions/show',
            $this->viewData([

                'title' => 'Detail Permission',

                'pageTitle' => 'Detail Permission',

                'permission' => $permission

            ])
        );
    }

    public function edit(int $id)
    {
        $this->authorize(Permissions::PERMISSION_UPDATE);

        $permission = $this->permissionService
            ->getById($id);

        if (! $permission) {

            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'management/permissions/edit',
            $this->viewData([

                'title' => 'Edit Permission',

                'pageTitle' => 'Edit Permission',

                'permission' => $permission

            ])
        );
    }

    public function update(int $id)
    {
        $this->authorize(Permissions::PERMISSION_UPDATE);

        if (! $this->validate(
            PermissionValidator::update($id)
        )) {

            return redirect()
                ->back()
                ->withInput();
        }

        $this->permissionService
            ->update(
                $id,
                $this->request->getPost()
            );

        return redirect()
            ->to(site_url('permissions'))
            ->with(
                'success',
                'Permission berhasil diperbarui.'
            );
    }

    public function delete(int $id)
    {
        $this->authorize(Permissions::PERMISSION_UPDATE);

        $this->permissionService->delete($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Permission berhasil dihapus.'
            );
    }
}
