<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\UserModel;

class RoleController extends BaseController
{
    protected RoleModel $roleModel;
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form']);

        $this->roleModel = new RoleModel();
        $this->userModel = new UserModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $keyword = trim($this->request->getGet('keyword'));

        $perPage = 10;

        $roles = $this->roleModel

            ->search($keyword)

            ->paginate($perPage);

        foreach ($roles as &$role) {

            $role['total_user'] = $this->roleModel

                ->countUser($role['id']);
        }

        $data = [

            'title' => 'Management Role',

            'roles' => $roles,

            'pager' => $this->roleModel->pager,

            'keyword' => $keyword,

            'totalRole' => $this->roleModel->countAll()

        ];

        return view('roles/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('roles/create', [

            'title'      => 'Tambah Role',

            'role'       => [],

            'validation' => \Config\Services::validation()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        if (
            !$this->validate(
                $this->validationRules(),
                $this->validationMessages()
            )
        ) {

            return redirect()

                ->back()

                ->withInput()

                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->roleModel->insert([

            'role_name'   => trim(
                $this->request->getPost('role_name')
            ),

            'description' => trim(
                $this->request->getPost('description')
            )

        ]);

        return redirect()

            ->to(base_url('roles'))

            ->with(
                'success',
                'Role berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Role tidak ditemukan.'
            );
        }

        return view('roles/edit', [

            'title'      => 'Edit Role',

            'role'       => $role,

            'validation' => \Config\Services::validation()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {

            return redirect()

                ->to(base_url('roles'))

                ->with(
                    'error',
                    'Role tidak ditemukan.'
                );
        }

        if (
            !$this->validate(
                $this->validationRules((int) $id),
                $this->validationMessages()
            )
        ) {

            return redirect()

                ->back()

                ->withInput()

                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->roleModel->update($id, [

            'role_name' => trim(
                $this->request->getPost('role_name')
            ),

            'description' => trim(
                $this->request->getPost('description')
            )

        ]);

        return redirect()

            ->to(base_url('roles'))

            ->with(
                'success',
                'Role berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $role = $this->roleModel->find($id);

        if (!$role) {

            return redirect()

                ->to(base_url('roles'))

                ->with(
                    'error',
                    'Role tidak ditemukan.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Administrator tidak boleh dihapus
    |--------------------------------------------------------------------------
    */

        if ($role['id'] == 1) {

            return redirect()

                ->to(base_url('roles'))

                ->with(
                    'error',
                    'Role Administrator tidak dapat dihapus.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Role masih digunakan User
    |--------------------------------------------------------------------------
    */

        $totalUser = $this->userModel

            ->where('role_id', $id)

            ->countAllResults();

        if ($totalUser > 0) {

            return redirect()

                ->to(base_url('roles'))

                ->with(
                    'error',
                    'Role tidak dapat dihapus karena masih digunakan oleh ' . $totalUser . ' user.'
                );
        }

        $this->roleModel->delete($id);

        return redirect()

            ->to(base_url('roles'))

            ->with(
                'success',
                'Role berhasil dihapus.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

    private function validationRules(?int $id = null): array
    {
        $roleRule = 'required|max_length[100]';

        if ($id === null) {

            $roleRule .= '|is_unique[roles.role_name]';
        } else {

            $roleRule .= '|is_unique[roles.role_name,id,' . $id . ']';
        }

        return [

            'role_name' => $roleRule,

            'description' => 'permit_empty|max_length[255]'

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION MESSAGES
    |--------------------------------------------------------------------------
    */

    private function validationMessages(): array
    {
        return [

            'role_name' => [

                'required'   => 'Nama role wajib diisi.',

                'max_length' => 'Nama role maksimal 100 karakter.',

                'is_unique'  => 'Nama role sudah digunakan.'

            ],

            'description' => [

                'max_length' => 'Deskripsi maksimal 255 karakter.'

            ]

        ];
    }
}
