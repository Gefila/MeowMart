<style>
    .product-img {
        width: 60px;
        height: auto;
        margin-right: 10px;
        border-radius: 5px;
    }

    .product-info {
        display: flex;
        align-items: center;
    }

    .qty-control {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        height: 100%;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        text-align: center;
        font-size: 16px;
        line-height: 1;
    }

    td, th {
        vertical-align: middle !important;
        text-align: center;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .table td,
    .table th {
        padding: 1rem;
    }

    .total-row {
        font-weight: bold;
        font-size: 1.1rem;
        background-color: #f8f9fa;
    }
</style>

<div class="container mb-3 mt-4">
    <h2 class="mb-4">Keranjang Belanja</h2>

    <?php if ($this->session->flashdata('message')): ?>
        <?= $this->session->flashdata('message'); ?>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table align-middle table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grand_total = 0;
                foreach ($produk as $item):
                    $sub_total = $item['harga_akhir'] * $item['jumlah'];
                    $grand_total += $sub_total;
                ?>
                    <tr>
                        <td class="text-start">
                            <div class="product-info">
                                <img src="<?= base_url('uploads/produk/' . (!empty($item['gambar'][0]['nama_gambar']) ? $item['gambar'][0]['nama_gambar'] : 'image-placeholder.jpg')) ?>" alt="<?= $item['pd_nama']; ?>" class="product-img">
                                <?= $item['pd_nama']; ?>
                            </div>
                        </td>
                        <td> 
                            <?php if (!empty($item['harga_akhir']) && $item['harga_akhir'] < $item['harga']): ?>
                                <span class="text-decoration-line-through text-muted">Rp. <?= number_format($item['harga'], 0, ',', '.'); ?></span>
                                <span class="text-danger">Rp. <?= number_format($item['harga_akhir'], 0, ',', '.'); ?></span>
                            <?php else: ?>
                                Rp. <?= number_format($item['harga'], 0, ',', '.'); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="qty-control">
                                <form action="<?= base_url('keranjang/ubah/') ?>" method="post" class="d-inline">
                                    <input type="hidden" name="id_keranjang_produk" value="<?= $item['id_keranjang_produk']; ?>">
                                    <input type="hidden" name="id_produk" value="<?= $item['id_produk']; ?>">
                                    <input type="hidden" name="jumlah" value="<?= $item['jumlah'] - 1 ?>">
                                    <button type="submit" class="btn btn-secondary qty-btn" <?= ($item['jumlah'] <= 1 ? 'disabled' : '') ?>>−</button>
                                </form>
                                <span><?= $item['jumlah']; ?></span>
                                <form action="<?= base_url('keranjang/ubah/') ?>" method="post" class="d-inline">
                                    <input type="hidden" name="id_keranjang_produk" value="<?= $item['id_keranjang_produk']; ?>">
                                    <input type="hidden" name="id_produk" value="<?= $item['id_produk']; ?>">
                                    <input type="hidden" name="jumlah" value="<?= $item['jumlah'] + 1 ?>">
                                    <button type="submit" class="btn btn-secondary qty-btn">+</button>
                                </form>

                            </div>
                        </td>
                        <td>Rp. <?= number_format($sub_total, 0, ',', '.'); ?></td>
                        <td>
                            <form action="<?= base_url('keranjang/hapus/') ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?');">
                                <input type="hidden" name="id_keranjang_produk" value="<?= $item['id_keranjang_produk']; ?>">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <!-- Optional: Grand Total -->
                <tr class="total-row">
                    <td colspan="3" class="text-end">Total Keseluruhan</td>
                    <td colspan="2" class="text-center">
                        Rp. <?= number_format($grand_total, 0, ',', '.'); ?>
                        <form action="<?= base_url('pesanan/tambah')?>" method="post" onsubmit="confirm('Apakah anda yakin ingin checkout')">
                            <input type="hidden" name="keranjang_id" value="<?= $keranjang_id; ?>">
                            <button type="submit" class="btn btn-success mt-2">Checkout</button>
                        </form>
                </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
