<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Manajemen user sederhana (dipakai oleh menu "users" & "admin-users").
 * Kolom yang dipakai mengikuti skema tabel `users` dan `roles`:
 *   users  : id, role_id, full_name, identity_number, phone_number,
 *            gender, email, password, is_active, ...
 *   roles  : id, code, name, is_active, ...
 */
class UserController extends BaseController
{
    protected UserModel $userModel;

    protected $db;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db        = \Config\Database::connect();
    }

    // Menampilkan daftar user
    public function index()
    {
        $users = $this->userModel
            ->select('users.*, roles.name AS role_name, roles.code AS role_code')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->orderBy('users.id', 'ASC')
            ->findAll();

        return view('users/index', [
            'title' => 'Manajemen User',
            'users' => $users,
        ]);
    }

    // Form tambah user
    public function create()
    {
        return view('users/create', [
            'title' => 'Tambah User',
            'roles' => $this->activeRoles(),
        ]);
    }

    // Simpan user
    public function store()
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[150]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[8]',
            'role_id'   => 'required|integer',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'full_name'       => $this->request->getPost('full_name'),
            'email'           => $this->request->getPost('email'),
            'phone_number'    => $this->nullable($this->request->getPost('phone_number')),
            'identity_number' => $this->nullable($this->request->getPost('identity_number')),
            'password'        => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id'         => (int) $this->request->getPost('role_id'),
            'is_active'       => 1,
        ]);

        return redirect()->to('/users')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            return redirect()->to('/users')
                ->with('error', 'User tidak ditemukan.');
        }

        return view('users/edit', [
            'title' => 'Edit User',
            'user'  => $user,
            'roles' => $this->activeRoles(),
        ]);
    }

    // Update user
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (! $user) {
            return redirect()->to('/users')
                ->with('error', 'User tidak ditemukan.');
        }

        $rules = [
            'full_name' => 'required|min_length[3]|max_length[150]',
            'email'     => 'required|valid_email',
            'role_id'   => 'required|integer',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name'       => $this->request->getPost('full_name'),
            'email'           => $this->request->getPost('email'),
            'phone_number'    => $this->nullable($this->request->getPost('phone_number')),
            'identity_number' => $this->nullable($this->request->getPost('identity_number')),
            'role_id'         => (int) $this->request->getPost('role_id'),
            'is_active'       => (int) $this->request->getPost('is_active') === 1 ? 1 : 0,
        ];

        // Password hanya diubah bila diisi.
        $password = trim((string) $this->request->getPost('password'));

        if ($password !== '') {
            if (strlen($password) < 8) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Password minimal 8 karakter.');
            }

            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/users')
            ->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function delete($id)
    {
        $id = (int) $id;

        // Jangan sampai admin menghapus akunnya sendiri.
        if ($id === (int) session()->get('user_id')) {
            return redirect()->to('/users')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        if (! $this->userModel->find($id)) {
            return redirect()->to('/users')
                ->with('error', 'User tidak ditemukan.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/users')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Daftar role aktif.
     */
    protected function activeRoles(): array
    {
        return $this->db
            ->table('roles')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Helper: string kosong -> null
     */
    protected function nullable($value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
