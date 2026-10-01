<?php

namespace App\Controllers;

use App\Models\FaqModel;

class MahasiswaHelpController extends BaseController
{
    public function index()
    {
        $faqModel = new FaqModel();

        $faqData = $faqModel->getActive();

        // Sesuaikan nama field database
        // dengan field yang dipakai oleh view
        $faqs = [];

        foreach ($faqData as $faq) {
            $faqs[] = [
                'pertanyaan' => $faq['question'],
                'jawaban'    => $faq['answer'],
            ];
        }

        $data = [
            'title' => 'Pusat Bantuan Mahasiswa',
            'faqs'  => $faqs,
        ];

        return view('mahasiswa/help/index', $data);
    }
}