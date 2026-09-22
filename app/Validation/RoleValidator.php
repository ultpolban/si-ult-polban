<?php

namespace App\Validation;

class RoleValidator
{
    public static function store(): array
    {
        return [

            'code' => [

                'label' => 'Kode Role',

                'rules' => 'required|max_length[30]'

            ],

            'name' => [

                'label' => 'Nama Role',

                'rules' => 'required|max_length[100]'

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

    public static function update(int $id): array
    {
        return self::store();
    }
}
