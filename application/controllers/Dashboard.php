<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Produk_kategori_model');
        $this->load->model('Produk_gambar_model');
    }
    
    public function index()
    {
        $data['gambar_model'] = $this->Produk_gambar_model;
        $data['list_produk'] = $this->Produk_model->get_all();
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        if($this->session->userdata('pelanggan_login') !== NULL){
            $data['data_pelanggan'] = array(
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'email' => $this->session->userdata('email'),
                'nama_pelanggan' => $this->session->userdata('nama'),
                'pelanggan_login' => $this->session->userdata('pelanggan_login')
            );
        }
        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/templates/carausel');
        $this->load->view('pelanggan/home', $data);
        $this->load->view('pelanggan/templates/footer');
    }
}
