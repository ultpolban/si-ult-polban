<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;

class DispositionController extends BaseController
{
    protected $ticketModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Menampilkan tiket yang sudah diverifikasi
     */
    public function index()
    {
        // Ambil semua tiket dengan status verified
        // Tidak peduli huruf besar/kecil
        $tickets = $this->ticketModel
            ->where("LOWER(status) = 'verified'", null, false)
            ->orderBy('verified_at', 'DESC')
            ->findAll();

        return view('disposition/index', [
            'tickets' => $tickets
        ]);
    }

    /**
     * Detail tiket untuk disposisi
     */
    public function detail($id = null)
    {
        if (!$id) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        // Cek status tanpa memperhatikan huruf besar/kecil
        if (strtolower(trim($ticket['status'] ?? '')) !== 'verified') {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket belum berstatus verified.');
        }

        return view('disposition/detail', [
            'ticket' => $ticket
        ]);
    }

    /**
     * Alias route lama
     */
    public function create($id)
    {
        return $this->detail($id);
    }

    /**
     * Proses disposisi
     */
    public function process($id = null)
    {
        if (!$id) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        // Pastikan tiket memang sudah diverifikasi
        if (strtolower(trim($ticket['status'] ?? '')) !== 'verified') {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket belum berstatus verified.');
        }

        $now = date('Y-m-d H:i:s');

        /*
         * Setelah didisposisikan:
         * verified -> Assigned
         */
        $updated = $this->ticketModel->update($id, [
            'status'     => 'Assigned',
            'updated_at' => $now
        ]);

        if (!$updated) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Gagal mengubah status tiket.');
        }

        // Simpan log aktivitas
        $logModel = new TicketLogModel();

        $logModel->insert([
            'ticket_id'  => $id,
            'activity'   => 'Tiket didisposisikan ke unit tujuan.',
            'user_name'  => session('name') ?? 'Petugas ULT',
            'created_at' => $now
        ]);

        return redirect()
            ->to(base_url('disposition'))
            ->with('success', 'Tiket berhasil didisposisikan ke unit tujuan.');
    }
}