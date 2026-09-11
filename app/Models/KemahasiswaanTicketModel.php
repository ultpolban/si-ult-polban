<?php

namespace App\Models;

use CodeIgniter\Model;

class KemahasiswaanTicketModel extends Model
{
    protected $table = 'kemahasiswaan_tickets';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'ticket_number','applicant_name','applicant_identifier','service_name','service_category','unit_name','title','description','status','priority','admin_note','result_note','result_file','submitted_at','processed_at','completed_at',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function queryTickets()
    {
        return $this->select('kemahasiswaan_tickets.*, ticket_number AS no_tiket, title AS judul, description AS deskripsi, service_name AS nama_layanan, service_category AS nama_kategori, unit_name AS nama_unit, applicant_name AS nama_pemohon');
    }
}
