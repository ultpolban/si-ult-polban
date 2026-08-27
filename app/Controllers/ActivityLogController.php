<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ActivityLogController extends BaseController
{
    public function index()
    {
        $db      = \Config\Database::connect();
        $keyword = trim($this->request->getGet('keyword') ?? '');
        $module  = trim($this->request->getGet('module') ?? '');
        $perPage = 20;
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $offset  = ($page - 1) * $perPage;

        // Query dengan join ke tabel users
        $builder = $db->table('activity_logs al')
            ->select('al.*, u.full_name as user_name, u.email as user_email')
            ->join('users u', 'u.id = al.user_id', 'left')
            ->orderBy('al.created_at', 'DESC');

        if ($keyword) {
            $builder->groupStart()
                ->like('al.action', $keyword)
                ->orLike('al.module', $keyword)
                ->orLike('u.full_name', $keyword)
                ->groupEnd();
        }

        if ($module) {
            $builder->where('al.module', $module);
        }

        // Total untuk pagination
        $total = (clone $builder)->countAllResults(false);

        $logs = $builder->limit($perPage, $offset)->get()->getResultArray();

        // Ambil daftar modul unik untuk filter
        $modules = $db->table('activity_logs')
            ->distinct()
            ->select('module')
            ->orderBy('module', 'ASC')
            ->get()->getResultArray();

        $data = [
            'title'      => 'Activity Log',
            'logs'       => $logs,
            'modules'    => array_column($modules, 'module'),
            'keyword'    => $keyword,
            'module'     => $module,
            'total'      => $total,
            'perPage'    => $perPage,
            'page'       => $page,
            'totalPages' => ceil($total / $perPage),
        ];

        return view('admin/activity_log', $data);
    }
}
