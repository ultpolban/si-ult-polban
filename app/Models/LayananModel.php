<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'master_services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['service_unit_id', 'service_category_id', 'code', 'name', 'service_hours', 'is_online', 'is_active'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getLayananWithRelations()
    {
        return $this->select("master_services.*, master_service_units.name as unit_nama, master_service_categories.name as kategori_nama, master_services.service_unit_id as unit_layanan_id, master_services.service_category_id as kategori_layanan_id, master_services.code as kode, master_services.name as nama, master_services.service_hours as sla, CASE WHEN master_services.is_online = 1 THEN 'Online' ELSE 'Offline' END as online, CASE WHEN master_services.is_active = 1 THEN 'Aktif' ELSE 'Nonaktif' END as status")
                    ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id', 'left')
                    ->join('master_service_categories', 'master_service_categories.id = master_services.service_category_id', 'left')
                    ->orderBy('master_services.name', 'ASC')
                    ->findAll();
    }
}
