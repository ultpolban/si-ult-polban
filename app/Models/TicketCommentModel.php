<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketCommentModel extends Model
{
    protected $table            = 'ticket_comments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'ticket_id',
        'user_id',
        'comment',
        'attachment',
        'is_internal'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getCommentsByTicket($ticketId)
    {
        return $this->db->table($this->table)
            ->select('ticket_comments.*, users.username, users.role')
            ->join('users', 'users.id = ticket_comments.user_id', 'left')
            ->where('ticket_comments.ticket_id', $ticketId)
            ->orderBy('ticket_comments.created_at', 'ASC')
            ->get()
            ->getResultArray();
    }
}