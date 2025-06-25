<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Transaksi_model');
    }

    public function index() {
        $data['title'] = 'Gefila Store - Transaksi Produk';
        $data['admin'] = array(
            'id' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        );
        $data['transaksi'] = $this->Transaksi_model->get_ringkasan_transaksi();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('administrator/transaksi/index', $data);
        $this->load->view('administrator/templates/footer');
    }
}
