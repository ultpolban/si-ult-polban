<?php

namespace App\Services;

use App\Libraries\TOTP;
use App\Models\UserModel;

/**
 * MfaService - Service untuk Multi-Factor Authentication (TOTP)
 */
class MfaService
{
    protected TOTP $totp;

    protected UserModel $userModel;

    protected string $issuer = 'SI ULT POLBAN';

    public function __construct()
    {
        $this->totp = new TOTP();
        $this->totp->setIssuer($this->issuer);

        $this->userModel = new UserModel();
    }

    /**
     * Issuer
     */
    public function issuer(): string
    {
        return $this->issuer;
    }

    /**
     * Generate random secret
     */
    public function generateSecret(): string
    {
        return $this->totp->generateSecret();
    }

    /**
     * Generate provisioning URI for QR
     */
    public function provisioningUri(string $secret, string $accountName): string
    {
        return $this->totp->provisioningUri($secret, $accountName);
    }

    /**
     * Generate list of recovery codes
     */
    public function generateRecoveryCodes(int $count = 10): array
    {
        $codes = [];

        while (count($codes) < $count) {
            $partOne = strtoupper(substr(bin2hex(random_bytes(6)), 0, 4));
            $partTwo = strtoupper(substr(bin2hex(random_bytes(6)), 0, 4));

            $code = $partOne . '-' . $partTwo;

            if (! in_array($code, $codes, true)) {
                $codes[] = $code;
            }
        }

        return $codes;
    }

    /**
     * Begin setup: store secret + recovery codes (MFA disabled until verified)
     */
    public function beginSetup(int $userId, string $secret, array $recoveryCodes): bool
    {
        return $this->userModel->update($userId, [
            'mfa_secret'         => $secret,
            'mfa_recovery_codes' => json_encode($recoveryCodes, JSON_UNESCAPED_SLASHES),
            'mfa_enabled'        => 0,
        ]);
    }

    /**
     * Activate MFA & activate user account after successful verification
     */
    public function activate(int $userId): bool
    {
        return $this->userModel->update($userId, [
            'mfa_enabled'      => 1,
            'mfa_confirmed_at' => date('Y-m-d H:i:s'),
            'is_active'        => 1,
        ]);
    }

    /**
     * Verify TOTP code for a user
     */
    public function verifyCode(int $userId, string $code): bool
    {
        $user = $this->userModel->find($userId);

        if (! $user || empty($user['mfa_secret'])) {
            return false;
        }

        return $this->totp->verify($user['mfa_secret'], $code);
    }

    /**
     * Verify a recovery code (case insensitive)
     */
    public function verifyRecoveryCode(int $userId, string $code): bool
    {
        $user = $this->userModel->find($userId);

        if (! $user) {
            return false;
        }

        $codes = json_decode($user['mfa_recovery_codes'] ?? '[]', true);

        if (! is_array($codes)) {
            return false;
        }

        $normalized = strtoupper(trim($code));

        foreach ($codes as $recoveryCode) {
            if (strtoupper(trim((string) $recoveryCode)) === $normalized) {
                return true;
            }
        }

        return false;
    }

    /**
     * Consume (hapus) recovery code yang sudah digunakan (sekali pakai)
     */
    public function consumeRecoveryCode(int $userId, string $code): bool
    {
        $user = $this->userModel->find($userId);

        if (! $user) {
            return false;
        }

        $codes = json_decode($user['mfa_recovery_codes'] ?? '[]', true);

        if (! is_array($codes)) {
            return false;
        }

        $normalized = strtoupper(trim($code));

        $codes = array_values(array_filter($codes, static function ($recoveryCode) use ($normalized) {
            return strtoupper(trim((string) $recoveryCode)) !== $normalized;
        }));

        return $this->userModel->update($userId, [
            'mfa_recovery_codes' => json_encode($codes, JSON_UNESCAPED_SLASHES),
        ]);
    }

    /**
     * User Model
     */
    public function getUserModel(): UserModel
    {
        return $this->userModel;
    }
}