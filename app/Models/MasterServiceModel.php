<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterServiceModel extends Model
{
    protected $table = 'master_services';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'service_unit_id',
        'service_category_id',
        'code',
        'name',
        'description',
        'service_hours',
        'max_file_size',
        'is_online',
        'is_active',
        'sort_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = false;

    protected $useSoftDeletes = true;

    protected $deletedField = 'deleted_at';


    /**
     * =========================================================
     * SERVICE AKTIF
     * =========================================================
     */
    public function getActive()
    {
        return $this
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }


    /**
     * =========================================================
     * SERVICE DENGAN UNIT + CATEGORY
     * =========================================================
     */
    public function getWithRelations()
    {
        return $this
            ->select('
                master_services.*,

                master_service_units.code AS unit_code,
                master_service_units.name AS unit_name,

                master_service_categories.code AS category_code,
                master_service_categories.name AS category_name
            ')
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            )
            ->join(
                'master_service_categories',
                'master_service_categories.id = master_services.service_category_id',
                'left'
            )
            ->orderBy('master_services.sort_order', 'ASC')
            ->orderBy('master_services.name', 'ASC');
    }


    /**
     * =========================================================
     * SERVICE AKTIF DENGAN UNIT + CATEGORY
     * =========================================================
     */
    public function getActiveWithRelations()
    {
        return $this
            ->getWithRelations()
            ->where('master_services.is_active', 1);
    }


    /**
     * =========================================================
     * BERDASARKAN UNIT
     * =========================================================
     */
    public function getByUnit(int $unitId)
    {
        return $this
            ->where('service_unit_id', $unitId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }


    /**
     * =========================================================
     * BERDASARKAN CATEGORY
     * =========================================================
     */
    public function getByCategory(int $categoryId)
    {
        return $this
            ->where('service_category_id', $categoryId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }


    /**
     * =========================================================
     * SEARCH SERVICE
     * =========================================================
     */
    public function search(string $keyword)
    {
        return $this
            ->groupStart()
                ->like('master_services.code', $keyword)
                ->orLike('master_services.name', $keyword)
                ->orLike('master_services.description', $keyword)
            ->groupEnd();
    }
}