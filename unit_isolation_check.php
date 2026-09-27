<?php

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
require FCPATH . '../app/Config/Paths.php';
$paths = new Config\Paths();
require $paths->systemDirectory . '/Boot.php';
define('ENVIRONMENT', 'development');
CodeIgniter\Boot::bootConsole($paths);

$db = Config\Database::connect();

$query = static function (string $unit) use ($db): array {
    return $db->table('tickets t')
        ->select('t.id, t.ticket_number, ms.name AS layanan, msu.name AS unit')
        ->join('master_services ms', 'ms.id = t.service_id', 'inner')
        ->join('master_service_categories msc', 'msc.id = ms.service_category_id', 'inner')
        ->join('master_service_units msu', 'msu.id = msc.service_unit_id', 'inner')
        ->where('msu.code', $unit)
        ->where('ms.service_unit_id = msu.id', null, false)
        ->orderBy('t.id', 'ASC')
        ->get()
        ->getResultArray();
};

$keuangan = $query('KEU');
$kemahasiswaan = $query('KEMHS');
$units = $db->table('master_service_units')
    ->select('id,code,name')
    ->orderBy('id', 'ASC')
    ->get()
    ->getResultArray();
$services = $db->table('master_services ms')
    ->select('ms.id,ms.code,ms.name,ms.service_unit_id,msc.service_unit_id AS category_unit_id')
    ->join('master_service_categories msc', 'msc.id = ms.service_category_id', 'left')
    ->orderBy('ms.id', 'ASC')
    ->get()
    ->getResultArray();
$ticketCount = $db->table('tickets')->countAllResults();

$result = [
    'ticket_total' => $ticketCount,
    'units' => array_map(static fn (array $unit): string => $unit['code'] . ':' . $unit['name'], $units),
    'service_count_by_unit' => array_reduce(
        $services,
        static function (array $counts, array $service): array {
            $counts[$service['service_unit_id']] = ($counts[$service['service_unit_id']] ?? 0) + 1;
            return $counts;
        },
        []
    ),
    'inconsistent_service_relations' => count(array_filter(
        $services,
        static fn (array $service): bool => (string) $service['service_unit_id'] !== (string) $service['category_unit_id']
    )),
    'keuangan_count' => count($keuangan),
    'keuangan_first_two' => array_slice($keuangan, 0, 2),
    'kemahasiswaan_count' => count($kemahasiswaan),
    'kemahasiswaan_first_two' => array_slice($kemahasiswaan, 0, 2),
    'shared_ticket_ids' => array_values(array_intersect(
        array_column($keuangan, 'id'),
        array_column($kemahasiswaan, 'id')
    )),
];

echo json_encode($result, JSON_PRETTY_PRINT), PHP_EOL;
