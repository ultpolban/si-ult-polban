<?php

namespace App\Controllers\Api\V1;

use App\Models\WorkUnitModel;

class WorkUnitController extends BaseApiController
{
    protected WorkUnitModel $model;

    public function __construct()
    {
        $this->model = new WorkUnitModel();
    }

    public function index()
    {
        return $this->respond([
            'success' => true,
            'data' => $this->model
                ->orderBy('unit_name', 'ASC')
                ->findAll()
        ]);
    }
}
