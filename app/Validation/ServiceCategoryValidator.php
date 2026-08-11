<?php

namespace App\Validation;

class ServiceCategoryValidator
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

            'code' => [
                'label' => 'Kode Kategori',
                'rules' => 'required|max_length[20]|is_unique[master_service_categories.code]'
            ],

            'name' => [
                'label' => 'Nama Kategori',
                'rules' => 'required|max_length[150]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'icon' => [
                'label' => 'Icon',
                'rules' => 'permit_empty|max_length[100]'
            ],

            'color' => [
                'label' => 'Warna',
                'rules' => 'permit_empty|max_length[30]'
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

            'code' => [
                'label' => 'Kode Kategori',
                'rules' => "required|max_length[20]|is_unique[master_service_categories.code,id,{$id}]"
            ],

            'name' => [
                'label' => 'Nama Kategori',
                'rules' => 'required|max_length[150]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'icon' => [
                'label' => 'Icon',
                'rules' => 'permit_empty|max_length[100]'
            ],

            'color' => [
                'label' => 'Warna',
                'rules' => 'permit_empty|max_length[30]'
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
