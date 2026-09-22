<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Services\AuthService;
use App\Services\ActivityLogService;
use App\Services\NotificationService;
use App\Services\PermissionService;

use App\Services\DepartmentService;
use App\Services\StudyProgramService;
use App\Services\ClassService;
use App\Services\ApplicantTypeService;
use App\Services\ServiceUnitService;
use App\Services\ServiceCategoryService;
use App\Services\ServiceService;
use App\Services\ServiceRequirementService;
use App\Services\UserService;
use App\Services\RoleService;
use App\Services\RolePermissionService;
use App\Services\FaqService;

class Services extends BaseService
{
    /*
|--------------------------------------------------------------------------
| Auth Service
|--------------------------------------------------------------------------
*/

    public static function authService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authService');
        }

        return new AuthService();
    }

    /*
|--------------------------------------------------------------------------
| Permission Service
|--------------------------------------------------------------------------
*/

    public static function permissionService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('permissionService');
        }

        return new PermissionService();
    }

    /*
|--------------------------------------------------------------------------
| Notification Service
|--------------------------------------------------------------------------
*/

    public static function notificationService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('notificationService');
        }

        return new NotificationService();
    }

    /*
|--------------------------------------------------------------------------
| Activity Log Service
|--------------------------------------------------------------------------
*/

    public static function activityLogService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('activityLogService');
        }

        return new ActivityLogService();
    }

    /*
|--------------------------------------------------------------------------
| Department Service
|--------------------------------------------------------------------------
*/

    public static function departmentService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('departmentService');
        }

        return new DepartmentService();
    }

    /*
|--------------------------------------------------------------------------
| Study Program Service
|--------------------------------------------------------------------------
*/

    public static function studyProgramService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('studyProgramService');
        }

        return new StudyProgramService();
    }

    /*
|--------------------------------------------------------------------------
| Class Service
|--------------------------------------------------------------------------
*/

    public static function classService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('classService');
        }

        return new ClassService();
    }

    /*
|--------------------------------------------------------------------------
| Applicant Type Service
|--------------------------------------------------------------------------
*/

    public static function applicantTypeService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('applicantTypeService');
        }

        return new ApplicantTypeService();
    }

    /*
|--------------------------------------------------------------------------
| Service Unit Service
|--------------------------------------------------------------------------
*/

    public static function serviceUnitService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('serviceUnitService');
        }

        return new ServiceUnitService();
    }

    /*
|--------------------------------------------------------------------------
| Service Category Service
|--------------------------------------------------------------------------
*/

    public static function serviceCategoryService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('serviceCategoryService');
        }

        return new ServiceCategoryService();
    }

    /*
|--------------------------------------------------------------------------
| Service Service
|--------------------------------------------------------------------------
*/

    public static function serviceService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('serviceService');
        }

        return new ServiceService();
    }

    /*
|--------------------------------------------------------------------------
| Service Requirement Service
|--------------------------------------------------------------------------
*/

    public static function serviceRequirementService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('serviceRequirementService');
        }

        return new ServiceRequirementService();
    }

    /*
|--------------------------------------------------------------------------
| User Service
|--------------------------------------------------------------------------
*/

    public static function userService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return new UserService();
    }

    /*
|--------------------------------------------------------------------------
| Role Service
|--------------------------------------------------------------------------
*/

    public static function roleService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('roleService');
        }

        return new RoleService();
    }

    /*
|--------------------------------------------------------------------------
| Role Permission Service
|--------------------------------------------------------------------------
*/

    public static function rolePermissionService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('rolePermissionService');
        }

        return new RolePermissionService();
    }
/*
    |--------------------------------------------------------------------------
    | FAQ Service
    |--------------------------------------------------------------------------
    */

    public static function faqService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('faqService');
        }

        return new FaqService();
    }
}
