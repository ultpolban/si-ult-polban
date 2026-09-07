<?php

namespace App\Models;

use CodeIgniter\Model;

class KemahasiswaanTicketModel extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'ticket_number', 'user_profile_id', 'service_id', 'title',
        'description', 'status', 'priority', 'assigned_to', 'submitted_at',
        'verified_at', 'processed_at', 'completed_at', 'rejected_at',
        'cancelled_at', 'admin_note', 'rejection_reason',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function queryTickets()
    {
        return $this->select(
            'tickets.*, tickets.ticket_number AS no_tiket,
             tickets.title AS judul, tickets.description AS deskripsi,
             master_services.name AS nama_layanan,
             master_service_categories.name AS nama_kategori,
             master_service_units.name AS nama_unit'
        )
            ->join('master_services', 'master_services.id = tickets.service_id', 'left')
            ->join('master_service_categories', 'master_service_categories.id = master_services.service_category_id', 'left')
            ->join('master_service_units', 'master_service_units.id = master_service_categories.service_unit_id', 'left')
            ->where('LOWER(master_service_units.name)', 'kemahasiswaan');
    }
}
