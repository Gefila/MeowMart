<style>
    .product-img {
        width: 100px;
        height: auto;
    }

    .qty-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .qty-btn {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 0;
    }
</style>

<div class="container mb-3 mt-4">
    <h2 class="mb-4">
        Data Pesanan
    </h2>
    <?php if ($this->session->flashdata('message')): ?>
        <?= $this->session->flashdata('message'); ?>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">
                        Produk
                    </th>
                    <th scope="col">
                        Harga
                    </th>
                    <th scope="col">
                        Jumlah
                    </th>
                    <th scope="col">
                        Total
                    </th>
                    <th scope="col">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $total_pesanan = 0; ?>
                <?php foreach ($pesanan as $order): ?>
                    <?php $total_pesanan = $order['total_pesanan']; ?>
                    <?php foreach ($order['produk'] as $item): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= $item['gambar'] ?>"
                                        alt="<?= $item['nama_produk'] ?>" class="product-img me-3">
                                    >
                                    <div>
                                        <strong>
                                            <?= $item['nama_produk'] ?>
                                        </strong>
                                        <small class="text-muted">
                                            Tanggal Pesanan: <?= date('d-m-Y', strtotime($order['tanggal_pesanan'])) ?>
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                Rp. <?= number_format($item['harga'], 0, ',', '.') ?>
                            </td>
                            <td>
                                <span>
                                    <?= $item['jumlah'] ?>
                                </span>
                            </td>
                            <td>
                                <span>
                                    Rp. <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn_secondary" disabled>
                                    Pembayaran
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <tr class="table-light">
                    <td colspan="3" class="text-end">
                        <strong>Total Pesanan:</strong>
                    </td>
                    <td colspan="2">
                        <strong>
                            Rp. <?= number_format($total_pesanan, 0, ',', '.') ?>
                        </strong>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm" disabled>
                            Pembayaran
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>