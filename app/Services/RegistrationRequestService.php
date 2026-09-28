<?php

namespace App\Services;

use App\Models\MasterApplicantTypeModel;
use App\Models\MasterClassModel;
use App\Models\MasterRoleModel;
use App\Models\MasterStudyProgramModel;
use App\Models\RegistrationRequestModel;
use App\Models\UserModel;
use App\Models\UserProfileModel;

class RegistrationRequestService
{
    /**
     * Model (Opsi A: DB `registrations` — payload penuh, status PENDING).
     */
    protected RegistrationRequestModel $model;

    protected UserModel $userModel;

    protected UserProfileModel $profileModel;

    protected MasterRoleModel $roleModel;

    protected MasterApplicantTypeModel $applicantTypeModel;

    protected MasterStudyProgramModel $studyProgramModel;

    protected MasterClassModel $classModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model              = new RegistrationRequestModel();
        $this->userModel          = new UserModel();
        $this->profileModel       = new UserProfileModel();
        $this->roleModel          = new MasterRoleModel();
        $this->applicantTypeModel = new MasterApplicantTypeModel();
        $this->studyProgramModel  = new MasterStudyProgramModel();
        $this->classModel         = new MasterClassModel();
    }

    /**
     * Daftar request untuk admin (dengan filter & pagination).
     */
    public function getList(string $keyword = '', string $status = '', int $perPage = 10): array
    {
        $builder = $this->model->withProcessor();

        if ($keyword !== '') {
            $builder = $builder->search($keyword);
        }

        if ($status !== '' && in_array($status, ['pending', 'approved', 'rejected'], true)) {
            $builder = $builder->where('registration_requests.status', $status);
        }

        $builder = $builder->orderBy('registration_requests.id', 'DESC');

        return [
            'items' => $builder->paginate($perPage),
            'pager' => $this->model->pager,
        ];
    }

    /**
     * Detail request (tanpa join lintas DB; nama admin dari snapshot).
     */
    public function find(int $id): ?array
    {
        return $this->model
            ->withProcessor()
            ->where('registration_requests.id', $id)
            ->first();
    }

    /**
     * Request terbaru berdasarkan email (untuk pengecekan duplikasi).
     */
    public function getByEmail(string $email): ?array
    {
        return $this->model->findByEmail($email);
    }

    /**
     * Apakah email sudah memiliki request berstatus approved?
     */
    public function hasApproved(string $email): bool
    {
        return (bool) $this->model
            ->where('email', $email)
            ->where('status', 'approved')
            ->countAllResults();
    }

    /**
     * Buat request registrasi penuh (status pending) di DB registrations.
     * $data = payload mentah form (termasuk password PLAIN &
     * applicant_type_id); snapshot master + hash password di sini.
     * TIDAK membuat user / profile / MFA — itu hanya saat approve().
     *
     * @return int ID request, 0 bila gagal / duplikat
     */
    public function create(array $data): int
    {
        $email = strtolower(trim((string) ($data['email'] ?? '')));

        if ($email === '') {
            return 0;
        }

        if ($this->userModel->where('email', $email)->countAllResults() > 0) {
            return 0;
        }

        $pending = $this->model
            ->where('email', $email)
            ->where('status', 'pending')
            ->countAllResults();

        if ($pending > 0) {
            return 0;
        }

        $applicantType = $this->applicantTypeModel->find((int) ($data['applicant_type_id'] ?? 0));

        if (! $applicantType) {
            return 0;
        }

        $studyProgram = ! empty($data['study_program_id'])
            ? $this->studyProgramModel->find((int) $data['study_program_id'])
            : null;

        $class = ! empty($data['class_id'])
            ? $this->classModel->find((int) $data['class_id'])
            : null;

        $nik = trim((string) ($data['nik'] ?? $data['identity_number'] ?? ''));

        $row = [
            'full_name'           => trim((string) ($data['full_name'] ?? '')),
            'email'               => $email,
            'password_hash'       => password_hash((string) ($data['password'] ?? ''), PASSWORD_DEFAULT),
            'applicant_type_id'   => (int) $applicantType['id'],
            'applicant_type_code' => (string) ($applicantType['code'] ?? ''),
            'applicant_type_name' => (string) ($applicantType['name'] ?? ''),
            'study_program_id'    => $studyProgram ? (int) $studyProgram['id'] : null,
            'study_program_name'  => $studyProgram ? (string) ($studyProgram['name'] ?? '') : null,
            'class_id'            => $class ? (int) $class['id'] : null,
            'class_name'          => $class ? (string) ($class['name'] ?? '') : null,
            'nim'                 => $this->nullStr($data['nim'] ?? null),
            'nik'                 => $nik === '' ? null : $nik,
            'student_name'        => $this->nullStr($data['student_name'] ?? null),
            'institution_name'    => $this->nullStr($data['institution_name'] ?? null),
            'position'            => $this->nullStr($data['position'] ?? null),
            'phone_number'        => $this->nullStr($data['phone_number'] ?? null),
            'address'             => $this->nullStr($data['address'] ?? null),
            'gender'              => in_array($data['gender'] ?? '', ['L', 'P'], true) ? $data['gender'] : null,
            'purpose'             => $this->nullStr($data['purpose'] ?? null),
            'status'              => 'pending',
        ];

        if (! $this->model->insert($row)) {
            return 0;
        }

        return (int) $this->model->getInsertID();
    }

    /**
     * Setujui request: buat user + profile di DB UTAMA (transaksi),
     * lalu tandai request APPROVED di DB registrations.
     * MFA TIDAK dijalankan di sini — user selesaikan via /register.
     *
     * @return array{ok:bool, user_id:int, error:string}
     */
    public function approve(int $id, int $adminId, string $adminName = ''): array
    {
        $request = $this->model->find($id);

        if (! $request || ($request['status'] ?? '') !== 'pending') {
            return ['ok' => false, 'user_id' => 0, 'error' => 'Permintaan tidak dalam status pending.'];
        }

        $email = strtolower(trim((string) ($request['email'] ?? '')));

        if ($this->userModel->where('email', $email)->countAllResults() > 0) {
            return ['ok' => false, 'user_id' => 0, 'error' => 'Email sudah terdaftar sebagai user.'];
        }

        $role = $this->roleModel->where('code', 'PEMOHON')->first();

        if (! $role) {
            return ['ok' => false, 'user_id' => 0, 'error' => 'Role PEMOHON tidak ditemukan.'];
        }

        $dbMain = \Config\Database::connect();
        $dbMain->transStart();

        $userId = $this->userModel->insert([
            'role_id'         => (int) $role['id'],
            'full_name'       => (string) ($request['full_name'] ?? ''),
            'identity_number' => $request['nik'] ?? null,
            'phone_number'    => $request['phone_number'] ?? null,
            'gender'          => in_array($request['gender'] ?? '', ['L', 'P'], true) ? $request['gender'] : null,
            'email'           => $email,
            'password'        => (string) ($request['password_hash'] ?? ''),
            'is_active'       => 0,
        ]);

        if (! $userId) {
            $dbMain->transRollback();

            return ['ok' => false, 'user_id' => 0, 'error' => 'Gagal membuat user.'];
        }

        $userId = (int) $userId;

        $profileOk = $this->profileModel->insert([
            'user_id'           => $userId,
            'applicant_type_id' => ! empty($request['applicant_type_id']) ? (int) $request['applicant_type_id'] : null,
            'study_program_id'  => ! empty($request['study_program_id']) ? (int) $request['study_program_id'] : null,
            'class_id'          => ! empty($request['class_id']) ? (int) $request['class_id'] : null,
            'nim'               => $request['nim'] ?? null,
            'nik'               => $request['nik'] ?? null,
            'student_name'      => $request['student_name'] ?? null,
            'institution_name'  => $request['institution_name'] ?? null,
            'position'          => $request['position'] ?? null,
            'name'              => (string) ($request['full_name'] ?? ''),
            'email'             => $email,
            'phone'             => $request['phone_number'] ?? null,
            'address'           => $request['address'] ?? null,
        ]);

        if (! $profileOk) {
            $dbMain->transRollback();

            return ['ok' => false, 'user_id' => 0, 'error' => 'Gagal membuat profil user.'];
        }

        $dbMain->transComplete();

        if ($dbMain->transStatus() === false) {
            return ['ok' => false, 'user_id' => 0, 'error' => 'Transaksi pembuatan user gagal.'];
        }

        $markOk = (bool) $this->model->update($id, [
            'status'            => 'approved',
            'processed_by'      => $adminId,
            'processed_by_name' => $adminName !== '' ? $adminName : null,
            'processed_at'      => date('Y-m-d H:i:s'),
            'rejection_reason'  => null,
            'created_user_id'   => $userId,
        ]);

        if (! $markOk) {
            return ['ok' => false, 'user_id' => $userId, 'error' => 'User dibuat (ID ' . $userId . ') tetapi status approval gagal ditandai.'];
        }

        return ['ok' => true, 'user_id' => $userId, 'error' => ''];
    }

    /**
     * Tolak request (hanya jika berstatus pending). Tanpa membuat user.
     */
    public function reject(int $id, int $adminId, string $reason, string $adminName = ''): bool
    {
        $request = $this->model->find($id);

        if (! $request || ($request['status'] ?? '') !== 'pending') {
            return false;
        }

        return (bool) $this->model->update($id, [
            'status'            => 'rejected',
            'processed_by'      => $adminId,
            'processed_by_name' => $adminName !== '' ? $adminName : null,
            'processed_at'      => date('Y-m-d H:i:s'),
            'rejection_reason'  => $reason,
        ]);
    }

    /**
     * Model
     */
    public function getModel(): RegistrationRequestModel
    {
        return $this->model;
    }

    /**
     * Helper: string kosong -> null
     */
    protected function nullStr($value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
