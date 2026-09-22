<?php

namespace App\Validation;

class FaqValidator
{
    /**
     * Validasi Tambah
     */
    public static function store(): array
    {
        return [

            'category' => [
                'label' => 'Kategori',
                'rules' => 'permit_empty|max_length[255]'
            ],

            'question' => [
                'label' => 'Pertanyaan',
                'rules' => 'required|max_length[255]'
            ],

            'answer' => [
                'label' => 'Jawaban',
                'rules' => 'required'
            ],

            'sort_order' => [
                'label' => 'Urutan',
                'rules' => 'required|integer'
            ],

            'is_active' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]'
            ],

        ];
    }

    /**
     * Validasi Update
     */
    public static function update(int $id): array
    {
        return [

            'category' => [
                'label' => 'Kategori',
                'rules' => 'permit_empty|max_length[255]'
            ],

            'question' => [
                'label' => 'Pertanyaan',
                'rules' => 'required|max_length[255]'
            ],

            'answer' => [
                'label' => 'Jawaban',
                'rules' => 'required'
            ],

            'sort_order' => [
                'label' => 'Urutan',
                'rules' => 'required|integer'
            ],

            'is_active' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]'
            ],

        ];
    }
}