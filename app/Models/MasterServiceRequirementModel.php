<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterServiceRequirementModel extends Model
{
    protected $table = 'master_service_requirements';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'service_id',
        'name',
        'description',
        'file_type',
        'max_file_size',
        'is_required',
        'allowed_extensions',
        'sort_order',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = false;

    protected $useSoftDeletes = true;

    protected $deletedField = 'deleted_at';


    /**
     * =========================================================
     * REQUIREMENT AKTIF BERDASARKAN SERVICE
     * =========================================================
     */
    public function getActiveByService(int $serviceId)
    {
        return $this
            ->where('service_id', $serviceId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }


    /**
     * =========================================================
     * SEMUA REQUIREMENT BERDASARKAN SERVICE
     * =========================================================
     */
    public function getByService(int $serviceId)
    {
        return $this
            ->where('service_id', $serviceId)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }


    /**
     * =========================================================
     * REQUIREMENT WAJIB
     * =========================================================
     */
    public function getRequiredByService(int $serviceId)
    {
        return $this
            ->where('service_id', $serviceId)
            ->where('is_required', 1)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }
}