<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Services\ActivityLogService;

class Services extends BaseService
{
    public static function activityLogService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('activityLogService');
        }

        return new ActivityLogService();
    }
}