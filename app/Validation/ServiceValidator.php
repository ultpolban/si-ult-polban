<?php

namespace App\Validation;

class ServiceValidator
{
    /**
     * Validasi Tambah
     */
    public static function store(): array
    {
        return [

            'service_unit_id' => [
                'label' => 'Unit Layanan',
                'rules' => 'required|integer'
            ],

            'service_category_id' => [
                'label' => 'Kategori Layanan',
                'rules' => 'required|integer'
            ],

            'code' => [
                'label' => 'Kode Layanan',
                'rules' => 'required|max_length[30]|is_unique[master_services.code]'
            ],

            'name' => [
                'label' => 'Nama Layanan',
                'rules' => 'required|max_length[200]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'service_hours' => [
                'label' => 'Estimasi Layanan',
                'rules' => 'required|integer'
            ],

            'max_file_size' => [
                'label' => 'Ukuran File',
                'rules' => 'required|integer'
            ],

            'is_online' => [
                'label' => 'Layanan Online',
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
     * Validasi Update
     */
    public static function update(int $id): array
    {
        return [

            'service_unit_id' => [
                'label' => 'Unit Layanan',
                'rules' => 'required|integer'
            ],

            'service_category_id' => [
                'label' => 'Kategori Layanan',
                'rules' => 'required|integer'
            ],

            'code' => [
                'label' => 'Kode Layanan',
                'rules' => "required|max_length[30]|is_unique[master_services.code,id,{$id}]"
            ],

            'name' => [
                'label' => 'Nama Layanan',
                'rules' => 'required|max_length[200]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'service_hours' => [
                'label' => 'Estimasi Layanan',
                'rules' => 'required|integer'
            ],

            'max_file_size' => [
                'label' => 'Ukuran File',
                'rules' => 'required|integer'
            ],

            'is_online' => [
                'label' => 'Layanan Online',
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
