<?php

namespace App\Libraries;

class ApiResponse
{
    public static function success(
        string $message,
        $data = []
    ) {
        return [

            'success' => true,

            'message' => $message,

            'data' => $data

        ];
    }

    public static function error(
        string $message,
        $errors = []
    ) {
        return [

            'success' => false,

            'message' => $message,

            'errors' => $errors

        ];
    }
}
