<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\ServiceModel;
use App\Models\RequirementModel;
use App\Models\StatisticModel;
use App\Models\VisitorModel;

class Home extends BaseController
{
    public function index()
    {
        $faqModel = new FaqModel();
        $serviceModel = new ServiceModel();
        $requirementModel = new RequirementModel();
        $visitorModel = new VisitorModel(); 

// Statistik pengunjung berdasarkan IP
$visitorIp = $this->request->getIPAddress();

$today = date('Y-m-d');

$alreadyVisited = $visitorModel
                    ->where('visitor_ip', $visitorIp)
                    ->where('visited_date', $today)
                    ->first();

if (!$alreadyVisited) {
    $visitorModel->insert([
        'visitor_ip'   => $visitorIp,
        'visited_date' => $today
    ]);
}
    // Statistik pengunjung

// Hari ini
$data['visitors_today'] = $visitorModel
    ->where('visited_date', date('Y-m-d'))
    ->countAllResults();

// Minggu ini
$startOfWeek = date('Y-m-d', strtotime('monday this week'));
$endOfWeek   = date('Y-m-d', strtotime('sunday this week'));

$data['visitors_week'] = $visitorModel
    ->where('visited_date >=', $startOfWeek)
    ->where('visited_date <=', $endOfWeek)
    ->countAllResults();

// Bulan ini
$startOfMonth = date('Y-m-01');
$endOfMonth   = date('Y-m-t');

$data['visitors_month'] = $visitorModel
    ->where('visited_date >=', $startOfMonth)
    ->where('visited_date <=', $endOfMonth)
    ->countAllResults();

// Tahun ini
$startOfYear = date('Y-01-01');
$endOfYear   = date('Y-12-31');

$data['visitors_year'] = $visitorModel
    ->where('visited_date >=', $startOfYear)
    ->where('visited_date <=', $endOfYear)
    ->countAllResults();

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