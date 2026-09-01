<?php

namespace App\Controllers;

use App\Models\MasterServiceModel;
use App\Models\MasterServiceRequirementModel;
use App\Models\MasterServiceUnitModel;

class DosenTicketController extends BaseController
{
    /**
     * ================================
     * CEK ROLE DOSEN
     * ================================
     */
    private function checkDosenRole()
    {
        $applicantTypeCode = session()->get('applicant_type_code');
        if ($applicantTypeCode !== 'DOSEN') {
            return redirect()
                ->to('/dashboard-mahasiswa')
                ->with('error', 'Akses hanya untuk dosen.');
        }
        return null;
    }

    /**
     * ================================
     * FORM AJUKAN LAYANAN
     * ================================
     */
    public function create()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        $unitModel = new MasterServiceUnitModel();

        $user = session()->get('user') ?? [];
        $profile = session()->get('dosen_profile') ?? [];

        $units = $unitModel
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        $pemohon = [
            'nama' => $user['nama']
                ?? $profile['nama']
                ?? 'Dosen',

            'nip' => $user['nip']
                ?? $profile['nip']
                ?? '',

            'nidn' => $user['nidn']
                ?? $profile['nidn']
                ?? '',

            'email' => $user['email']
                ?? $profile['email']
                ?? '',

            'telepon' => $user['no_hp']
                ?? $profile['no_hp']
                ?? '',
        ];

        $data = [
            'title' => 'Ajukan Layanan',
            'user' => $pemohon,
            'profile' => $profile,
            'units' => $units,
        ];

        return view('dosen/ticket/create', $data);
    }

    public function jenisLayanan()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        $unitId = $this->request->getGet('unit_id');

        if (!$unitId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unit layanan tidak ditemukan.',
                'data' => [],
            ]);
        }

        $serviceModel = new MasterServiceModel();

        $services = $serviceModel
            ->where('service_unit_id', $unitId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $services,
        ]);
    }

    public function persyaratan()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        $serviceId = $this->request->getGet('service_id');

        if (!$serviceId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jenis layanan tidak ditemukan.',
                'data' => [],
            ]);
        }

        $requirementModel = new MasterServiceRequirementModel();

        $requirements = $requirementModel
            ->where('service_id', $serviceId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $requirements,
        ]);
    }

    public function saveDraft()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        $db = \Config\Database::connect();

        $serviceId = $this->request->getPost('jenis_layanan');

        if (empty($serviceId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Silakan pilih jenis layanan terlebih dahulu.');
        }

        $service = $db->table('master_services')
            ->where('id', $serviceId)
            ->where('is_active', 1)
            ->get()
            ->getRowArray();

        if (!$service) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Jenis layanan tidak valid.');
        }

        $requirements = $db->table('master_service_requirements')
            ->where('service_id', $serviceId)
            ->where('is_active', 1)
            ->get()
            ->getResultArray();

        $files = $this->request->getFiles();
        $documents = $files['dokumen'] ?? [];

        foreach ($requirements as $requirement) {
            if ((int) $requirement['is_required'] !== 1) {
                continue;
            }

            $requirementId = $requirement['id'];
            $file = $documents[$requirementId] ?? null;

            if (!$file || !$file->isValid() || $file->hasMoved()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Dokumen "' . $requirement['name'] . '" wajib diupload.');
            }
        }

        $user = session()->get('user') ?? [];
        $profile = session()->get('dosen_profile') ?? [];
        $now = date('Y-m-d H:i:s');
        $ticketNumber = 'ULT-DOSEN-' . strtoupper(bin2hex(random_bytes(4)));

        $unitName = $db->table('master_service_units')
            ->where('id', $service['service_unit_id'] ?? 0)
            ->get()
            ->getRowArray();

        $draft = [
            'id' => time(),
            'nomor' => $ticketNumber,
            'layanan' => $service['name'] ?? '-',
            'unit' => $unitName['name'] ?? '-',
            'tanggal' => date('d F Y'),
            'status' => 'Draft',
            'keterangan' => $this->request->getPost('keterangan'),
            'nama' => $user['nama'] ?? $profile['nama'] ?? 'Dosen',
            'nip' => $user['nip'] ?? $profile['nip'] ?? '',
            'email' => $user['email'] ?? $profile['email'] ?? '',
            'service_id' => $serviceId,
            'created_at' => $now,
        ];

        $drafts = session()->get('dosen_drafts') ?? [];
        $drafts[] = $draft;
        session()->set('dosen_drafts', $drafts);

        return redirect()
            ->to(base_url('dosen/ticket/draft'))
            ->with('success', 'Pengajuan berhasil disimpan sebagai draft.');
    }

    /**
     * ================================
     * PROSES FORM PENGAJUAN
     * ================================
     */
    public function store()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        $db = \Config\Database::connect();

        $serviceId = $this->request->getPost('jenis_layanan');
        $keterangan = trim((string) $this->request->getPost('keterangan'));
        $action = $this->request->getPost('action');

        if (empty($serviceId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Silakan pilih jenis layanan terlebih dahulu.');
        }

        if ($keterangan === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Keterangan pengajuan wajib diisi.');
        }

        $service = $db->table('master_services')
            ->where('id', $serviceId)
            ->where('is_active', 1)
            ->get()
            ->getRowArray();

        if (!$service) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Jenis layanan tidak valid.');
        }

        $requirements = $db->table('master_service_requirements')
            ->where('service_id', $serviceId)
            ->where('is_active', 1)
            ->get()
            ->getResultArray();

        $files = $this->request->getFiles();
        $documents = $files['dokumen'] ?? [];

        foreach ($requirements as $requirement) {
            if ((int) $requirement['is_required'] !== 1) {
                continue;
            }

            $requirementId = $requirement['id'];
            $file = $documents[$requirementId] ?? null;

            if (!$file || !$file->isValid() || $file->hasMoved()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Dokumen "' . $requirement['name'] . '" wajib diupload.');
            }
        }

        $user = session()->get('user') ?? [];
        $profile = session()->get('dosen_profile') ?? [];
        $ticketNumber = 'ULT-DOSEN-' . strtoupper(bin2hex(random_bytes(4)));
        $now = date('Y-m-d H:i:s');

        $unitName = $db->table('master_service_units')
            ->where('id', $service['service_unit_id'] ?? 0)
            ->get()
            ->getRowArray();

        $ticket = [
            'id' => time(),
            'nomor' => $ticketNumber,
            'layanan' => $service['name'] ?? '-',
            'unit' => $unitName['name'] ?? '-',
            'tanggal' => date('d F Y'),
            'status' => 'Submitted',
            'keterangan' => $keterangan,
            'nama' => $user['nama'] ?? $profile['nama'] ?? 'Dosen',
            'nip' => $user['nip'] ?? $profile['nip'] ?? '',
            'email' => $user['email'] ?? $profile['email'] ?? '',
            'service_id' => $serviceId,
            'created_at' => $now,
        ];

        if ($action === 'draft') {
            $drafts = session()->get('dosen_drafts') ?? [];
            $drafts[] = $ticket;
            session()->set('dosen_drafts', $drafts);

            return redirect()
                ->to(base_url('dosen/ticket/draft'))
                ->with('success', 'Pengajuan berhasil disimpan sebagai draft.');
        }

        if ($action === 'submit') {
            $tickets = session()->get('dosen_tickets') ?? [];
            $tickets[] = $ticket;
            session()->set('dosen_tickets', $tickets);
            session()->setFlashdata('ticket', $ticket);

            return redirect()
                ->to(base_url('dosen/ticket/success'));
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Aksi pengajuan tidak valid.');
    }

    /**
     * ================================
     * HALAMAN SUCCESS
     * ================================
     */
    public function success()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        $ticket = session()->getFlashdata('ticket') ?? [];

        $data = [
            'title'  => 'Pengajuan Berhasil',
            'ticket' => $ticket,
        ];

        return view(
            'dosen/ticket/success',
            $data
        );
    }


    /**
     * ================================
     * HISTORY / TRACKING TIKET
     * ================================
     */
    public function history()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        // Ambil tiket yang sudah diajukan
        $tickets = session()->get('dosen_tickets') ?? [];

        $data = [
            'title'   => 'Tracking Tiket',
            'tickets' => $tickets,
        ];

        return view(
            'dosen/ticket/history',
            $data
        );
    }

    /**
     * ================================
     * DETAIL TIKET
     * ================================
     */
    public function detail($id)
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        // ==========================================
        // AMBIL DATA BALASAN DOSEN DARI SESSION
        // ==========================================

        $replies = session()->get('dosen_replies') ?? [];

        $balasan = $replies[$id]['balasan'] ?? null;


        // ==========================================
        // DATA DETAIL TIKET
        // ==========================================

        $data = [

            'title' => 'Detail Tiket Dosen',

            'ticket' => [

                'id' => $id,

                'nomor' =>
                'ULT-DOSEN-00' . $id,

                'layanan' =>
                'Layanan Dosen',

                'unit' =>
                'Akademik',

                'tanggal' =>
                date('d F Y'),

                'status' =>
                'Submitted',

                'keterangan' =>
                'Pengajuan layanan dosen.',

                // Catatan dari petugas
                'catatan_petugas' =>
                'Mohon lengkapi dokumen pendukung pengajuan Anda.',

                // Balasan dari dosen
                'balasan' =>
                $balasan

            ]

        ];


        // ==========================================
        // TAMPILKAN DETAIL TIKET
        // ==========================================

        return view(
            'dosen/ticket/detail',
            $data
        );
    }


    public function draft()
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        $drafts =
            session()->get('dosen_drafts')
            ?? [];


        $data = [

            'title' =>
            'Draft Pengajuan',

            'drafts' =>
            $drafts,

        ];


        return view(
            'dosen/ticket/draft',
            $data
        );
    }


    public function editDraft($index)
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        // Ambil semua draft
        $drafts = session()->get('dosen_drafts') ?? [];


        // Cek apakah draft tersedia
        if (!isset($drafts[$index])) {

            return redirect()
                ->to(base_url('dosen/ticket/draft'))
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        // Ambil draft yang dipilih
        $draft = $drafts[$index];


        // Data user
        $user = session()->get('user') ?? [];


        $data = [

            'title' => 'Lanjutkan Draft Pengajuan',

            'user' => $user,

            'draft' => $draft,

            'draft_index' => $index,

        ];


        return view(
            'dosen/ticket/edit_draft',
            $data
        );
    }

    public function updateDraft($index)
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        // ==========================================
        // AMBIL SEMUA DRAFT
        // ==========================================

        $drafts = session()->get('dosen_drafts') ?? [];


        // ==========================================
        // CEK APAKAH DRAFT ADA
        // ==========================================

        if (!isset($drafts[$index])) {

            return redirect()
                ->to(base_url('dosen/ticket/draft'))
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        // ==========================================
        // AMBIL DATA DARI FORM
        // ==========================================

        $unitTujuan = $this->request
            ->getPost('unit_tujuan');

        $jenisLayanan = $this->request
            ->getPost('jenis_layanan');

        $judul = $this->request
            ->getPost('judul');

        $keterangan = $this->request
            ->getPost('keterangan');


        // ==========================================
        // VALIDASI FIELD WAJIB
        // ==========================================

        if (
            empty($unitTujuan) ||
            empty($jenisLayanan) ||
            empty($judul) ||
            empty($keterangan)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Semua field wajib harus diisi.'
                );
        }


        // ==========================================
        // UPDATE DATA DRAFT
        // ==========================================

        $draft = $drafts[$index];


        $draft['unit_tujuan'] =
            $unitTujuan;

        $draft['jenis_layanan'] =
            $jenisLayanan;

        $draft['judul'] =
            $judul;

        $draft['keterangan'] =
            $keterangan;

        $draft['status'] =
            'Submitted';

        $draft['updated_at'] =
            date('Y-m-d H:i:s');


        // ==========================================
        // SIMPAN DATA TIKET YANG SUDAH DIAJUKAN
        // KE SESSION TIKET DOSEN
        // ==========================================

        $submittedTickets =
            session()->get('dosen_tickets') ?? [];


        $submittedTickets[] =
            $draft;


        session()->set(
            'dosen_tickets',
            $submittedTickets
        );


        // ==========================================
        // HAPUS DRAFT DARI SESSION
        // ==========================================

        unset(
            $drafts[$index]
        );


        // Rapikan kembali index array
        $drafts = array_values(
            $drafts
        );


        // Simpan draft yang tersisa
        session()->set(
            'dosen_drafts',
            $drafts
        );


        // ==========================================
        // KIRIM DATA TIKET KE SUCCESS
        // ==========================================

        session()->setFlashdata(
            'ticket',
            $draft
        );


        // ==========================================
        // REDIRECT SUCCESS
        // ==========================================

        return redirect()
            ->to(
                base_url(
                    'dosen/ticket/success'
                )
            );
    }

    // ==========================================
    // HAPUS DRAFT
    // ==========================================
    public function deleteDraft($index)
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        // Ambil semua draft dari session
        $drafts = session()->get('dosen_drafts') ?? [];

        // Cek apakah draft dengan index tersebut tersedia
        if (!isset($drafts[$index])) {

            return redirect()
                ->to(base_url('dosen/ticket/draft'))
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }

        // Hapus draft berdasarkan index
        unset($drafts[$index]);

        // Rapikan kembali index array
        $drafts = array_values($drafts);

        // Simpan kembali draft yang tersisa ke session
        session()->set(
            'dosen_drafts',
            $drafts
        );

        // Kembali ke halaman draft
        return redirect()
            ->to(base_url('dosen/ticket/draft'))
            ->with(
                'success',
                'Draft pengajuan berhasil dihapus.'
            );
    }

    // ==========================================
    // BALASAN DOSEN TERHADAP CATATAN PETUGAS
    // ==========================================
    public function reply($id)
    {
        // Cek role
        $check = $this->checkDosenRole();
        if ($check) return $check;

        // Ambil isi balasan dari form
        $balasan = $this->request->getPost('balasan');

        // Validasi balasan
        if (empty(trim($balasan))) {

            return redirect()
                ->to(base_url('dosen/ticket/detail/' . $id))
                ->with(
                    'error',
                    'Balasan tidak boleh kosong.'
                );
        }

        // ==========================================
        // SEMENTARA SIMPAN KE SESSION
        // ==========================================

        $replies = session()->get('dosen_replies') ?? [];

        $replies[$id] = [
            'balasan' => $balasan,
            'tanggal' => date('Y-m-d H:i:s')
        ];

        session()->set(
            'dosen_replies',
            $replies
        );

        // ==========================================
        // KEMBALI KE DETAIL TIKET
        // ==========================================

        return redirect()
            ->to(base_url('dosen/ticket/detail/' . $id))
            ->with(
                'success',
                'Balasan berhasil dikirim.'
            );
    }
}
