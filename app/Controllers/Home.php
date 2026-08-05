<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\ServiceModel;
use App\Models\RequirementModel;
use App\Models\StatisticModel;

class Home extends BaseController
{
public function index()
{
    $faqModel = new FaqModel();
    $serviceModel = new ServiceModel();
    $requirementModel = new RequirementModel();

    // FAQ
    $data['faqs'] = $faqModel
                        ->where('is_active', 1)
                        ->findAll();

    // Statistik
    $data['total_services'] = $serviceModel->countAllResults();

    // Total layanan Akademik (category_id = 2)
    $data['layanan_akademik'] = $serviceModel
                                    ->where('category_id', 2)
                                    ->countAllResults();

    // Total layanan Keuangan (category_id = 1)
    $data['layanan_keuangan'] = $serviceModel
                                    ->where('category_id', 1)
                                    ->countAllResults();

    // Total persyaratan
    $data['total_requirements'] = $requirementModel->countAllResults();

    // Total FAQ
    $data['total_faqs'] = $faqModel
                            ->where('is_active', 1)
                            ->countAllResults();

$statisticModel = new StatisticModel();

$data['popular_services'] = $statisticModel
    ->select('services.service_name, service_statistics.total_submission')
    ->join('services', 'services.id = service_statistics.service_id')
    ->where('service_statistics.year', date('Y'))
    ->orderBy('service_statistics.total_submission', 'DESC')
    ->findAll();

return view('home/index', $data);
}

public function kemahasiswaan()
{
    return view('layanan/kemahasiswaan');
}
}