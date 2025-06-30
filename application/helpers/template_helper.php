<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('is_active')) {
    function is_active($segment1 = '', $segment2 = '') {
        $CI = &get_instance();
        $uri1 = $CI->uri->segment(1);
        $uri2 = $CI->uri->segment(2);

        if ($segment1 === $uri1 && $segment2 === ' ') {
            return ($uri1 == $segment1 && $uri2 !== NULL) ? 'active' : '';
        }

        // Jika hanya 1 segment yang diperiksa
        if ($segment2 === '') {
            return ($uri1 == $segment1 && $uri2 == '') ? 'active' : '';
        }



        if ($segment1 === '' && $segment2 !== '') {
            // Jika hanya 2 segment yang diperiksa
            return ($uri2 == $segment2) ? 'active' : '';
        }
        // Jika 2 segment yang diperiksa
        return ($uri1 == $segment1 && $uri2 == $segment2) ? 'active' : '';
    }
}

if (! function_exists('indo_date')) {
    function indo_date($date, $include_day = false) {
        if (!$date || $date == '0000-00-00') return '';

        $days = array(
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        );

        $months = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $tanggal = date('d', strtotime($date));
        $bulan   = date('m', strtotime($date));
        $tahun   = date('Y', strtotime($date));
        $nama_hari = date('l', strtotime($date));

        $formatted_date = (int)$tanggal . ' ' . $months[$bulan] . ' ' . $tahun;

        if ($include_day) {
            $formatted_date = $days[$nama_hari] . ', ' . $formatted_date;
        }

        return $formatted_date;
    }
}

if (! function_exists('indo_datetime')) {
    function indo_datetime($datetime, $include_day = false, $include_time = true) {
        if (!$datetime || $datetime == '0000-00-00 00:00:00' || $datetime == '0000-00-00') return '';

        $days = array(
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        );

        $months = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $timestamp = strtotime($datetime);

        $tanggal   = date('d', $timestamp);
        $bulan     = date('m', $timestamp);
        $tahun     = date('Y', $timestamp);
        $jam       = date('H:i', $timestamp);
        $nama_hari = date('l', $timestamp);

        $formatted_date = (int)$tanggal . ' ' . $months[$bulan] . ' ' . $tahun;

        if ($include_day) {
            $formatted_date = $days[$nama_hari] . ', ' . $formatted_date;
        }

        if ($include_time) {
            $formatted_date .= ' ' . $jam;
        }

        return $formatted_date;
    }
}

function is_active_sidebar($segment1 = '', $segment2 = '')
{
    $CI = &get_instance();
    $uri1 = $CI->uri->segment(1);
    $uri2 = $CI->uri->segment(2);

    if ($segment1 && !$segment2) {
        // hanya aktif kalau segment 1 cocok dan tidak ada segment 2
        return ($uri1 === $segment1 && $uri2 === null) ? 'active' : '';
    } elseif (!$segment1 && $segment2) {
        return ($uri2 === $segment2) ? 'active' : '';
    } elseif ($segment1 && $segment2) {
        return ($uri1 === $segment1 && $uri2 === $segment2) ? 'active' : '';
    }

    return '';
}

