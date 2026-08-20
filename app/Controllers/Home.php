<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\ServiceModel;
use App\Models\RequirementModel;
use App\Models\VisitorModel;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // ==============================
        // VISITOR
        // ==============================
        $visitorModel = new VisitorModel();

        $ip = $this->request->getIPAddress();
        $today = date('Y-m-d');

        $alreadyVisited = $visitorModel
            ->where('visitor_ip', $ip)
            ->where('visited_date', $today)
            ->first();

        if (!$alreadyVisited) {
            $visitorModel->insert([
                'visitor_ip'   => $ip,
                'visited_date' => $today
            ]);
        }

        $data['visitors_today'] = $visitorModel
            ->where('visited_date', date('Y-m-d'))
            ->countAllResults();

        $data['visitors_week'] = $visitorModel
            ->where(
                'visited_date >=',
                date('Y-m-d', strtotime('monday this week'))
            )
            ->where(
                'visited_date <=',
                date('Y-m-d', strtotime('sunday this week'))
            )
            ->countAllResults();

        $data['visitors_month'] = $visitorModel
            ->where(
                'visited_date >=',
                date('Y-m-01')
            )
            ->where(
                'visited_date <=',
                date('Y-m-t')
            )
            ->countAllResults();

        $data['visitors_year'] = $visitorModel
            ->where(
                'visited_date >=',
                date('Y-01-01')
            )
            ->where(
                'visited_date <=',
                date('Y-12-31')
            )
            ->countAllResults();


        // ==============================
        // UNIT LAYANAN
        // ==============================
        $data['units'] = $db
            ->table('master_service_units')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultArray();


        // ==============================
        // KATEGORI
        // ==============================
        $data['categories'] = $db
            ->table('master_service_categories')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultArray();


        // ==============================
        // SERVICES
        // ==============================
        $data['services'] = $db
            ->table('master_services')
            ->select('
                master_services.*,
                master_service_units.name AS unit_name,
                master_service_categories.name AS category_name
            ')
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id'
            )
            ->join(
                'master_service_categories',
                'master_service_categories.id = master_services.service_category_id'
            )
            ->where('master_services.is_active', 1)
            ->orderBy('master_services.sort_order', 'ASC')
            ->get()
            ->getResultArray();


        // ==============================
        // STATISTIK
        // ==============================
        $data['total_services'] = $db
            ->table('master_services')
            ->where('is_active', 1)
            ->countAllResults();

        $data['total_requirements'] = $db
            ->table('master_service_requirements')
            ->where('is_active', 1)
            ->countAllResults();


        // ==============================
        // FAQ
        // ==============================
        $faqModel = new FaqModel();

        $data['faqs'] = $faqModel
            ->where('is_active', 1)
            ->findAll();

        $data['total_faqs'] = count($data['faqs']);

// ==============================
// LAYANAN POPULER
// ==============================

$data['popular_services'] = $db->table('service_statistics')
    ->select('master_services.name AS service_name, service_statistics.total_submission')
    ->join(
        'master_services',
        'master_services.id = service_statistics.service_id'
    )
    ->where('service_statistics.year', date('Y'))
    ->orderBy('service_statistics.total_submission', 'DESC')
    ->limit(4)
    ->get()
    ->getResultArray();
return view('home/index', $data);
}
}