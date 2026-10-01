<?php

namespace App\Controllers;

use App\Models\UserModel;

class ResetPasswordController extends BaseController
{
    public function reset()
    {
        $email = 'muhamadrafiputrazakaria@gmail.com';

        // Password sementara
        $newPassword = 'Rapiu@12345';

        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return 'Akun tidak ditemukan.';
        }

        $updated = $userModel->update(
            $user['id'],
            [
                'password' => password_hash(
                    $newPassword,
                    PASSWORD_DEFAULT
                ),
            ]
        );

        if (!$updated) {
            return 'Gagal mengubah password.';
        }

        return 'Password berhasil direset.';
    }
}