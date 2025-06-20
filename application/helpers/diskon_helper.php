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
