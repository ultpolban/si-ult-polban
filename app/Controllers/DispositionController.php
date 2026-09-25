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
     * ============================================================
     */
    public function index()
    {
        $tickets = $this->db
            ->table('tickets t')
            ->select('
                t.id,
                t.ticket_number,
                t.status,
                t.priority,
                t.submitted_at,
                t.created_at,
                t.unit_id,
                t.assigned_to,
                ms.name AS service_name,
                ms.service_unit_id,
                COALESCE(msu.name, unit_direct.name) AS unit_name,
                master_service_categories.name AS category_name,
                COUNT(service_request_files.id) AS jumlah_lampiran,
                up.name AS applicant_name,
                up.student_name,
                up.nim,
                up.nik,
                up.email,
                up.phone
            ', false)
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = ms.service_unit_id',
                'left'
            )
            ->join(
                'master_service_units unit_direct',
                'unit_direct.id = t.unit_id',
                'left'
            )
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'master_service_categories',
                'master_service_categories.id = ms.service_category_id',
                'left'
            )
            ->join(
                'service_requests',
                'service_requests.ticket_number = t.ticket_number',
                'left'
            )
            ->join(
                'service_request_files',
                'service_request_files.service_request_id = service_requests.id',
                'left'
            )
            ->where('LOWER(t.status)', 'verified')
            ->groupBy('t.id')
            ->orderBy('t.submitted_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('disposition/index', [
            'tickets' => $tickets
        ]);
    }


    /**
     * ============================================================
     * DETAIL DISPOSISI
     *
     * Unit tujuan OTOMATIS.
     *
     * Prioritas:
     * 1. assigned_to yang sudah tersimpan
     * 2. Jika belum ada, ambil dari:
     *    tickets.service_id
     *        ↓
     *    master_services.service_unit_id
     *        ↓
     *    master_service_units.id
     * ============================================================
     */
    public function detail($id = null)
    {
        if (empty($id)) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        // Ambil detail tiket
        $ticket = $this->ticketModel->getTicketDetail($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        // Pastikan tiket VERIFIED
        if (
            strtolower(trim($ticket['status'] ?? '')) !== 'verified'
        ) {
            return redirect()
                ->to(base_url('disposition'))
                ->with(
                    'error',
                    'Tiket ini tidak berada dalam antrean disposisi.'
                );
        }


        /**
         * ========================================================
         * CARI UNIT TUJUAN
         * ========================================================
         */

        $unit = null;


        /**
         * --------------------------------------------------------
         * PRIORITAS 1
         * --------------------------------------------------------
         *
         * Kalau assigned_to sudah diisi pada proses verifikasi,
         * gunakan unit tersebut.
         */
        if (!empty($ticket['assigned_to'])) {

            $unit = $this->db
                ->table('master_service_units')
                ->select('id, code, name, description')
                ->where(
                    'id',
                    (int) $ticket['assigned_to']
                )
                ->where(
                    'is_active',
                    1
                )
                ->where(
                    'deleted_at IS NULL',
                    null,
                    false
                )
                ->get()
                ->getRowArray();
        }


        /**
         * --------------------------------------------------------
         * PRIORITAS 2
         * --------------------------------------------------------
         *
         * Jika assigned_to belum ada, tentukan otomatis
         * berdasarkan layanan tiket.
         */
        if (
            !$unit
            && !empty($ticket['service_id'])
        ) {

            $unit = $this->db
                ->table('master_services ms')
                ->select('
                    ms.id AS service_id,
                    ms.name AS service_name,
                    ms.code AS service_code,
                    ms.service_unit_id,

                    su.id AS id,
                    su.code AS code,
                    su.name AS name,
                    su.description AS description
                ')
                ->join(
                    'master_service_units su',
                    'su.id = ms.service_unit_id',
                    'left'
                )
                ->where(
                    'ms.id',
                    (int) $ticket['service_id']
                )
                ->where(
                    'su.is_active',
                    1
                )
                ->where(
                    'su.deleted_at IS NULL',
                    null,
                    false
                )
                ->get()
                ->getRowArray();
        }


        /**
         * ========================================================
         * SIMPAN INFORMASI UNIT KE DATA TIKET
         * ========================================================
         */
        if ($unit) {

            $ticket['unit_id'] = $unit['id'];
            $ticket['unit_code'] = $unit['code'];
            $ticket['unit_name'] = $unit['name'];

            // Jika assigned_to belum ada,
            // gunakan ID unit otomatis.
            if (empty($ticket['assigned_to'])) {
                $ticket['assigned_to'] = $unit['id'];
            }

        } else {

            $ticket['unit_id'] = null;
            $ticket['unit_code'] = null;
            $ticket['unit_name'] = null;
        }


        /**
         * ========================================================
         * KIRIM DATA KE VIEW
         * ========================================================
         */
        return view('petugas/disposisi', [
            'ticket' => $ticket,
            'tiket'  => $ticket
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
     * TIDAK ADA PILIH UNIT.
     *
     * Sistem mengambil unit otomatis dari tiket.
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
         * Ambil tiket terbaru
         */
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('disposition'))
                ->with('error', 'Tiket tidak ditemukan.');
        }


        /**
         * Pastikan status VERIFIED
         */
        if (
            strtolower(trim($ticket['status'] ?? '')) !== 'verified'
        ) {
            return redirect()
                ->to(base_url('disposition'))
                ->with(
                    'error',
                    'Tiket ini sudah tidak berada dalam antrean disposisi.'
                );
        }


        /**
         * ========================================================
         * TENTUKAN UNIT OTOMATIS
         * ========================================================
         */

        $assignedTo = null;
        $unit = null;


        /**
         * --------------------------------------------------------
         * PRIORITAS 1:
         * assigned_to yang sudah ada
         * --------------------------------------------------------
         */
        if (!empty($ticket['assigned_to'])) {

            $assignedTo = (int) $ticket['assigned_to'];

            $unit = $this->db
                ->table('master_service_units')
                ->select('id, code, name')
                ->where(
                    'id',
                    $assignedTo
                )
                ->where(
                    'is_active',
                    1
                )
                ->where(
                    'deleted_at IS NULL',
                    null,
                    false
                )
                ->get()
                ->getRowArray();
        }


        /**
         * --------------------------------------------------------
         * PRIORITAS 2:
         * Ambil dari layanan
         * --------------------------------------------------------
         */
        if (
            !$unit
            && !empty($ticket['service_id'])
        ) {

            $unit = $this->db
                ->table('master_services ms')
                ->select('
                    ms.id AS service_id,
                    ms.name AS service_name,
                    ms.code AS service_code,
                    ms.service_unit_id,

                    su.id AS id,
                    su.code AS code,
                    su.name AS name
                ')
                ->join(
                    'master_service_units su',
                    'su.id = ms.service_unit_id',
                    'left'
                )
                ->where(
                    'ms.id',
                    (int) $ticket['service_id']
                )
                ->where(
                    'su.is_active',
                    1
                )
                ->where(
                    'su.deleted_at IS NULL',
                    null,
                    false
                )
                ->get()
                ->getRowArray();

            if ($unit) {
                $assignedTo = (int) $unit['id'];
            }
        }


        /**
         * --------------------------------------------------------
         * PRIORITAS 3:
         * Ambil langsung dari unit_id tiket
         * Khusus tiket offline Unit Layanan Terpadu
         * --------------------------------------------------------
         */
        if (
            !$unit
            && !empty($ticket['unit_id'])
        ) {

            $unit = $this->db
                ->table('master_service_units')
                ->select('
                    id,
                    code,
                    name
                ')
                ->where(
                    'id',
                    (int) $ticket['unit_id']
                )
                ->where(
                    'is_active',
                    1
                )
                ->where(
                    'deleted_at IS NULL',
                    null,
                    false
                )
                ->get()
                ->getRowArray();

            if ($unit) {
                $assignedTo = (int) $unit['id'];
            }
        }


        /**
         * ========================================================
         * VALIDASI UNIT
         * ========================================================
         */
        if (!$unit || empty($assignedTo)) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Unit tujuan otomatis belum dapat ditentukan. Pastikan layanan tiket sudah memiliki unit tujuan.'
                );
        }


        /**
         * ========================================================
         * CATATAN DISPOSISI
         * ========================================================
         */
        $note = trim(
            (string) $this->request->getPost('note')
        );


        /**
         * ========================================================
         * UPDATE TIKET
         * ========================================================
         */
        $updateData = [
    'unit_id' => $assignedTo,
    'status'  => 'assigned'
];


        /**
         * Simpan catatan jika kolom tersedia
         */
        $ticketFields = $this->db->getFieldNames('tickets');

        if (
            in_array('admin_note', $ticketFields, true)
            && $note !== ''
        ) {
            $updateData['admin_note'] = $note;
        }


        /**
         * Update database
         */
        $updated = $this->ticketModel->update(
            $id,
            $updateData
        );


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
        $userName =
            session()->get('name')
            ?? session()->get('full_name')
            ?? 'Petugas ULT';


        $this->ticketLogModel->addLog(
            $id,
            'Tiket didisposisikan otomatis ke unit: '
            . $unit['name'],
            $userName
        );


        /**
         * ========================================================
         * SELESAI
         * ========================================================
         */
        return redirect()
            ->to(base_url('disposition'))
            ->with(
                'success',
                'Tiket berhasil didisposisikan otomatis ke unit '
                . $unit['name']
                . '.'
            );
    }
}