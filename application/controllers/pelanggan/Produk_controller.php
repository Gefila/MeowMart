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

    public function index()
    {
        $data['gambar_model'] = $this->Produk_gambar_model;
        $data['list_produk'] = $this->Produk_model->get_all();
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        if ($this->session->userdata('pelanggan_login') !== NULL) {
            $data['data_pelanggan'] = array(
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'email' => $this->session->userdata('email'),
                'nama_pelanggan' => $this->session->userdata('nama'),
                'pelanggan_login' => $this->session->userdata('pelanggan_login')
            );
        }
        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/produk', $data);
        $this->load->view('pelanggan/templates/footer');
    }

    public function kategori($id=0){
        if($id == 0){
            redirect('/');
            die;
        }
        $kategori = $this->Produk_kategori_model->get_by_id($id);
        if(!$kategori){
            redirect('/');
            die;
        }
        $data['kategori'] = $kategori;
        $data['list_produk'] = $this->Produk_model->get_by_kategori_id($id);
        $data['gambar_model'] = $this->Produk_gambar_model;
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/produk', $data);
        $this->load->view('pelanggan/templates/footer');
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
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        $this->load->view('pelanggan/templates/header', $data);
        $this->load->view('pelanggan/produk_detail', $data);
        $this->load->view('pelanggan/templates/footer');
    }
}
