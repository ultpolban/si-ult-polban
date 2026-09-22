<?php

namespace App\Validation;

class ApplicantTypeValidator
{
    /**
     * Validasi Tambah
     */
    public static function store(): array
    {
        return [

            'code' => [
                'label' => 'Kode Jenis Pemohon',
                'rules' => 'required|max_length[20]|is_unique[master_applicant_types.code]'
            ],

            'name' => [
                'label' => 'Nama Jenis Pemohon',
                'rules' => 'required|max_length[100]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'is_internal' => [
                'label' => 'Jenis',
                'rules' => 'required|in_list[0,1]'
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

            'code' => [
                'label' => 'Kode Jenis Pemohon',
                'rules' => "required|max_length[20]|is_unique[master_applicant_types.code,id,{$id}]"
            ],

            'name' => [
                'label' => 'Nama Jenis Pemohon',
                'rules' => 'required|max_length[100]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'is_internal' => [
                'label' => 'Jenis',
                'rules' => 'required|in_list[0,1]'
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
