<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected $format = 'json';

    protected function successResponse($data = [], string $message = 'Berhasil', int $code = 200)
    {
        return $this->respond([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    protected function errorResponse(string $message = 'Terjadi kesalahan', int $code = 400)
    {
        return $this->respond([
            'success' => false,
            'message' => $message
        ], $code);
    }
}
