<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketCommentModel extends Model
{
    protected $table            = 'ticket_comments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'ticket_id',
        'sender',
        'comment',
        'created_at',
    ];

    protected $useTimestamps = false;

    /**
     * ============================================================
     * AMBIL KOMENTAR BERDASARKAN TIKET
     * ============================================================
     */
    public function getCommentsByTicket($ticketId)
    {
        return $this->where('ticket_id', $ticketId)
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }
}