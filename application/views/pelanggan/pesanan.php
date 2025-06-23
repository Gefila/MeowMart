<style>
    .card-pesanan {
        border-radius: 1rem;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .card-pesanan .card-header {
        border-bottom: 1px solid #dee2e6;
        background: linear-gradient(135deg, #007bff, #00c3ff);
        color: white;
        font-weight: 600;
    }

    .list-group-item {
        border: none;
        border-bottom: 1px solid #f1f1f1;
        padding: 1rem 0;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .produk-img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 0.5rem;
    }
</style>

<div class="container mb-3 mt-4">
    <h2 class="mb-4">
        Data Pesanan
    </h2>
    <?php if ($this->session->flashdata('message')): ?>
        <?= $this->session->flashdata('message'); ?>
    <?php endif; ?>

    <?php foreach ($pesanan as $p) : ?>
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <strong>ID Pesanan: <?= $p['id_pesanan'] ?></strong>
                <span class="float-end"><?= date('d M Y, H:i', strtotime($p['tanggal_pesanan'])) ?></span>
            </div>
            <div class="card-body">
                <p><strong>Total Pesanan:</strong> Rp<?= number_format($p['total_pesanan'], 0, ',', '.') ?></p>
                <hr>
                <h6 class="mb-3">Daftar Produk:</h6>
                <ul class="list-group list-group-flush">
                    <?php foreach ($p['produk'] as $produk) : ?>
                        <li class="list-group-item d-flex align-items-center">
                            <img src="<?= $produk['gambar']; ?>" alt="<?= $produk['nama_produk'] ?>" width="60" class="me-3 rounded">
                            <div class="flex-grow-1">
                                <div><strong><?= $produk['nama_produk'] ?></strong></div>
                                <div class="text-muted">Qty: <?= $produk['jumlah'] ?> x Rp<?= number_format($produk['harga'], 0, ',', '.') ?></div>
                            </div>
                            <div class="fw-bold text-end">
                                Rp<?= number_format($produk['jumlah'] * $produk['harga'], 0, ',', '.') ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-footer text-end">
                <a href="<?= base_url('pesanan/detail/' . $p['id_pesanan']) ?>" class="btn btn-primary">
                    Detail Pesanan
                </a>
            </div>
        </div>
    <?php endforeach; ?>

</div>