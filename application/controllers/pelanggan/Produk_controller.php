<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Produk_kategori_model');
        $this->load->model('Produk_gambar_model');
    }

    public function detail($id=0){
        if($id == 0){
            redirect('/');
            die;
        }
        $produk = $this->Produk_model->get_by_id($id);
        if(!$produk){
            redirect('/');
            die;
        }
        $data['produk'] = $produk;
        $data['list_gambar'] = $this->Produk_gambar_model->get_by_produk_id($id);
        $data['kategori'] = $this->Produk_kategori_model->get_by_id($produk['categori_id']);
        $this->load->view('pelanggan/templates/header');
        $this->load->view('pelanggan/produk_detail', $data);
        $this->load->view('pelanggan/templates/footer');
    }
}
