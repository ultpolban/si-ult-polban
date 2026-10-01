<?php

namespace App\Controllers;

/**
 * =====================================================================
 *  Dashboard Redirector
 * =====================================================================
 *
 *  Route lama (/dashboard/detail, /dashboard/tiket, dan sejenisnya)
 *  tidak lagi punya view sendiri. Semua request diarahkan ke dashboard
 *  milik role pengguna supaya tidak pernah menampilkan halaman kosong.
 */
class Dashboard extends BaseController
{
    public function __construct()
    {
        helper(['role']);
    }

    public function index()
    {
        return redirect()->to(ult_redirect_url());
    }

    public function layanan()
    {
        return redirect()->to(base_url('services'));
    }

    public function tiket()
    {
        return redirect()->to(base_url(ult_ticket_index_url()));
    }

    public function detail()
    {
        return redirect()->to(base_url(ult_ticket_index_url()));
    }

    public function profile()
    {
        return redirect()->to(base_url('profile'));
    }
}
