<?php

namespace App\Models;

class MasterApplicantTypeModel extends BaseModel
{
    protected $table = 'master_applicant_types';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'code',
        'name',
        'description',
        'is_internal',
        'sort_order',
        'is_active'
    ];

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $validationRules = [

        'code' => [
            'label' => 'Kode Jenis Pemohon',
            'rules' => 'required|max_length[20]|is_unique[master_applicant_types.code,id,{id}]'
        ],

        'name' => [
            'label' => 'Nama Jenis Pemohon',
            'rules' => 'required|max_length[100]'
        ],

        'description' => [
            'label' => 'Deskripsi',
            'rules' => 'permit_empty'
        ],

        'is_internal' => [
            'label' => 'Internal',
            'rules' => 'required|in_list[0,1]'
        ],

        'sort_order' => [
            'label' => 'Urutan',
            'rules' => 'required|integer'
        ],

        'is_active' => [
            'label' => 'Status',
            'rules' => 'required|in_list[0,1]'
        ]

    ];

    protected $validationMessages = [];

    protected $skipValidation = false;

    /**
     * Data aktif
     */
    public function getActive()
    {
        return $this->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    /**
     * Data internal
     */
    public function getInternal()
    {
        return $this->where('is_internal', 1)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Data eksternal
     */
    public function getExternal()
    {
        return $this->where('is_internal', 0)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Dropdown
     */
    public function dropdown()
    {
        return $this->select('id, code, name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * Search
     */
    public function search(string $keyword = '')
    {
        return $this->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->groupEnd()
            ->orderBy('sort_order', 'ASC');
    }
}
