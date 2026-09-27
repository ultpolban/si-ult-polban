<?php

namespace App\Controllers;

use App\Services\TicketService;
use App\Models\UserProfileModel;

/**
 * RealtimeController
 *
 * Menyediakan endpoint JSON ringan yang dipakai polling JavaScript di sisi
 * klien agar Dashboard, badge Notifikasi, dan daftar tiket terbaru selalu
 * aktual tanpa harus reload halaman.
 */
class RealtimeController extends AdminController
{
    protected TicketService $ticketService;
    protected UserProfileModel $profileModel;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService = new TicketService();
        $this->profileModel  = new UserProfileModel();
    }

    /**
     * GET /realtime/notifications
     * Data notifikasi belum dibaca milik user yang sedang login.
     */
    public function notifications()
    {
        $userId = (int) (session()->get('user_id') ?? 0);

        if ($userId <= 0) {
            return $this->error('Sesi berakhir.', [], 401);
        }

        $items = $this->notificationService->getUnread();

        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'id'         => (int) $item['id'],
                'title'      => $item['title'] ?? '',
                'message'    => mb_substr((string) ($item['message'] ?? ''), 0, 90),
                'type'       => $item['type'] ?? 'info',
                'url'        => $item['url'] ?? null,
                'created_at' => $item['created_at'] ?? null,
            ];

            if (count($data) >= 8) {
                break;
            }
        }

        return $this->success('OK', [
            'count' => $this->notificationService->unreadCount($userId),
            'items' => $data,
        ]);
    }

    /**
     * GET /realtime/unread-count
     * Hanya jumlah notifikasi belum dibaca (ringan).
     */
    public function unreadCount()
    {
        $userId = (int) (session()->get('user_id') ?? 0);

        if ($userId <= 0) {
            return $this->error('Sesi berakhir.', [], 401);
        }

        return $this->success('OK', [
            'count' => $this->notificationService->unreadCount($userId),
        ]);
    }

    /**
     * GET /realtime/dashboard
     * Statistik kartu pada dashboard, dibedakan per role.
     */
    public function dashboardStats()
    {
        $userId   = (int) (session()->get('user_id') ?? 0);
        $roleCode = strtoupper((string) (session()->get('role_code') ?? ''));

        $summary = $this->ticketService->summary();

        $data = [
            'total'      => (int) $summary['total'],
            'pending'    => (int) $summary['pending'],
            'processing' => (int) $summary['processing'],
            'completed'  => (int) $summary['completed'],
            'rejected'   => (int) $summary['rejected'],
        ];

        // Pemohon hanya melihat angka terkait tiket miliknya
        if ($roleCode === 'PEMOHON' && $userId > 0) {
            $profile = $this->profileModel->findByUser($userId);

            if ($profile) {
                $own = $this->ticketService->summaryForProfile((int) $profile['id']);

                $data = array_merge($data, $own);
                $data['total'] = $own['total'];
            }
        }

        return $this->success('OK', $data);
    }

    /**
     * GET /realtime/tickets-last/(:num)
     * Tiket terbaru (umumnya untuk petugas / admin / pimpinan).
     */
    public function lastTickets(int $limit = 5)
    {
        $limit = max(1, min((int) $limit, 25));

        $userId   = (int) (session()->get('user_id') ?? 0);
        $roleCode = strtoupper((string) (session()->get('role_code') ?? ''));

        $tickets = [];

        if ($roleCode === 'PEMOHON' && $userId > 0) {
            $profile = $this->profileModel->findByUser($userId);

            if ($profile) {
                $tickets = $this->ticketService->myTickets((int) $profile['id'], $limit);
            }
        } else {
            $tickets = $this->ticketService->latest((int) $limit);
        }

        $result = [];

        foreach ($tickets as $t) {
            $result[] = [
                'id'             => (int) $t['id'],
                'ticket_number'  => $t['ticket_number'] ?? '',
                'title'          => mb_substr((string) ($t['title'] ?? ''), 0, 60),
                'applicant_name' => $t['applicant_name'] ?? '',
                'service_name'   => $t['service_name'] ?? '',
                'status'         => $t['status'] ?? '',
                'priority'       => $t['priority'] ?? 'normal',
                'created_at'     => $t['created_at'] ?? null,
            ];
        }

        return $this->success('OK', ['tickets' => $result]);
    }
}