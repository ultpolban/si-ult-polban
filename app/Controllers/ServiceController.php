<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\RequirementModel;
use App\Models\MasterServiceUnitModel;
use App\Models\UnitProfileModel;
use App\Models\ServicePopularityModel;

class ServiceController extends BaseController
{
    // Menampilkan semua layanan
    /**
     * Daftar layanan publik, dikelompokkan per kategori (unit).
     *
     * Setiap kelompok membawa:
     *   unit     -> baris master_service_units (kode, nama, dll)
     *   services -> daftar layanan milik unit tersebut
     */
    public function index()
    {
        $model = new ServiceModel();
        $unitModel = new MasterServiceUnitModel();

        $services = $model
            ->where('is_active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        // Susun daftar unit (hanya yang aktif) supaya urutannya rapi
        $units = $unitModel->where('is_active', 1)->findAll();

        // Kelompokkan layanan berdasarkan service_unit_id
        $grouped = [];

        foreach ($services as $service) {
            $uid = (int) ($service['service_unit_id'] ?? 0);
            $grouped[$uid][] = $service;
        }

        // Bentuk daftar kategori yang punya layanan
        $categories = [];

        foreach ($units as $unit) {
            $uid = (int) $unit['id'];

            if (empty($grouped[$uid])) {
                continue;
            }

            $categories[] = [
                'unit'     => $unit,
                'icon'     => $this->unitIcon((string) ($unit['code'] ?? '')),
                'services' => $grouped[$uid],
                'count'    => count($grouped[$uid]),
            ];
        }

        // Layanan yang unit-nya tidak ditemukan / tidak aktif tetap
        // ditampilkan di akhir, supaya tidak ada data yang hilang.
        $known = array_map(static fn ($u) => (int) $u['id'], $units);
        $orphan = [];

        foreach ($grouped as $uid => $list) {
            if (! in_array((int) $uid, $known, true)) {
                $orphan = array_merge($orphan, $list);
            }
        }

        if ($orphan !== []) {
            $categories[] = [
                'unit'     => null,
                'icon'     => 'bi-grid',
                'services' => $orphan,
                'count'    => count($orphan),
            ];
        }

        return view('services/index', [
            'services'      => $services,
            'categories'    => $categories,
            'totalServices' => count($services),
            'totalUnits'    => count($categories),
        ]);
    }

    /**
     * Ikon bootstrap sesuai kode unit layanan.
     */
    private function unitIcon(string $code): string
    {
        return match (strtoupper(trim($code))) {
            'AKD'         => 'bi-mortarboard',
            'KEU'         => 'bi-wallet2',
            'KEM'         => 'bi-people',
            'PERP'        => 'bi-journals',
            'JUR'         => 'bi-diagram-3',
            'TIK'         => 'bi-cpu',
            'ADM'         => 'bi-folder2-open',
            'UPT'         => 'bi-building-gear',
            default       => 'bi-grid',
        };
    }

    // Menampilkan layanan kategori Keuangan
  
public function keuangan()
{
    $model = new ServiceModel();
    $serviceUnitModel = new MasterServiceUnitModel();
    $unitProfileModel = new UnitProfileModel();

    $data['title'] = 'Layanan Keuangan';

    // Ambil layanan Keuangan
    $data['services'] = $model
        ->where('service_unit_id', 3)
        ->where('is_active', 1)
        ->findAll();

   $data['unit'] = $serviceUnitModel
    ->where('code', 'KEU')
    ->first();

    // Ambil profil unit Keuangan
    $data['profile'] = null;

    if ($data['unit']) {
        $data['profile'] = $unitProfileModel
            ->where('service_unit_id', $data['unit']['id'])
            ->first();
    }

    return view('services/keuangan', $data);
}

public function akademik()
{
    $model = new ServiceModel();
    $serviceUnitModel = new MasterServiceUnitModel();
    $unitProfileModel = new UnitProfileModel();

    $data['title'] = 'Layanan Akademik';

    $data['services'] = $model
        ->where('service_unit_id', 2)
        ->where('is_active', 1)
        ->findAll();

    $data['unit'] = $serviceUnitModel
        ->where('code', 'AKD')
        ->first();

    $data['profile'] = null;

    if ($data['unit']) {
        $data['profile'] = $unitProfileModel
            ->where('service_unit_id', $data['unit']['id'])
            ->first();
    }

    return view('services/akademik', $data);
}
public function upa()
{
    $db = \Config\Database::connect();

    $data['units'] = $db->table('master_service_units')
        ->where('code', 'UPT')
        ->where('is_active', 1)
        ->get()
        ->getResultArray();

    return view('services/upa', $data);
}

    public function detail($id)
{
    $serviceModel = new ServiceModel();
    $requirementModel = new RequirementModel();

    // Ambil data layanan
    $service = $serviceModel->find($id);

    // Kalau layanan tidak ada
    if (!$service) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Ambil persyaratan berdasarkan service_id
    $requirements = $requirementModel
        ->where('service_id', $id)
        ->where('is_active', 1)
        ->findAll();

    // Nama unit pemilik layanan (dipakai di header halaman detail)
    $unitName = null;

    if (! empty($service['service_unit_id'])) {
        $unitRow = (new MasterServiceUnitModel())
            ->select('name')
            ->find($service['service_unit_id']);

        $unitName = is_array($unitRow) ? ($unitRow['name'] ?? null) : $unitRow;
    }

    // Catat kunjungan: dipakai untuk "Layanan Paling Banyak Diakses"
    // di landing page. Gagal tidak boleh mengganggu halaman.
    try {
        (new ServicePopularityModel())->recordView((int) $service['id']);
    } catch (\Throwable $e) {
        // diamkan: statistik tidak boleh membuat halaman error
    }

    $data = [
        'service'      => $service,
        'unit_name'    => $unitName,
        'requirements' => $requirements
    ];

    return view('services/detail', $data);
}


public function kemahasiswaan()
{
    $model = new ServiceModel();
    $serviceUnitModel = new MasterServiceUnitModel();
    $unitProfileModel = new UnitProfileModel();

    $data['title'] = 'Layanan Kemahasiswaan';

    $data['services'] = $model
        ->where('service_unit_id', 4)
        ->where('is_active', 1)
        ->findAll();

    $data['unit'] = $serviceUnitModel
        ->where('code', 'KEMHS')
        ->first();

    $data['profile'] = null;

    if ($data['unit']) {
        $data['profile'] = $unitProfileModel
            ->where('service_unit_id', $data['unit']['id'])
            ->first();
    }

    return view('services/kemahasiswaan', $data);
}
}