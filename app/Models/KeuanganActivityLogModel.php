<?php
namespace App\Models;
use CodeIgniter\Model;
class KeuanganActivityLogModel extends Model
{
    protected $table='keuangan_activity_logs'; protected $primaryKey='id'; protected $returnType='array'; protected $useTimestamps=false;
    protected $allowedFields=['user_id','ticket_id','action','activity','status','note','created_at'];
}
