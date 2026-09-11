<?php

namespace App\Models;

use CodeIgniter\Model;

abstract class CoreUnitActivityLogModel extends Model
{
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['user_id','ticket_id','action','activity','status','note','created_at'];

    public function queryWithTickets()
    {
        return $this->select($this->table . '.*, t.ticket_number AS no_tiket, t.unit_name AS unit, t.service_name AS layanan')
            ->join($this->ticketTable . ' t', 't.id = ' . $this->table . '.ticket_id', 'left')
            ->orderBy($this->table . '.created_at', 'DESC');
    }
}

class AkademikActivityLogModel extends CoreUnitActivityLogModel
{
    protected $table = 'akademik_activity_logs';
    protected string $ticketTable = 'akademik_tickets';
}

class KeuanganActivityLogModel extends CoreUnitActivityLogModel
{
    protected $table = 'keuangan_activity_logs';
    protected string $ticketTable = 'keuangan_tickets';
}

class KemahasiswaanActivityLogModel extends CoreUnitActivityLogModel
{
    protected $table = 'kemahasiswaan_activity_logs';
    protected string $ticketTable = 'kemahasiswaan_tickets';
}
