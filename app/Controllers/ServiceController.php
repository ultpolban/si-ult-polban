<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

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

        $data['services'] = $model
            ->where('category_id', 1)
            ->findAll();

        return view('services/keuangan', $data);
    }

    // Menampilkan layanan kategori Akademik
    public function akademik()
    {
        $model = new ServiceModel();

        $data['services'] = $model
            ->where('category_id', 2)
            ->findAll();

        return view('services/akademik', $data);
    }

    public function detail($id)
{
    $model = new ServiceModel();

    $data['service'] = $model->find($id);

    if (!$data['service']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('service/detail', $data);
}
}