<?php

namespace App\Controllers;

use App\Models\FaqModel;

class Home extends BaseController
{
    public function index()
    {
        $faqModel = new FaqModel();

        $data['faqs'] = $faqModel
                            ->where('is_active', 1)
                            ->findAll();

        return view('home/index', $data);
    }
}