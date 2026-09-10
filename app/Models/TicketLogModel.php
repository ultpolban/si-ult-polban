<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketLogModel extends Model
{
    protected $table            = 'ticket_logs';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    /**
     * ============================================================
     * SESUAI DENGAN STRUKTUR DATABASE ticket_logs
     * ============================================================
     *
     * id
     * ticket_id
     * activity
     * user_name
     * created_at
     *
     * ============================================================
     */
    protected $allowedFields = [
        'ticket_id',
        'activity',
        'user_name',
        'created_at',
    ];

    /**
     * created_at diisi manual oleh controller.
     */
    protected $useTimestamps = false;


    /**
     * ============================================================
     * AMBIL LOG BERDASARKAN TIKET
     * ============================================================
     */
    public function getLogsByTicket($ticketId)
    {
        return $this->where('ticket_id', $ticketId)
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }


    /**
     * ============================================================
     * TAMBAH LOG AKTIVITAS
     * ============================================================
     */
    public function addLog(
        $ticketId,
        $activity,
        $userName = 'Petugas ULT'
    ) {
        return $this->insert([
            'ticket_id'  => (int) $ticketId,
            'activity'   => $activity,
            'user_name'  => $userName ?: 'Petugas ULT',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}