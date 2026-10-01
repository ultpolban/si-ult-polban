<?php

namespace App\Validation;

class ClassValidator
{
    /**
     * Validasi Tambah
     */
    public static function store(): array
    {
        return [

            'study_program_id' => [
                'label' => 'Program Studi',
                'rules' => 'required|integer'
            ],

            'code' => [
                'label' => 'Kode Kelas',
                'rules' => 'required|max_length[30]|is_unique[master_classes.code]'
            ],

            'name' => [
                'label' => 'Nama Kelas',
                'rules' => 'required|max_length[100]'
            ],

            'level' => [
                'label' => 'Tingkat',
                'rules' => 'required|integer|greater_than[0]'
            ],

            'parallel_class' => [
                'label' => 'Kelas Paralel',
                'rules' => 'required|max_length[5]'
            ],

            'entry_year' => [
                'label' => 'Tahun Masuk',
                'rules' => 'required|integer|exact_length[4]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
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
     * Validasi Edit
     */
    public static function update(int $id): array
    {
        return [

            'study_program_id' => [
                'label' => 'Program Studi',
                'rules' => 'required|integer'
            ],

            'code' => [
                'label' => 'Kode Kelas',
                'rules' => "required|max_length[30]|is_unique[master_classes.code,id,{$id}]"
            ],

            'name' => [
                'label' => 'Nama Kelas',
                'rules' => 'required|max_length[100]'
            ],

            'level' => [
                'label' => 'Tingkat',
                'rules' => 'required|integer|greater_than[0]'
            ],

            'parallel_class' => [
                'label' => 'Kelas Paralel',
                'rules' => 'required|max_length[5]'
            ],

            'entry_year' => [
                'label' => 'Tahun Masuk',
                'rules' => 'required|integer|exact_length[4]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
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
