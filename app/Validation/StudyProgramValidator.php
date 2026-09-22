<?php

namespace App\Validation;

class StudyProgramValidator
{
    /**
     * Validasi Tambah
     */
    public static function store(): array
    {
        return [

            'department_id' => [
                'label' => 'Jurusan',
                'rules' => 'required|integer'
            ],

            'code' => [
                'label' => 'Kode Program Studi',
                'rules' => 'required|max_length[20]|is_unique[master_study_programs.code]'
            ],

            'name' => [
                'label' => 'Nama Program Studi',
                'rules' => 'required|max_length[200]'
            ],

            'short_name' => [
                'label' => 'Nama Singkat',
                'rules' => 'permit_empty|max_length[50]'
            ],

            'degree' => [
                'label' => 'Jenjang',
                'rules' => 'required|in_list[D1,D2,D3,D4,S1,S2,Profesi]'
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

            'department_id' => [
                'label' => 'Jurusan',
                'rules' => 'required|integer'
            ],

            'code' => [
                'label' => 'Kode Program Studi',
                'rules' => "required|max_length[20]|is_unique[master_study_programs.code,id,{$id}]"
            ],

            'name' => [
                'label' => 'Nama Program Studi',
                'rules' => 'required|max_length[200]'
            ],

            'short_name' => [
                'label' => 'Nama Singkat',
                'rules' => 'permit_empty|max_length[50]'
            ],

            'degree' => [
                'label' => 'Jenjang',
                'rules' => 'required|in_list[D1,D2,D3,D4,S1,S2,Profesi]'
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
