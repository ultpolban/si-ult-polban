<?php

namespace App\Services;

use App\Models\UserModel;
use CodeIgniter\Email\Email;
use Throwable;

class PasswordResetService
{
    private const TOKEN_LIFETIME_MINUTES = 60;

    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function requestReset(string $email): void
    {
        $db = null;
        $tokenHash = null;

        try {
            $user = $this->userModel
                ->where('email', $email)
                ->where('is_active', 1)
                ->first();

            if (! $user) {
                return;
            }

            $token = bin2hex(random_bytes(32));
            $tokenHash = hash('sha256', $token);
            $now = date('Y-m-d H:i:s');
            $expiresAt = date(
                'Y-m-d H:i:s',
                time() + self::TOKEN_LIFETIME_MINUTES * 60
            );

            $db = db_connect();
            $db->transBegin();

            $db->table('password_reset_tokens')
                ->where('expires_at <=', $now)
                ->delete();

            $db->table('password_reset_tokens')
                ->where('user_id', (int) $user['id'])
                ->delete();

            $db->table('password_reset_tokens')->insert([
                'user_id'    => (int) $user['id'],
                'token_hash' => $tokenHash,
                'expires_at' => $expiresAt,
                'created_at' => $now,
            ]);

            if (! $db->transStatus()) {
                $db->transRollback();

                log_message(
                    'error',
                    'Password reset token could not be stored.'
                );

                return;
            }

            $db->transCommit();

            $message = 'Halo '
                . ($user['full_name'] ?? 'Pengguna')
                . ",\n\n"
                . "Gunakan tautan berikut untuk mengatur ulang password SI ULT POLBAN. "
                . "Tautan berlaku selama 60 menit dan hanya dapat digunakan satu kali.\n\n"
                . base_url('password/reset/' . $token)
                . "\n\n"
                . "Abaikan email ini jika Anda tidak meminta reset password.";

            /*
             * Baca konfigurasi SMTP dari environment Docker.
             * Gunakan $_SERVER sebagai alternatif getenv().
             */
            $readEnv = static function (string $key, string $default = ''): string {
                $value = $_SERVER[$key] ?? getenv($key);

                if ($value === false || $value === null || $value === '') {
                    return $default;
                }

                return (string) $value;
            };

            $smtpHost = $readEnv('EMAIL_SMTP_HOST');
            $smtpUser = $readEnv('EMAIL_SMTP_USER');
            $smtpPass = $readEnv('EMAIL_SMTP_PASS');
            $smtpPort = (int) $readEnv('EMAIL_SMTP_PORT', '587');
            $smtpCrypto = $readEnv('EMAIL_SMTP_CRYPTO', 'tls');
            $smtpTimeout = (int) $readEnv('EMAIL_SMTP_TIMEOUT', '30');
            $fromEmail = $readEnv('EMAIL_FROM_EMAIL');
            $fromName = $readEnv('EMAIL_FROM_NAME', 'SI ULT POLBAN');

            if ($smtpHost === '' || $smtpUser === '' || $smtpPass === '') {
                log_message(
                    'error',
                    'Password reset SMTP configuration is incomplete. '
                    . 'Host configured: {host}; user configured: {user}; '
                    . 'password configured: {password}.',
                    [
                        'host'     => $smtpHost !== '' ? 'yes' : 'no',
                        'user'     => $smtpUser !== '' ? 'yes' : 'no',
                        'password' => $smtpPass !== '' ? 'yes' : 'no',
                    ]
                );

                $db->table('password_reset_tokens')
                    ->where('token_hash', $tokenHash)
                    ->delete();

                return;
            }

            $emailConfig = config(\Config\Email::class);

            $emailConfig->protocol = 'smtp';
            $emailConfig->SMTPHost = $smtpHost;
            $emailConfig->SMTPUser = $smtpUser;
            $emailConfig->SMTPPass = $smtpPass;
            $emailConfig->SMTPPort = $smtpPort;
            $emailConfig->SMTPCrypto = $smtpCrypto;
            $emailConfig->SMTPTimeout = $smtpTimeout;
            $emailConfig->fromEmail = $fromEmail;
            $emailConfig->fromName = $fromName;

            $emailService = new Email($emailConfig);

            log_message(
                'debug',
                'Password reset SMTP host configured: '
                . ($emailService->SMTPHost !== '' ? 'yes' : 'no')
            );

            $emailService->clear(true);
            $emailService->setTo($user['email']);
            $emailService->setFrom($fromEmail, $fromName);
            $emailService->setSubject('Reset Password SI ULT POLBAN');
            $emailService->setMessage($message);

            if (! $emailService->send()) {
                log_message(
                    'error',
                    'Password reset email could not be sent for user ID {userId}.',
                    [
                        'userId' => (int) $user['id'],
                    ]
                );

                $db->table('password_reset_tokens')
                    ->where('token_hash', $tokenHash)
                    ->delete();

                // Catat detail diagnostik tanpa mencatat password atau token.
                log_message(
                    'error',
                    'Password reset email diagnostics: {details}',
                    [
                        'details' => $emailService->printDebugger(
                            ['headers']
                        ),
                    ]
                );
            }
        } catch (Throwable $exception) {
            if ($db !== null && $db->transStatus() === false) {
                $db->transRollback();
            }

            if ($db !== null && $tokenHash !== null) {
                try {
                    $db->table('password_reset_tokens')
                        ->where('token_hash', $tokenHash)
                        ->delete();
                } catch (Throwable $cleanupException) {
                    log_message(
                        'error',
                        'Password reset token cleanup failed: {message}',
                        ['message' => $cleanupException->getMessage()]
                    );
                }
            }

            log_message(
                'error',
                'Password reset request failed: {message}',
                ['message' => $exception->getMessage()]
            );
        }
    }

    public function isValidToken(string $token): bool
    {
        if (! preg_match('/\A[a-f0-9]{64}\z/i', $token)) {
            return false;
        }

        return $this->findValidToken(hash('sha256', $token)) !== null;
    }

    public function resetPassword(string $token, string $password): bool
    {
        if (! preg_match('/\A[a-f0-9]{64}\z/i', $token)) {
            return false;
        }

        $db = db_connect();
        $now = date('Y-m-d H:i:s');
        $tokenHash = hash('sha256', $token);

        try {
            $db->transBegin();

            $reset = $this->findValidToken($tokenHash);

            if ($reset === null) {
                $db->transRollback();
                return false;
            }

            $user = $this->userModel->find((int) $reset['user_id']);

            if (! $user || (int) $user['is_active'] !== 1) {
                $db->transRollback();
                return false;
            }

            $db->table('password_reset_tokens')
                ->where('id', (int) $reset['id'])
                ->where('consumed_at', null)
                ->where('expires_at >', $now)
                ->update([
                    'consumed_at' => $now,
                ]);

            if ($db->affectedRows() !== 1) {
                $db->transRollback();
                return false;
            }

            $db->table('users')
                ->where('id', (int) $user['id'])
                ->where('is_active', 1)
                ->update([
                    'password'   => password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    ),
                    'updated_at' => $now,
                ]);

            if ($db->affectedRows() !== 1 || ! $db->transStatus()) {
                $db->transRollback();
                return false;
            }

            $db->transCommit();

            return true;
        } catch (Throwable $exception) {
            $db->transRollback();

            log_message(
                'error',
                'Password reset failed: {message}',
                ['message' => $exception->getMessage()]
            );

            return false;
        }
    }

    protected function findValidToken(string $tokenHash): ?array
    {
        $record = db_connect()
            ->table('password_reset_tokens')
            ->where('token_hash', $tokenHash)
            ->where('consumed_at', null)
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->get()
            ->getRowArray();

        return $record ?: null;
    }
}
