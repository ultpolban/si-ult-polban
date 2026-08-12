<?php

namespace App\Models;

use CodeIgniter\Model;

class PersyaratanLayananModel extends Model
{
    protected $table            = 'master_service_requirements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['service_id', 'name', 'file_type', 'max_file_size', 'is_required', 'allowed_extensions', 'is_active'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getPersyaratanWithLayanan()
    {
        return $this->select("master_service_requirements.*, master_services.name as layanan_nama, master_service_requirements.service_id as layanan_id, master_service_requirements.name as persyaratan, master_service_requirements.file_type as tipe_file, master_service_requirements.max_file_size as ukuran, CASE WHEN master_service_requirements.is_required = 1 THEN 'Wajib' ELSE 'Opsional' END as wajib, CASE WHEN master_service_requirements.is_active = 1 THEN 'Aktif' ELSE 'Nonaktif' END as status")
                    ->join('master_services', 'master_services.id = master_service_requirements.service_id', 'left')
                    ->orderBy('master_service_requirements.name', 'ASC')
                    ->findAll();
    }
}
