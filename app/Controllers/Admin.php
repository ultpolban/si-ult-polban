<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $userModel = new UserModel();

        $totalUser = $userModel->countAllResults();
        $userAktif = $userModel->where('is_active', 1)->countAllResults();
        $petugasUlt = $userModel->where('role_id', 2)->countAllResults();
        $pemohon = $userModel->where('role_id', 4)->countAllResults();

        // Get 5 recent users with role name
        $recentUsers = $userModel
            ->select('users.*, roles.name as role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->orderBy('users.id', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'totalUser'   => $totalUser,
            'userAktif'   => $userAktif,
            'petugasUlt'  => $petugasUlt,
            'pemohon'     => $pemohon,
            'recentUsers' => $recentUsers
        ];

        return view('admin/dashboard', $data);
    }


    public function layanan()
    {
        $data['layanan'] = [
            [
                'kode' => 'SRT001',
                'nama' => 'Surat Keterangan Aktif Kuliah',
                'kategori' => 'Akademik',
                'unit' => 'Akademik',
                'sla' => '2 Hari',
                'status' => 'Aktif'
            ],
            [
                'kode' => 'LEG002',
                'nama' => 'Legalisir Ijazah/Transkrip',
                'kategori' => 'Akademik',
                'unit' => 'Akademik',
                'sla' => '3 Hari',
                'status' => 'Aktif'
            ],
        ];

        return view('admin/layanan', $data);
    }

    public function kategoriLayanan()
    {
        return view('admin/kategori_layanan');
    }

    public function persyaratanLayanan()
    {
        return view('admin/persyaratan_layanan');
    }

    public function laporan()
    {
        $pengajuanModel = new \App\Models\PengajuanLayananModel();
        $db             = \Config\Database::connect();

        // Ambil data untuk dropdown filter
        $units          = $db->table('master_service_units')->get()->getResultArray();
        $applicantTypes = $db->table('master_applicant_types')->get()->getResultArray();

        // Get filter params
        $status          = $this->request->getGet('status') ?? '';
        $unitId          = $this->request->getGet('unit_id') ?? '';
        $applicantTypeId = $this->request->getGet('applicant_type_id') ?? '';
        $startDate       = $this->request->getGet('start_date') ?? '';
        $endDate         = $this->request->getGet('end_date') ?? '';
        $export          = $this->request->getGet('export') ?? '';
        
        if (in_array($export, ['csv', 'excel', 'pdf'])) {
            $result = $pengajuanModel->getAllTicketsWithFilters('', $status, '', 0, 0, $unitId, $applicantTypeId, $startDate, $endDate);
            if ($export === 'csv')   return $this->exportCsv($result['data']);
            if ($export === 'excel') return $this->exportExcel($result['data']);
            if ($export === 'pdf')   return $this->exportPdf($result['data']);
        }

        // Pagination untuk tampilan web
        $perPage = 15;
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $offset  = ($page - 1) * $perPage;

        $result = $pengajuanModel->getAllTicketsWithFilters('', $status, '', $perPage, $offset, $unitId, $applicantTypeId, $startDate, $endDate);

        $data = [
            'laporan'         => $result['data'],
            'units'           => $units,
            'applicantTypes'  => $applicantTypes,
            'status'          => $status,
            'unit_id'         => $unitId,
            'applicant_type_id' => $applicantTypeId,
            'start_date'      => $startDate,
            'end_date'        => $endDate,
            'page'            => $page,
            'perPage'         => $perPage,
            'total'           => $result['total'],
            'totalPages'      => ceil($result['total'] / $perPage)
        ];

        return view('admin/laporan', $data);
    }

    // ─── Helper: label maps ────────────────────────────────────────────────────
    private function getExportMaps(): array
    {
        return [
            'status' => [
                'submitted'   => 'Diajukan',
                'in_progress' => 'Diproses',
                'completed'   => 'Selesai',
                'rejected'    => 'Ditolak',
                'cancelled'   => 'Dibatalkan',
            ],
            'priority' => [
                'normal' => 'Normal',
                'high'   => 'Penting',
                'urgent' => 'Mendesak',
            ],
        ];
    }

    // ─── Export CSV ────────────────────────────────────────────────────────────
    private function exportCsv($data)
    {
        $maps     = $this->getExportMaps();
        $filename = 'Laporan_Pengajuan_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Pragma: no-cache');

        $out = fopen('php://output', 'w');
        // BOM untuk Excel agar bisa baca UTF-8
        fputs($out, "\xEF\xBB\xBF");

        fputcsv($out, ['No', 'No. Tiket', 'Judul', 'Layanan', 'Unit', 'Pemohon', 'Jenis Pemohon', 'Status', 'Prioritas', 'Tanggal']);
        $no = 1;
        foreach ($data as $row) {
            fputcsv($out, [
                $no++,
                $row['ticket_number'],
                $row['title'],
                $row['layanan_nama'] ?? '-',
                $row['unit_nama']    ?? '-',
                $row['pemohon_nama'] ?? '-',
                $row['pemohon_tipe'] ?? '-',
                $maps['status'][$row['status']]     ?? $row['status'],
                $maps['priority'][$row['priority']] ?? $row['priority'],
                $row['created_at'],
            ]);
        }
        fclose($out);
        exit;
    }

    // ─── Export Excel ──────────────────────────────────────────────────────────
    private function exportExcel($data)
    {
        $maps     = $this->getExportMaps();
        $filename = 'Laporan_Pengajuan_' . date('Ymd_His') . '.xlsx';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Pengajuan');

        // Header baris pertama (judul)
        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', 'Laporan Pengajuan Layanan');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('A2:J2');
        $sheet->setCellValue('A2', 'Dicetak: ' . date('d M Y H:i:s'));
        $sheet->getStyle('A2')->getFont()->setItalic(true)->setColor(
            (new \PhpOffice\PhpSpreadsheet\Style\Color('FF888888'))
        );
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        // Header kolom
        $headers = ['No', 'No. Tiket', 'Judul', 'Layanan', 'Unit', 'Pemohon', 'Jenis Pemohon', 'Status', 'Prioritas', 'Tanggal'];
        $col = 'A';
        foreach ($headers as $h) {
            $sheet->setCellValue($col . '4', $h);
            $sheet->getStyle($col . '4')->getFont()->setBold(true);
            $sheet->getStyle($col . '4')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF2563EB');
            $sheet->getStyle($col . '4')->getFont()->getColor()->setARGB('FFFFFFFF');
            $sheet->getStyle($col . '4')->getAlignment()->setHorizontal('center');
            $col++;
        }

        // Data rows
        $rowNum = 5;
        $no = 1;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNum, $no++);
            $sheet->setCellValue('B' . $rowNum, $row['ticket_number']);
            $sheet->setCellValue('C' . $rowNum, $row['title']);
            $sheet->setCellValue('D' . $rowNum, $row['layanan_nama'] ?? '-');
            $sheet->setCellValue('E' . $rowNum, $row['unit_nama']    ?? '-');
            $sheet->setCellValue('F' . $rowNum, $row['pemohon_nama'] ?? '-');
            $sheet->setCellValue('G' . $rowNum, $row['pemohon_tipe'] ?? '-');
            $sheet->setCellValue('H' . $rowNum, $maps['status'][$row['status']] ?? $row['status']);
            $sheet->setCellValue('I' . $rowNum, $maps['priority'][$row['priority']] ?? $row['priority']);
            $sheet->setCellValue('J' . $rowNum, $row['created_at']);

            // Zebra stripe
            if ($rowNum % 2 === 0) {
                $sheet->getStyle('A' . $rowNum . ':J' . $rowNum)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFF0F7FF');
            }
            $rowNum++;
        }

        // Auto width
        foreach (range('A', 'J') as $c) {
            $sheet->getColumnDimension($c)->setAutoSize(true);
        }

        // Border seluruh data
        $lastRow = $rowNum - 1;
        if ($lastRow >= 5) {
            $sheet->getStyle('A4:J' . $lastRow)->getBorders()->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->getColor()->setARGB('FFD1D5DB');
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    // ─── Export PDF ────────────────────────────────────────────────────────────
    private function exportPdf($data)
    {
        $maps     = $this->getExportMaps();
        $filename = 'Laporan_Pengajuan_' . date('Ymd_His') . '.pdf';

        $rows = '';
        $no   = 1;
        foreach ($data as $row) {
            $bg      = $no % 2 === 0 ? '#f0f7ff' : '#ffffff';
            $status  = $maps['status'][$row['status']]     ?? $row['status'];
            $prio    = $maps['priority'][$row['priority']] ?? $row['priority'];
            $tanggal = date('d/m/Y', strtotime($row['created_at']));
            $rows   .= "
                <tr style='background:{$bg};'>
                    <td style='text-align:center;'>{$no}</td>
                    <td><b>" . htmlspecialchars($row['ticket_number']) . "</b></td>
                    <td>" . htmlspecialchars($row['title'])        . "</td>
                    <td>" . htmlspecialchars($row['layanan_nama'] ?? '-') . "</td>
                    <td>" . htmlspecialchars($row['unit_nama']    ?? '-') . "</td>
                    <td>" . htmlspecialchars($row['pemohon_nama'] ?? '-') . "</td>
                    <td>" . htmlspecialchars($row['pemohon_tipe'] ?? '-') . "</td>
                    <td style='text-align:center;'>{$status}</td>
                    <td style='text-align:center;'>{$prio}</td>
                    <td style='text-align:center;'>{$tanggal}</td>
                </tr>";
            $no++;
        }

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body  { font-family: Arial, sans-serif; font-size: 9px; color: #1e293b; }
                h2    { text-align: center; color: #1d4ed8; margin-bottom: 2px; font-size: 14px; }
                p.sub { text-align: center; color: #64748b; margin-top: 0; font-size: 8px; }
                table { width: 100%; border-collapse: collapse; margin-top: 12px; }
                th    { background: #1d4ed8; color: #fff; padding: 5px 4px; text-align: center; font-size: 8px; }
                td    { padding: 4px; border: 1px solid #e2e8f0; font-size: 8px; }
                tr:hover td { background: #dbeafe !important; }
                .footer { text-align: center; margin-top: 16px; font-size: 7px; color: #94a3b8; }
            </style>
        </head>
        <body>
            <h2>Laporan Pengajuan Layanan</h2>
            <p class='sub'>Dicetak: " . date('d M Y H:i:s') . " | Total: " . count($data) . " data</p>
            <table>
                <thead>
                    <tr>
                        <th>No</th><th>No. Tiket</th><th>Judul</th>
                        <th>Layanan</th><th>Unit</th><th>Pemohon</th>
                        <th>Jenis Pemohon</th><th>Status</th><th>Prioritas</th><th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>{$rows}</tbody>
            </table>
            <p class='footer'>Sistem Informasi Layanan Terpadu &mdash; Politeknik Negeri Bandung</p>
        </body></html>";

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', false);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => true]);
        exit;
    }

    public function tiket()
    {
        $pengajuanModel = new \App\Models\PengajuanLayananModel();

        // Get filter params
        $keyword  = $this->request->getGet('keyword') ?? '';
        $status   = $this->request->getGet('status') ?? '';
        $priority = $this->request->getGet('priority') ?? '';
        
        // Pagination
        $perPage = 10;
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $offset  = ($page - 1) * $perPage;

        $result = $pengajuanModel->getAllTicketsWithFilters($keyword, $status, $priority, $perPage, $offset);

        $data = [
            'tiket'      => $result['data'],
            'keyword'    => $keyword,
            'status'     => $status,
            'priority'   => $priority,
            'page'       => $page,
            'perPage'    => $perPage,
            'total'      => $result['total'],
            'totalPages' => ceil($result['total'] / $perPage)
        ];

        return view('admin/tiket', $data);
    }

    public function buatTiket()
    {
        $db = \Config\Database::connect();
        
        $data = [
            'users'    => $db->table('users')
                ->select('users.id, users.full_name as name, users.email')
                ->join('user_profiles', 'user_profiles.user_id = users.id')
                ->where('users.is_active', 1)
                ->get()->getResultArray(),
            'units'    => $db->table('master_service_units')->where('is_active', 1)->get()->getResultArray(),
            'services' => $db->table('master_services')->where('is_active', 1)->get()->getResultArray(),
            'officers' => $db->table('users')
                ->select('users.id, users.full_name as name, roles.name as role_name')
                ->join('roles', 'roles.id = users.role_id')
                ->where('users.is_active', 1)
                ->whereIn('roles.code', ['PETUGAS_AKADEMIK', 'PETUGAS_KEUANGAN', 'PETUGAS_UMUM', 'PETUGAS_ULT'])
                ->orderBy('users.full_name', 'ASC')
                ->get()
                ->getResultArray(),
        ];

        return view('admin/buat_tiket', $data);
    }

    public function updateTiket($id)
    {
        $db = \Config\Database::connect();
        $ticket = $db->table('service_requests')->where('id', $id)->get()->getRowArray();

        if (!$ticket) {
            return redirect()->to('/tiket/manajemen')->with('error', 'Tiket tidak ditemukan.');
        }

        $status = (string) $this->request->getPost('status');
        $priority = (string) $this->request->getPost('priority');
        $allowedStatuses = ['submitted', 'verification', 'revision', 'processing', 'completed', 'rejected', 'cancelled'];
        $allowedPriorities = ['low', 'normal', 'high', 'urgent'];

        if (!in_array($status, $allowedStatuses, true) || !in_array($priority, $allowedPriorities, true)) {
            return redirect()->back()->withInput()->with('error', 'Status atau prioritas tiket tidak valid.');
        }

        $data = [
            'title'       => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'status'      => $status,
            'priority'    => $priority,
            'updated_at'  => date('Y-m-d H:i:s'),
        ];
        $statusDates = [
            'verification' => 'verified_at', 'processing' => 'processed_at', 'completed' => 'completed_at',
            'rejected' => 'rejected_at', 'cancelled' => 'cancelled_at',
        ];
        if ($ticket['status'] !== $status && isset($statusDates[$status])) {
            $data[$statusDates[$status]] = date('Y-m-d H:i:s');
        }

        $db->transStart();
        $db->table('service_requests')->where('id', $id)->update($data);

        if ($ticket['status'] !== $status) {
            $db->table('service_request_logs')->insert([
                'service_request_id' => $id,
                'user_id'            => session()->get('user_id'),
                'old_status'         => $ticket['status'],
                'new_status'         => $status,
                'action'             => 'Status tiket diperbarui',
                'description'        => 'Status tiket diubah melalui manajemen tiket.',
                'ip_address'         => $this->request->getIPAddress(),
                'user_agent'         => substr($this->request->getUserAgent()->getAgentString(), 0, 65535),
                'created_at'         => date('Y-m-d H:i:s'),
            ]);
        }
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Perubahan tiket gagal disimpan.');
        }

        return redirect()->to('/tiket/manajemen')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function deleteTiket($id)
    {
        $db = \Config\Database::connect();
        $ticket = $db->table('service_requests')->select('id, ticket_number')->where('id', $id)->get()->getRowArray();

        if (!$ticket) {
            return redirect()->to('/tiket/manajemen')->with('error', 'Tiket tidak ditemukan.');
        }

        $db->table('service_requests')->where('id', $id)->delete();

        return redirect()->to('/tiket/manajemen')->with('success', 'Tiket ' . $ticket['ticket_number'] . ' berhasil dihapus.');
    }

    public function simpanTiket()
    {
        $db = \Config\Database::connect();
        
        $pemohonId   = $this->request->getPost('pemohon_id');
        $unitId      = $this->request->getPost('unit_id');
        $layananId   = $this->request->getPost('layanan_id');
        $prioritas   = $this->request->getPost('prioritas');
        $deskripsi   = $this->request->getPost('deskripsi');
        $ditugaskan  = $this->request->getPost('ditugaskan_ke');

        // Generate Ticket Number (e.g., TKT-202608-00001)
        $monthYear = date('Ym');
        $lastTicket = $db->table('service_requests')
            ->like('ticket_number', 'TKT-' . $monthYear)
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();

        $sequence = 1;
        if ($lastTicket) {
            $lastSequence = (int) substr($lastTicket['ticket_number'], -5);
            $sequence = $lastSequence + 1;
        }
        $ticketNumber = 'TKT-' . $monthYear . '-' . str_pad((string)$sequence, 5, '0', STR_PAD_LEFT);

        // Fetch related IDs for user profile and applicant type if available
        $userProfile = $db->table('user_profiles')->where('user_id', $pemohonId)->get()->getRowArray();
        if (!$userProfile) {
            return redirect()->back()->withInput()->with('error', 'Pemohon belum memiliki profil.');
        }
        $userProfileId = $userProfile['id'];

        $layananRow = $db->table('master_services')->where('id', $layananId)->get()->getRowArray();
        if (!$layananRow || (int) $layananRow['service_unit_id'] !== (int) $unitId) {
            return redirect()->back()->withInput()->with('error', 'Layanan tidak sesuai dengan unit layanan yang dipilih.');
        }

        $insertData = [
            'ticket_number'   => $ticketNumber,
            'user_profile_id' => $userProfileId,
            'service_id'      => $layananId,
            'assigned_to'     => $ditugaskan ?: null,
            'title'           => $layananRow['name'],
            'description'     => $deskripsi,
            'status'          => 'submitted',
            'priority'        => $prioritas,
            'submitted_at'    => date('Y-m-d H:i:s'),
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ];

        $db->transStart();
        $db->table('service_requests')->insert($insertData);
        $newTicketId = $db->insertID();

        $db->table('service_request_logs')->insert([
            'service_request_id' => $newTicketId,
            'user_id'            => session()->get('user_id'),
            'new_status'         => 'submitted',
            'action'             => 'Tiket diajukan',
            'description'        => 'Tiket dibuat melalui menu manajemen tiket.',
            'ip_address'         => $this->request->getIPAddress(),
            'user_agent'         => substr($this->request->getUserAgent()->getAgentString(), 0, 65535),
            'created_at'         => date('Y-m-d H:i:s'),
        ]);
        
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat tiket.');
        }

        return redirect()->to('/tiket/manajemen')->with('success', 'Tiket berhasil dibuat.');
    }


    public function verifikasiTiket()
    {
        $data['tiket'] = [
            [
                'kode'      => 'ULT-2024-004',
                'pemohon'   => 'Dewi Larasati',
                'layanan'   => 'Surat Keterangan Aktif Kuliah',
                'unit'      => 'Akademik',
                'tanggal'   => '05 Mei 2024',
                'status'    => 'Menunggu Verifikasi',
                'aksi'      => 'Periksa',
            ],
            [
                'kode'      => 'ULT-2024-005',
                'pemohon'   => 'Rian Saputra',
                'layanan'   => 'Legalisir Ijazah/Transkrip',
                'unit'      => 'Akademik',
                'tanggal'   => '06 Mei 2024',
                'status'    => 'Menunggu Verifikasi',
                'aksi'      => 'Periksa',
            ],
            [
                'kode'      => 'ULT-2024-006',
                'pemohon'   => 'Nina Rahma',
                'layanan'   => 'Konfirmasi Pembayaran',
                'unit'      => 'Keuangan',
                'tanggal'   => '07 Mei 2024',
                'status'    => 'Menunggu Verifikasi',
                'aksi'      => 'Periksa',
            ],
        ];

        return view('admin/verifikasi_tiket', $data);
    }

    public function statistik()
    {
        return view('admin/statistik');
    }

    public function tracking()
    {
        $ticketNumber = trim((string) $this->request->getGet('ticket_number'));
        $ticket = null;
        $notFound = false;

        if ($ticketNumber !== '') {
            $ticket = (new \App\Models\PengajuanLayananModel())
                ->getTicketTracking($ticketNumber);
            $notFound = $ticket === null;
        }

        return view('admin/tracking', [
            'title'        => 'Tracking Tiket',
            'ticketNumber' => $ticketNumber,
            'ticket'       => $ticket,
            'notFound'     => $notFound,
        ]);
    }

    public function dashboardPimpinan()
    {
        $data = [
            'totalTicket'    => 1248,
            'ticketSelesai'  => 982,
            'slaTercapai'    => '92,4%',
            'ticketTerlambat' => 52,
            'avgSelesai'     => '2,4 Hari',
            'topServices' => [
                ['name' => 'Surat Keterangan Aktif Kuliah', 'count' => 320, 'percentage' => 85],
                ['name' => 'Legalisir Ijazah/Transkrip', 'count' => 210, 'percentage' => 65],
                ['name' => 'Verifikasi Alumni', 'count' => 156, 'percentage' => 45],
                ['name' => 'Konfirmasi Pembayaran', 'count' => 137, 'percentage' => 40],
                ['name' => 'Permohonan Informasi Publik', 'count' => 90, 'percentage' => 25]
            ]
        ];

        return view('pimpinan/dashboard', $data);
    }
}
