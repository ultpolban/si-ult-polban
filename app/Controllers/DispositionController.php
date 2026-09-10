<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;

class DispositionController extends BaseController
{
    protected TicketModel $ticketModel;
    protected TicketLogModel $ticketLogModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel    = new TicketModel();
        $this->ticketLogModel = new TicketLogModel();
        $this->db             = \Config\Database::connect();
    }

    /**
     * ============================================================
     * HALAMAN DISPOSISI
     *
     * Hanya menampilkan tiket dengan status VERIFIED.
     * ============================================================
     */
    public function index()
    {
        $tickets = $this->ticketModel->getByStatus('verified');

        return view('disposition/index', [
            'tickets' => $tickets
        ]);
    }


    /**
     * ============================================================
     * DETAIL TIKET
     *
     * Menampilkan:
     * - detail tiket
     * - layanan
     * - daftar unit layanan aktif
     * ============================================================
     */
    public function detail($id = null)
    {
        if (empty($id)) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        /**
         * Ambil detail tiket.
         */
        $ticket = $this->ticketModel->getTicketDetail($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        /**
         * Pastikan hanya tiket VERIFIED
         * yang dapat didisposisikan.
         */
        if (
            strtolower(
                trim($ticket['status'] ?? '')
            ) !== 'verified'
        ) {
            return redirect()
                ->to(base_url('disposition'))
                ->with(
                    'error',
                    'Tiket ini tidak berada dalam antrean disposisi.'
                );
        }

        /**
         * Ambil unit layanan aktif.
         *
         * tickets.assigned_to
         *          ↓
         * master_service_units.id
         */
        $units = $this->db
            ->table('master_service_units')
            ->select('id, code, name, description')
            ->where('is_active', 1)
            ->where('deleted_at IS NULL', null, false)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('disposition/detail', [
            'ticket' => $ticket,
            'units'  => $units
        ]);
    }


    /**
     * ============================================================
     * ALIAS ROUTE LAMA
     * ============================================================
     */
    public function create($id = null)
    {
        return $this->detail($id);
    }


    /**
     * ============================================================
     * PROSES DISPOSISI
     *
     * VERIFIED
     *     ↓
     * ASSIGNED
     *
     * assigned_to = master_service_units.id
     * ============================================================
     */
    public function process($id = null)
    {
        if (empty($id)) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        /**
         * Ambil tiket terbaru.
         */
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        /**
         * Pastikan status masih VERIFIED.
         */
        if (
            strtolower(
                trim($ticket['status'] ?? '')
            ) !== 'verified'
        ) {
            return redirect()
                ->to(base_url('disposition'))
                ->with(
                    'error',
                    'Tiket ini sudah tidak berada dalam antrean disposisi.'
                );
        }

        /**
         * Ambil unit tujuan.
         */
        $assignedTo = $this->request->getPost('assigned_to');

        if (
            $assignedTo === null ||
            $assignedTo === '' ||
            !is_numeric($assignedTo)
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unit tujuan wajib dipilih.'
                );
        }

        $assignedTo = (int) $assignedTo;

        /**
         * Pastikan unit benar-benar ada
         * dan masih aktif.
         */
        $unit = $this->db
            ->table('master_service_units')
            ->select('id, code, name')
            ->where('id', $assignedTo)
            ->where('is_active', 1)
            ->where('deleted_at IS NULL', null, false)
            ->get()
            ->getRowArray();

        if (!$unit) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unit tujuan tidak ditemukan atau tidak aktif.'
                );
        }

        $now = date('Y-m-d H:i:s');

        /**
         * ========================================================
         * UPDATE TIKET
         * ========================================================
         *
         * assigned_to = ID master_service_units
         * status      = assigned
         * updated_at  = waktu disposisi
         */
        $updated = $this->ticketModel->update($id, [
            'assigned_to' => $assignedTo,
            'status'      => 'assigned',
            'updated_at'  => $now
        ]);

        if (!$updated) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal menyimpan disposisi tiket.'
                );
        }

        /**
         * ========================================================
         * SIMPAN LOG
         * ========================================================
         */
       $this->ticketLogModel->addLog(
    $id,
    'Tiket didisposisikan ke unit: ' . $unit['name'],
    session()->get('name') ?? 'Petugas ULT'
);
        /**
         * Kembali ke halaman disposisi.
         */
        return redirect()
            ->to(base_url('disposition'))
            ->with(
                'success',
                'Tiket berhasil didisposisikan ke unit ' .
                $unit['name'] .
                '.'
            );
    }
}