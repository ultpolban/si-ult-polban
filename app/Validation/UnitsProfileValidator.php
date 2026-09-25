<?php

namespace App\Validation;

class UnitsProfileValidator
{
    public static function store(): array
    {
        return [
            'service_unit_id' => ['label' => 'Unit Layanan', 'rules' => 'required|integer|is_unique[units_profiles.service_unit_id]'],
            'description'     => ['label' => 'Deskripsi Unit', 'rules' => 'required|min_length[10]'],
            'is_active'       => ['label' => 'Status', 'rules' => 'required|in_list[0,1]'],
        ];
    }

    public static function update(int $id): array
    {
        return [
            'service_unit_id' => ['label' => 'Unit Layanan', 'rules' => "required|integer|is_unique[units_profiles.service_unit_id,id,{$id}]"],
            'description'     => ['label' => 'Deskripsi Unit', 'rules' => 'required|min_length[10]'],
            'is_active'       => ['label' => 'Status', 'rules' => 'required|in_list[0,1]'],
        ];
    }
}

