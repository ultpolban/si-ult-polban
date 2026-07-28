<?php

namespace App\Controllers\Api\V1;

use App\Services\AuthService;

class AuthController extends BaseApiController
{
    protected AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function register()
    {
        $data = $this->request->getJSON(true);

        // Validasi input
        if (!$this->validateData($data, 'register')) {
            return $this->errorResponse(
                $this->validator->getErrors(),
                422
            );
        }

        // Proses register
        $result = $this->authService->register($data);

        if (!$result['success']) {
            return $this->errorResponse($result['message']);
        }

        return $this->successResponse([], $result['message'], 201);
    }

    public function login()
    {
        $data = $this->request->getJSON(true);

        // Validasi input
        if (!$this->validateData($data, 'login')) {
            return $this->errorResponse(
                $this->validator->getErrors(),
                422
            );
        }

        // Proses login
        $result = $this->authService->login($data);

        if (!$result['success']) {
            return $this->errorResponse($result['message'], 401);
        }

        return $this->successResponse([
            'token' => $result['token'],
            'user'  => $result['user']
        ], $result['message']);
    }

    public function profile()
    {
        $result = $this->authService->profile($this->request->user);

        if (!$result['success']) {
            return $this->errorResponse($result['message'], 404);
        }

        return $this->successResponse(
            $result['data'],
            $result['message']
        );
    }

    public function changePassword()
    {
        $result = $this->authService->changePassword(
            $this->request->user,
            $this->request->getJSON(true)
        );

        if (!$result['success']) {
            return $this->errorResponse($result['message']);
        }

        return $this->successResponse([], $result['message']);
    }

    public function logout()
    {
        return $this->successResponse([], 'Logout berhasil.');
    }
}
