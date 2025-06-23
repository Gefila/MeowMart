<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Keranjang_model');
        $this->load->model('Keranjang_produk_model');
        $this->load->model('Produk_model');
        $this->load->model('Produk_gambar_model');
        $this->load->model('Pesanan_model');
        $this->load->model('Pesanan_produk_model');
        cek_pelanggan_login();
    }

    public function index() {
        $pelanggan_id = $this->session->userdata('id');
        $pesanan = $this->Pesanan_model->get_by_pelanggan_id($pelanggan_id);
        if (!$pesanan) {
            swal('info', 'Tidak ada pesanan', 'Anda belum memiliki pesanan.');
            redirect('produk');
            return;
        }


        $data['pesanan'] = [];
        foreach ($pesanan as $item) {
            $id_pesanan = $item['id_pesanan'];
            $pesanan_produk = $this->Pesanan_produk_model->get_by_id_pesanan($id_pesanan);
            $produk_data = [];
            foreach ($pesanan_produk as $produk_item) {
                $produk = $this->Produk_model->get_by_id($produk_item['produk_id']);
                if ($produk) {
                    $gambar_produk = $this->Produk_gambar_model->get_by_produk_id($produk_item['produk_id']);
                    $produk_item['harga'] = $produk['harga'];
                    $produk_item['nama_produk'] = $produk['pd_nama'];
                    $produk_item['gambar'] = !empty($gambar_produk) ? base_url('uploads/produk/' . $gambar_produk[0]['nama_gambar']) : null;
                    $produk_data[] = $produk_item;
                }
            }
            $item['produk'] = $produk_data;
            $data['pesanan'][] = $item;
        }
        $this->load->view('pelanggan/templates/header');
        $this->load->view('pelanggan/pesanan', $data);
        $this->load->view('pelanggan/templates/footer');
    }

    public function tambah_pesanan() {
        $pelanggan_id = $this->session->userdata('id');
        $id_keranjang = $this->input->post('keranjang_id');
        $keranjang = $this->Keranjang_model->getKeranjangByIdAndPelanggan($id_keranjang, $pelanggan_id);
        if (!$keranjang) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "error",
                title: "Keranjang tidak ditemukan",
                text: "Keranjang yang Anda pilih tidak valid atau sudah dihapus.",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "' . base_url('keranjang') . '";
                }
            });
            </script>');
            redirect('keranjang');
            return;
        }
        $keranjang_produk = $this->Keranjang_produk_model->get_by_keranjang($id_keranjang);
        $total = 0;
        foreach ($keranjang_produk as $item) {
            $produk = $this->Produk_model->get_by_id($item['produk_id']);
            if ($produk) {
                $total += $produk['harga'] * $item['jumlah'];
            } else {
                $this->session->set_flashdata('message', '
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Produk tidak ditemukan",
                    text: "Salah satu produk dalam keranjang tidak ditemukan.",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "' . base_url('keranjang') . '";
                    }
                });
                </script>');
                redirect('keranjang');
                return;
            }
        }
        $data_pesanan = [
            'pelanggan_id' => $pelanggan_id,
            'tanggal_pesanan' => date('Y-m-d H:i:s'),
            'total_pesanan' => $total,
        ];
        $id_pesanan = $this->Pesanan_model->tambah($data_pesanan);
        if (!$id_pesanan) {
            $this->session->set_flashdata('message', '
            <script>
            Swal.fire({
                icon: "error",
                title: "Gagal menambahkan pesanan",
                text: "Terjadi kesalahan saat menambahkan pesanan. Silakan coba lagi.",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "' . base_url('keranjang') . '";
                }
            });
            </script>');
            redirect('keranjang');
            return;
        }
        foreach ($keranjang_produk as $item) {
            $data_produk = [
                'pesanan_id' => $id_pesanan,
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
            ];
            $produk = $this->Produk_model->get_by_id($item['produk_id']);
            if ($produk) {
                $stok_baru = $produk['stok'] - $item['jumlah'];
                if ($stok_baru < 0) {
                    $this->session->set_flashdata('message', 'Stok tidak cukup untuk produk: ' . $produk['nama']);
                    redirect('keranjang');
                    return;
                }
                $this->Produk_model->ubah(['stok' => $stok_baru], $item['produk_id']);
            }
            $this->Pesanan_produk_model->tambah($data_produk);
        }
        $this->Keranjang_model->hapus($id_keranjang);
        $this->Keranjang_produk_model->hapus_by_keranjang($id_keranjang);
        $this->session->set_flashdata('message', '
        <script>
        Swal.fire({
            icon: "success",
            title: "Pesanan berhasil ditambahkan",
            text: "Pesanan Anda telah berhasil dibuat. Terima kasih telah berbelanja!",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "' . base_url('pesanan') . '";
            }
        });
        </script>
        ');
        redirect('pesanan/detail/' . $id_pesanan);
    }

    public function detail($id) {
        $pelanggan_id = $this->session->userdata('id');
        $pesanan = $this->Pesanan_model->get_by_id($id);
        if (!$pesanan || $pesanan['pelanggan_id'] != $pelanggan_id) {
            $this->session->set_flashdata('message', 'Pesanan tidak ditemukan atau tidak valid.');
            redirect('pesanan');
            return;
        }
        $pesanan_produk = $this->Pesanan_produk_model->get_by_id_pesanan($id);
        $produk_data = [];
        foreach ($pesanan_produk as $item) {
            $produk = $this->Produk_model->get_by_id($item['produk_id']);
            if ($produk) {
                $gambar_produk = $this->Produk_gambar_model->get_by_produk_id($item['produk_id']);
                $item['harga'] = $produk['harga'];
                $item['nama_produk'] = $produk['pd_nama'];
                $item['gambar'] = !empty($gambar_produk) ? base_url('uploads/produk/' . $gambar_produk[0]['nama_gambar']) : null;
                $produk_data[] = $item;
            }
        }
        $data['pesanan'] = [
            'id_pesanan' => $pesanan['id_pesanan'],
            'tanggal_pesanan' => date('d M Y, H:i', strtotime($pesanan['tanggal_pesanan'])),
            'total_pesanan' => number_format($pesanan['total_pesanan'], 0, ',', '.'),
            'produk' => $produk_data,
        ];

        $this->load->view('pelanggan/templates/header');
        $this->load->view('pelanggan/pesanan_detail', $data);
        $this->load->view('pelanggan/templates/footer');
    }
}
