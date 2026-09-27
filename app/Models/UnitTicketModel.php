<?php

namespace App\Models;

use CodeIgniter\Model;

abstract class UnitTicketModel extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected string $unitName;

    protected $allowedFields = [
        'ticket_number', 'user_profile_id', 'service_id', 'title',
        'description', 'status', 'priority', 'assigned_to',
        'submitted_at', 'verified_at', 'processed_at', 'completed_at',
        'rejected_at', 'cancelled_at', 'admin_note', 'rejection_reason',
        'result_note', 'result_file', 'sent_to_ult', 'sent_to_ult_at',
        'sent_to_applicant', 'sent_to_applicant_at',
    ];

    protected $beforeFind = ['prepareUnitQuery'];

    protected function prepareUnitQuery(array $data): array
    {
        $this->select(
            'tickets.*,
             tickets.ticket_number AS no_tiket,
             tickets.title AS judul,
             tickets.description AS deskripsi,
             COALESCE(user_profiles.name, users.full_name) AS applicant_name,
             COALESCE(user_profiles.nik, users.identity_number) AS applicant_identifier,
             master_services.name AS service_name,
             master_service_categories.name AS service_category,
             master_service_units.name AS unit_name,
             master_services.name AS nama_layanan,
             master_service_categories.name AS nama_kategori,
             master_service_units.name AS nama_unit,
             COALESCE(user_profiles.name, users.full_name) AS nama_pemohon'
        )
            ->join('user_profiles', 'user_profiles.id = tickets.user_profile_id', 'left')
            ->join('users', 'users.id = user_profiles.user_id', 'left')
            ->join('master_services', 'master_services.id = tickets.service_id', 'left')
            ->join('master_service_categories', 'master_service_categories.id = master_services.service_category_id', 'left')
            ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id', 'left')
            ->where('master_service_units.name', $this->unitName);

        $this->builder()->resetQuery('QBOrderBy')->orderBy('tickets.id', 'DESC');

        return $data;
    }

    public function queryTickets(): self
    {
        return $this;
    }

}
