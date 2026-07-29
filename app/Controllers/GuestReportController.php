<?php

namespace App\Controllers;

use App\Models\TicketModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GuestReportController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    // ==================================================
    // LIST DATA
    // ==================================================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $status  = $this->request->getGet('status');

        $builder = $this->ticketModel;

        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('ticket_number', $keyword)
                ->orLike('applicant_name', $keyword)
                ->orLike('nim', $keyword)
                ->groupEnd();
        }

        if (!empty($status)) {
            $builder = $builder->where('status', $status);
        }

        $data = [
            'tickets' => $builder
                ->orderBy('submitted_at', 'DESC')
                ->paginate(10),

            'pager' => $this->ticketModel->pager,

            'keyword' => $keyword,
            'status' => $status,
        ];

        return view('guest_report/index', $data);
    }

    // ==================================================
    // FORM TAMBAH
    // ==================================================
    public function create()
    {
        return view('guest_report/create');
    }

    // ==================================================
    // SIMPAN
    // ==================================================
    public function store()
{
    helper(['form']);

    $rules = [
        'applicant_name'     => 'required',
        'applicant_type'     => 'required',
        'service_name'       => 'required',
        'ticket_title'       => 'required',
        'ticket_description' => 'required',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    // Nomor tiket otomatis
    $ticketNumber = 'ULT-' . date('YmdHis') . rand(100, 999);

    // Upload lampiran
    $attachment = null;

    $file = $this->request->getFile('attachment');

    if ($file && $file->isValid() && !$file->hasMoved()) {

        $attachment = $file->getRandomName();

        $file->move(FCPATH . 'uploads', $attachment);
    }

    // Simpan ke database
    $this->ticketModel->insert([

        // Data Tiket
        'ticket_number'      => $ticketNumber,
        'submission_type'    => 'Walk In',
        'service_name'       => $this->request->getPost('service_name'),
        'ticket_title'       => $this->request->getPost('ticket_title'),
        'ticket_description' => $this->request->getPost('ticket_description'),
        'attachment'         => $attachment,

        // Data Pemohon
        'applicant_name'     => $this->request->getPost('applicant_name'),
        'applicant_type'     => $this->request->getPost('applicant_type'),
        'nim'                => $this->request->getPost('nim'),
        'email'              => $this->request->getPost('email'),
        'phone'              => $this->request->getPost('phone'),

        // Mahasiswa
        'program_studi'      => $this->request->getPost('program_studi'),
        'jurusan'            => $this->request->getPost('jurusan'),
        'angkatan'           => $this->request->getPost('angkatan'),

        // Dosen
        'fakultas'           => $this->request->getPost('fakultas'),
        'jabatan_dosen'      => $this->request->getPost('jabatan_dosen'),

        // Tendik
        'unit_kerja'         => $this->request->getPost('unit_kerja'),
        'jabatan_tendik'     => $this->request->getPost('jabatan_tendik'),

        // Orang Tua
        'nama_mahasiswa'     => $this->request->getPost('nama_mahasiswa'),
        'nim_mahasiswa'      => $this->request->getPost('nim_mahasiswa'),
        'hubungan'           => $this->request->getPost('hubungan'),

        // Alumni
        'prodi_alumni'       => $this->request->getPost('prodi_alumni'),
        'tahun_lulus'        => $this->request->getPost('tahun_lulus'),

        // Mitra
        'instansi'           => $this->request->getPost('instansi'),
        'pic'                => $this->request->getPost('pic'),
        'jabatan_mitra'      => $this->request->getPost('jabatan_mitra'),

        // Public
        'instansi_public'    => $this->request->getPost('instansi_public'),
        'alamat_public'      => $this->request->getPost('alamat_public'),

        // Masyarakat
        'alamat'             => $this->request->getPost('alamat'),
        'pekerjaan'          => $this->request->getPost('pekerjaan'),

        // Status Tiket
        'status'             => 'Waiting Verification',
        'priority'           => 'Normal',
        'assigned_unit'      => null,
        'verified_by'        => null,
        'verification_note'  => null,

        // Waktu
        'submitted_at'       => date('Y-m-d H:i:s'),
        'verified_at'        => null,
        'completed_at'       => null,
    ]);

    return redirect()->to('/guest-report')
        ->with('success', 'Laporan berhasil ditambahkan.');
} 
    // ==================================================
    // DETAIL
    // ==================================================
    public function detail($id)
    {
        $data['ticket'] = $this->ticketModel->find($id);

        if (!$data['ticket']) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('guest_report/detail', $data);
    }

    // ==================================================
    // FORM EDIT
    // ==================================================
    public function edit($id)
    {
        $data['ticket'] = $this->ticketModel->find($id);

        if (!$data['ticket']) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('guest_report/edit', $data);
    }

    // ==================================================
    // UPDATE
    // ==================================================
    public function update($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            throw PageNotFoundException::forPageNotFound();
        }

        $attachment = $ticket['attachment'];

        $file = $this->request->getFile('attachment');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (!empty($attachment) && file_exists(FCPATH . 'uploads/' . $attachment)) {
                unlink(FCPATH . 'uploads/' . $attachment);
            }

            $attachment = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $attachment);
        }

        $this->ticketModel->update($id, [

            'service_name'       => $this->request->getPost('service_name'),
            'ticket_title'       => $this->request->getPost('ticket_title'),
            'ticket_description' => $this->request->getPost('ticket_description'),

            'applicant_name'     => $this->request->getPost('applicant_name'),
            'applicant_type'     => $this->request->getPost('applicant_type'),
            'nim'                => $this->request->getPost('nim'),
            'email'              => $this->request->getPost('email'),
            'phone'              => $this->request->getPost('phone'),

            'program_studi'      => $this->request->getPost('program_studi'),
            'jurusan'            => $this->request->getPost('jurusan'),
            'angkatan'           => $this->request->getPost('angkatan'),

            'fakultas'           => $this->request->getPost('fakultas'),
            'jabatan_dosen'      => $this->request->getPost('jabatan_dosen'),

            'unit_kerja'         => $this->request->getPost('unit_kerja'),
            'jabatan_tendik'     => $this->request->getPost('jabatan_tendik'),

            'nama_mahasiswa'     => $this->request->getPost('nama_mahasiswa'),
            'nim_mahasiswa'      => $this->request->getPost('nim_mahasiswa'),
            'hubungan'           => $this->request->getPost('hubungan'),

            'prodi_alumni'       => $this->request->getPost('prodi_alumni'),
            'tahun_lulus'        => $this->request->getPost('tahun_lulus'),

            'instansi'           => $this->request->getPost('instansi'),
            'pic'                => $this->request->getPost('pic'),
            'jabatan_mitra'      => $this->request->getPost('jabatan_mitra'),

            'instansi_public'    => $this->request->getPost('instansi_public'),
            'alamat_public'      => $this->request->getPost('alamat_public'),

            'alamat'             => $this->request->getPost('alamat'),
            'pekerjaan'          => $this->request->getPost('pekerjaan'),

            'attachment'         => $attachment

        ]);

        return redirect()->to('/guest-report')
            ->with('success', 'Data berhasil diubah.');
    }

    // ==================================================
    // DELETE
    // ==================================================
    public function delete($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (!empty($ticket['attachment']) && file_exists(FCPATH . 'uploads/' . $ticket['attachment'])) {
            unlink(FCPATH . 'uploads/' . $ticket['attachment']);
        }

        $this->ticketModel->delete($id);

        return redirect()->to('/guest-report')
            ->with('success', 'Data berhasil dihapus.');
    }

}