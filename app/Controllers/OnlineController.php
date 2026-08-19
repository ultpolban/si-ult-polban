<?php

namespace App\Controllers;

use App\Models\TicketModel;
use Config\Database;

class OnlineController extends BaseController
{
    protected $ticketModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->db = Database::connect();
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
            'service_id'         => 'required|integer',
            'applicant_name'     => 'required',
            'ticket_title'       => 'required',
            'ticket_description' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $ticketNumber = 'ULT-' . date('YmdHis') . rand(100, 999);
        $serviceId = (int) $this->request->getPost('service_id');
        $applicantName = $this->request->getPost('applicant_name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $nim = $this->request->getPost('nim');

        $attachment = null;
        $file = $this->request->getFile('attachment');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $attachment = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $attachment);
        }

        // Obter ou criar perfil de usuário
        $userProfileId = $this->getOrCreateUserProfile(
            $applicantName,
            $nim,
            $email,
            $phone
        );

        if (!$userProfileId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal membuat profil pengguna.');
        }

        // Inserir tiket
        $inserted = $this->ticketModel->insert([
            'ticket_number'  => $ticketNumber,
            'user_profile_id' => $userProfileId,
            'service_id'     => $serviceId,
            'title'          => $this->request->getPost('ticket_title'),
            'description'    => $this->request->getPost('ticket_description'),
            'attachment'     => $attachment,
            'status'         => 'submitted',
            'priority'       => 'normal',
            'submitted_at'   => date('Y-m-d H:i:s')
        ]);

        if (!$inserted) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan tiket: ' . implode(', ', $this->ticketModel->errors()));
        }

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

    // ==========================
    // HELPER: Obter ou criar perfil de usuário
    // ==========================
    private function getOrCreateUserProfile($name, $nim = null, $email = null, $phone = null)
    {
        if (empty($name)) {
            return null;
        }

        // Tentar encontrar perfil existente por email ou NIM
        if (!empty($email)) {
            $existing = $this->db->table('user_profiles')
                ->where('email', $email)
                ->where('deleted_at IS NULL', null, false)
                ->get()
                ->getRowArray();

            if ($existing) {
                return $existing['id'];
            }
        }

        if (!empty($nim)) {
            $existing = $this->db->table('user_profiles')
                ->where('nim', $nim)
                ->where('deleted_at IS NULL', null, false)
                ->get()
                ->getRowArray();

            if ($existing) {
                return $existing['id'];
            }
        }

        // Criar novo perfil
        $profileData = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'nim' => $nim,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $inserted = $this->db->table('user_profiles')
            ->insert($profileData);

        if ($inserted) {
            return $this->db->insertID();
        }

        return null;
    }
}
