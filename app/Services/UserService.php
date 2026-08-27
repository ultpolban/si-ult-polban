<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\MasterRoleModel;

class UserService extends BaseService
{
    protected $model;

    protected UserProfileModel $profileModel;

    protected MasterRoleModel $roleModel;

    public function __construct()
    {
        $this->model = new UserModel();

        $this->profileModel = new UserProfileModel();

        $this->roleModel = new MasterRoleModel();
    }

    /**
     * List User
     */
    public function paginate(int $perPage = 10)
    {
        return $this->model
            ->getWithRole()
            ->orderBy('users.full_name', 'ASC')
            ->paginate($perPage);
    }

    /**
     * Detail User
     */
    public function find(int $id): ?array
    {
        return $this->model
            ->getWithRole()
            ->where('users.id', $id)
            ->first();
    }

    /**
     * Simpan User
     */
    public function store(array $data): int
    {
        unset($data['password_confirmation']);

        if (!empty($data['password'])) {
            $data['password'] = password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            );
        }

        $userData = [
            'role_id'          => $data['role_id'] ?? null,
            'full_name'        => $data['full_name'] ?? '',
            'identity_number'  => $data['identity_number'] ?? null,
            'phone_number'     => $data['phone_number'] ?? null,
            'gender'           => in_array($data['gender'] ?? '', ['L', 'P'], true) ? $data['gender'] : null,
            'email'            => $data['email'] ?? '',
            'password'         => $data['password'] ?? '',
            'is_active'        => isset($data['is_active']) ? 1 : 0,
        ];

        $userId = $this->model->insert($userData);

        if (!$userId) {
            return 0;
        }

        // Simpan profile pemohon
        $this->saveProfile((int) $userId, $data);

        return (int) $userId;
    }

    /**
     * Update User
     */
    public function update(int $id, array $data): bool
    {
        unset($data['password_confirmation']);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            );
        }

        $userData = [
            'role_id'          => $data['role_id'] ?? null,
            'full_name'        => $data['full_name'] ?? '',
            'identity_number'  => $data['identity_number'] ?? null,
            'phone_number'     => $data['phone_number'] ?? null,
            'gender'           => in_array($data['gender'] ?? '', ['L', 'P'], true) ? $data['gender'] : null,
            'email'            => $data['email'] ?? '',
            'is_active'        => isset($data['is_active']) ? 1 : 0,
        ];

        if (isset($data['password'])) {
            $userData['password'] = $data['password'];
        }

        $result = $this->model->update($id, $userData);

        if ($result) {
            $this->saveProfile($id, $data);
        }

        return $result;
    }

    /**
     * Simpan / Perbarui profile pemohon
     */
    protected function saveProfile(int $userId, array $data): void
    {
        $profile = $this->profileModel
            ->where('user_id', $userId)
            ->first();

        $profileData = [
            'user_id'            => $userId,
            'applicant_type_id'  => $data['applicant_type_id'] ?? null,
            'study_program_id'   => !empty($data['study_program_id']) ? $data['study_program_id'] : null,
            'class_id'           => !empty($data['class_id']) ? $data['class_id'] : null,
            'nim'                => !empty($data['nim']) ? $data['nim'] : null,
            'nik'                => !empty($data['nik']) ? $data['nik'] : null,
            'student_name'       => !empty($data['student_name']) ? $data['student_name'] : null,
            'institution_name'   => !empty($data['institution_name']) ? $data['institution_name'] : null,
            'position'           => !empty($data['position']) ? $data['position'] : null,
            'name'               => $data['full_name'] ?? '',
            'email'              => $data['email'] ?? '',
            'phone'              => $data['phone_number'] ?? null,
            'address'            => $data['address'] ?? null,
        ];

        // Bersihkan field kosong agar tidak overwrite data lama
        $profileData = array_filter($profileData, fn($value) => $value !== null);

        if ($profile) {
            $this->profileModel->update($profile['id'], $profileData);
        } else {
            $this->profileModel->insert($profileData);
        }
    }

    /**
     * Restore User
     */
    public function restore(int $id): bool
    {
        return parent::restore($id);
    }

    /**
     * Active User
     */
    public function getActive(): array
    {
        return $this->model->getActive();
    }

    /**
     * Login
     */
    public function findByEmail(string $email): ?array
    {
        return $this->model->findByEmail($email);
    }

    /**
     * Update Last Login
     */
    public function updateLastLogin(int $id): bool
    {
        return $this->model->updateLastLogin($id);
    }

    /**
     * Search User
     */
    public function search(string $keyword, int $perPage = 10)
    {
        return $this->model
            ->getWithRole()
            ->search($keyword)
            ->orderBy('users.full_name', 'ASC')
            ->paginate($perPage);
    }

    /**
     * Model
     */
    public function getModel(): UserModel
    {
        return $this->model;
    }
}
