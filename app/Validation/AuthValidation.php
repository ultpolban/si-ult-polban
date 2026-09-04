<?php

namespace App\Validation;

class AuthValidation
{
    public static function register()
    {
        return [

            'role_id' => [
                'rules' => 'required|is_natural_no_zero'
            ],

            'user_type_id' => [
                'rules' => 'required|is_natural_no_zero'
            ],

            'full_name' => [
                'rules' => 'required|min_length[5]|max_length[150]'
            ],

            'personal_email' => [
                'rules' => 'required|valid_email|is_unique[users.personal_email]'
            ],

            'phone' => [
                'rules' => 'required|min_length[10]|max_length[15]'
            ],

            'password' => [
                'rules' => 'required|min_length[8]'
            ],

            'confirm_password' => [
                'rules' => 'required|matches[password]'
            ]

        ];
    }
}
