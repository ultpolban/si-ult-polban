<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityLogController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Activity Log',
            'logs'  => []
        ];
        
        return view('admin/activity_log', $data);
    }
}
