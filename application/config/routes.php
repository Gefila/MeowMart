<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'administrator/Admin_dashboard_controller/index';
$route['admin/login'] = 'administrator/Admin_auth_controller/index';
$route['admin/logout'] = 'administrator/Admin_auth_controller/logout';

#admin kategori
$route['admin/kategori'] = 'administrator/Kategori_controller/index';
$route['admin/kategori/tambah'] = 'administrator/Kategori_controller/tambah_kategori';
$route['admin/kategori/hapus/(:num)'] = 'administrator/Kategori_controller/hapus_kategori/$1';
$route['admin/kategori/ubah/(:num)'] = 'administrator/Kategori_controller/ubah_kategori/$1';

#prduk
$route['admin/produk'] = 'administrator/Produk_controller/index';
$route['admin/produk/tambah'] = 'administrator/Produk_controller/tambah_produk';
$route['admin/produk/ubah/(:num)'] = 'administrator/Produk_controller/ubah_produk/$1';
$route['admin/produk/hapus/(:num)'] = 'administrator/Produk_controller/hapus_produk/$1';
$route['admin/produk/ubah_gambar/(:num)'] = 'administrator/Produk_controller/ubah_gambar/$1';
$route['admin/produk/hapus_gambar/(:num)'] = 'administrator/Produk_controller/hapus_gambar/$1';

#diskon
$route['admin/diskon'] = 'administrator/Diskon_controller/index';
$route['admin/diskon/tambah'] = 'administrator/Diskon_controller/tambah_diskon';
$route['admin/diskon/hapus/(:num)'] = 'administrator/Diskon_controller/hapus_diskon/$1';
$route['admin/diskon/ubah/(:num)'] = 'administrator/Diskon_controller/ubah_diskon/$1';

#pelanggan
$route['login'] = 'pelanggan/Pelanggan_controller/login';
$route['register'] = 'pelanggan/Pelanggan_controller/register';
$route['logout'] = 'pelanggan/Pelanggan_controller/logout';
$route['profil'] = 'pelanggan/Pelanggan_controller/profil';
$route['profil/ubah'] = 'pelanggan/Pelanggan_controller/ubah_profil';

#produk
$route['produk'] = 'pelanggan/Produk_controller/index';
$route['produk/(:num)'] = 'pelanggan/Produk_controller/detail/$1';
$route['produk/kategori/(:num)'] = 'pelanggan/Produk_controller/kategori/$1';

#keranjang
$route['keranjang'] = 'pelanggan/Keranjang_controller/index';
$route['keranjang/tambah'] = 'pelanggan/Keranjang_controller/tambah';
$route['keranjang/ubah'] = 'pelanggan/Keranjang_controller/ubah_keranjang';
$route['keranjang/hapus'] = 'pelanggan/Keranjang_controller/hapus_produk_keranjang';

#pesanan
$route['pesanan'] = 'pelanggan/Pesanan_controller/index';
$route['pesanan/detail/(:num)'] = 'pelanggan/Pesanan_controller/detail/$1';
$route['pesanan/tambah'] = 'pelanggan/Pesanan_controller/tambah_pesanan';

#pembayaran
$route['pembayaran/(:num)'] = 'pelanggan/Pembayaran_controller/index/$1';
$route['pembayaran/bayar'] = 'pelanggan/Pembayaran_controller/bayar';

#transaksi
$route['admin/transaksi'] = 'administrator/Transaksi_controller/index';
$route['admin/transaksi/cetak/(:num)'] = 'administrator/Transaksi_controller/cetak/$1';
