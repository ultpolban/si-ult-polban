<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $register = [

        'role_id' => 'required',

        'user_type_id' => 'required',

        'full_name' => 'required|min_length[3]|max_length[150]',

        'personal_email' => 'required|valid_email|is_unique[users.personal_email]',

        'phone' => 'required|min_length[10]|max_length[15]',

        'password' => 'required|min_length[8]',

        'confirm_password' => 'required|matches[password]',

    ];

    public array $login = [

        'personal_email' => 'required|valid_email',

        'password' => 'required',

    ];
}
