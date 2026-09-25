<?php

namespace App\Controllers;

class LogAktivitasController extends BaseController
{
    /**
     * Halaman Log Aktivitas
     */
    public function index()
    {
        $db = db_connect();

        // ==========================================
        // FILTER
        // ==========================================
        $keyword = trim((string) $this->request->getGet('keyword'));
        $role    = trim((string) $this->request->getGet('role'));
        $aksi    = trim((string) $this->request->getGet('aksi'));

        $limit = (int) ($this->request->getGet('limit') ?? 10);

        if ($limit < 1) {
            $limit = 10;
        }

        if ($limit > 100) {
            $limit = 100;
        }

        $currentPage = max(
            1,
            (int) ($this->request->getGet('page') ?? 1)
        );

        $offset = ($currentPage - 1) * $limit;


        // ==========================================
        // QUERY DASAR
        // ==========================================
        $builder = $db->table('activity_logs al');

        $builder->select([
            'al.id',
            'al.user_id',
            'al.action',
            'al.module',
            'al.reference_id',
            'al.created_at',
            'al.ip_address',

            'u.full_name',
            'u.username',
            'u.email',

            'r.name AS role_name'
        ]);

        $builder->join(
            'users u',
            'u.id = al.user_id',
            'left'
        );

        $builder->join(
            'roles r',
            'r.id = u.role_id',
            'left'
        );


        // ==========================================
        // FILTER KEYWORD
        // ==========================================
        if ($keyword !== '') {

            $builder->groupStart();

            $builder->like('u.full_name', $keyword);
            $builder->orLike('u.username', $keyword);
            $builder->orLike('u.email', $keyword);
            $builder->orLike('al.action', $keyword);
            $builder->orLike('al.module', $keyword);
            $builder->orLike('al.reference_id', $keyword);
            $builder->orLike('al.ip_address', $keyword);

            $builder->groupEnd();
        }


        // ==========================================
        // FILTER ROLE
        // ==========================================
        if ($role !== '') {
            $builder->where(
                'LOWER(r.name)',
                strtolower($role)
            );
        }


        // ==========================================
        // FILTER AKSI
        // ==========================================
        if ($aksi !== '') {

            if ($aksi === 'User Login') {

                $builder->where('UPPER(al.action)', 'LOGIN');

            } elseif ($aksi === 'User Logout') {

                $builder->where('UPPER(al.action)', 'LOGOUT');

            } elseif ($aksi === 'Aktivitas Data') {

                $builder->whereNotIn(
                    'al.action',
                    ['LOGIN', 'LOGOUT']
                );
            }
        }


        // ==========================================
        // TOTAL FILTERED
        // ==========================================
        $countBuilder = clone $builder;

        $totalFiltered = $countBuilder
            ->countAllResults();


        // ==========================================
        // AMBIL DATA
        // ==========================================
        $logs = $builder
            ->orderBy('al.created_at', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->getResultArray();


        // ==========================================
        // FORMAT DATA UNTUK VIEW
        // ==========================================
        foreach ($logs as &$log) {

            $action = strtoupper(trim($log['action'] ?? ''));
            $module = trim($log['module'] ?? '');

            // ------------------------------
            // AKTOR
            // ------------------------------
            $log['aktor'] = !empty($log['full_name'])
                ? $log['full_name']
                : (!empty($log['email']) ? $log['email'] : 'User');


            // ------------------------------
            // ROLE
            // ------------------------------
            $log['role'] = !empty($log['role_name'])
                ? $log['role_name']
                : '-';


            // ------------------------------
            // TANGGAL & JAM
            // ------------------------------
            if (!empty($log['created_at'])) {

                $timestamp = strtotime(
                    $log['created_at']
                );

                $log['tanggal'] = date(
                    'd-m-Y',
                    $timestamp
                );

                $log['jam'] = date(
                    'H:i:s',
                    $timestamp
                );

            } else {

                $log['tanggal'] = '-';
                $log['jam'] = '-';
            }


            // ------------------------------
            // JENIS AKSI
            // ------------------------------
            switch ($action) {

                case 'LOGIN':

                    $log['aksi_label'] = 'User Login';
                    $log['aksi_icon']  = 'fa-sign-in-alt';
                    $log['aksi_class'] = 'badge-login';

                    break;

                case 'LOGOUT':

                    $log['aksi_label'] = 'User Logout';
                    $log['aksi_icon']  = 'fa-sign-out-alt';
                    $log['aksi_class'] = 'badge-disposisi';

                    break;

                case 'VERIFY':
                case 'VERIFICATION':
                case 'VERIFY_TICKET':

                    $log['aksi_label'] = 'Verifikasi';
                    $log['aksi_icon']  = 'fa-user-check';
                    $log['aksi_class'] = 'badge-verifikasi';

                    break;

                case 'DISPOSITION':
                case 'DISPOSISI':
                case 'ASSIGN':

                    $log['aksi_label'] = 'Disposisi';
                    $log['aksi_icon']  = 'fa-share';
                    $log['aksi_class'] = 'badge-disposisi';

                    break;

                case 'EXPORT':

                    $log['aksi_label'] = 'Export Data';
                    $log['aksi_icon']  = 'fa-file-export';
                    $log['aksi_class'] = 'badge-export';

                    break;

                default:

                    $log['aksi_label'] = $action !== ''
                        ? $action
                        : '-';

                    $log['aksi_icon']  = 'fa-database';
                    $log['aksi_class'] = 'badge-export';

                    break;
            }


            // ------------------------------
            // REFERENSI
            // ------------------------------
            if (
                isset($log['reference_id']) &&
                $log['reference_id'] !== null &&
                $log['reference_id'] !== ''
            ) {

                $log['referensi'] =
                    '#' . $log['reference_id'];

            } else {

                $log['referensi'] = '-';
            }


            // ------------------------------
            // DETAIL SESUAI DATABASE
            // ------------------------------
            $detailParts = [];

            if ($action !== '') {
                $detailParts[] = $action;
            }

            if ($module !== '') {
                $detailParts[] = 'Module: ' . $module;
            }

            if (
                isset($log['reference_id']) &&
                $log['reference_id'] !== null &&
                $log['reference_id'] !== ''
            ) {
                $detailParts[] = 'Referensi: #' . $log['reference_id'];
            }

            $log['detail'] = !empty($detailParts)
                ? implode(' • ', $detailParts)
                : '-';
        }

        unset($log);


        // ==========================================
        // STATISTIK
        // ==========================================
        $totalLog = $db
            ->table('activity_logs')
            ->countAllResults();

        $totalLogin = $db
            ->table('activity_logs')
            ->where('action', 'LOGIN')
            ->countAllResults();

        $totalLogout = $db
            ->table('activity_logs')
            ->where('action', 'LOGOUT')
            ->countAllResults();

        $totalLainnya = max(
            0,
            $totalLog - $totalLogin - $totalLogout
        );


        // ==========================================
        // PAGINATION
        // ==========================================
        $totalPages = $totalFiltered > 0
            ? (int) ceil($totalFiltered / $limit)
            : 1;

        $startData = $totalFiltered > 0
            ? $offset + 1
            : 0;

        $endData = min(
            $offset + $limit,
            $totalFiltered
        );


        // ==========================================
        // DATA KE VIEW
        // ==========================================
        return view('petugas/log_aktivitas', [

            'logs' => $logs,

            'totalLog'     => $totalLog,
            'totalLogin'   => $totalLogin,
            'totalLogout'  => $totalLogout,
            'totalLainnya' => $totalLainnya,

            'keyword' => $keyword,
            'role'    => $role,
            'aksi'    => $aksi,
            'limit'   => $limit,

            'currentPage'   => $currentPage,
            'totalFiltered' => $totalFiltered,
            'totalPages'    => $totalPages,
            'startData'     => $startData,
            'endData'       => $endData,
        ]);
    }
}