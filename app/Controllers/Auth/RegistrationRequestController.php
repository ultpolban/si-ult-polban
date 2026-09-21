<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\MasterApplicantTypeModel;
use App\Models\MasterClassModel;
use App\Models\MasterStudyProgramModel;
use App\Models\UserModel;
use App\Services\RegistrationRequestService;
use App\Validation\RegistrationRequestValidator;

class RegistrationRequestController extends BaseController
{
    protected RegistrationRequestService $requestService;

    protected MasterApplicantTypeModel $applicantTypeModel;

    protected MasterStudyProgramModel $studyProgramModel;

    protected MasterClassModel $classModel;

    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form', 'url']);

        $this->requestService     = new RegistrationRequestService();
        $this->applicantTypeModel = new MasterApplicantTypeModel();
        $this->studyProgramModel  = new MasterStudyProgramModel();
        $this->classModel         = new MasterClassModel();
        $this->userModel          = new UserModel();
    }

    /**
     * Form Permintaan Izin Registrasi (payload penuh, status PENDING)
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/registration_request', [
            'title'          => 'Permintaan Izin Registrasi',
            'applicantTypes' => $this->applicantTypeModel->getActive(),
            'studyPrograms'  => $this->studyProgramModel->getActive(),
            'classes'        => $this->classModel->getActive(),
            'applicantCode'  => 'UMUM',
            'applicantType'  => null,
            'data'           => [],
        ]);
    }

    /**
     * Field dinamis per jenis pemohon (AJAX, dipakai form registration-request)
     */
    public function fields(int $applicantTypeId)
    {
        $applicantType = $this->applicantTypeModel->find($applicantTypeId);

        if (! $applicantType) {
            return $this->response->setStatusCode(404)->setBody('Jenis pemohon tidak ditemukan.');
        }

        return view('auth/_registration_request_fields', [
            'applicantCode' => $applicantType['code'] ?? 'UMUM',
            'applicantType' => $applicantType,
            'studyPrograms' => $this->studyProgramModel->getActive(),
            'classes'       => $this->classModel->getActive(),
            'data'          => ['applicant_type_id' => $applicantTypeId],
        ]);
    }

    /**
     * Proses simpan permintaan izin registrasi (payload penuh -> PENDING).
     * TIDAK membuat user / profile / MFA di sini.
     */
    public function store()
    {
        $data = $this->request->getPost();

        if (! $this->validate(RegistrationRequestValidator::store())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email = strtolower(trim((string) ($data['email'] ?? '')));

        // Cek duplikasi user aktif di DB utama (sudah punya akun -> tolak).
        if ($this->userModel->where('email', $email)->first()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email sudah terdaftar sebagai pengguna. Silakan login.');
        }

        // Cek duplikasi berdasarkan request terbaru untuk email tsb.
        $existing = $this->requestService->getByEmail($email);

        if ($existing) {
            if (($existing['status'] ?? '') === 'pending') {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('info', 'Permintaan izin registrasi Anda sedang menunggu persetujuan admin.');
            }

            if (($existing['status'] ?? '') === 'approved') {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('info', 'Permintaan izin registrasi Anda sudah disetujui. Silakan melanjutkan registrasi.');
            }
        }

        // Tidak ada request sebelumnya / request sebelumnya rejected -> buat baru.
        // Service melakukan snapshot master + hash password -> PENDING.
        $id = $this->requestService->create($data);

        if ($id <= 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengirim permintaan. Silakan coba lagi.');
        }

        // Catat aktivitas (user belum punya akun -> user_id null).
        // Email dikirim terpisah agar disimpan terstruktur pada kolom JSON
        // new_data (dibersihkan + divalidasi di ActivityLogService),
        // bukan dirangkai mentah ke dalam string deskripsi.
        service('activityLogService')->storeLog([
            'action'       => 'registration_request_created',
            'module'       => 'registration_request',
            'reference_id' => $id,
            'user_id'      => null,
            'email'        => $email,
            'description'  => 'Permintaan izin registrasi baru',
            'ip_address'   => $this->request->getIPAddress(),
            'user_agent'   => $this->request->getUserAgent()->getAgentString(),
        ]);

        return redirect()
            ->to('/registration-request/status?email=' . rawurlencode($email))
            ->with('success', 'Permintaan izin registrasi berhasil dikirim. Silakan tunggu persetujuan admin.');
    }

    /**
     * Halaman status permintaan izin registrasi
     */
    public function status()
    {
        $email = strtolower(trim((string) $this->request->getGet('email')));

        $request = null;

        if ($email !== '') {
            $request = $this->requestService->getByEmail($email);
        }

        return view('auth/registration_request_status', [
            'title'   => 'Status Permintaan Registrasi',
            'email'   => $email,
            'request' => $request,
        ]);
    }
}
