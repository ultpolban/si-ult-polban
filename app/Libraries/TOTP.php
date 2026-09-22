<?php

namespace App\Libraries;

/**
 * TOTP - Time-based One Time Password (RFC 6238)
 *
 * Implementasi pure-PHP tanpa dependency external.
 * Usado untuk MFA (Two-Factor Authentication) via Google Authenticator,
 * Microsoft Authenticator, etc.
 */
class TOTP
{
    /**
     * Algorithm HMAC
     */
    protected string $algorithm = 'SHA1';

    /**
     * Amount of digits in the generated pin
     */
    protected int $digits = 6;

    /**
     * Period to generate code (in seconds)
     */
    protected int $period = 30;

    /**
     * Issuer untuk provisioning URI
     */
    protected string $issuer = 'SI ULT POLBAN';

    /**
     * Base32 alphabet
     */
    protected string $base32Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    /**
     * Set Issuer
     */
    public function setIssuer(string $issuer): void
    {
        $this->issuer = $issuer;
    }

    /**
     * Get Issuer
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * Generate random Base32 secret
     */
    public function generateSecret(int $length = 32): string
    {
        $secret = '';

        for ($i = 0; $i < $length; $i++) {
            $secret .= $this->base32Chars[random_int(0, 31)];
        }

        return $secret;
    }

    /**
     * Generate current TOTP code
     */
    public function code(string $secret, ?int $timestamp = null): string
    {
        $timestamp ??= time();

        $counter = (int) floor($timestamp / $this->period);

        $hash = hash_hmac(
            $this->algorithm,
            $this->intToBytes($counter),
            $this->base32Decode($secret),
            true
        );

        // Dynamic truncation (RFC 4226)
        $offset = ord($hash[19]) & 0x0F;

        $value = ((ord($hash[$offset]) & 0x7F) << 24)
            | (ord($hash[$offset + 1]) << 16)
            | (ord($hash[$offset + 2]) << 8)
            | ord($hash[$offset + 3]);

        $modulus = 10 ** $this->digits;

        return str_pad((string) ($value % $modulus), $this->digits, '0', STR_PAD_LEFT);
    }

    /**
     * Verify code against secret (with time window tolerance)
     */
    public function verify(
        string $secret,
        string $code,
        int $window = 1,
        ?int $timestamp = null
    ): bool {
        $code = trim($code);

        if ($code === '' || ! ctype_digit($code)) {
            return false;
        }

        $timestamp ??= time();

        for ($i = -$window; $i <= $window; $i++) {
            $checkTime = $timestamp + ($i * $this->period);

            if (hash_equals($this->code($secret, $checkTime), $code)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate otpauth:// provisioning URI (for QR code)
     */
    public function provisioningUri(string $secret, string $accountName): string
    {
        $label = rawurlencode($this->issuer . ':' . $accountName);

        $params = http_build_query([
            'secret'    => $secret,
            'issuer'    => $this->issuer,
            'algorithm' => $this->algorithm,
            'digits'    => $this->digits,
            'period'    => $this->period,
        ]);

        return 'otpauth://totp/' . $label . '?' . $params;
    }

    /**
     * Convert integer to 8-byte big-endian string
     */
    protected function intToBytes(int $value): string
    {
        $result = '';

        for ($i = 7; $i >= 0; $i--) {
            $result .= chr(($value >> (8 * $i)) & 0xFF);
        }

        return $result;
    }

    /**
     * Decode Base32 (RFC 4648) to binary string
     */
    protected function base32Decode(string $base32): string
    {
        $base32 = strtoupper(trim($base32));

        $bits = '';

        foreach (str_split($base32) as $char) {
            if ($char === '=') {
                continue;
            }

            $position = strpos($this->base32Chars, $char);

            if ($position === false) {
                return '';
            }

            $bits .= str_pad(decbin($position), 5, '0', STR_PAD_LEFT);
        }

        $bytes = '';

        foreach (str_split($bits, 8) as $chunk) {
            if (strlen($chunk) < 8) {
                $chunk = str_pad($chunk, 8, '0', STR_PAD_RIGHT);
            }

            $bytes .= chr(bindec($chunk));
        }

        return $bytes;
    }
}