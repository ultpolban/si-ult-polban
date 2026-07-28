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
        $search = $this->request->getGet('search');

        $query = $this->userModel
            ->select('users.*, roles.role_name')
            ->join('roles', 'roles.id = users.role_id');

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('users.name', $search)
                ->orLike('users.email', $search)
                ->orLike('users.phone', $search)
                ->groupEnd();
        }

        $data['users'] = $query->findAll();
        $data['search'] = $search;

        return view('users/index', $data);
    }

    // Toggle user status (Aktif/Nonaktif)
    public function toggleStatus($id)
    {
        $user = $this->userModel->find($id);
        if ($user) {
            $newStatus = ($user['is_active'] == 1) ? 0 : 1;
            $this->userModel->update($id, ['is_active' => $newStatus]);
            
            $statusText = ($newStatus == 1) ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->to('/users')->with('success', "User " . esc($user['name']) . " berhasil {$statusText}.");
        }
        return redirect()->to('/users');
    }


    // Form tambah user
    public function create()
    {
        $data['roles']   = $this->db->table('roles')->get()->getResultArray();
        $data['jurusan'] = $this->db->table('jurusans')->orderBy('nama_jurusan', 'ASC')->get()->getResultArray();
        $data['prodi']   = $this->db->table('program_studis')
                                    ->select('program_studis.*, program_studis.jurusan_id')
                                    ->orderBy('nama_program', 'ASC')
                                    ->get()->getResultArray();

        return view('users/create', $data);
    }

    // Simpan user
    public function store()
    {
        $rules = [
            'name'          => 'required|min_length[3]',
            'password'      => 'required|min_length[6]',
            'role_id'       => 'required',
            'email'         => 'permit_empty|valid_email|is_unique[users.email]',
            'email_pribadi' => 'permit_empty|valid_email',
        ];

        $messages = [
            'email' => [
                'is_unique'   => 'Email institusi sudah digunakan oleh user lain. Gunakan email yang berbeda.',
                'valid_email' => 'Format Email Institusi tidak valid.',
            ],
            'email_pribadi' => [
                'valid_email' => 'Format Email Personal tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Create upload dir if not exists
        $uploadDir = ROOTPATH . 'public/uploads/users';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Handle photo upload
        $fotoName = null;
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move($uploadDir, $fotoName);
        }

        $userData = [
            'name'           => $this->request->getPost('name'),
            'email'          => $this->request->getPost('email') ?: null,
            'email_pribadi'  => $this->request->getPost('email_pribadi') ?: null,
            'phone'          => $this->request->getPost('phone') ?: null,
            'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id'        => $this->request->getPost('role_id'),
            'unit_kerja'     => $this->request->getPost('unit_kerja') ?: null,
            'jenis_pemohon'  => $this->request->getPost('jenis_pemohon') ?: null,
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin') ?: null,
            'tempat_lahir'   => $this->request->getPost('tempat_lahir') ?: null,
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir') ?: null,
            'alamat'         => $this->request->getPost('alamat') ?: null,
            'is_active'      => $this->request->getPost('is_active') ?? 1,
            'foto'           => $fotoName,
        ];

        // Mahasiswa-specific fields
        if ($this->request->getPost('jenis_pemohon') === 'Mahasiswa') {
            $userData['nim']              = $this->request->getPost('nim') ?: null;
            $userData['jurusan_id']       = $this->request->getPost('jurusan_id') ?: null;
            $userData['prodi_id']         = $this->request->getPost('prodi_id') ?: null;
            $userData['kelas']            = $this->request->getPost('kelas') ?: null;
            $userData['angkatan']         = $this->request->getPost('angkatan') ?: null;
            $userData['status_mahasiswa'] = $this->request->getPost('status_mahasiswa') ?: null;
            $userData['tahun_masuk']      = $this->request->getPost('tahun_masuk') ?: null;
        }

        try {
            $this->userModel->save($userData);
        } catch (\Exception $e) {
            $errMsg = 'Gagal menyimpan user. ';
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $errMsg .= 'Email yang dimasukkan sudah terdaftar di sistem. Gunakan email lain.';
            } else {
                $errMsg .= 'Terjadi kesalahan sistem, silakan coba lagi.';
            }
            return redirect()->back()
                ->withInput()
                ->with('errors', [$errMsg]);
        }

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
