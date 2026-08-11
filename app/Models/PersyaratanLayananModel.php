<?php

namespace App\Models;

use CodeIgniter\Model;

class PersyaratanLayananModel extends Model
{
    protected $table            = 'persyaratan_layanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['layanan_id', 'persyaratan', 'tipe_file', 'ukuran', 'wajib', 'status'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getPersyaratanWithLayanan()
    {
        return $this->select('persyaratan_layanan.*, layanans.nama as layanan_nama')
                    ->join('layanans', 'layanans.id = persyaratan_layanan.layanan_id', 'left')
                    ->findAll();
    }
}
