<?php

namespace App\Validation;

class DepartmentValidator
{
    public static function store(): array
    {
        return [
            'code' => [
                'label' => 'Kode Jurusan',
                'rules' => 'required|max_length[10]|is_unique[master_departments.code]',
            ],

            'name' => [
                'label' => 'Nama Jurusan',
                'rules' => 'required|max_length[150]|is_unique[master_departments.name]',
            ],

            'short_name' => [
                'label' => 'Singkatan',
                'rules' => 'permit_empty|max_length[30]',
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty',
            ],

            'sort_order' => [
                'label' => 'Urutan',
                'rules' => 'required|integer',
            ],

            'is_active' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]',
            ],
        ];
    }

    public static function update(int $id): array
    {
        return [
            'code' => [
                'label' => 'Kode Jurusan',
                'rules' => "required|max_length[10]|is_unique[master_departments.code,id,{$id}]",
            ],

            'name' => [
                'label' => 'Nama Jurusan',
                'rules' => "required|max_length[150]|is_unique[master_departments.name,id,{$id}]",
            ],

            'short_name' => [
                'label' => 'Singkatan',
                'rules' => 'permit_empty|max_length[30]',
            ],

            'description' => [
                'label' => 'Deskripsi',
                'rules' => 'permit_empty',
            ],

            'sort_order' => [
                'label' => 'Urutan',
                'rules' => 'required|integer',
            ],

            'is_active' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]',
            ],
        ];
    }
}
