<?php

use App\Validation\SecurityRules;

if (! function_exists('password_min_length')) {
    /**
     * Panjang minimal password.
     *
     * Mengambil dari SecurityRules supaya angka yang tampil di form
     * selalu sama dengan angka yang dipakai validasi server.
     */
    function password_min_length(): int
    {
        return SecurityRules::PASSWORD_MIN_LENGTH;
    }
}

if (! function_exists('password_max_length')) {
    /**
     * Panjang maksimal password (72 byte, batas bcrypt).
     */
    function password_max_length(): int
    {
        return SecurityRules::PASSWORD_MAX_LENGTH;
    }
}

if (! function_exists('password_hint')) {
    /**
     * Petunjuk password untuk ditampilkan di bawah field.
     */
    function password_hint(): string
    {
        return SecurityRules::passwordHint();
    }
}
