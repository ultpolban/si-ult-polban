<?php

namespace App\Constants;

final class Permissions
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public const DASHBOARD = 'dashboard';

    /*
    |--------------------------------------------------------------------------
    | Department
    |--------------------------------------------------------------------------
    */

    public const DEPARTMENT_VIEW   = 'department.view';
    public const DEPARTMENT_CREATE = 'department.create';
    public const DEPARTMENT_UPDATE = 'department.update';
    public const DEPARTMENT_DELETE = 'department.delete';
    public const DEPARTMENT_RESTORE = 'department.restore';

    /*
    |--------------------------------------------------------------------------
    | Study Program
    |--------------------------------------------------------------------------
    */

    public const STUDY_PROGRAM_VIEW   = 'study_program.view';
    public const STUDY_PROGRAM_CREATE = 'study_program.create';
    public const STUDY_PROGRAM_UPDATE = 'study_program.update';
    public const STUDY_PROGRAM_DELETE = 'study_program.delete';
    public const STUDY_PROGRAM_RESTORE = 'study_program.restore';

    /*
    |--------------------------------------------------------------------------
    | Class
    |--------------------------------------------------------------------------
    */

    public const CLASS_VIEW   = 'class.view';
    public const CLASS_CREATE = 'class.create';
    public const CLASS_UPDATE = 'class.update';
    public const CLASS_DELETE = 'class.delete';
    public const CLASS_RESTORE = 'class.restore';

    /*
    |--------------------------------------------------------------------------
    | Applicant Type
    |--------------------------------------------------------------------------
    */

    public const APPLICANT_TYPE_VIEW   = 'applicant_type.view';
    public const APPLICANT_TYPE_CREATE = 'applicant_type.create';
    public const APPLICANT_TYPE_UPDATE = 'applicant_type.update';
    public const APPLICANT_TYPE_DELETE = 'applicant_type.delete';
    public const APPLICANT_TYPE_RESTORE = 'applicant_type.restore';

    /*
    |--------------------------------------------------------------------------
    | Service Unit
    |--------------------------------------------------------------------------
    */

    public const SERVICE_UNIT_VIEW   = 'service_unit.view';
    public const SERVICE_UNIT_CREATE = 'service_unit.create';
    public const SERVICE_UNIT_UPDATE = 'service_unit.update';
    public const SERVICE_UNIT_DELETE = 'service_unit.delete';
    public const SERVICE_UNIT_RESTORE = 'service_unit.restore';

    /*
    |--------------------------------------------------------------------------
    | Service Category
    |--------------------------------------------------------------------------
    */

    public const SERVICE_CATEGORY_VIEW   = 'service_category.view';
    public const SERVICE_CATEGORY_CREATE = 'service_category.create';
    public const SERVICE_CATEGORY_UPDATE = 'service_category.update';
    public const SERVICE_CATEGORY_DELETE = 'service_category.delete';
    public const SERVICE_CATEGORY_RESTORE = 'service_category.restore';

    /*
    |--------------------------------------------------------------------------
    | Service
    |--------------------------------------------------------------------------
    */

    public const SERVICE_VIEW   = 'service.view';
    public const SERVICE_CREATE = 'service.create';
    public const SERVICE_UPDATE = 'service.update';
    public const SERVICE_DELETE = 'service.delete';
    public const SERVICE_RESTORE = 'service.restore';

    /*
    |--------------------------------------------------------------------------
    | Service Requirement
    |--------------------------------------------------------------------------
    */

    public const SERVICE_REQUIREMENT_VIEW   = 'service_requirement.view';
    public const SERVICE_REQUIREMENT_CREATE = 'service_requirement.create';
    public const SERVICE_REQUIREMENT_UPDATE = 'service_requirement.update';
    public const SERVICE_REQUIREMENT_DELETE = 'service_requirement.delete';
    public const SERVICE_REQUIREMENT_RESTORE = 'service_requirement.restore';

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public const USER_VIEW = 'user.view';
    public const USER_CREATE = 'user.create';
    public const USER_UPDATE = 'user.update';
    public const USER_DELETE = 'user.delete';
    public const USER_RESTORE = 'user.restore';
    public const USER_RESET_PASSWORD = 'user.reset_password';

    /*
    |--------------------------------------------------------------------------
    | Role
    |--------------------------------------------------------------------------
    */

    public const ROLE_VIEW = 'role.view';
    public const ROLE_CREATE = 'role.create';
    public const ROLE_UPDATE = 'role.update';
    public const ROLE_DELETE = 'role.delete';

    /*
    |--------------------------------------------------------------------------
    | Permission
    |--------------------------------------------------------------------------
    */

    public const PERMISSION_VIEW = 'permission.view';
    public const PERMISSION_UPDATE = 'permission.update';

    /*
    |--------------------------------------------------------------------------
    | Service Request
    |--------------------------------------------------------------------------
    */

    public const REQUEST_CREATE = 'request.create';
    public const REQUEST_VIEW = 'request.view';
    public const REQUEST_UPDATE = 'request.update';
    public const REQUEST_VERIFY = 'request.verify';
    public const REQUEST_APPROVE = 'request.approve';
    public const REQUEST_REJECT = 'request.reject';
    public const REQUEST_COMPLETE = 'request.complete';
    public const REQUEST_CANCEL = 'request.cancel';

    /*
    |--------------------------------------------------------------------------
    | Notification
    |--------------------------------------------------------------------------
    */

    public const NOTIFICATION_VIEW = 'notification.view';

    /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    */

    public const ACTIVITY_LOG_VIEW = 'activity_log.view';

    /*
    |--------------------------------------------------------------------------
    | Report
    |--------------------------------------------------------------------------
    */

    public const REPORT_VIEW   = 'report.view';
    public const REPORT_EXPORT = 'report.export';

    /*
    |--------------------------------------------------------------------------
    | Statistic
    |--------------------------------------------------------------------------
    */

    public const STATISTIC_VIEW = 'statistic.view';
}
