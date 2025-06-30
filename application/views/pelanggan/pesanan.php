<style>
    .card-pesanan {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 24px;
    }

    .card-pesanan:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .card-pesanan .card-header {
        border-bottom: none;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        font-weight: 600;
        padding: 16px 24px;
    }

    .produk-item {
        display: flex;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #f1f1f1;
    }

    .produk-img {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .produk-info {
        flex: 1;
    }

    .produk-nama {
        font-weight: 600;
        margin-bottom: 4px;
        color: #1f2937;
    }

    .produk-detail {
        color: #6b7280;
        font-size: 14px;
    }

    .produk-harga {
        font-weight: 600;
        color: #1f2937;
    }

    .other-products {
        background-color: #f9fafb;
        border-radius: 8px;
        padding: 12px 16px;
        margin-top: 12px;
        font-size: 14px;
        color: #4b5563;
        display: flex;
        align-items: center;
    }

    .other-products i {
        margin-right: 8px;
        color: #3b82f6;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .order-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .order-meta span {
        color: #6b7280;
    }

    .order-meta .total {
        font-weight: 600;
        color: #1f2937;
        font-size: 16px;
    }
</style>

<div class="container mb-5 mt-4">
    <h2 class="mb-4 fw-bold" style="color: #1f2937;">Daftar Pesanan Anda</h2>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-<?= $this->session->flashdata('message_type') ?> alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($pesanan)): ?>
        <div class="text-center py-5">
            <img src="<?= base_url('assets/img/empty-order.png') ?>" alt="Empty order" width="200" class="mb-4">
            <h5 class="text-muted mb-3">Belum ada pesanan</h5>
            <a href="<?= base_url('produk') ?>" class="btn btn-primary px-4">Mulai Belanja</a>
        </div>
    <?php else: ?>
        <?php foreach ($pesanan as $p) : ?>
            <div class="card card-pesanan">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-white text-primary me-2">#<?= $p['id_pesanan'] ?></span>
                        <span class="badge status-badge bg-light text-dark">
                            <?= ucfirst($p['status']) ?>
                        </span>
                    </div>
                    <span><?= date('d M Y, H:i', strtotime($p['tanggal_pesanan'])) ?></span>
                </div>

                <div class="card-body">
                    <div class="order-meta">
                        <span><?= count($p['produk']) ?> item</span>
                        <span class="total">Total: Rp<?= number_format($p['total_pesanan'], 0, ',', '.') ?></span>
                    </div>

                    <!-- Tampilkan produk pertama -->
                    <div class="produk-item">
                        <img src="<?= $p['produk'][0]['gambar'] ?>" alt="<?= $p['produk'][0]['nama_produk'] ?>" class="produk-img">
                        <div class="produk-info">
                            <div class="produk-nama"><?= $p['produk'][0]['nama_produk'] ?></div>
                            <div class="produk-detail">
                                <?= $p['produk'][0]['jumlah'] ?> x Rp<?= number_format($p['produk'][0]['harga'], 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="produk-harga">
                            Rp<?= number_format($p['produk'][0]['jumlah'] * $p['produk'][0]['harga'], 0, ',', '.') ?>
                        </div>
                    </div>

                    <!-- Tampilkan info produk lainnya jika ada -->
                    <?php if (count($p['produk']) > 1): ?>
                        <div class="other-products d-flex align-items-center">
                            <i class="fas fa-box-open me-2" style="font-size:18px;color:#2563eb;"></i>
                            <div>
                                <span class="fw-semibold"><?= count($p['produk']) - 1 ?> produk lainnya</span>
                                <span class="text-muted ms-1">dalam pesanan ini:</span>
                                <ul class="mb-0 ms-3" style="list-style:square;font-size:13px;">
                                    <?php foreach (array_slice($p['produk'], 1, 2) as $prod): ?>
                                        <li><?= htmlspecialchars($prod['nama_produk']) ?> (<?= $prod['jumlah'] ?>x)</li>
                                    <?php endforeach; ?>
                                    <?php if (count($p['produk']) > 3): ?>
                                        <li class="text-muted">+<?= count($p['produk']) - 3 ?> produk lainnya</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer bg-white text-end">
                    <a href="<?= base_url('pesanan/detail/' . $p['id_pesanan']) ?>" class="btn btn-outline-primary me-2">
                        <i class="fas fa-info-circle me-1"></i> Detail
                    </a>
                    <?php if ($p['status'] == 'menunggu pembayaran'): ?>
                        <a href="<?= base_url('pembayaran/' . $p['id_pesanan']) ?>" class="btn btn-primary">
                            <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>