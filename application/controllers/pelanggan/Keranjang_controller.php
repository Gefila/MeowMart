<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keranjang_model');
        $this->load->model('Keranjang_produk_model');
        $this->load->model('Produk_model');
        $this->load->model('Produk_gambar_model');
        $this->load->model('Produk_kategori_model');

        if (!$this->session->userdata('pelanggan_login')) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "error",
                title: "Akses Ditolak",
                text: "Anda harus login terlebih dahulu.",
                confirmButtonText: "OK"
            });
            </script>');
            redirect(base_url('login'));
            die;
        }
    }

    function hitung_diskon($harga, $persentase_diskon)
    {
        if ($persentase_diskon > 0) {
            $diskon = ($harga * $persentase_diskon) / 100;
            return $harga - $diskon;
        }
        return $harga;
    }

    public function index()
    {
        $pelanggan_id = $this->session->userdata('id');
        $keranjang = $this->Keranjang_model->get_by_pelanggan($pelanggan_id);
        if (!$keranjang) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "info",
                title: "Keranjang Kosong",
                text: "Silahkan Tambahkan Produk ke Keranjang",
                confirmButtonText: "OK"
            });
            </script>');
            redirect(base_url());
        }

        $keranjang_id = $keranjang[0]['id_keranjang'];
        $produk = $this->Keranjang_model->get_detail_keranjang($keranjang_id);
        $total = 0;
        foreach ($produk as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }
        $data['total'] = $total;
        $data['keranjang_id'] = $keranjang[0]['id_keranjang'];
        $data['produk'] = $produk;
        $data['list_kategori'] = $this->Produk_kategori_model->get_all();
        $this->load->view('pelanggan/templates/header');
        $this->load->view('pelanggan/keranjang', $data);
        $this->load->view('pelanggan/templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('id_produk', 'ID Produk', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__tambah_produk_keranjang();
        } else {
            redirect(base_url());
        }
    }

    private function __tambah_produk_keranjang()
    {
        $id_produk = $this->input->post('id_produk');
        $jumlah = $this->input->post('jumlah');
        $pelanggan_id = $this->session->userdata('id');
        $produk = $this->Produk_model->get_by_id($id_produk);
        if (!$produk || $produk['stok'] < $jumlah) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "error",
                title: "Gagal Menambahkan ke Keranjang",
                text: "Produk tidak tersedia atau stok tidak mencukupi.",
                confirmButtonText: "OK"
            });
            </script>');
            redirect(base_url());
            return;
        }

        $keranjang = $this->Keranjang_model->get_by_pelanggan($pelanggan_id);

        if (!$keranjang) {
            $this->db->insert('keranjang', [
                'pelanggan_id' => $pelanggan_id,
                'total' => 0,
            ]);
            $keranjang_id = $this->db->insert_id();
        } else {
            $keranjang_id = $keranjang[0]['id_keranjang'];
        }

        $produk_di_keranjang = $this->Keranjang_produk_model->get_by_produk_keranjang($keranjang_id, $id_produk);

        if ($produk_di_keranjang) {
            $jumlah_baru = $produk_di_keranjang['jumlah'] + $jumlah;
            $this->Keranjang_produk_model->ubah(['jumlah' => $jumlah_baru], $produk_di_keranjang['id_keranjang_produk']);
        } else {
            $this->Keranjang_produk_model->tambah([
                'keranjang_id' => $keranjang_id,
                'produk_id' => $id_produk,
                'jumlah' => $jumlah
            ]);
        }

        $keranjang_produk = $this->Keranjang_produk_model->get_by_keranjang($keranjang_id);
        $total = 0;
        foreach ($keranjang_produk as $item) {
            $produk_data = $this->Produk_model->get_by_id($item['produk_id']);
            if ($produk_data) {
                $total += $produk_data['harga'] * $item['jumlah'];
            }
        }

        $this->Keranjang_model->ubah(['total' => $total], $keranjang_id);
        $this->session->set_flashdata('message', '
        <script>
        Swal.fire({
            icon: "success",
            title: "Berhasil Menambahkan ke Keranjang",
            text: "Produk telah berhasil ditambahkan ke keranjang."
        });
        </script>');
        redirect(base_url('keranjang'));
    }

    public function ubah_keranjang()
    {
        $this->form_validation->set_rules('id_produk', 'ID Produk', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('id_keranjang_produk', 'ID Keranjang Produk', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__ubah_produk_keranjang();
        } else {
            redirect(base_url('keranjang'));
        }
    }

    public function __ubah_produk_keranjang()
    {
        echo "ubah produk keranjang";
        $id_produk = $this->input->post('id_produk');
        $jumlah = $this->input->post('jumlah');
        $id_keranjang_produk = $this->input->post('id_keranjang_produk');

        $keranjang_produk = $this->Keranjang_produk_model->get_by_id($id_keranjang_produk);
        if (!$keranjang_produk) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "error",
                title: "Gagal Mengubah Keranjang",
                text: "Produk tidak ditemukan di keranjang.",
                confirmButtonText: "OK"
            });
            </script>');
            redirect(base_url('keranjang'));
            return;
        }

        $produk = $this->Produk_model->get_by_id($id_produk);
        if (!$produk || $produk['stok'] < $jumlah) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "error",
                title: "Gagal Mengubah Keranjang",
                text: "Produk tidak tersedia atau stok tidak mencukupi.",
                confirmButtonText: "OK"
            });
            </script>');
            redirect(base_url('keranjang'));
            return;
        }

        $this->Keranjang_produk_model->ubah(['jumlah' => $jumlah], $id_keranjang_produk);
        $keranjang_id = $keranjang_produk['keranjang_id'];
        $keranjang_produk = $this->Keranjang_produk_model->get_by_keranjang($keranjang_id);
        $total = 0;
        foreach ($keranjang_produk as $item) {
            $produk_data = $this->Produk_model->get_by_id($item['produk_id']);
            if ($produk_data) {
                $total += $produk_data['harga'] * $item['jumlah'];
            }
        }

        $this->Keranjang_model->ubah(['total' => $total], $keranjang_id);
        $this->session->set_flashdata('message', '
        <script>
        Swal.fire({
            icon: "success",
            title: "Berhasil Mengubah Keranjang",
            text: "Produk telah berhasil diubah di keranjang.",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "' . base_url('keranjang') . '";
            }
        });
        </script>');
        redirect(base_url('keranjang'));
    }

    public function hapus_produk_keranjang()
    {
        $this->form_validation->set_rules('id_keranjang_produk', 'ID Keranjang Produk', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__hapus_produk_keranjang();
        } else {
            redirect(base_url('keranjang'));
        }
    }

    public function __hapus_produk_keranjang()
    {
        $id_keranjang_produk = $this->input->post('id_keranjang_produk');
        $keranjang_produk = $this->Keranjang_produk_model->get_by_id($id_keranjang_produk);
        if (!$keranjang_produk) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "error",
                title: "Gagal Menghapus Produk",
                text: "Produk tidak ditemukan di keranjang.",
            });
            </script>');
            redirect(base_url('keranjang'));
            return;
        }

        $this->Keranjang_produk_model->hapus($id_keranjang_produk);
        $keranjang_id = $keranjang_produk['keranjang_id'];
        $keranjang_produk = $this->Keranjang_produk_model->get_by_keranjang($keranjang_id);

        if (empty($keranjang_produk)) {
            $this->Keranjang_model->hapus($keranjang_id);
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "info",
                title: "Keranjang Kosong",
                text: "Semua produk telah dihapus dari keranjang.",
            });
            </script>');
            redirect(base_url('keranjang'));
            return;
        }

        $total = 0;
        foreach ($keranjang_produk as $item) {
            $produk_data = $this->Produk_model->get_by_id($item['produk_id']);
            if ($produk_data) {
                $total += $produk_data['harga'] * $item['jumlah'];
            }
        }

        $this->Keranjang_model->ubah(['total' => $total], $keranjang_id);
        $this->session->set_flashdata('message', '
        <script>
        Swal.fire({
            icon: "success",
            title: "Berhasil Menghapus Produk",
            text: "Produk telah berhasil dihapus dari keranjang.",
            confirmButtonText: "OK"
        })
        </script>');
        redirect(base_url('keranjang'));
    }
}
