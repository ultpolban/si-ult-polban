<?php

namespace App\Controllers;

use App\Models\TicketModel;

class OnlineController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    // ==========================
    // LIST
    // ==========================
    public function index()
    {
        $data['tickets'] = $this->ticketModel
            ->orderBy('submitted_at', 'DESC')
            ->findAll();

        return view('online/index', $data);
    }

    // ==========================
    // FORM CREATE
    // ==========================
    public function create()
    {
        return view('online/create');
    }

    // ==========================
    // SIMPAN
    // ==========================
    public function store()
    {
        helper(['form']);

        $rules = [
            'service_name'       => 'required',
            'applicant_name'     => 'required',
            'applicant_type'     => 'required',
            'ticket_title'       => 'required',
            'ticket_description' => 'required'
        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $ticketNumber = 'ULT-' . date('YmdHis') . rand(100,999);

        $attachment = null;

        $file = $this->request->getFile('attachment');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $attachment = $file->getRandomName();

            $file->move(FCPATH.'uploads', $attachment);
        }

        $this->ticketModel->insert([

            'ticket_number'      => $ticketNumber,
            'submission_type'    => 'Online',

            'service_name'       => $this->request->getPost('service_name'),

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

            'ticket_title'       => $this->request->getPost('ticket_title'),
            'ticket_description' => $this->request->getPost('ticket_description'),

            'attachment'         => $attachment,

            'status'             => 'Submitted',
            'priority'           => 'Normal',
            'submitted_at'       => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/online/success/' . $ticketNumber);
    }

    // ==========================
    // BERHASIL
    // ==========================
    public function success($ticket)
    {
        return view('online/success', [
            'ticket_number' => $ticket
        ]);
    }
}