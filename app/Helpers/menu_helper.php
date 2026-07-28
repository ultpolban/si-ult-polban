<?php

if (!function_exists('menu_active')) {

    function menu_active($segment)
    {
        return service('uri')->getSegment(1) == $segment
            ? 'active'
            : '';
    }
}
