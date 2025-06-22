<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('is_active')) {
    function is_active($segment1 = '', $segment2 = '')
    {
        $CI = &get_instance();
        $uri1 = $CI->uri->segment(1);
        $uri2 = $CI->uri->segment(2);

        // Jika hanya 1 segment yang diperiksa
        if ($segment2 === '') {
            return ($uri1 == $segment1 && $uri2 == '') ? 'active' : '';
        }

        // Jika 2 segment yang diperiksa
        return ($uri1 == $segment1 && $uri2 == $segment2) ? 'active' : '';
    }
}
