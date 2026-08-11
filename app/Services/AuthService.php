<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class AuthService extends BaseService
{
    protected UserModel $userModel;

    protected UserProfileModel $profileModel;

    public function __construct()
    {
        parent::__construct();

        $this->userModel = new UserModel();

        $this->profileModel = new UserProfileModel();
    }

    /**
     * Login
     */
    public function login(
        string $username,
        string $password
    ): bool {
        $user = $this->userModel
            ->findByUsernameOrEmail($username);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        if ((int) $user['is_active'] !== 1) {
            return false;
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'role_id'    => $user['role_id'],
            'full_name'  => $user['full_name'],
            'email'      => $user['email'],
        ]);

        return true;
    }

    /**
     * Logout
     */
    public function logout(): void
    {
        session()->destroy();
    }

    /**
     * Current User
     */
    public function user(): ?array
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return null;
        }

        return $this->userModel
            ->withProfile()
            ->find($userId);
    }

    /**
     * Check Login
     */
    public function check(): bool
    {
        return session()->get('isLoggedIn') === true;
    }

    /**
     * User ID
     */
    public function id(): ?int
    {
        return session()->get('user_id');
    }

    /**
     * Hash Password
     */
    public function hashPassword(
        string $password
    ): string {
        return password_hash(
            $password,
            PASSWORD_DEFAULT
        );
    }

    /**
     * Verify Password
     */
    public function verifyPassword(
        string $password,
        string $hash
    ): bool {
        return password_verify(
            $password,
            $hash
        );
    }
}
