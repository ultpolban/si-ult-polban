<?php

namespace App\Controllers\Api\V1;

use App\Models\UserModel;

class UserController extends BaseApiController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * GET /api/v1/users
     */
    public function index()
    {
        $users = $this->userModel
            ->select("
                users.id,
                users.full_name,
                users.personal_email,
                users.phone,
                users.is_active,
                roles.role_name,
                user_types.type_name
            ")
            ->join('roles', 'roles.id = users.role_id')
            ->join('user_types', 'user_types.id = users.user_type_id')
            ->orderBy('users.full_name', 'ASC')
            ->findAll();

        return $this->successResponse($users, 'Daftar pengguna berhasil diambil.');
    }

    public function show($id = null)
    {
        $user = $this->userModel
            ->select("
            users.*,
            roles.role_name,
            user_types.type_name,
            departments.department_name,
            study_programs.program_name,
            work_units.unit_name
        ")
            ->join('roles', 'roles.id = users.role_id')
            ->join('user_types', 'user_types.id = users.user_type_id')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->join('study_programs', 'study_programs.id = users.study_program_id', 'left')
            ->join('work_units', 'work_units.id = users.work_unit_id', 'left')
            ->where('users.id', $id)
            ->first();

        if (!$user) {
            return $this->errorResponse('User tidak ditemukan.', 404);
        }

        unset($user['password']);

        return $this->successResponse($user, 'Detail pengguna berhasil diambil.');
    }

    public function toggleStatus($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->errorResponse('User tidak ditemukan.', 404);
        }

        $this->userModel->update($id, [
            'is_active' => !$user['is_active']
        ]);

        return $this->successResponse([], 'Status pengguna berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->errorResponse('User tidak ditemukan.', 404);
        }

        $this->userModel->delete($id);

        return $this->successResponse([], 'User berhasil dihapus.');
    }

    public function update($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->errorResponse('User tidak ditemukan.', 404);
        }

        $data = $this->request->getJSON(true);

        // Password tidak boleh diubah dari endpoint ini
        unset($data['password']);

        $this->userModel->update($id, $data);

        return $this->successResponse([], 'Profil berhasil diperbarui.');
    }
}
