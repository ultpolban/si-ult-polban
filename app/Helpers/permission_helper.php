<?php

if (!function_exists('hasRole')) {

    function hasRole($roles)
    {
        $role = session()->get('role_id');

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        return in_array($role, $roles);
    }
}
