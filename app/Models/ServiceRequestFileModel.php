<?php

namespace App\Models;

class ServiceRequestFileModel extends BaseModel
{
    protected $table = 'service_request_files';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $allowedFields = [
        'service_request_id',
        'requirement_id',
        'original_name',
        'file_name',
        'file_path',
        'file_extension',
        'mime_type',
        'file_size',
        'is_verified',
        'verified_by',
        'verified_at',
        'notes'
    ];

    protected $validationRules = [
        'service_request_id' => 'required|integer',
        'requirement_id'     => 'required|integer',
        'original_name'      => 'required',
        'file_name'          => 'required',
        'file_path'          => 'required'
    ];

    public function getByRequest(int $requestId)
    {
        return $this
            ->select("
                service_request_files.*,
                master_service_requirements.name AS requirement_name
            ")
            ->join(
                'master_service_requirements',
                'master_service_requirements.id = service_request_files.requirement_id'
            )
            ->where('service_request_id', $requestId)
            ->findAll();
    }
}
