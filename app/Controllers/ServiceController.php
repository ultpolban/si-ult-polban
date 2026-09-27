<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\RequirementModel;
use App\Models\MasterServiceUnitModel;
use App\Models\UnitProfileModel;

class ServiceController extends BaseController
{
    // Menampilkan semua layanan
    public function index()
    {
        $model = new ServiceModel();

        $data['services'] = $model->findAll();

        return view('services/index', $data);
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

    $data = [
        'service'      => $service,
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