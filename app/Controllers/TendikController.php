<?php

namespace App\Controllers;

class TendikController extends BaseController
{
    /**
     * ==========================================
     * DASHBOARD TENDIK
     * ==========================================
     */
    public function dashboard()
    {
        // Ambil data user dari session
        $user = session()->get('user') ?? [];

        // Ambil tiket Tendik dari session
        $tickets = session()->get('tendik_tickets') ?? [];

        // Hitung statistik tiket
        $statistik = [
            'total' => count($tickets),
            'diproses' => 0,
            'revisi' => 0,
            'selesai' => 0,
        ];

        foreach ($tickets as $ticket) {

            $status = strtolower(
                $ticket['status'] ?? ''
            );

            if (
                $status === 'in progress' ||
                $status === 'diproses' ||
                $status === 'processing'
            ) {
                $statistik['diproses']++;
            }

            if (
                $status === 'revision' ||
                $status === 'revisi' ||
                $status === 'perlu revisi'
            ) {
                $statistik['revisi']++;
            }

            if (
                $status === 'completed' ||
                $status === 'selesai'
            ) {
                $statistik['selesai']++;
            }
        }

        // Data yang dikirim ke view
        $data = [
            'title' => 'Dashboard Tendik',

            'user' => $user,

            'tickets' => $tickets,

            'statistik' => $statistik,
        ];

        return view(
            'tendik/dashboard',
            $data
        );
    }
}