<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;

class UnitController extends BaseController
{
    protected TicketModel $ticketModel;
    protected TicketLogModel $ticketLogModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->ticketLogModel = new TicketLogModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * ============================================================
     * HALAMAN UNIT LAYANAN
     *
     * Menampilkan tiket:
     * assigned
     * processing
     * ============================================================
     */
    public function index()
    {
        $tickets = $this->db
            ->table('tickets t')
            ->select('
                t.*,
                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id,
                msu.name AS unit_name
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = t.assigned_to',
                'left'
            )
            ->whereIn('LOWER(t.status)', ['assigned', 'processing'])
            ->orderBy('t.updated_at', 'DESC')
            ->get()
            ->getResultArray();

        /*
         * Ambil data pemohon berdasarkan user_profile_id.
         */
        foreach ($tickets as &$ticket) {

            $ticket['applicant_name'] = '-';

            if (!empty($ticket['user_profile_id'])) {

                $profile = $this->db
                    ->table('user_profiles')
                    ->where('id', $ticket['user_profile_id'])
                    ->get()
                    ->getRowArray();

                if ($profile) {

                    /*
                     * Sesuaikan dengan nama kolom yang tersedia.
                     */
                    if (!empty($profile['name'])) {
                        $ticket['applicant_name'] = $profile['name'];
                    } elseif (!empty($profile['full_name'])) {
                        $ticket['applicant_name'] = $profile['full_name'];
                    } elseif (!empty($profile['nama'])) {
                        $ticket['applicant_name'] = $profile['nama'];
                    } elseif (!empty($profile['username'])) {
                        $ticket['applicant_name'] = $profile['username'];
                    }
                }
            }
        }

        unset($ticket);

        return view('unit/index', [
            'tickets' => $tickets
        ]);
    }


    /**
     * ============================================================
     * PROSES TIKET
     *
     * assigned
     *     ↓
     * processing
     * ============================================================
     */
    public function process($id = null)
    {
        if (empty($id)) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        if (
            strtolower(trim($ticket['status'] ?? '')) !== 'assigned'
        ) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Tiket ini belum berada dalam antrean unit.'
                );
        }

        $now = date('Y-m-d H:i:s');

        $updated = $this->ticketModel->update($id, [
            'status'       => 'processing',
            'processed_at' => $now,
            'updated_at'   => $now
        ]);

        if (!$updated) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Gagal mengubah status tiket menjadi processing.'
                );
        }

        $this->ticketLogModel->addLog(
            $id,
            'Tiket mulai diproses oleh unit layanan.',
            session()->get('name') ?? 'Petugas Unit'
        );

        return redirect()
            ->to(base_url('unit'))
            ->with(
                'success',
                'Tiket berhasil diproses.'
            );
    }


    /**
     * ============================================================
     * SELESAIKAN TIKET
     *
     * processing
     *     ↓
     * completed
     * ============================================================
     */
    public function complete($id = null)
    {
        if (empty($id)) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        if (
            strtolower(trim($ticket['status'] ?? '')) !== 'processing'
        ) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Tiket belum berstatus processing.'
                );
        }

        $now = date('Y-m-d H:i:s');

        $updated = $this->ticketModel->update($id, [
            'status'       => 'completed',
            'completed_at' => $now,
            'updated_at'   => $now
        ]);

        if (!$updated) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Gagal menyelesaikan tiket.'
                );
        }

        $this->ticketLogModel->addLog(
            $id,
            'Tiket telah selesai diproses oleh unit layanan.',
            session()->get('name') ?? 'Petugas Unit'
        );

        return redirect()
            ->to(base_url('unit'))
            ->with(
                'success',
                'Tiket berhasil diselesaikan.'
            );
    }
}