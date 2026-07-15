<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
    }

    // Menampilkan daftar user
    public function index()
    {
        $data['users'] = $this->userModel
            ->select('users.*, roles.role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->findAll();

        return view('users/index', $data);
    }

    // Form tambah user
    public function create()
    {
        $data['roles'] = $this->db->table('roles')->get()->getResultArray();

        return view('users/create', $data);
    }

    // Simpan user
    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'phone'    => 'required',
            'password' => 'required|min_length[6]',
            'role_id'  => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id'   => $this->request->getPost('role_id'),
            'is_active' => 1,
        ]);

        return redirect()->to('/users')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        $data['roles'] = $this->db->table('roles')->get()->getResultArray();

        return view('users/edit', $data);
    }

    // Update user
    public function update($id)
    {
        $rules = [
            'name'    => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'phone'   => 'required',
            'role_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'role_id' => $this->request->getPost('role_id')
        ]);

        return redirect()->to('/users')
            ->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/users');
    }
}
