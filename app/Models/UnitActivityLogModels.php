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
        return $this->select($this->table . '.*, t.ticket_number AS no_tiket, msu.name AS unit, ms.name AS layanan')
            ->join('tickets t', 't.id = ' . $this->table . '.ticket_id', 'left')
            ->join('master_services ms', 'ms.id = t.service_id', 'left')
            ->join('master_service_units msu', 'msu.id = ms.service_unit_id', 'left')
            ->orderBy($this->table . '.created_at', 'DESC');
    }
}

class AkademikActivityLogModel extends CoreUnitActivityLogModel
{
    protected $table = 'akademik_activity_logs';
}

class KeuanganActivityLogModel extends CoreUnitActivityLogModel
{
    protected $table = 'keuangan_activity_logs';
}

class KemahasiswaanActivityLogModel extends CoreUnitActivityLogModel
{
    protected $table = 'kemahasiswaan_activity_logs';
}
