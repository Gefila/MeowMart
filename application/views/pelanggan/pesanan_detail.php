<style>
    .detail-pesanan {
        max-width: 800px;
        margin: auto;
    }

    .produk-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
    }

    .produk-item:last-child {
        border-bottom: none;
    }

    .produk-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.75rem;
    }

    .produk-info {
        flex-grow: 1;
        margin-left: 1rem;
    }

    .produk-info .nama {
        font-weight: 600;
        color: #333;
    }

    .produk-info .detail {
        font-size: 0.9rem;
        color: #777;
    }

    .produk-total {
        font-weight: 600;
        color: #007bff;
        white-space: nowrap;
    }

    .card-summary {
        border-radius: 1rem;
        background: #f9f9f9;
        padding: 1rem;
    }
</style>

<div class="detail-pesanan mt-5">
    <?php if ($this->session->flashdata('message')): ?>
        <?= $this->session->flashdata('message'); ?>
    <?php endif; ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Detail Pesanan</h5>

            <div class="mb-2"><strong>ID Pesanan:</strong> <?= $pesanan['id_pesanan'] ?></div>
            <div class="mb-2"><strong>Tanggal Pesanan:</strong> <?= date('d M Y, H:i', strtotime($pesanan['tanggal_pesanan'])) ?></div>
            <div class="mb-2"><strong>Status:</strong> <span class="badge bg-success">Selesai</span></div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h6 class="mb-3">Produk yang Dipesan</h6>
            <?php foreach ($pesanan['produk'] as $produk) : ?>
                <div class="produk-item">
                    <img src="<?= $produk['gambar'] ?>" class="produk-img" alt="<?= $produk['nama_produk'] ?>">
                    <div class="produk-info">
                        <div class="nama"><?= $produk['nama_produk'] ?></div>
                        <div class="detail">Qty: <?= $produk['jumlah'] ?> x Rp<?= number_format($produk['harga'], 0, ',', '.') ?></div>
                    </div>
                    <div class="produk-total">
                        Rp<?= number_format($produk['jumlah'] * $produk['harga'], 0, ',', '.') ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="card-summary shadow-sm mb-5">
        <div class="d-flex justify-content-between mb-2">
            <span>Subtotal</span>
            <span>
                Rp<?= number_format((int)str_replace('.', '', $pesanan['total_pesanan']), 0, ',', '.') ?>
            </span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span>Ongkos Kirim</span>
            <span>Rp<?= number_format($pesanan['ongkir'] ?? 0, 0, ',', '.') ?></span>
        </div>
        <hr>
        <div class="d-flex justify-content-between fw-bold">
            <span>Total Bayar</span>
            <span>
                Rp<?= number_format((int)str_replace('.', '', $pesanan['total_pesanan']) + ($pesanan['ongkir'] ?? 0), 0, ',', '.') ?>
            </span>
        </div>
    </div>

    <div>
        <a href="<?= base_url('pesanan') ?>" class="btn btn-primary">Kembali ke Daftar Pesanan</a>
        <a href="<?= base_url('pembayaran/' . $pesanan['id_pesanan']) ?>" class="btn btn-success">
            Bayar Sekarang
        </a>
    </div>

</div>