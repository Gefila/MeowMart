<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('is_diskon_aktif')) {
    function is_diskon_aktif($tanggal_mulai, $tanggal_akhir) {
        $tanggal_sekarang = date('Y-m-d');
        return ($tanggal_sekarang >= $tanggal_mulai && $tanggal_sekarang <= $tanggal_akhir);
    }
}

if (!function_exists('hitung_diskon')) {
    function hitung_diskon($harga, $persentase_diskon, $tanggal_mulai, $tanggal_akhir) {
        if (is_diskon_aktif($tanggal_mulai, $tanggal_akhir)) {
            $diskon = ($harga * $persentase_diskon) / 100;
            $harga = $harga - $diskon;
        }
        return $harga;
    }
}

if (!function_exists('filter_diskon_terbesar')) {
    function filter_diskon_terbesar_dan_aktif($diskon_list) {
        $diskonTerbesar = null;
        foreach ($diskon_list as $diskon) {
            if (is_diskon_aktif($diskon['tanggal_mulai'], $diskon['tanggal_akhir'])) {
                if ($diskonTerbesar === null || $diskon['persentase'] > $diskonTerbesar['persentase']) {
                    $diskonTerbesar = $diskon;
                }
            }
        }
        return $diskonTerbesar;
    }
}
