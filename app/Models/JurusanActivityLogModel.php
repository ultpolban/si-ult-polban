<?php
namespace App\Models;
use CodeIgniter\Model;
class JurusanActivityLogModel extends Model
{
    protected $table='jurusan_activity_logs'; protected $primaryKey='id'; protected $returnType='array'; protected $useTimestamps=false;
    protected $allowedFields=['user_id','ticket_id','action','activity','status','note','created_at'];
}
