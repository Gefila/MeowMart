<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('swal')) {
    function swal($type = 'success', $title = '', $text = '', $redirect = null, $timer = null)
    {
        $ci = &get_instance(); // otomatis ambil CI instance

        $script = "<script>
        Swal.fire({
            icon: '$type',
            title: '$title',
            text: '$text',
            confirmButtonText: 'OK'";

        if ($timer) {
            $script .= ", timer: $timer, showConfirmButton: false";
        }

        $script .= "})";

        if ($redirect) {
            $script .= ".then((result) => {
            window.location.href = '$redirect';
        })";
        }

        $script .= ";</script>";

        $ci->session->set_flashdata('message', $script);
    }
}
