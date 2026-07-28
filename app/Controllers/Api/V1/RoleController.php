<?php

namespace App\Controllers\Api\V1;

use App\Models\RoleModel;

class RoleController extends BaseApiController
{
    protected RoleModel $model;

    public function __construct()
    {
        $this->model = new RoleModel();
    }

    public function index()
    {
        return $this->respond([
            'success' => true,
            'data' => $this->model->findAll()
        ]);
    }
}
