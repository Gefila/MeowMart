<style>
    :root {
        --primary: #4361ee;
        --primary-light: #e6eaf8;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --danger: #f72585;
        --warning: #f8961e;
        --info: #4895ef;
        --dark: #212529;
        --light: #f8f9fa;
        --border-radius: 12px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .order-detail-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .order-card {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--box-shadow);
        overflow: hidden;
        margin-bottom: 2rem;
        transition: transform 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-3px);
    }

    .order-header {
        background-color: var(--primary);
        color: white;
        padding: 1.5rem;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .order-header h2 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .order-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-icon {
        font-size: 1.2rem;
    }

    .product-item {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-item:hover {
        background-color: var(--primary-light);
    }

    .product-image {
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 8px;
        border: 1px solid #eee;
        background: white;
        padding: 0.5rem;
    }

    .product-info {
        flex: 1;
        margin-left: 1.5rem;
    }

    .product-name {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .product-price {
        color: #666;
        font-size: 0.95rem;
    }

    .product-total {
        font-weight: 700;
        color: var(--primary);
        min-width: 120px;
        text-align: right;
    }

    .summary-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px dashed #eee;
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .total-row {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--primary);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        flex-wrap: wrap;
    }

    .btn-primary {
        background-color: var(--primary);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-danger {
        background-color: var(--danger);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
    }

    .btn-outline {
        background-color: white;
        border: 1px solid var(--primary);
        color: var(--primary);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-outline:hover {
        background-color: var(--primary-light);
        transform: translateY(-2px);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .badge-diproses {
        background-color: #cce5ff;
        color: #004085;
    }

    .badge-dikirim {
        background-color: #d4edda;
        color: #155724;
    }

    .badge-selesai {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .badge-dibatalkan {
        background-color: #f8d7da;
        color: #721c24;
    }

    .progress-tracker {
        margin: 2rem 0;
        padding: 1.5rem;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
    }

    .tracker-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-top: 2rem;
    }

    .tracker-steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 3px;
        background: #eee;
        z-index: 1;
    }

    .tracker-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 2;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
        color: #999;
        font-weight: bold;
    }

    .step-label {
        font-size: 0.8rem;
        color: #999;
        text-align: center;
    }

    .step-active .step-icon {
        background: var(--primary);
        color: white;
    }

    .step-active .step-label {
        color: var(--primary);
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .product-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-info {
            margin-left: 0;
            margin-top: 1rem;
        }

        .product-total {
            margin-top: 1rem;
            text-align: left;
            width: 100%;
        }

        .action-buttons {
            justify-content: center;
        }
    }

    .payment-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .payment-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .payment-image-container {
        border: 1px dashed #ddd;
        border-radius: var(--border-radius);
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 200px;
    }

    .payment-image {
        max-width: 100%;
        max-height: 180px;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    .payment-info {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .payment-info-item {
        display: flex;
        justify-content: space-between;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f5f5f5;
    }

    .payment-info-item:last-child {
        border-bottom: none;
    }

    .payment-info-label {
        font-weight: 600;
        color: #666;
    }

    .payment-info-value {
        color: var(--dark);
    }

    .payment-status {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .payment-status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .payment-status-terverifikasi {
        background-color: #d4edda;
        color: #155724;
    }

    .payment-status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .btn-payment-details {
        background-color: var(--info);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
    }

    .btn-payment-details:hover {
        background-color: #3a7bd5;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(58, 123, 213, 0.2);
    }

    .btn-payment-details i {
        margin-right: 8px;
    }
</style>

<div class="order-detail-container">
    <!-- Flash message -->
    <?php if ($this->session->flashdata('message')): ?>
        <?= $this->session->flashdata('message'); ?>
    <?php endif; ?>

    <!-- Order Header Card -->
    <div class="order-card">
        <div class="order-header">
            <h2>Order #<?= $pesanan['id_pesanan'] ?></h2>
            <div class="order-meta">
                <div class="meta-item">
                    <i class="fa fa-calendar meta-icon"></i>
                    <span><?= date('d M Y, H:i', strtotime($pesanan['tanggal_pesanan'])) ?></span>
                </div>
                <div class="meta-item">
                    <i class="fa-solid fa-hashtag"></i> <span class="status-badge badge-<?= $pesanan['status'] ?>">
                        <?= ucfirst($pesanan['status']) ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Order Progress Tracker -->
        <div class="progress-tracker">
            <h5>
                <i class="fa-solid fa-truck me-2"></i>
                Order Status
            </h5>
            <div class="tracker-steps">
                <div class="tracker-step <?= in_array($pesanan['status'], ['pending', 'diproses', 'dikirim', 'selesai']) ? 'step-active' : '' ?>">
                    <div class="step-icon">1</div>
                    <div class="step-label">Order Placed</div>
                </div>
                <div class="tracker-step <?= in_array($pesanan['status'], ['diproses', 'dikirim', 'selesai']) ? 'step-active' : '' ?>">
                    <div class="step-icon">2</div>
                    <div class="step-label">Processing</div>
                </div>
                <div class="tracker-step <?= in_array($pesanan['status'], ['dikirim', 'selesai']) ? 'step-active' : '' ?>">
                    <div class="step-icon">3</div>
                    <div class="step-label">Shipped</div>
                </div>
                <div class="tracker-step <?= $pesanan['status'] == 'selesai' ? 'step-active' : '' ?>">
                    <div class="step-icon">4</div>
                    <div class="step-label">Delivered</div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card-body">
            <h5 class="mb-4">
                <i class="fa-solid fa-box me-2"></i>
                Order Items
            </h5>
            <?php foreach ($pesanan['produk'] as $produk) : ?>
                <div class="product-item">
                    <img src="<?= $produk['gambar'] ?>" class="product-image" alt="<?= $produk['nama_produk'] ?>">
                    <div class="product-info">
                        <div class="product-name"><?= $produk['nama_produk'] ?></div>
                        <div class="product-price">
                            <?= $produk['jumlah'] ?> × Rp<?= number_format($produk['harga'], 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="product-total">
                        Rp<?= number_format($produk['jumlah'] * $produk['harga'], 0, ',', '.') ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Payment Information Section (Added) -->
    <?php if (isset($pembayaran) && $pembayaran !== null && $pembayaran['bukti_pembayaran']  !== null) : ?>
        <div class="payment-card">
            <h5 class="mb-3">
                <i class="fa-solid fa-credit-card me-2"></i>
                Payment Information
            </h5>
            <div class="payment-details">
                <div class="payment-image-container">
                    <?php if (!empty($pembayaran['bukti_pembayaran'])) : ?>
                        <img src="<?= base_url('uploads/bukti-pembayaran/') . $pembayaran['bukti_pembayaran'] ?>" class="payment-image" alt="Payment Proof">
                        <a href="<?= base_url('uploads/bukti-pembayaran/') . $pembayaran['bukti_pembayaran'] ?>" target="_blank" class="btn btn-sm btn-outline mt-2">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> View Full Image
                        </a>
                    <?php else : ?>
                        <i class="fa-solid fa-receipt text-muted" style="font-size: 3rem;"></i>
                        <span class="text-muted mt-2">No payment proof uploaded</span>
                    <?php endif; ?>
                </div>

                <div class="payment-info">
                    <div class="payment-info-item">
                        <span class="payment-info-label">Payment ID:</span>
                        <span class="payment-info-value">#<?= $pembayaran['id_pembayaran'] ?></span>
                    </div>
                    <div class="payment-info-item">
                        <span class="payment-info-label">Payment Date:</span>
                        <span class="payment-info-value"><?= date('d M Y, H:i', strtotime($pembayaran['tanggal_pembayaran'])) ?></span>
                    </div>
                    <div class="payment-info-item">
                        <span class="payment-info-label">Amount Paid:</span>
                        <span class="payment-info-value">Rp<?= number_format($pembayaran['total_bayar'], 0, ',', '.') ?></span>
                    </div>
                    <div class="payment-info-item">
                        <span class="payment-info-label">Payment Status:</span>
                        <span class="payment-info-value">
                            <span class="payment-status payment-status-<?= $pembayaran['status'] ?>">
                                <?= ucfirst($pembayaran['status']) ?>
                            </span>
                        </span>
                    </div>
                    <?php if ($pembayaran['status'] == 'pending') : ?>
                        <div class="payment-info-item">
                            <span class="payment-info-label">Note:</span>
                            <span class="payment-info-value text-warning">
                                Your payment is being verified by our team
                            </span>
                        </div>
                    <?php endif; ?>
                    <div class="text-end mt-3">
                        <a href="<?= base_url('pembayaran/' . $pesanan['id_pesanan']) ?>" class="btn btn-payment-details">
                            <i class="fa-solid fa-credit-card me-2"></i>View Payment Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Order Summary -->
    <div class="summary-card">
        <h5 class="mb-4">
            <i class="fa-solid fa-receipt me-2"></i>
            Order Summary
        </h5>
        <div class="summary-row">
            <span>Subtotal</span>
            <span>Rp<?= number_format((int)str_replace('.', '', $pesanan['total_pesanan']), 0, ',', '.') ?></span>
        </div>
        <div class="summary-row">
            <span>Shipping Fee</span>
            <span>Rp<?= number_format($pesanan['ongkir'] ?? 0, 0, ',', '.') ?></span>
        </div>
        <div class="summary-row total-row">
            <span>Total Payment</span>
            <span>Rp<?= number_format((int)str_replace('.', '', $pesanan['total_pesanan']) + ($pesanan['ongkir'] ?? 0), 0, ',', '.') ?></span>
        </div>
    </div>


    <!-- Action Buttons (Updated) -->
    <div class="action-buttons">
        <a href="<?= base_url('pesanan') ?>" class="btn btn-outline">
            <i class="fa-solid fa-arrow-left me-2"></i>Back to Orders
        </a>

        <?php if ($pesanan['status'] == 'pending') : ?>
            <?php if (isset($pembayaran) && $pembayaran !== null) : ?>
                <!-- Show different button if payment exists but order is still pending -->
                <a href="<?= base_url('pembayaran/' . $pesanan['id_pesanan']) ?>" class="btn btn-primary">
                    <i class="fa-solid fa-credit-card me-2"></i>Payment Details
                </a>
            <?php else : ?>
                <!-- Show Pay Now button if no payment exists -->
                <a href="<?= base_url('pembayaran/' . $pesanan['id_pesanan']) ?>" class="btn btn-primary">
                    <i class="fa-solid fa-credit-card me-2"></i>Pay Now
                </a>
                <a href="<?= base_url('pesanan/cancel/' . $pesanan['id_pesanan']) ?>" class="btn btn-danger">
                    <i class="fa-solid fa-circle-xmark me-2"></i>Cancel Order
                </a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($pesanan['status'] == 'selesai') : ?>
            <a href="<?= base_url('produk') ?>" class="btn btn-primary">
                <i class="fa-solid fa-cart-plus me-2"></i>Beli Lagi
            </a>
        <?php endif; ?>
    </div>
</div>