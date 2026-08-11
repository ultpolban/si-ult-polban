<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\PermissionService;
use App\Validation\PermissionValidator;
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
        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );

        $result = $this->permissionService
            ->getList($keyword);

        return view(
            'master/permission/index',
            $this->viewData([

                'title' => 'Master Permission',

                'pageTitle' => 'Master Permission',

                'permissions' => $result['permissions'],

                'pager' => $result['pager'],

                'keyword' => $keyword

            ])
        );
    }

    public function create()
    {
        return view(
            'master/permission/create',
            $this->viewData([

                'title' => 'Tambah Permission',

                'pageTitle' => 'Tambah Permission'

            ])
        );
    }

    public function store()
    {
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
            ->to(site_url('master/permissions'))
            ->with(
                'success',
                'Permission berhasil ditambahkan.'
            );
    }

    public function show(int $id)
    {
        $permission = $this->permissionService
            ->getById($id);

        if (! $permission) {

            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'master/permission/show',
            $this->viewData([

                'title' => 'Detail Permission',

                'pageTitle' => 'Detail Permission',

                'permission' => $permission

            ])
        );
    }

    public function edit(int $id)
    {
        $permission = $this->permissionService
            ->getById($id);

        if (! $permission) {

            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'master/permission/edit',
            $this->viewData([

                'title' => 'Edit Permission',

                'pageTitle' => 'Edit Permission',

                'permission' => $permission

            ])
        );
    }

    public function update(int $id)
    {
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
            ->to(site_url('master/permissions'))
            ->with(
                'success',
                'Permission berhasil diperbarui.'
            );
    }

    public function delete(int $id)
    {
        $this->permissionService->delete($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Permission berhasil dihapus.'
            );
    }
}
