<?php

namespace App\Traits;

trait ApiResponseTrait
{

    protected function success(
        $message,
        $data = []
    ) {

        return [

            'success' => true,

            'message' => $message,

            'data' => $data

        ];
    }

    protected function failed(
        $message,
        $errors = []
    ) {

        return [

            'success' => false,

            'message' => $message,

            'errors' => $errors

        ];
    }
}
