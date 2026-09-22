<?php

namespace App\Validation;

class ServiceUnitValidator
{
    /**
     * Validasi Tambah
     */
    public static function store(): array
    {
        return [

            'code' => [
                'label' => 'Kode Unit Layanan',
                'rules' => 'required|max_length[20]|is_unique[master_service_units.code]'
            ],

            'name' => [
                'label' => 'Nama Unit Layanan',
                'rules' => 'required|max_length[150]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'permit_empty|valid_email|max_length[150]'
            ],

            'phone' => [
                'label' => 'Nomor Telepon',
                'rules' => 'permit_empty|max_length[30]'
            ],

            'location' => [
                'label' => 'Lokasi',
                'rules' => 'permit_empty|max_length[255]'
            ],

            'website' => [
                'label' => 'Website',
                'rules' => 'permit_empty|max_length[255]'
            ],

            'logo' => [
                'label' => 'Logo',
                'rules' => 'permit_empty|max_length[255]'
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

            'code' => [
                'label' => 'Kode Unit Layanan',
                'rules' => "required|max_length[20]|is_unique[master_service_units.code,id,{$id}]"
            ],

            'name' => [
                'label' => 'Nama Unit Layanan',
                'rules' => 'required|max_length[150]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'permit_empty|valid_email|max_length[150]'
            ],

            'phone' => [
                'label' => 'Nomor Telepon',
                'rules' => 'permit_empty|max_length[30]'
            ],

            'location' => [
                'label' => 'Lokasi',
                'rules' => 'permit_empty|max_length[255]'
            ],

            'website' => [
                'label' => 'Website',
                'rules' => 'permit_empty|max_length[255]'
            ],

            'logo' => [
                'label' => 'Logo',
                'rules' => 'permit_empty|max_length[255]'
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
