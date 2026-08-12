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
                    users.email,
                    users.phone_number as phone,
                    users.is_active,
                    roles.name as role_name,
                    master_applicant_types.name
                ")
            ->join('roles', 'roles.id = users.role_id')
            ->join('user_profiles', 'user_profiles.user_id = users.id', 'left')
            ->join('master_applicant_types', 'master_applicant_types.id = user_profiles.applicant_type_id', 'left')
            ->orderBy('users.full_name', 'ASC')
            ->findAll();

        return $this->successResponse($users, 'Daftar pengguna berhasil diambil.');
    }

    public function show($id = null)
    {
        $user = $this->userModel
            ->select("
                users.*,
                roles.name as role_name,
                master_applicant_types.name,
                master_departments.name as department_name,
                master_study_programs.name as program_name,
                master_service_units.name as unit_name
            ")
            ->join('roles', 'roles.id = users.role_id')
            ->join('user_profiles', 'user_profiles.user_id = users.id', 'left')
            ->join('master_applicant_types', 'master_applicant_types.id = user_profiles.applicant_type_id', 'left')
            ->join('master_study_programs', 'master_study_programs.id = user_profiles.study_program_id', 'left')
            ->join('master_departments', 'master_departments.id = master_study_programs.department_id', 'left')


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
