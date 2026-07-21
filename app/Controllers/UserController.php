<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\WorkUnitModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $roleModel;
    protected $workUnitModel;

    public function __construct()
    {
        $this->userModel     = new UserModel();
        $this->roleModel     = new RoleModel();
        $this->workUnitModel = new WorkUnitModel();
    }

    /*
    |--------------------------------------------------------------------------
    | MANAGEMENT USER
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->userModel
            ->select('
                users.*,
                roles.role_name,
                work_units.unit_name
            ')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->join('work_units', 'work_units.id = users.work_unit_id', 'left');

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if (!empty($keyword)) {

            $builder->groupStart()

                ->like('users.full_name', $keyword)

                ->orLike('users.personal_email', $keyword)

                ->orLike('users.phone', $keyword)

                ->orLike('roles.role_name', $keyword)

                ->groupEnd();
        }

        /*
        |--------------------------------------------------------------------------
        | ORDER
        |--------------------------------------------------------------------------
        */

        $builder->orderBy('users.id', 'DESC');

        $data = [

            'title'   => 'Management User',

            'users'   => $builder->paginate(10),

            'pager'   => $this->userModel->pager,

            'keyword' => $keyword

        ];

        return view('users/index', $data);
    }

        /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH USER
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data = [

            'title'      => 'Tambah User',

            'roles'      => $this->roleModel->findAll(),

            'workUnits'  => $this->workUnitModel->findAll()

        ];

        return view('users/create', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN USER
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $rules = [

            'role_id' => 'required',

            'full_name' => 'required|min_length[3]',

            'personal_email' => 'required|valid_email|is_unique[users.personal_email]',

            'phone' => 'required',

            'password' => 'required|min_length[6]'

        ];

        if (!$this->validate($rules)) {

            return redirect()->back()

                ->withInput()

                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([

            'role_id'             => $this->request->getPost('role_id'),

            'work_unit_id'        => $this->request->getPost('work_unit_id') ?: null,

            'full_name'           => $this->request->getPost('full_name'),

            'gender'              => $this->request->getPost('gender'),

            'phone'               => $this->request->getPost('phone'),

            'nip'                 => $this->request->getPost('nip'),

            'nidn'                => $this->request->getPost('nidn'),

            'institution_email'   => $this->request->getPost('institution_email'),

            'personal_email'      => $this->request->getPost('personal_email'),

            'birth_place'         => $this->request->getPost('birth_place'),

            'birth_date'          => $this->request->getPost('birth_date'),

            'address'             => $this->request->getPost('address'),

            'password'            => password_hash(
                                        $this->request->getPost('password'),
                                        PASSWORD_DEFAULT
                                    ),

            'is_active'           => $this->request->getPost('is_active')

        ]);

        return redirect()

            ->to('/users')

            ->with('success', 'User berhasil ditambahkan.');
    }

        /*
    |--------------------------------------------------------------------------
    | DETAIL USER
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $user = $this->userModel
            ->select('
                users.*,
                roles.role_name,
                work_units.unit_name
            ')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->join('work_units', 'work_units.id = users.work_unit_id', 'left')
            ->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail User',
            'user'  => $user
        ];

        return view('users/show', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT USER
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User tidak ditemukan.');
        }

        $data = [

            'title' => 'Edit User',

            'user' => $user,

            'roles' => $this->roleModel->findAll(),

            'workUnits' => $this->workUnitModel->findAll()

        ];

        return view('users/edit', $data);
    }

        /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')
                ->with('error', 'User tidak ditemukan.');
        }

        $rules = [

            'role_id'        => 'required',
            'full_name'      => 'required|min_length[3]',
            'personal_email' => 'required|valid_email',
            'phone'          => 'required'

        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());

        }

        $data = [

            'role_id'           => $this->request->getPost('role_id'),
            'work_unit_id'      => $this->request->getPost('work_unit_id') ?: null,
            'full_name'         => $this->request->getPost('full_name'),
            'gender'            => $this->request->getPost('gender'),
            'phone'             => $this->request->getPost('phone'),
            'nip'               => $this->request->getPost('nip'),
            'nidn'              => $this->request->getPost('nidn'),
            'institution_email' => $this->request->getPost('institution_email'),
            'personal_email'    => $this->request->getPost('personal_email'),
            'birth_place'       => $this->request->getPost('birth_place'),
            'birth_date'        => $this->request->getPost('birth_date'),
            'address'           => $this->request->getPost('address'),
            'is_active'         => $this->request->getPost('is_active')

        ];

        if (!empty($this->request->getPost('password'))) {

            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );

        }

        $this->userModel->update($id, $data);

        return redirect()->to('/users')
            ->with('success', 'User berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | AKTIF / NONAKTIF USER
    |--------------------------------------------------------------------------
    */

    public function toggle($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return redirect()->to('/users')
                ->with('error', 'User tidak ditemukan.');

        }

        $this->userModel->update($id, [

            'is_active' => !$user['is_active']

        ]);

        return redirect()->to('/users')
            ->with('success', 'Status user berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS USER
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {

            return redirect()->to('/users')
                ->with('error', 'User tidak ditemukan.');

        }

        $this->userModel->delete($id);

        return redirect()->to('/users')
            ->with('success', 'User berhasil dihapus.');
    }
}