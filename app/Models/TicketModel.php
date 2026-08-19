<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table            = 'tickets';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'ticket_number',
        'user_profile_id',
        'service_id',
        'status',
        'priority',
        'submitted_at',
        'verified_at',
        'completed_at',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = false;

    public function getTickets()
    {
        return $this->db->table('tickets t')
            ->select('
                t.*,
                ms.name AS service_display_name,
                ms.code AS service_code
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getTicketDetail($id)
    {
        return $this->db->table('tickets t')
            ->select('
                t.*,
                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->where('t.id', $id)
            ->get()
            ->getRowArray();
    }

    public function getByStatus($status)
    {
        return $this->db->table('tickets t')
            ->select('
                t.*,
                ms.name AS service_display_name,
                ms.code AS service_code
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->where('LOWER(t.status)', strtolower($status))
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();
    }
}