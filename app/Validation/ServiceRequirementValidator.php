<?php

namespace App\Validation;

class ServiceRequirementValidator
{
    /**
     * Validasi Tambah
     */
    public static function store(): array
    {
        return [

            'service_id' => [
                'label' => 'Layanan',
                'rules' => 'required|integer'
            ],

            'name' => [
                'label' => 'Nama Persyaratan',
                'rules' => 'required|max_length[200]'
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty'
            ],

            'file_type' => [
                'label' => 'Jenis File',
                'rules' => 'required|max_length[100]'
            ],

            'max_file_size' => [
                'label' => 'Ukuran Maksimum File',
                'rules' => 'required|integer'
            ],

            'allowed_extensions' => [
                'label' => 'Ekstensi File',
                'rules' => 'permit_empty|max_length[255]'
            ],

            'is_required' => [
                'label' => 'Wajib Upload',
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
        return self::store();
    }
}
