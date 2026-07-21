<?php

namespace App\Controllers;

use App\Models\RoleModel;

class RoleController extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Management Role',

            'roles' => $this->roleModel
                ->orderBy('id', 'ASC')
                ->findAll()

        ];

        return view('roles/index', $data);
    }

    public function create()
    {
        return view('roles/create', [
            'title' => 'Tambah Role'
        ]);
    }

    public function store()
    {
        $this->validate([

            'role_name' => 'required',

            'description' => 'permit_empty'

        ]);

        $this->roleModel->save([

            'role_name' => $this->request->getPost('role_name'),

            'description' => $this->request->getPost('description')

        ]);

        return redirect()->to('/roles')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('roles/edit', [

            'title' => 'Edit Role',

            'role' => $this->roleModel->find($id)

        ]);
    }

    public function update($id)
    {
        $this->roleModel->update($id, [

            'role_name' => $this->request->getPost('role_name'),

            'description' => $this->request->getPost('description')

        ]);

        return redirect()->to('/roles')
            ->with('success', 'Role berhasil diubah.');
    }

    public function delete($id)
    {
        $this->roleModel->delete($id);

        return redirect()->to('/roles')
            ->with('success', 'Role berhasil dihapus.');
    }
}
