<?php

namespace App\Controllers;

use App\Models\TicketModel;

class GuestReportController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    // ===============================
    // LIST DATA
    // ===============================
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

            'pager' => $this->ticketModel->pager
        ];

        return view('guest_report/index', $data);
    }

    // ===============================
    // FORM TAMBAH
    // ===============================
    public function create()
    {
        return view('guest_report/create');
    }

    // ===============================
    // SIMPAN
    // ===============================
    public function store()
    {
        helper(['form']);

        $rules = [
            'applicant_name'     => 'required',
            'applicant_type'     => 'required',
            'service_name'       => 'required',
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

            $file->move(FCPATH.'uploads',$attachment);

        }

        $this->ticketModel->insert([

            'ticket_number'      => $ticketNumber,
            'service_name'       => $this->request->getPost('service_name'),
            'applicant_name'     => $this->request->getPost('applicant_name'),
            'applicant_type'     => $this->request->getPost('applicant_type'),
            'nim'                => $this->request->getPost('nim'),
            'email'              => $this->request->getPost('email'),
            'phone'              => $this->request->getPost('phone'),
            'ticket_title'       => $this->request->getPost('ticket_title'),
            'ticket_description' => $this->request->getPost('ticket_description'),
            'attachment'         => $attachment,

            'status'        => 'Submitted',
            'priority'      => 'Normal',
            'submitted_at'  => date('Y-m-d H:i:s')

        ]);

        return redirect()->to('/guest-report')
            ->with('success','Laporan berhasil ditambahkan.');
    }

    // ===============================
    // DETAIL
    // ===============================
    public function detail($id)
    {
        $data['ticket'] = $this->ticketModel->find($id);

        if(!$data['ticket']){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('guest_report/detail',$data);
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit($id)
    {
        $data['ticket'] = $this->ticketModel->find($id);

        if(!$data['ticket']){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('guest_report/edit',$data);
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update($id)
    {
        $ticket = $this->ticketModel->find($id);

        $attachment = $ticket['attachment'];

        $file = $this->request->getFile('attachment');

        if($file && $file->isValid() && !$file->hasMoved()){

            if(!empty($attachment) && file_exists(FCPATH.'uploads/'.$attachment)){
                unlink(FCPATH.'uploads/'.$attachment);
            }

            $attachment = $file->getRandomName();

            $file->move(FCPATH.'uploads',$attachment);

        }

        $this->ticketModel->update($id,[

            'service_name'       => $this->request->getPost('service_name'),
            'applicant_name'     => $this->request->getPost('applicant_name'),
            'applicant_type'     => $this->request->getPost('applicant_type'),
            'nim'                => $this->request->getPost('nim'),
            'email'              => $this->request->getPost('email'),
            'phone'              => $this->request->getPost('phone'),
            'ticket_title'       => $this->request->getPost('ticket_title'),
            'ticket_description' => $this->request->getPost('ticket_description'),
            'attachment'         => $attachment

        ]);

        return redirect()->to('/guest-report')
            ->with('success','Data berhasil diubah.');
    }

    // ===============================
    // DELETE
    // ===============================
    public function delete($id)
    {
        $ticket = $this->ticketModel->find($id);

        if(!empty($ticket['attachment']) && file_exists(FCPATH.'uploads/'.$ticket['attachment'])){
            unlink(FCPATH.'uploads/'.$ticket['attachment']);
        }

        $this->ticketModel->delete($id);

        return redirect()->to('/guest-report')
            ->with('success','Data berhasil dihapus.');
    }
}