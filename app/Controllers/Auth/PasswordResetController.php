<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Services\PasswordResetService;

class PasswordResetController extends BaseController
{
    protected PasswordResetService $passwordResetService;

    public function __construct()
    {
        helper('form');
        $this->passwordResetService = new PasswordResetService();
    }

    public function requestForm()
    {
        return view('auth/password_forgot', [
            'title' => 'Lupa Password',
        ]);
    }

    public function sendLink()
    {
        $email = trim((string) $this->request->getPost('email'));

        if (! $this->validateData(['email' => $email], [
            'email' => 'required|valid_email|max_length[150]',
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->passwordResetService->requestReset($email);

        return redirect()->to('/password/forgot')->with(
            'success',
            'Jika email tersebut terdaftar dan akun aktif, instruksi reset password akan dikirim.'
        );
    }

    public function resetForm(string $token)
    {
        return view('auth/password_reset', [
            'title'      => 'Reset Password',
            'token'      => $token,
            'validToken' => $this->passwordResetService->isValidToken($token),
        ]);
    }

    public function updatePassword(string $token)
    {
        if (! $this->passwordResetService->isValidToken($token)) {
            return redirect()->to('/password/reset/' . rawurlencode($token));
        }

        $password     = (string) $this->request->getPost('password');
        $confirmation = (string) $this->request->getPost('password_confirmation');

        if (strlen($password) > 72) {
            return redirect()->back()
                ->with('errors', ['password' => 'Password tidak boleh melebihi 72 byte.']);
        }

        if (! $this->validateData([
            'password'              => $password,
            'password_confirmation' => $confirmation,
        ], [
            'password'              => 'required|min_length[8]|max_length[255]',
            'password_confirmation' => 'required|matches[password]',
        ])) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors());
        }

        if (! $this->passwordResetService->resetPassword($token, $password)) {
            return redirect()->to('/password/reset/' . rawurlencode($token));
        }

        return redirect()->to('/login/form')->with(
            'success',
            'Password berhasil diubah. Silakan login menggunakan password baru.'
        );
    }
}