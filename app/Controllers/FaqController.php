<?php

namespace App\Controllers;

use App\Models\FaqModel;

class FaqController extends BaseController
{
    protected $faqModel;

    public function __construct()
    {
        $this->faqModel = new FaqModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen FAQ',
            'faqs' => $this->faqModel->getFaqs()
        ];

        return view('faqs/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah FAQ Baru',
            'validation' => \Config\Services::validation()
        ];

        return view('faqs/create', $data);
    }

    public function store()
    {
        $rules = [
            'question' => 'required|min_length[5]',
            'answer' => 'required|min_length[5]',
            'category' => 'permit_empty|max_length[255]',
            'sort_order' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->faqModel->save([
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'category' => $this->request->getPost('category'),
            'sort_order' => $this->request->getPost('sort_order'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to('/faqs')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit FAQ',
            'faq' => $faq,
            'validation' => \Config\Services::validation()
        ];

        return view('faqs/edit', $data);
    }

    public function update($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'question' => 'required|min_length[5]',
            'answer' => 'required|min_length[5]',
            'category' => 'permit_empty|max_length[255]',
            'sort_order' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->faqModel->update($id, [
            'question' => $this->request->getPost('question'),
            'answer' => $this->request->getPost('answer'),
            'category' => $this->request->getPost('category'),
            'sort_order' => $this->request->getPost('sort_order'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to('/faqs')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function delete($id)
    {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->faqModel->delete($id);

        return redirect()->to('/faqs')->with('success', 'FAQ berhasil dihapus.');
    }
}
