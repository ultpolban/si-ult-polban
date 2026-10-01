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
     *
     * Nilai ini adalah sumber tunggal (single source of truth). Semua
     * validator, pesan galat, dan atribut formulir mengambil angka ini
     * dari konstanta yang sama sehingga tidak mudah tidak sinkron.
     */
    public const PASSWORD_MIN_LENGTH = 8;

    /**
     * Panjang maksimal password.
     *
     * Dibatasi 72 byte karena password_hash() dengan PASSWORD_DEFAULT
     * (bcrypt) memotong input di atas 72 byte, sehingga karakter setelahnya
     * terbuang tanpa disadari pengguna.
     */
    public const PASSWORD_MAX_LENGTH = 72;

    /**
     * Aturan validasi password yang siap dipakai pada kunci `rules`.
     *
     * Kebijakan: cukup panjang minimal. Tidak ada lagi syarat komposisi
     * (huruf besar, huruf kecil, angka, atau simbol).
     *
     * @param bool $required false untuk kebutuhan form edit (password
     *                       boleh dikosongkan)
     */
    public static function password(bool $required = true): string
    {
        return ($required ? 'required' : 'permit_empty')
            . '|min_length[' . self::PASSWORD_MIN_LENGTH . ']'
            . '|max_length[' . self::PASSWORD_MAX_LENGTH . ']';
    }

    /**
     * Pesan galat khusus password, siap dipakai pada kunci `errors`.
     *
     * @return array<string, string>
     */
    public static function passwordErrors(): array
    {
        return [
            'min_length' => 'Password minimal ' . self::PASSWORD_MIN_LENGTH . ' karakter.',
            'max_length' => 'Password maksimal ' . self::PASSWORD_MAX_LENGTH . ' karakter.',
        ];
    }

    /**
     * Petunjuk password untuk ditampilkan pada formulir.
     */
    public static function passwordHint(): string
    {
        return 'Minimal ' . self::PASSWORD_MIN_LENGTH . ' karakter.';
    }
}
