<?php

namespace App\Controllers;

class FaqController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Bantuan'
        ];

        return view('faq/index', $data);
    }
}