<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RoleController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // Daftar Role
    public function index()
    {
        $data['roles'] = $this->db->table('roles')->orderBy('id', 'ASC')->get()->getResultArray();
        return view('roles/index', $data);
    }

    // Form Tambah Role
    public function create()
    {
        return view('roles/create');
    }

    // Simpan Role
    public function store()
    {
        $rules = [
            'role_name'   => 'required|min_length[3]|is_unique[roles.role_name]',
            'description' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->db->table('roles')->insert([
            'role_name'   => $this->request->getPost('role_name'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/roles')->with('success', 'Role berhasil ditambahkan.');
    }

    // Form Edit Role
    public function edit($id)
    {
        $data['role'] = $this->db->table('roles')->where('id', $id)->get()->getRowArray();
        if (!$data['role']) {
            return redirect()->to('/roles')->with('error', 'Role tidak ditemukan.');
        }
        return view('roles/edit', $data);
    }

    // Update Role
    public function update($id)
    {
        $rules = [
            'role_name'   => 'required|min_length[3]',
            'description' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->db->table('roles')->where('id', $id)->update([
            'role_name'   => $this->request->getPost('role_name'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/roles')->with('success', 'Role berhasil diperbarui.');
    }

    // Hapus Role
    public function delete($id)
    {
        // Cek apakah role sedang digunakan oleh user
        $usersWithRole = $this->db->table('users')->where('role_id', $id)->countAllResults();
        if ($usersWithRole > 0) {
            return redirect()->to('/roles')->with('error', 'Role tidak bisa dihapus karena masih digunakan oleh ' . $usersWithRole . ' user.');
        }

        $this->db->table('roles')->where('id', $id)->delete();
        return redirect()->to('/roles')->with('success', 'Role berhasil dihapus.');
    }
}
