<?php

namespace App\Models;

class RegistrationRequestModel extends BaseModel
{
    /**
     * Opsi A: tabel ini hidup di database FISIK terpisah (`registrations`).
     * User / role / permission / MFA tetap di grup `default`.
     */
    protected $DBGroup = 'registrations';

    protected $table = 'registration_requests';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $protectFields = true;

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = 'deleted_at';

    protected $allowedFields = [
        'full_name',
        'gender',
        'email',
        'password_hash',
        'applicant_type_id',
        'applicant_type_code',
        'applicant_type_name',
        'study_program_id',
        'study_program_name',
        'class_id',
        'class_name',
        'nim',
        'nik',
        'student_name',
        'institution_name',
        'position',
        'phone_number',
        'address',
        'purpose',
        'status',
        'processed_by',
        'processed_by_name',
        'processed_at',
        'rejection_reason',
        'created_user_id',
    ];

    protected $validationRules = [
        'full_name'           => 'required|max_length[150]',
        'email'               => 'required|valid_email|max_length[150]',
        'password_hash'       => 'required|max_length[255]',
        'applicant_type_id'   => 'required|integer',
        'applicant_type_code' => 'required|max_length[20]',
        'applicant_type_name' => 'required|max_length[100]',
        'status'              => 'required|in_list[pending,approved,rejected]',
    ];

    /**
     * Cari request berdasarkan email (data terbaru didahulukan).
     */
    public function findByEmail(string $email)
    {
        return $this->where('email', $email)
            ->orderBy('id', 'DESC')
            ->first();
    }

    /**
     * Request dengan status tertentu (mis. pending).
     */
    public function findByStatus(string $status)
    {
        return $this->where('status', $status)
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    /**
     * Opsi A: cross-DB JOIN tidak mungkin (registrations vs default),
     * jadi daftar/detail TIDAK join ke users. Nama admin pemroses
     * dibaca dari kolom snapshot `processed_by_name`.
     * Method ini dipertahankan sebagai no-op agar service lama
     * tetap kompatibel.
     */
    public function withProcessor()
    {
        return $this->select('registration_requests.*');
    }

    /**
     * Pencarian (nama, email, keperluan).
     */
    public function search(string $keyword = '')
    {
        return $this
            ->groupStart()
            ->like('registration_requests.full_name', $keyword)
            ->orLike('registration_requests.email', $keyword)
            ->orLike('registration_requests.purpose', $keyword)
            ->groupEnd();
    }
}
