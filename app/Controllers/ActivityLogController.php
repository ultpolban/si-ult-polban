<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\ActivityLogService;
use App\Constants\Permissions;

class ActivityLogController extends AdminController
{
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        parent::__construct();

        $this->activityLogService = service('activityLogService');
    }

    /**
     * Daftar activity log
     */
    public function index()
    {
        $this->authorize(Permissions::ACTIVITY_LOG_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->activityLogService->getList($keyword);

        return view('activity-logs/index', $this->viewData([
            'title'        => 'Activity Log',
            'pageTitle'    => 'Activity Log',
            'breadcrumb'   => ['Activity Log'],
            'keyword'      => $keyword,
            'logs'         => $result['logs'],
            'pager'        => $result['pager'],
        ]));
    }

    /**
     * Detail activity log
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::ACTIVITY_LOG_VIEW);

        $log = $this->activityLogService->getById($id);

        if (! $log) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('activity-logs/show', $this->viewData([
            'title'      => 'Detail Activity Log',
            'pageTitle'  => 'Detail Activity Log',
            'log'        => $log,
        ]));
    }
}
