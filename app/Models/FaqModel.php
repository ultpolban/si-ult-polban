<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = [
        'category',
        'question',
        'answer',
        'sort_order',
        'is_active'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function getFaqs($activeOnly = false)
    {
        $builder = $this->orderBy('sort_order', 'ASC')
                        ->orderBy('created_at', 'DESC');
        
        if ($activeOnly) {
            $builder->where('is_active', 1);
        }
        
        return $builder->findAll();
    }
}
