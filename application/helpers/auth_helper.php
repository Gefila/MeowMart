<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('cek_pelanggan_login')) {
    function cek_pelanggan_login() {
        $CI = &get_instance();
        if (!$CI->session->userdata('pelanggan_login')) {
            swal('error', 'Akses Ditolak', 'Anda harus login terlebih dahulu.');
            redirect(base_url('login'));
            die;
        }
    }
}
