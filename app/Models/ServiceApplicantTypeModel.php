<?php

namespace App\Models;

class ServiceApplicantTypeModel extends BaseModel
{
    protected $table = 'service_applicant_types';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = false;

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'service_id',
        'applicant_type_id',
    ];

    protected $validationRules = [
        'service_id'        => 'required|integer',
        'applicant_type_id' => 'required|integer',
    ];

    /**
     * ID jenis pemohon yang boleh mengakses sebuah layanan.
     */
    public function getApplicantTypeIdsForService(int $serviceId): array
    {
        return array_column(
            $this->where('service_id', $serviceId)->findAll(),
            'applicant_type_id'
        );
    }

    /**
     * ID layanan yang boleh diakses oleh sebuah jenis pemohon.
     */
    public function getServiceIdsForApplicantType(int $applicantTypeId): array
    {
        return array_column(
            $this->where('applicant_type_id', $applicantTypeId)->findAll(),
            'service_id'
        );
    }

    /**
     * Data lengkap mapping sebuah layanan (join nama jenis pemohon).
     */
    public function getByService(int $serviceId): array
    {
        return $this
            ->join(
                'master_applicant_types',
                'master_applicant_types.id = service_applicant_types.applicant_type_id',
                'left'
            )
            ->where('service_applicant_types.service_id', $serviceId)
            ->orderBy('master_applicant_types.sort_order', 'ASC')
            ->orderBy('master_applicant_types.name', 'ASC')
            ->findAll();
    }

    /**
     * Ganti seluruh mapping sebuah layanan.
     */
    public function replaceForService(int $serviceId, array $applicantTypeIds): bool
    {
        $this->where('service_id', $serviceId)->delete();

        $now = date('Y-m-d H:i:s');

        foreach ($applicantTypeIds as $applicantTypeId) {
            if ((int) $applicantTypeId <= 0) {
                continue;
            }

            $this->insert([
                'service_id'        => (int) $serviceId,
                'applicant_type_id' => (int) $applicantTypeId,
                'created_at'        => $now,
                'updated_at'        => $now,
            ]);
        }

        return true;
    }
}
