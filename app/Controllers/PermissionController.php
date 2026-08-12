<?php

namespace App\Controllers;

class PermissionController extends BaseController
{
    public function index()
    {
        $permissions = db_connect()
            ->table('permissions')
            ->where('deleted_at', null)
            ->orderBy('code', 'ASC')
            ->get()
            ->getResultArray();

        return view('permissions/index', [
            'title' => 'Permission',
            'permissions' => $permissions,
        ]);
    }
}
