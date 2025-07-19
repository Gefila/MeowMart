<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['midtrans_server_key'] = $_ENV['midtrans_server_key'];
$config['midtrans_client_key'] = $_ENV['midtrans_client_key'];
$config['midtrans_is_production'] = false; // true jika live
$config['midtrans_sanitized'] = true;
$config['midtrans_3ds'] = true;
