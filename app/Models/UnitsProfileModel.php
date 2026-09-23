<?php

namespace App\Models;

class UnitsProfileModel extends BaseModel
{
    protected $table = 'units_profiles';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $protectFields = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'service_unit_id', 'description', 'is_active',
        'created_by', 'updated_by',
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [
        'service_unit_id' => 'required|integer',
        'description'     => 'required|min_length[10]',
        'is_active'       => 'required|in_list[0,1]',
    ];

    public function getWithUnit()
    {
        return $this->select('units_profiles.*, master_service_units.code AS unit_code, master_service_units.name AS unit_name')
            ->join('master_service_units', 'master_service_units.id = units_profiles.service_unit_id', 'left');
    }

    public function getActive()
    {
        return $this->where('units_profiles.is_active', 1)
            ->orderBy('units_profiles.id', 'ASC')->findAll();
    }

    public function search(string $keyword = '')
    {
        return $this->groupStart()->like('description', $keyword)->groupEnd();
    }
}

