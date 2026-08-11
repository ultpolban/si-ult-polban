<?php

namespace App\Models;

class MasterDepartmentModel extends BaseModel
{
    /**
     * Nama tabel
     */
    protected $table = 'master_departments';

    /**
     * Primary Key
     */
    protected $primaryKey = 'id';

    /**
     * Return Type
     */
    protected $returnType = 'array';

    /**
     * Auto Increment
     */
    protected $useAutoIncrement = true;

    /**
     * Soft Delete
     */
    protected $useSoftDeletes = true;

    /**
     * Protect Field
     */
    protected $protectFields = true;

    /**
     * Allowed Fields
     */
    protected $allowedFields = [
        'code',
        'name',
        'short_name',
        'description',
        'sort_order',
        'is_active',
    ];

    /**
     * Timestamp
     */
    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    /**
     * Validation
     */
    protected $validationRules = [

        'code' => [
            'label' => 'Kode Departemen',
            'rules' => 'required|max_length[10]'
        ],

        'name' => [
            'label' => 'Nama Departemen',
            'rules' => 'required|max_length[150]'
        ],

        'short_name' => [
            'label' => 'Nama Singkat',
            'rules' => 'permit_empty|max_length[30]'
        ],

        'description' => [
            'label' => 'Deskripsi',
            'rules' => 'permit_empty'
        ],

        'sort_order' => [
            'label' => 'Urutan',
            'rules' => 'required|integer'
        ],

        'is_active' => [
            'label' => 'Status',
            'rules' => 'required|in_list[0,1]'
        ],

    ];

    protected $validationMessages = [];

    protected $skipValidation = false;

    /**
     * ==========================
     * Scope Active
     * ==========================
     */
    public function getActive()
    {
        return $this->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    /**
     * ==========================
     * Dropdown
     * ==========================
     */
    public function dropdown()
    {
        return $this->select('id, code, name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /**
     * ==========================
     * Search
     * ==========================
     */
    public function search(string $keyword = '')
    {
        return $this->groupStart()
            ->like('code', $keyword)
            ->orLike('name', $keyword)
            ->orLike('short_name', $keyword)
            ->groupEnd()
            ->orderBy('sort_order', 'ASC');
    }
}
