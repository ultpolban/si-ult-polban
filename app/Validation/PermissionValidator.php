<?php

namespace App\Validation;

class PermissionValidator
{
    public static function store(): array
    {
        return [

            'code' => 'required|max_length[100]',

            'name' => 'required|max_length[150]',

            'module' => 'required|max_length[100]',

            'description' => 'permit_empty',

            'sort_order' => 'required|integer',

            'is_active' => 'required|in_list[0,1]'

        ];
    }

    public static function update(int $id): array
    {
        return self::store();
    }
}
