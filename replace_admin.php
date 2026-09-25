<?php
$file = 'app/Controllers/Admin.php';
$content = file_get_contents($file);

$search = <<<'EOD'
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
EOD;

$replace = <<<'EOD'
    public function dashboardPimpinan()
    {
        $db = \Config\Database::connect();
        
        $totalTicket = $db->table('service_requests')->countAllResults();
        $ticketSelesai = $db->table('service_requests')->where('status', 'completed')->countAllResults();
        
        $ticketTerlambat = $db->table('service_requests')
            ->whereNotIn('status', ['completed', 'rejected', 'cancelled'])
            ->where('created_at <', date('Y-m-d H:i:s', strtotime('-3 days')))
            ->countAllResults();
            
        $topServicesQuery = $db->query("
            SELECT ms.name, COUNT(sr.id) as count 
            FROM master_services ms 
            JOIN service_requests sr ON ms.id = sr.service_id 
            GROUP BY ms.id 
            ORDER BY count DESC 
            LIMIT 5
        ")->getResultArray();
        
        $topServices = [];
        foreach ($topServicesQuery as $ts) {
            $percentage = $totalTicket > 0 ? round(($ts['count'] / $totalTicket) * 100) : 0;
            $topServices[] = [
                'name' => $ts['name'],
                'count' => (int) $ts['count'],
                'percentage' => $percentage
            ];
        }

        $slaTercapai = $totalTicket > 0 ? round(($ticketSelesai / $totalTicket) * 100, 1) . '%' : '0%';
        
        $avgQuery = $db->query("
            SELECT AVG(DATEDIFF(updated_at, created_at)) as avg_days 
            FROM service_requests 
            WHERE status = 'completed'
        ")->getRow();
        $avgDays = $avgQuery && $avgQuery->avg_days ? round($avgQuery->avg_days, 1) : 0;
        $avgSelesai = $avgDays . ' Hari';

        $data = [
            'totalTicket'     => $totalTicket,
            'ticketSelesai'   => $ticketSelesai,
            'slaTercapai'     => $slaTercapai,
            'ticketTerlambat' => $ticketTerlambat,
            'avgSelesai'      => $avgSelesai,
            'topServices'     => $topServices
        ];

        return view('pimpinan/dashboard', $data);
EOD;

// Fix possible line ending differences
$search = str_replace("\r\n", "\n", $search);
$content = str_replace("\r\n", "\n", $content);

if (strpos($content, $search) !== false) {
    $content = str_replace($search, $replace, $content);
    file_put_contents($file, $content);
    echo "Success";
} else {
    echo "Search string not found!";
}
