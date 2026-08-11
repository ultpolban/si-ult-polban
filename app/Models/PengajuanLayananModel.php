<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanLayananModel extends Model
{
    protected $table            = 'pengajuan_layanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tiket', 'user_id', 'layanan_id', 'judul', 'deskripsi', 'prioritas', 'status'
    ];

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

    // Helper method to get pengajuan with details
    public function getPengajuanWithDetails($id = null)
    {
        // For now, layanans table might not exist, but let's assume it has an id and name.
        // We will just return the base table.
        if ($id) {
            return $this->where('id', $id)->first();
        }
        return $this->findAll();
    }
}
