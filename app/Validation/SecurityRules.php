<?php

namespace App\Validation;

/**
 * SecurityRules
 *
 * Sumber tunggal (single source of truth) aturan validasi keamanan agar
 * kebijakan password konsisten di seluruh validator aplikasi.
 *
 * Dipakai oleh: RegisterValidator, RegistrationRequestValidator,
 * UserValidator, dan Config\Validation.
 */
class SecurityRules
{
    /**
     * Panjang minimal password yang diizinkan.
     */
    public const PASSWORD_MIN_LENGTH = 10;

    /**
     * Panjang maksimal password.
     *
     * Dibatasi 72 byte karena password_hash() dengan PASSWORD_DEFAULT
     * (bcrypt) memotong input di atas 72 byte, sehingga karakter setelahnya
     * terbuang tanpa disadari pengguna.
     */
    public const PASSWORD_MAX_LENGTH = 72;

    /**
     * Pola kekuatan password: wajib memuat huruf kecil, huruf besar,
     * angka, dan minimal satu simbol.
     */
    public const PASSWORD_PATTERN = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/';

    /**
     * Aturan validasi password yang siap dipakai pada kunci `rules`.
     *
     * @param bool $required false untuk kebutuhan form edit (password
     *                       boleh dikosongkan)
     */
    public static function password(bool $required = true): string
    {
        return ($required ? 'required' : 'permit_empty')
            . '|min_length[' . self::PASSWORD_MIN_LENGTH . ']'
            . '|max_length[' . self::PASSWORD_MAX_LENGTH . ']'
            . '|regex_match[' . self::PASSWORD_PATTERN . ']';
    }

    /**
     * Pesan galat khusus password, siap dipakai pada kunci `errors`.
     *
     * @return array<string, string>
     */
    public static function passwordErrors(): array
    {
        return [
            'min_length'  => 'Password minimal ' . self::PASSWORD_MIN_LENGTH . ' karakter.',
            'max_length'  => 'Password maksimal ' . self::PASSWORD_MAX_LENGTH . ' karakter.',
            'regex_match' => 'Password harus memuat huruf besar, huruf kecil, angka, dan simbol.',
        ];
    }

    /**
     * Petunjuk kekuatan password untuk ditampilkan pada formulir.
     */
    public static function passwordHint(): string
    {
        return 'Minimal ' . self::PASSWORD_MIN_LENGTH
            . ' karakter dan harus memuat huruf besar, huruf kecil, angka, serta simbol.';
    }
}
