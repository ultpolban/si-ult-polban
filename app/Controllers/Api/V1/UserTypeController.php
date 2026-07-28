<?php

namespace App\Controllers\Api\V1;

use App\Models\UserTypeModel;

class UserTypeController extends BaseApiController
{
    protected UserTypeModel $model;

    public function __construct()
    {
        $this->model = new UserTypeModel();
    }

    public function index()
    {
        return $this->respond([
            'success' => true,
            'data' => $this->model
                ->orderBy('id', 'ASC')
                ->findAll()
        ]);
    }
}
