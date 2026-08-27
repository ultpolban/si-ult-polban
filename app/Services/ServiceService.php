<?php

namespace App\Services;

use App\Models\MasterServiceModel;
use App\Models\ServiceApplicantTypeModel;

class ServiceService
{
    protected MasterServiceModel $model;

    public function __construct()
    {
        $this->model = new MasterServiceModel();
    }

    /**
     * List Data
     */
    public function getList(string $keyword = ''): array
    {
        $builder = $this->model
            ->getComplete();

        if ($keyword !== '') {

            $builder
                ->groupStart()
                ->like('master_services.code', $keyword)
                ->orLike('master_services.name', $keyword)
                ->orLike('master_service_units.name', $keyword)
                ->orLike('master_service_categories.name', $keyword)
                ->groupEnd();
        }

        $builder
            ->orderBy('master_services.sort_order', 'ASC')
            ->orderBy('master_services.name', 'ASC');

        return [

            'services' => $builder->paginate(10),

            'pager' => $this->model->pager,

        ];
    }

    /**
     * Dropdown
     */
    public function getDropdown(): array
    {
        return $this->model->dropdown();
    }

    /**
     * Active
     */
    public function getActive(): array
    {
        return $this->model->getActive();
    }

    /**
     * Layanan aktif yang boleh diakses oleh sebuah jenis pemohon.
     *
     * - $applicantTypeId = null/0 (staff / tanpa profil)  => semua layanan.
     * - Jika tabel mapping belum diisi sama sekali        => semua layanan
     *   (backward compatibility agar layanan baru tetap bisa diakses).
     */
    public function getActiveForApplicantType(?int $applicantTypeId): array
    {
        $services = $this->model->getActive();

        if (! $applicantTypeId || $applicantTypeId <= 0) {
            return $services;
        }

        $mappingModel = new ServiceApplicantTypeModel();

        // Belum ada mapping sama sekali => semua layanan boleh diakses
        if ($mappingModel->countAll() === 0) {
            return $services;
        }

        $allowedIds = $mappingModel->getServiceIdsForApplicantType($applicantTypeId);

        return array_values(array_filter(
            $services,
            static fn ($service) => in_array((int) $service['id'], $allowedIds, true)
        ));
    }

    /**
     * Cek apakah sebuah layanan boleh diakses oleh jenis pemohon tertentu.
     *
     * - $applicantTypeId = null/0 (staff / tanpa profil)  => diizinkan.
     * - Jika tabel mapping belum diisi                     => diizinkan.
     */
    public function isAllowedForApplicantType(int $serviceId, ?int $applicantTypeId): bool
    {
        if (! $applicantTypeId || $applicantTypeId <= 0) {
            return true;
        }

        $mappingModel = new ServiceApplicantTypeModel();

        if ($mappingModel->countAll() === 0) {
            return true;
        }

        $allowedIds = $mappingModel->getServiceIdsForApplicantType($applicantTypeId);

        return in_array($serviceId, $allowedIds, true);
    }

    /**
     * Detail
     */
    public function getById(int $id): ?array
    {
        return $this->model
            ->getComplete()
            ->where('master_services.id', $id)
            ->first();
    }

    /**
     * Simpan
     */
    public function create(array $data): int
    {
        return (int) $this->model->insert($data);
    }

    /**
     * Update
     */
    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    /**
     * Hapus
     */
    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    /**
     * Restore
     */
    public function restore(int $id): bool
    {
        return $this->model
            ->onlyDeleted()
            ->update($id, [
                'deleted_at' => null,
            ]);
    }

    /**
     * Status
     */
    public function changeStatus(
        int $id,
        bool $status
    ): bool {

        return $this->model->update($id, [
            'is_active' => $status,
        ]);
    }
}
