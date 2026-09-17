<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganTicketModel extends Model
{
    protected $table = 'keuangan_tickets';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'ticket_number','applicant_name','applicant_identifier','service_name','service_category','unit_name','title','description','status','priority','admin_note','result_note','result_file','submitted_at','processed_at','completed_at','sent_to_ult','sent_to_ult_at','sent_to_applicant','sent_to_applicant_at',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function queryTickets()
    {
        return $this->select('keuangan_tickets.*, ticket_number AS no_tiket, title AS judul, description AS deskripsi, service_name AS nama_layanan, service_category AS nama_kategori, unit_name AS nama_unit, applicant_name AS nama_pemohon');
    }

    public function findById(int $ticketId): ?array
    {
        if ($ticketId <= 0) {
            return null;
        }

        return $this->queryTickets()
            ->where('keuangan_tickets.id', $ticketId)
            ->first() ?: null;
    }
}
