<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriLayananModel extends Model
{
    protected $table            = 'master_service_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['service_unit_id', 'code', 'name', 'icon', 'color', 'is_active'];

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

    public function getKategoriWithUnit()
    {
        return $this->select("master_service_categories.*, master_service_units.name as unit_nama, master_service_categories.service_unit_id as unit_layanan_id, master_service_categories.code as kode, master_service_categories.name as nama, CASE WHEN master_service_categories.is_active = 1 THEN 'Aktif' ELSE 'Nonaktif' END as status")
                    ->join('master_service_units', 'master_service_units.id = master_service_categories.service_unit_id', 'left')
                    ->orderBy('master_service_categories.name', 'ASC')
                    ->findAll();
    }
}
